<?php

namespace App\Http\Controllers;

use App\Mail\AccountsCreated;
use App\Models\ITechGroup;
use App\Models\OperationsAccount;
use App\Models\SavingsAccount;
use App\Models\WelfareAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;
use Throwable;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class ITechGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $groups = ITechGroup::all();
        if (count($groups) !== 0) {
            $saving = $groups[0]->savingsAccount()->first();
            return response($saving);
        }

        return response($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $request->validate(['id' => 'required|int', 'code' => 'required|string', 'name' => 'required|string',
            'representativeFirstName' => 'required|string', 'representativePhone' => 'required|string',
            'representativeEmail' => 'required|string|email', 'accounts' => 'required|string']);
        try {
            DB::transaction(function () use ($request) {
                $group = new ITechGroup();
                $group->id = $request->input('id');
                $group->code = $request->input('code');
                $group->name = $request->input('name');
                $group->representativeFirstName = $request->input('representativeFirstName');
                $group->representativePhone = $request->input('representativePhone');
                $group->representativeEmail = $request->input('representativeEmail');
                $groupSaved = $group->save();

                if ($groupSaved && is_string($request->input('accounts'))) {
                    $accounts = json_decode($request->input('accounts'), true, 512, JSON_THROW_ON_ERROR);
                    var_dump($accounts);

                    if ($accounts !== null) {
                        // Cast to array
                        $accountsArray = array($accounts);
                        $accountsData = json_decode($accountsArray[0], true, 512, JSON_THROW_ON_ERROR);
                        var_dump(['Savings' => (string)$accountsData[0]['id'], 'Operations' => (string)$accountsData[1]['id'],
                            'Welfare' => (string)$accountsData[2]['id']]);
                        // Handle the case of recording the savings account
                        $savingsAccount = new SavingsAccount();
                        if (count($accountsData[0]) !== 0) {
                            $savingsAccount->fill(['id' => $accountsData[0]['id'], 'codage' => $accountsData[0]['codage'],
                                'name' => $accountsData[0]['name'], 'numcpt' => $accountsData[0]['numcpt'],
                                'grpCode' => $accountsData[0]['grpCode'], 'numcli' => $accountsData[0]['numcli'],
                                'accType' => $accountsData[0]['accType'], 'initialBal' => $accountsData[0]['initialBal'],
                                'applyComis' => $accountsData[0]['applyComis'], 'isBlocked' => $accountsData[0]['isBlocked']
                            ]);
                            $savingsAccount->save();
                        }

                        // Handle the case of recording the operations account
                        $operationsAccount = new OperationsAccount();
                        if (count($accountsData[1]) !== 0) {
                            $operationsAccount->fill(['id' => $accountsData[1]['id'], 'codage' => $accountsData[1]['codage'],
                                'name' => $accountsData[1]['name'], 'numcpt' => $accountsData[1]['numcpt'],
                                'grpCode' => $accountsData[1]['grpCode'], 'numcli' => $accountsData[1]['numcli'],
                                'accType' => $accountsData[1]['accType'], 'initialBal' => $accountsData[1]['initialBal'],
                                'applyComis' => $accountsData[1]['applyComis'], 'isBlocked' => $accountsData[1]['isBlocked']
                            ]);
                            $operationsAccount->save();
                        }

                        // Handle the case of recording the welfare account
                        $welfareAccount = new WelfareAccount();
                        if (count($accountsData[2]) !== 0) {
                            $welfareAccount->fill(['id' => $accountsData[2]['id'], 'codage' => $accountsData[2]['codage'],
                                'name' => $accountsData[2]['name'], 'numcpt' => $accountsData[2]['numcpt'],
                                'grpCode' => $accountsData[2]['grpCode'], 'numcli' => $accountsData[2]['numcli'],
                                'accType' => $accountsData[2]['accType'], 'initialBal' => $accountsData[2]['initialBal'],
                                'applyComis' => $accountsData[2]['applyComis'], 'isBlocked' => $accountsData[2]['isBlocked']
                            ]);
                            $welfareAccount->save();
                        }
                    }
                }

                Mail::to($group->representativeEmail)->send(new AccountsCreated($group));
                $this->sendSMS($group);

            }, 2);
            return response(['message' => 'Group accounts created successfully'], ResponseCodes::HTTP_CREATED);
        } catch (Throwable $exception) {
            return response(['message' => 'An error occurred, please try again. If it persists please contact support',
                'extra' => $exception->getMessage(), 'code' => $exception->getCode(), 'class' => get_class($exception),
                'trace' => $exception->getTraceAsString()], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return Response
     */
    public function show(string $id): Response
    {
        $group = ITechGroup::find($id);
        return response($group);
    }

    /**
     * Update the specified email field in storage.
     *
     * And send bank details to new email
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function update(Request $request, string $id): Response
    {
        return response($id);
    }

    /**
     * @throws ConfigurationException
     * @throws TwilioException
     */
    public function sendSMS(ITechGroup $group): MessageInstance
    {
//        Using BulkSMS
//        $response = Http::withBasicAuth(env('BULK_SMS_API_TOKEN'), env('BULK_SMS_API_SECRET'))->acceptJson()
//            ->post(env('BULK_SMS_BASE_URL') . "/messages", [
//                'from' => '17032983994',
//                'to' => '+237677551755',
//                'body' => 'Testing values \n\n Pether',
//                'encoding' => 'UNICODE'
//            ]);

        $twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $message = $twilio->messages->create('+2347047390150', ['from' => env('TWILIO_MESSAGE_SERVICE_ID'),
            'body' => "Dear " . ucwords($group->representativeFirstName) . ", the group " . ucwords($group->name) . " successfully created at: " . $group->created_at .
                ". Here are the accounts: Savings:" . $group->savingsAccount->numcpt
                . ", Operations:" . $group->operationsAccount->numcpt
                . ", Welfare:" . $group->welfareAccount->numcpt . "\nThank you for using Pether Digital Services"]);
        print_r($message->toArray());
        return $message;
    }
}
