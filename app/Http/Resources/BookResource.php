<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'title' => $this->title,
            'cover_full_URL'=>$this->getFirstMediaUrl('books_images'),
            'price' => $this->price,
            'authors'=>$this->authors->implode('name',', '),
            'description' => $this->when($request->book, $this->description),
            'genres'=>$this->genres->implode('name',', '),
        ];
    }
}
