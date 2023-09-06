<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable= [
        'companyName',
        'logo',
        'slogan',
        'email',
        'phone'
    ];
    use HasFactory;
}
