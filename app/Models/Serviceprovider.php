<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Serviceprovider extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'sp_id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'service_type',
        'address',
        'approve_status',
        'image_url',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
