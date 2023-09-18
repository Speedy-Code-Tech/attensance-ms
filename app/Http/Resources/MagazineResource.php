<?php

// app/Http/Resources/MagazineResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MagazineResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'issue' => $this->issue,
            'pdf_url' => asset('storage/' . $this->pdf_path),
            'thumbnail_url' => $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}