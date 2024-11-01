<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number'];

    // Add any specific methods if needed
}
