<?php

namespace App\Http\Requests\Api\Owners\Coupons;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends APIRequest
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
            'name' => 'required',
            'discount' => 'required|gt:0|lt:50',
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after:from',
            'number_of_use' => 'required|gt:0',
            'status' => 'required|boolean',
            'realestate_ids.*' => 'required',
        ];
    }

    public function add()
    {
        $this['code'] = generateRandomCode(substr($this->name, 0, 3));
        $this['owner_id'] = Auth::guard('owner')->id();

        $coupon =  Coupon::create($this->all());

        foreach ($this['realestate_ids'] as $key => $realestate) {
            DB::table('coupon_realestate')->insert([
                'realestate_id' => $realestate,
                'coupon_id' => $coupon->id,
            ]);
        }
    }
}
