<?php

namespace App\Http\Controllers\Api\Customers\V1\Auth;

use Carbon\Carbon;
use App\Models\Verify;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Customers\CustomerResource;
use App\Http\Requests\Api\Customers\Auth\LoginRequest;
use App\Http\Requests\Api\Customers\Auth\VerifyRequest;
use App\Http\Requests\Api\Customers\Auth\RegisterRequest;
use App\Http\Requests\Api\Customers\Auth\ChangePasswordRequest;

class AuthController extends Controller
{
    /**
     * Register new user
     * @param  RegisterRequest $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        $customer =  $request->add();

        $this->sendCode($request->mobile, $customer->id, 'register');

        return $this->successStatus(__("send code to your number"));
    }
    /**
     * Send Code Use SMS 
     * @param  LoginRequest $request
     * @return mixed
     */
    public function sendCode($mobile, $user_id, $type)
    {
        $verificationCode = 4444;
        //$verificationCode = mt_rand(1000, 9999);
        Verify::create([
            'user_id' => $user_id,
            'mobile' => $mobile,
            'verification_code' => $verificationCode,
            'user_type' => 'customer',
            'type' => $type,
            'verification_expiry_minutes' => Carbon::now()->addMinute(5),
        ]);
        $mobile = (int)$mobile;
        $message = "Your verification code is: {$verificationCode}";

        // SMS 
        //  $senderFactory = new SenderFactory();
        //  $senderFactory->initialize('sms', $mobile, $message);

        return $this->successStatus(__('Send SMS Successfully Please Check Your Phone ' . $verificationCode));
    }
    /**
     * Check Captains 
     * @param  VerifyRequest $request
     * @return mixed
     */
    public function check(VerifyRequest $request)
    {
        $customer = Customer::whereMobile($request->mobile)->first();

        //check if passenger has verification code
        $verify = Verify::whereMobile($request->mobile)->where('user_type', 'customer')->latest()->first();

        if (empty($verify->verification_code)) {
            return $this->errorStatus(__('Verification code is missing'));
        }

        if ($verify->verification_code != $request->verification_code) {
            return $this->errorStatus(__('Verification code is wrong'));
        }

        if (Carbon::parse($verify->verification_expiry_minutes)->lte(Carbon::now())) {
            return $this->errorStatus(__('Verification code is expired'));
        }
        $verify->delete();

        // if ($request->type == 'change-password') {
        //     return $this->successStatus(__('Verification code is valid'));
        // }

        $customer->update(['verified_at' => now()]);

        return $this->respondWithItem(new CustomerResource($customer));
    }
    /**
     * Login
     * @param  LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $hash = app('hash');
        $customer = Customer::whereMobile($request->mobile)->first();

        if (!$hash->check($request->password, $customer->password)) {
            return $this->errorStatus(__('Your  Mobile or Password are Wrong'));
        }

        if (!$customer->verified_at) {
            return $this->errorStatus(__('not verified'));
        }
        $token = $customer->createToken('Token-Login')->accessToken;

        $customer->update([
            'remember_token' => $token,
            'device_token' => $request->device_token,
        ]);
        /*
        $data = DB::table('oauth_access_tokens')->where('user_id',$passenger->id)->get();

        if($data){
           DB::table('oauth_access_tokens')->where('user_id',$passenger->id)->delete();
          }
          */
        return $this->respondWithItem(new CustomerResource($customer));
    }




    /**
     * Send Code Use SMS 
     * @param  LoginRequest $request
     * @return mixed
     */
    public function verifyChangePassword(ChangePasswordRequest $request)
    {
        $customer = Customer::where('mobile', $request->mobile)->first();
        $this->sendCode($request->mobile, $customer->id, 'change-password');

        return $this->successStatus(__('Send SMS Successfully Please Check Your Phone'));
    }
    /**
     * Send Code Use SMS 
     * @param  LoginRequest $request
     * @return mixed
     */
    public function changePassword(Request $request)
    {
        $customer = Customer::where('mobile', $request->mobile)->first();
        $customer->update(['password' => bcrypt($request->new_password)]);

        return $this->respondWithItem(new CustomerResource($customer));
    }


    /**
     * Logout Passenger
     * @return mixed
     */
    public function logout()
    {
        Auth::user()->token()->revoke();

        return $this->successStatus(__('successfully logout'));
    }
}
