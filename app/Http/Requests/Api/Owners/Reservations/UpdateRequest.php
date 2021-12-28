<?php

namespace App\Http\Requests\Api\Owners\RealEstates;

use App\Models\RealEstate;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends APIRequest
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
        $realEstate =  RealEstate::find($id);

        foreach ($this['images'] as $key => $image) {
            DB::table('realestate_media')->insert([
                'realestate_id' => $realEstate->id,
                'image' => $image,
            ]);
        }
        foreach ($this['price'] as $key => $price) {
            DB::table('realestate_price')->insert([
                'realestate_id' => $realEstate->id,
                'price' => $price,
            ]);
        }
    }
}
