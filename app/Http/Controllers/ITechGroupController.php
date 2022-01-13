<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
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
use Swift_TransportException;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;
use Throwable;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class ITechGroupController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        try {
            $groups = ITechGroup::all();
            foreach ($groups as $group) {
                $savings = $group->savingsAccount;
                $operations = $group->operationsAccount;
                $welfare = $group->welfareAccount;
            }
            return $this->successResponse(['groups' => $groups, 'count' => count($groups)]);
        } catch (\Exception $exception) {
            report($exception);
            return $this->errorResponse('Error getting group accounts', $exception, ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
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
            $group = new ITechGroup();
            $group->id = $request->input('id');
            $group->code = $request->input('code');
            $group->name = $request->input('name');
            $group->representativeFirstName = $request->input('representativeFirstName');
            $group->representativePhone = $request->input('representativePhone');
            $group->representativeEmail = $request->input('representativeEmail');

            DB::transaction(function () use ($group, $request) {
                $groupSaved = $group->save();

                if ($groupSaved && is_string($request->input('accounts'))) {
                    $accountsData = json_decode($request->input('accounts'), true, 512, JSON_THROW_ON_ERROR);

                    if ($accountsData !== null) {
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

            return $this->successResponse('Group accounts created successfully', [],
                ResponseCodes::HTTP_CREATED);
        } catch (Throwable $exception) {
            report($exception);
//            if ($exception instanceof Swift_TransportException) {
//                return $this->errorResponse('Group accounts saved but failed to send notifications. Resend notifications manually',
//                    $exception, ResponseCodes::HTTP_INTERNAL_SERVER_ERROR, ['sentEmail' => $emailSent,
//                        'sendSms' => $smsSent]);
//            }
            if ($exception->getCode() === "23000") {
                return $this->errorResponse('Group accounts already saved',
                    $exception, ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
            }
            return $this->errorResponse('Error saving group accounts. If it persists, please contact support',
                $exception, ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
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
     * Resend email or sms notification or both.
     *
     * @param Request $request
     * @param string $code
     * @return Response
     */
    public function sendNotification(Request $request, string $code): Response
    {
        $emailSent = false;
        $smsSent = false;
        $notificationType = $request->input('type');
        $group = ITechGroup::find($code);

        try {
            if ($group !== null) {
                if (isset($notificationType)) {
                    if ($notificationType === 'email') {
                        Mail::to($group->representativeEmail)->send(new AccountsCreated($group));
                        $emailSent = true;
                        return $this->successResponse('Email notifications sent', ['sentEmail' => $emailSent]);
                    }
                    if ($notificationType === 'sms') {
                        $this->sendSMS($group);
                        $smsSent = true;
                        return $this->successResponse('Sms notifications sent', ['sendSms' => $smsSent]);
                    }
                }
                Mail::to($group->representativeEmail)->send(new AccountsCreated($group));
                $emailSent = true;
                $this->sendSMS($group);
                $smsSent = true;
                return $this->successResponse('Notifications sent', ['sentEmail' => $emailSent, 'sendSms' => $smsSent]);
            }
            return $this->errorResponse('Group not found', null, ResponseCodes::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            report($exception);
            return $this->errorResponse('An internal error occurred. If it persists, please contact support',
                $exception, ResponseCodes::HTTP_INTERNAL_SERVER_ERROR, ['sentEmail' => $emailSent,
                    'sendSms' => $smsSent]);
        }
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

//        todo: Replace hardcoded phone number with variable
        $twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        return $twilio->messages->create('+2347047390150', ['from' => env('TWILIO_MESSAGE_SERVICE_ID'),
            'body' => "Dear " . ucwords($group->representativeFirstName) . ", the group " . ucwords($group->name) . " successfully created at: " . $group->created_at .
                ". Here are the accounts: Savings:" . $group->savingsAccount->numcpt
                . ", Operations:" . $group->operationsAccount->numcpt
                . ", Welfare:" . $group->welfareAccount->numcpt . "\nThank you for using Pether Digital Services"]);
    }
}
