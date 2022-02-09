<?php

namespace App\Http\Requests\Api\Customers\Reviews;

use App\Http\Requests\Api\APIRequest;

class StoreReviewRequest extends APIRequest
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
            'real_estate_id' => 'required|exists:realestates,id',
            'rate' => 'required|integer|in:1,2,3,4,5',
            'note' => 'required',
        ];
    }
}
