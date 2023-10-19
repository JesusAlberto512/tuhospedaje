<?php

namespace App\Http\Controllers;

use App\Models\LoginCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginCodesRequest;
use App\Http\Requests\UpdateLoginCodesRequest;

class LoginCodesController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoginCodesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoginCodesRequest $request)
    {
        if($request->ajax()){
            LoginCodes::create($request->validated());
            return view('login.view');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Http\Response
     */
    public function show(LoginCodes $loginCodes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginCodes $loginCodes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoginCodesRequest  $request
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoginCodesRequest $request, LoginCodes $loginCodes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginCodes $loginCodes)
    {
        //
    }
}
