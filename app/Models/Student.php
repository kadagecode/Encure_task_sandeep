<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable=[
        'email',
        'password',
        'state',
        'city',
        'branch',
    ];


    protected $hidden =[
        'password',
        'remember_token',
    ];

    protected $casts=[
        'email_verified_at' => 'datetime',
    ];
    
}
