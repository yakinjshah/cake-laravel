<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductGallaryResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category,
            'quantity' => $this->quantity,
            'image' => $this->image,
            'description' => $this->description,
            'price' => $this->price,
            'sku' => $this->sku,
            'total_review' => $this->total_review,
            'total_ratting' => $this->total_ratting,
            'image_gallary' => ProductGallaryResource::collection($this->image_gallary),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        //return parent::toArray($request);
    }
}
