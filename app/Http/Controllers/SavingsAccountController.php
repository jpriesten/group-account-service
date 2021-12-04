<?php

namespace App\Http\Controllers;

use App\Models\SavingsAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class SavingsAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param mixed $account
     * @return Response
     */
    public function store(Request $request, $account = null): Response
    {
        return Response(['message' => 'Created'], ResponseCodes::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SavingsAccount  $savingsAccount
     * @return \Illuminate\Http\Response
     */
    public function show(SavingsAccount $savingsAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SavingsAccount  $savingsAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SavingsAccount $savingsAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SavingsAccount  $savingsAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SavingsAccount $savingsAccount)
    {
        //
    }
}
