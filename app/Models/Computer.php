<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Computer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lab_id',
        'name',
        'model',
        'status',
    ];

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class, 'lab_id');
    }

    public function setLabIdAttribute($value)
    {
        $this->attributes['lab_id'] = $value;

        if ($this->getOriginal('lab_id') != $value) {
            $this->attributes['assigned_date'] = Carbon::today()->toDateString();
        }
    }

    public static function getComputersWithLab(): Collection
    {
        return self::with('laboratory:id,name')->get();
    }
}
