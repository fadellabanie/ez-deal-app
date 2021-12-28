<?php

namespace App\Http\Requests\Api\Owners\Reservations;

use App\Models\RealEstate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends APIRequest
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
            'realestate_id' => 'required|exists:realestates,id',
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after:from',      
        ];
    }
   
}
