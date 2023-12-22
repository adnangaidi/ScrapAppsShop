<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'file_name' => $this->file_name,
            'src'       => $this->getUrl(),
            'thumb'     => $this->getUrl('thumb'),
            'mime_type' => $this->mime_type,
            'size'      => $this->size,
        ];
    }
}
