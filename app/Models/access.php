<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class access extends Model
{
    use HasFactory;
    public function permissions():BelongsToMany
    {
        return $this->belongsToMany(permissions::class,'permissions_access');
    }
}
