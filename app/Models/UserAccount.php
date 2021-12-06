<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'uname',
        'name',
        'age',
        'city',
        'image'
    ];
}
