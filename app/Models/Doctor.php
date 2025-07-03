<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctor'; // your custom table name
    protected $primaryKey = 'DID'; // your custom PK
    public $timestamps = false; // disable timestamps if your table doesn't have created_at/updated_at

    protected $fillable = ['name', 'phone', 'email'];

        public function appointments()
{
    return $this->hasMany(Appointment::class, 'DID', 'DID');
}
 
        // foreign key in appointment table, local key in doctor table
    }

