<?php

namespace Src\Catalog\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['slug', 'name', 'latin', 'grow_days', 'yield_min_g', 'yield_max_g', 'tag', 'is_active', 'content'])]
class VarietyModel extends Model
{
    protected $table = 'varieties';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'grow_days' => 'integer',
            'yield_min_g' => 'integer',
            'yield_max_g' => 'integer',
            'is_active' => 'boolean',
            'content' => 'array',
        ];
    }
}
