<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class permissions extends Model
{
    use HasFactory;
    public function userGroup():BelongsToMany
    {
        return $this->belongsToMany(userGroup::class , 'user_group_permissions');
    }
    public function access ():BelongsToMany
    {
        return $this->belongsToMany(access::class, 'permissions_access');
    }
}
