<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

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
        // Validate input fields
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required'
        ]);

        // Create and store the appointment
        Appointment::create($request->all());

        // Redirect back to the doctor's appointments page
        return redirect()->route('doctor.appointments', $request->doctor_id)
                         ->with('success', 'Appointment booked successfully!');
    }

    // These are unused in your current project, but left for resource structure
    public function index() {}
    public function show(Appointment $appointment) {}
    public function edit(Appointment $appointment) {}
    public function update(Request $request, Appointment $appointment) {}
    public function destroy(Appointment $appointment) {}
}
