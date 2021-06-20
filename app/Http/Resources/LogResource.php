<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->causer_id == null) {
            return [
                'description' => $this->description,
                'book_title' => \App\Models\Book::withTrashed()->find($this->subject_id)->title,
                'username' => 'پیش فرض',
                'time' => $this->created_at
            ];
        } else {
            return [
                'description' => $this->description,
                'book_title' => \App\Models\Book::withTrashed()->find($this->subject_id)->title,
                'username' => \App\Models\User::find($this->causer_id)->name,
                'time' => $this->created_at
            ];
        }
    }
}
