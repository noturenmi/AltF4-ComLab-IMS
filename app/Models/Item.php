<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'quantity',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function setQuantityAttribute($value): void
    {

        $this->attributes['quantity'] = $value;

        if ($this->getOriginal('quantity') != $value) {
            $this->attributes['status'] =
            $value > 10 ? 'Available' :
            ($value > 0 ? 'Low Stock' : 'Out of Stock');
        }
    }

    public static function getLowStock()
    {
        return self::where('status', '=', 'Low Stock')->get();
    }
}
