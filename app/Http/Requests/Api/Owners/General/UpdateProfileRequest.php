<?php

namespace App\Http\Requests\Api\Owners\General;

use App\Models\Owner;
use App\Models\RealEstate;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ];
    }
    public function edit($id)
    {
        Owner::whereId($id)->update([
            'first_name' => $this['first_name'],
            'last_name' => $this['last_name'],
            'mobile' => $this['mobile'],
            'email' => $this['email'],
        ]);
    }
}
