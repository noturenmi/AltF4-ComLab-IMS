<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'item_id');
    }

    public static function getLowStock()
    {
        return self::where('status', '=', 'Low Stock')->get();
    }
}
