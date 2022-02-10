<?php

namespace App\Http\Resources\Owners;

use Carbon\Carbon;
use App\Models\RealEstate;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total_my_realestate = RealEstate::mine()->count();
        $total_reserved_realestate = RealEstate::reserved()->count();
        $total_not_reserved_realestate = RealEstate::notReserved()->count();
        return [
            'active' => true,
            'id' => $this->id,
            'username' => $this->first_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'avatar' => asset($this->avatar),
            'total_my_realestate' => $total_my_realestate,
            'total_reserved_realestate' => $total_reserved_realestate,
            'total_not_reserved_realestate' => $total_not_reserved_realestate,
            'token_type' => 'Bearer',
            'access_token' => $this->remember_token,
        ];
    }
}
