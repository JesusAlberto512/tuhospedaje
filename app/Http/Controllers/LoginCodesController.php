<?php

namespace App\Http\Controllers;

use App\Models\LoginCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginCodesRequest;
use App\Http\Requests\UpdateLoginCodesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Models\{Settings};
use Illuminate\Support\Facades\Log;

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
        Log::channel('custom')->info($request->get('phone') );
        //dd($request);
        Log::channel('custom')->info($request);
        $code = mt_rand(100000, 999999);
        Log::channel('custom')->error($code);
        Log::channel('custom')->emergency($request->ajax());
        $validated = $request->validated();
        Log::channel('custom')->warning($validated);
        $loginCode = LoginCodes::create(['verification_code' => $code,
            'carrier_code' => $request->get('carrier_code'),
            'phone' => $request->get('phone') ,
        ]);
        Log::channel('custom')->info('LoginCode {id} success.', ['id' => $loginCode->code_id]);
        return redirect()->route('validate-mobile') ->with('loginCode', $loginCode);

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
        return view('home.validate_authentication')->with('loginCode', session('loginCode'));
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
        Log::channel('custom')->info($request);
        Log::channel('custom')->info($loginCodes);
        if (LoginCodes::verifyCode($request->get('field04'), $request->get('field06'), $request->get('field02'))){
            return redirect()->route('validate-mobile') ->with('error', 'Codigo Verificado');
        }else{
            Log::channel('custom')->error("Error");
            $loginCodes->setAttribute('code_id', $request->get('field02'));
            $loginCodes->setAttribute('phone', $request->get('field04'));
            return redirect()->route('validate-mobile') ->with('loginCode', $loginCodes);
        }
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
