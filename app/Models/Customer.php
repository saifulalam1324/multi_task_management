<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $primaryKey = 'c_id';
    protected $fillable = ['name', 'email', 'password'];
    protected $table = 'customers';
}
