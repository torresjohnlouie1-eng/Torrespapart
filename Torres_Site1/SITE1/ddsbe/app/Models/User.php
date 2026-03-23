<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // This line tells Lumen: "Ignore the default name, use my specific table"
    protected $table = 'tbluser'; 

    protected $primaryKey = 'userId';
    protected $fillable = ['username', 'password', 'gender'];
    public $timestamps = false;
}