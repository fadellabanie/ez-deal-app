<?php

namespace App\Http\Resources\Owners;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Boolean;

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
        return [
            'id' => $this->id,
            'username' => $this->first_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'avatar' => asset($this->avatar),
            'is_dark' => (Boolean) $this->is_dark,
            'created_at' => (string) $this->created_at,
            'verified' =>(string) $this->verified_at,
            'token_type' => 'Bearer',
            'access_token' => $this->remember_token,
        ];
    }
}
