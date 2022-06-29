<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;


    protected $table = "admins";
    protected $fillable = ['name','email','password'];

    public $timestamps = false;
}
