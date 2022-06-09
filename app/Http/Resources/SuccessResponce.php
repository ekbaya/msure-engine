<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResponce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "success" => true,
            "status" => 0,
            "message" => "success",
            "data" => $request->data
        ];
    }
}
