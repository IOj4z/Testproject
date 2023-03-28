<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResourse extends JsonResource
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
            'id'=> $this->id,
            'phone'=> $this->phone,
            'file'=> $this->file,
            'email'=> $this->email,
            'last_name'=> $this->last_name,
            'created_at'=> $this->created_at,
        ];
    }
}
