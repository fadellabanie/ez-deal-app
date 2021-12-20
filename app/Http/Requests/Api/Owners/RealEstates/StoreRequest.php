<?php

namespace App\Http\Requests\Api\Owners\RealEstates;

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
            'realestate_type_id' => 'required|exists:realestate_types,id',
            'city_id' => 'required|exists:cities,id',
            'ar_name' => 'required',
            'en_name' => 'required',
            'space' => 'required',
            'guest_type' => 'required',
            'guest_count' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'is_sleep' => 'required',
            'wc_count' => 'required',
            'wc_prepared' => 'required',
            'living_room' => 'required',
            'bed_room' => 'required',
            'smail_bed_count' => 'required',
            'large_bed_count' => 'required',
            'kitchen_count' => 'required',
            'kitchen_prepared' => 'required',
            'price' => 'nullable',
            'enter_time' => 'required',
            'leave_time' => 'required',
            'is_overnight' => 'required',
            'image' => 'required',
            'images.*' => 'required',
            'description' => 'required',
            'note' => 'required',
            'status' => 'required',
            'attributes.*' => 'required',
            'prices.*' => 'required',
            'days.*' => 'required',
        ];
    }
    public function add()
    {
        $this['owner_id'] = Auth::id();
        $this['price'] = floatval($this['prices'][0]);
        $this['country_id'] = 1;
        $this['is_active'] = false;

        $realEstate =  RealEstate::create($this->all());

       
        foreach ($this['images'] as $key => $image) {
            DB::table('realestate_media')->insert([
                'realestate_id' => $realEstate->id,
                'image' => $image,
            ]);
        }
        foreach ($this['prices'] as $key => $price) {
            DB::table('realestate_price')->insert([
                'realestate_id' => $realEstate->id,
                'day_id' => $this['days'][$key],
                'price' => $price,
            ]);
        }
        foreach ($this['attributes'] as $key => $attribute) {
            DB::table('realestate_attributes')->insert([
                'realestate_id' => $realEstate->id,
                'attribute_id' => $attribute,
            ]);
        }
    }
}
