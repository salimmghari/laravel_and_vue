<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class NoteResource extends JsonResource {
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return parent::toArray($request);
    }
}
