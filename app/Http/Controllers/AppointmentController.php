<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AppointmentController extends Controller
{
    /**
     * Show the form to create a new appointment for a doctor.
     */
    public function create($id)
    {
        // Find the doctor by ID to pass to the form
        $doctor = Doctor::findOrFail($id);
        return view('appointments.create', compact('doctor'));
    }

    /**
     * Store a newly created appointment in the database.
     */
   public function store(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctor,DID',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required'
    ]);

    $alreadyBooked = DB::table('appointment')
        ->where('DID', $request->doctor_id)
        ->where('day', $request->appointment_date)
        ->where('time', $request->appointment_time)
        ->whereNotIn('status', ['cancelled', 'rejected']) // optional filter
        ->exists();

    if ($alreadyBooked) {
        return back()->with('error', 'This slot is already booked for this doctor.');
    }

    DB::table('appointment')->insert([
        'UID' => Session::get('user')->UID,
        'DID' => $request->doctor_id,
        'day' => $request->appointment_date,
        'time' => $request->appointment_time,
        'status' => 'pending'
    ]);

    return redirect()->route('user.dashboard')->with('success', 'Appointment booked!');
}



public function getAvailableSlots(Request $request)
{
    $doctorId = $request->doctor_id;
    $date = $request->date;

    // All slots (can customize here)
    $allSlots = [
        '09:00', '09:30', '10:00', '10:30',
        '11:00', '11:30', '12:00',
        '12:30', '13:00', '14:00','14:30','15:00'
    ];

    // Already booked time slots
    $booked = DB::table('appointment')
        ->where('DID', $doctorId)
        ->where('day', $date)
        ->pluck('time')
        ->toArray();

    // Filter out booked slots
    $available = array_values(array_diff($allSlots, $booked));

    return response()->json($available);
}



    // These are unused in your current project, but left for resource structure
    public function index() {}
    public function show(Appointment $appointment) {}
    public function edit(Appointment $appointment) {}
    public function update(Request $request, Appointment $appointment) {}
    public function destroy(Appointment $appointment) {}
}
