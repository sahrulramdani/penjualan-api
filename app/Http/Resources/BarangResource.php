<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'KODE' => $this->KODE,
            'NAMA' => $this->NAMA,
            'KATEGORI' => $this->KATEGORI,
            'HARGA' => $this->HARGA,
        ];
    }
}
