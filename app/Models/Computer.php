<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Computer extends Model
{
    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class, 'lab_id');
    }

    public static function getComputersWithLab(): Collection
    {
        return self::with('laboratory:id,name')->get();
    }
}
