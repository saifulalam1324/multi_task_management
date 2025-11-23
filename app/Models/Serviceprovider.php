<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Serviceprovider extends Authenticatable
{
    protected $primaryKey = 'sp_id';
    protected $fillable = ['name', 'email', 'password', 'phone', 'service_type', 'address'];
    protected $table = 'serviceproviders';
}
