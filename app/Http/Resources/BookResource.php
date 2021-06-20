<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'user_id' => $this->user_id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'year' => $this->year,
            'price' => $this->price,
            'validation' => $this->validation,
            'stock' => $this->stock->number,
            'ratings' => $this->ratings,
        ];
    }
}
