<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable=
    [
        'branchName',
        'logo',
        'slogan',
        'location',
        'phone',
        'companies_id'
    ];
    use HasFactory;
}
