<?php

namespace App\Http\Requests\Api\Owners\Discounts;

use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends APIRequest
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
            'weekly_discount' => 'required|gt:0|lt:50',
            'status' => 'required|boolean',
            'realestate_ids.*' => 'required',
        ];
    }

    public function add()
    {
        $this['code'] = generateRandomCode(substr($this->name, 0, 3));
        $this['owner_id'] = Auth::guard('owner')->id();

        $discount =  Discount::create($this->all());

        foreach ($this['realestate_ids'] as $realestate) {
            DB::table('discount_realestate')->insert([
                'realestate_id' => $realestate,
                'discount_id' => $discount->id,
            ]);
        }
    }
}
