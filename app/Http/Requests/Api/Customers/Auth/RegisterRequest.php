<?php

namespace App\Http\Requests\Api\Customers\Auth;

use App\Http\Requests\Api\APIRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prefix' => 'required',
            'first_name' => 'required|min:4|max:100',
            'last_name' => 'required|min:4|max:100',
            'email' =>  'required|unique:customers,email',
            'country_code' =>  ['required'],
            'mobile' =>  ['required','unique:customers,mobile'],
            'password' => 'required|min:8|max:15',
            'birthday' => 'required',
            'gender' => 'required',
            'device_token' => 'required',
        ];
    }
    public function add()
    {
        $this['code'] = generateRandomCode('cus');
        $this['password'] = Hash::make($this['password']);

        $customer = Customer::create($this->all());

        $token = $customer->createToken('Token-Login')->accessToken;
        
        $customer->update([
            'remember_token' => $token
        ]);

        return $customer;
    }
}
