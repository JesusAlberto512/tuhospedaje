<?php

namespace App\Http\Controllers;

use App\Models\LoginCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginCodesRequest;
use App\Http\Requests\UpdateLoginCodesRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\{Settings};

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
        $data['social'] = Settings::getAll()->where('type','social')->pluck('value','name');
        return view('home.authenticate', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLoginCodesRequest $request
     * @return RedirectResponse|void
     */
    public function store(StoreLoginCodesRequest $request)
    {
        Log::emergenci($request);
        $code = mt_rand(100000, 999999);
        Log::info($code);
        Log::notice($request->ajax());
        $validated = $request->validated();
        if($request->ajax()){
            if($validated){
                LoginCodes::created(['verification_code' => $code,
                    'carrier_code' => $request->input('carrier_code'),
                    'phone' => 'formatted_phone']);
                //LoginCodes::create($request->validated());
                return redirect()->route('validate-mobile') ->with('response', 'Codigo enviado correctamente');
            }else{
                abort(404);
            }

        }else{
            abort(404);
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
