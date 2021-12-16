<?php

namespace App\Http\Requests\Api\Owners\RealStates;

use App\Models\RealEstate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'description' => 'required',
            'space' => 'required',
            'room' => 'required',
            'wc' => 'required',
            'guests' => 'required',
            'image' => 'required',
            'bed' => 'required',
            'note' => 'required',
            'enter_time' => 'required',
            'leave_time' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'images.*' => 'required',
            'prices.*' => 'required',
        ];
    }
    public function add()
    {
        $this['owner_id'] = Auth::id();
        $this['price'] = $this['prices'][0];
        $this['status'] = false;

        $realEstate =  RealEstate::create($this->all());

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
