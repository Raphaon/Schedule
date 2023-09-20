<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userGroupPermission extends Model
{
    protected $fillable=[
        'user_group_id','permissions_id'
    ];
    // protected $table=
    use HasFactory;
}
