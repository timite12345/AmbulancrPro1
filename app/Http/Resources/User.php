<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'tel' => $this->tel,
            'adresse' => $this->adresse,
            'email' => $this->email,
        ];
    }
}
