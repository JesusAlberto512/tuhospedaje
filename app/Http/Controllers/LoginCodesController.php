<?php

namespace App\Http\Controllers;

use App\Models\LoginCodes;
use App\Http\{
    Controllers\Controller,
    Controllers\EmailController,

};
use App\Http\Requests\StoreLoginCodesRequest;
use App\Http\Requests\UpdateLoginCodesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Models\{Settings, User};
use Illuminate\Support\Facades\Log;
use Auth, Validator, Socialite, DateTime, Hash, DB, Session, Common;

class LoginCodesController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
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
        if($loginCode != null && $loginCode->code_id != null){
            Log::channel('custom')->info('LoginCode {$id} success.', ["id" => $loginCode->code_id]);
            Log::info('Showing the user profile for user: {id}', ["id" => $loginCode->code_id]);
            Log::info('Enviando mensaje');
            $response = Common::sendWhatsApp($request->get('carrier_code').$request->get('phone'), $code);
            $data = json_decode($response);
            if($data->sent){
                Log::info("Mensaje response {data}", ["data" => $data]);
                Log::info('Mensaje Enviado');
                return redirect()->route('validate-mobile') ->with('loginCode', $loginCode);
            }else{
                Log::error("Mensaje No enviado: response {data}", ["data" => $data]);
            }
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
        return view('home.validate_authentication')->with('loginCode', session('loginCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoginCodesRequest  $request
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return RedirectResponse
     */
    public function update(UpdateLoginCodesRequest $request, LoginCodes $loginCodes)
    {
        Log::channel('custom')->info("update".$request);
        Log::channel('custom')->info("update".$loginCodes);
        if (LoginCodes::verifyCode($request->get('field04'), $request->get('validation_code'), $request->get('field02'))){
            if(User::allReadyExist($request->get('field00'), $request->get('field04'))){
                $user = User::where('carrier_code', $request->get('field00'))->where('phone', $request->get('field04'))->first();
                Log::info("us {%user%} ", ["user" => $user]);
                if($user != null){
                    if (Auth::attempt(['email' => $user->email, 'password' => $user->password])) {
                        $this->helper->one_time_message('success', __('You have registered successfully.').'');
                        return redirect()->intended('dashboard');
                    } else {
                        $this->helper->one_time_message('danger', __('Log In Failed. Please Check Your Email/Password.'));
                        return redirect('login');
                    }
                } else {
                    $this->helper->one_time_message('danger', __('Log In Failed. Please Check Your Email/Password.'));
                    return redirect('login');
                }
            }else{
                $loginCodes->setAttribute('code_id', $request->get('field02'));
                $loginCodes->setAttribute('phone', $request->get('field04'));
                return redirect()->route('registration')->with('loginCode', $loginCodes);
            }

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
