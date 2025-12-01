<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

    public static function withTotalQuantity()
    {
        return self::withCount('items')->withSum('items', 'quantity');
    }
}
