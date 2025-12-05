<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'type',
        'user_id',
        'remarks',
    ];

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

    public static function logCreate(User $user, Model $parent, ?Model $child = null)
    {
        $parentName = class_basename($parent);
        $childName = class_basename($child) ?: false;
        $remark = '';

        if ($childName) {
            $remark = "$childName $child->id has been assigned to $parentName $parent->id.";
        } else {
            $remark = "$parentName $parent->id has been created.";
        }

        self::create([
            'type' => 'CREATE',
            'user_id' => "$user->id",
            'remarks' => $remark,
        ]);
    }

    public static function logUpdate(User $user, ?Model $parent = null, ?Model $child = null)
    {
        $parentName = class_basename($parent);
        $childName = class_basename($child);
        $remark = '';

        if ($child) {
            if (empty($parent->id)) {
                $remark = "$childName $child->id has been unassigned.";
            } else {
                $remark = "$childName $child->id has been assigned to $parentName $parent->id.";
            }
        } else {
            $remark = "$parentName $parent->id has been updated.";
        }

        self::create([
            'type' => 'UPDATE',
            'user_id' => "$user->id",
            'remarks' => $remark,
        ]);
    }

    public static function logDelete(User $user, Model $model)
    {
        $modelName = class_basename($model);
        $remark = "$modelName $model->id has been deleted.";

        self::create([
            'type' => 'DELETE',
            'user_id' => "$user->id",
            'remarks' => $remark,
        ]);
    }
}
