<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'status'];

    public function computers()
    {
        return $this->hasMany(Computer::class, 'lab_id');
    }

    public static function withComputerStats()
    {
        return self::withCount([
            'computers',
            'computers as active_count' => function ($query) {
                $query->where('status', 'Active');
            },
            'computers as inactive_count' => function ($query) {
                $query->where('status', 'Inactive');
            },
            'computers as maintenance_count' => function ($query) {
                $query->where('status', 'Maintenance');
            },
        ]);
    }
}
