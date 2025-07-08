<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:doctor,email',
            'password' => 'required|string|min:6'
        ]);

        DB::table('doctor')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Doctor added successfully.');
    }

    public function showLogin()
    {
        return view('doctor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $doctor = DB::table('doctor')->where('email', $request->email)->first();

        if ($doctor && Hash::check($request->password, $doctor->password)) {
            Session::put('doctor', $doctor);
            return redirect()->route('doctor.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Session::forget('doctor');
        return redirect()->route('doctor.login');
    }

    public function dashboard()
    {
        $doctor = Session::get('doctor');

        $appointments = DB::table('appointment')
            ->join('user', 'appointment.UID', '=', 'user.UID')
            ->where('appointment.DID', $doctor->DID)
            ->where('appointment.payment_status', 'approved')
            ->select('appointment.*', 'user.name as patient_name')
            ->get();

        return view('doctor.dashboard', compact('doctor', 'appointments'));
    }

    public function updateStatus(Request $request)
    {
        DB::table('appointment')
            ->where('Anum', $request->Anum)
            ->update(['appointment_status' => $request->status]);

        return back()->with('success', 'Status updated successfully.');
    }

    public function showRescheduleForm($Anum)
    {
        $appointment = DB::table('appointment')
            ->join('user', 'appointment.UID', '=', 'user.UID')
            ->where('appointment.Anum', $Anum)
            ->select('appointment.*', 'user.name as patient_name', 'user.email as patient_email')
            ->first();

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        if ($appointment->appointment_status === 'completed') {
            return redirect()->back()->with('error', 'Completed appointments cannot be rescheduled.');
        }

        $allSlots = [
            '09:00', '09:30', '10:00', '10:30',
            '11:00', '11:30', '12:00',
            '12:30', '13:30', '14:00','14:30','15:00'
        ];

        $bookedSlots = DB::table('appointment')
            ->where('day', $appointment->day)
            ->where('DID', $appointment->DID)
            ->where('Anum', '!=', $appointment->Anum)
            ->pluck('time')
            ->toArray();

        $availableSlots = array_values(array_diff($allSlots, $bookedSlots));

        return view('doctor.reschedule', compact('appointment', 'availableSlots'));
    }

    public function rescheduleAppointment(Request $request)
    {
        $request->validate([
            'Anum' => 'required|exists:appointment,Anum',
            'new_day' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addDays(14)->format('Y-m-d'),
            'new_time' => 'required|in:09:00,09:30,10:00,10:30,11:00,11:30,12:00,02:00,02:30,03:00'
        ]);

        $appointment = DB::table('appointment')
            ->join('user', 'appointment.UID', '=', 'user.UID')
            ->join('doctor', 'appointment.DID', '=', 'doctor.DID')
            ->where('appointment.Anum', $request->Anum)
            ->select(
                'appointment.*',
                'user.name as patient_name',
                'user.email as patient_email',
                'doctor.name as doctor_name',
                'doctor.email as doctor_email'
            )
            ->first();

        if ($appointment->appointment_status === 'completed') {
            return back()->with('error', 'You cannot reschedule a completed appointment.');
        }

        $existing = DB::table('appointment')
            ->where('day', $request->new_day)
            ->where('time', $request->new_time)
            ->where('DID', $appointment->DID)
            ->where('Anum', '!=', $appointment->Anum)
            ->first();

        if ($existing) {
            return back()->with('error', 'Time slot already booked.');
        }

        DB::table('appointment')->where('Anum', $request->Anum)->update([
            'day' => $request->new_day,
            'time' => $request->new_time,
            'status' => 'rescheduled'
        ]);

        // Send to patient
        Mail::send('emails.reschedule_notice', [
            'patientName' => $appointment->patient_name,
            'doctorName' => $appointment->doctor_name,
            'newDay' => $request->new_day,
            'newTime' => $request->new_time
        ], function ($message) use ($appointment) {
            $message->to($appointment->patient_email)
                    ->subject('Your Appointment Has Been Rescheduled');
        });

        // Send to doctor
        Mail::send('emails.reschedule_notice', [
            'patientName' => $appointment->patient_name,
            'doctorName' => $appointment->doctor_name,
            'newDay' => $request->new_day,
            'newTime' => $request->new_time
        ], function ($message) use ($appointment) {
            $message->to($appointment->doctor_email)
                    ->subject('Appointment with ' . $appointment->patient_name . ' Rescheduled');
        });

        return redirect()->route('doctor.dashboard')->with('success', 'Appointment rescheduled and emails sent.');
    }

    public function showRecordForm($Anum)
    {
        $appointment = DB::table('appointment')->where('Anum', $Anum)->first();
        $record = DB::table('medical_records')->where('Anum', $Anum)->first();

        return view('doctor.record_form', compact('appointment', 'record'));
    }

    public function storeRecord(Request $request, $Anum)
    {
        $request->validate([
            'issue' => 'required',
            'medicine' => 'required',
            'notes' => 'nullable',
        ]);

        $existing = DB::table('medical_records')->where('Anum', $Anum)->first();

        if ($existing) {
            DB::table('medical_records')->where('Anum', $Anum)->update([
                'issue' => $request->issue,
                'medicine' => $request->medicine,
                'notes' => $request->notes,
                'updated_at' => now()
            ]);
        } else {
            DB::table('medical_records')->insert([
                'Anum' => $Anum,
                'issue' => $request->issue,
                'medicine' => $request->medicine,
                'notes' => $request->notes,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return back()->with('success', 'Medical record saved.');
    }
}
