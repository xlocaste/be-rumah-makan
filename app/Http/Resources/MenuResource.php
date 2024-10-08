<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this -> id,
            'nama' => $this -> nama,
            'kategori' => $this -> kategori,
            'rumah_makan_id' => $this -> rumah_makan_id,
            'stok' => $this -> stok,
            'created_at' => $this -> created_at,
            'updated_at' => $this -> updated_at,

            'rumah_makan' => new RumahMakanResource($this->whenLoaded('rumah_makan')),
        ];
    }
}
