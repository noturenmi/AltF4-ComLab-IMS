<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /**
     * @return BelongsTo<User,Transaction>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getTransactionsToday()
    {
        return self::whereDate('created_at', today())->get();
    }

    /**
     * @return Collection<int,Transaction>
     */
    public static function getTransactionsWithUser(): Collection
    {
        return self::with('user:id,first_name,last_name')->get();
    }
}
