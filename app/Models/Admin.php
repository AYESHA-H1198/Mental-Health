<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'AID';
    public $timestamps = false;

    protected $fillable = ['name', 'phone', 'email'];
}
