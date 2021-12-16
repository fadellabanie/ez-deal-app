<?php

namespace App\Http\Requests\Api\Owners\RealStates;

use App\Models\RealEstate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
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
            'realestate_type_id' => 'required|exists:realestate_types,id',
            'city_id' => 'required|exists:cities,id',
            'name' => 'required',
            'space' => 'required',
            'room' => 'required',
            'wc' => 'required',
            'guests' => 'required',
            'bed' => 'required',
            'note' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'images.*' => 'required',
            'price.*' => 'required',
        ];
    }
    public function edit($id)
    {
        RealEstate::whereId($id)->update($this->all());
    }
}
