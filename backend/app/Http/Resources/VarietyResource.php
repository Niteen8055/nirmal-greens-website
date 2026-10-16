<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Catalog\Domain\Variety\Variety;

class VarietyResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Variety $this->resource */
        return [
            'slug' => $this->resource->slug(),
            'name' => $this->resource->name(),
            'latin' => $this->resource->latin(),
            'grow_days' => $this->resource->growDays(),
            'yield_min_g' => $this->resource->yieldMinG(),
            'yield_max_g' => $this->resource->yieldMaxG(),
            'tag' => $this->resource->tag(),
            'is_active' => $this->resource->isActive(),
            'content' => $this->resource->content(),
        ];
    }
}
