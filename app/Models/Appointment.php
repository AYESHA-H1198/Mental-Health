<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Appointment extends Model
{
    protected $table = 'appointment';        // your actual table name
    protected $primaryKey = 'AID';           // set if your primary key is not "id"
    public $timestamps = false;              // set this if your table doesn’t have created_at/updated_at

    protected $fillable = ['DID', 'appointment_date', 'appointment_time'];

    public function doctor()
{
    return $this->belongsTo(Doctor::class, 'DID', 'DID');
}
 public function user()
    {
        return $this->belongsTo(User::class, 'UID', 'UID'); // ADD THIS METHOD
    }
}
