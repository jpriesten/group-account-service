<?php

namespace App\Http\Controllers;

use App\Models\OperationsAccount;
use Illuminate\Http\Request;

class OperationsAccountController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $account = null)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OperationsAccount  $operationsAccount
     * @return \Illuminate\Http\Response
     */
    public function show(OperationsAccount $operationsAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OperationsAccount  $operationsAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OperationsAccount $operationsAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OperationsAccount  $operationsAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperationsAccount $operationsAccount)
    {
        //
    }
}
