<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vault extends Model
{
    protected $fillable = ['perangkat', 'username', 'password', 'level', 'expires_at'];
}