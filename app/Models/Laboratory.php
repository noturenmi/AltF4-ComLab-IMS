<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
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
