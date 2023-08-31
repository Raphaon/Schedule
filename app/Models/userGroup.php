<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class userGroup extends Model
{
    use HasFactory;

    public function user():HasMany
    {
        return $this->hasMany(User::class);
    }
    public function permissions():BelongsToMany
    {
        return $this->belongsToMany(permissions::class , 'user_group_permissions');
    }
}
