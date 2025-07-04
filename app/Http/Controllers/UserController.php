<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showRegister() {
        return view('user.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required|min:4'
        ]);

        // Insert into 'user' table
        $uid = DB::table('user')->insertGetId([
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        // Insert into 'register' table
        DB::table('register')->insert([
            'UID' => $uid,
            'name' => $request->email,
            'pass' => $request->password  // In future: use Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Account created. Please login.');
    }

    public function showLogin() {
        return view('user.login');
    }

    public function login(Request $request) {
        $user = DB::table('register')->where('name', $request->email)->first();

        if ($user && $request->password == $user->pass) {
            Session::put('user', $user);
            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function dashboard() {
        $user = Session::get('user');

        $doctors = DB::table('doctor')->get();

        $appointments = DB::table('appointment')
            ->join('doctor', 'appointment.DID', '=', 'doctor.DID')
            ->where('appointment.UID', $user->UID)
            ->select('appointment.*', 'doctor.name as doctor_name')
            ->get();

        return view('user.dashboard', compact('user', 'doctors', 'appointments'));
    }

    public function logout() {
        Session::forget('user');
        return redirect('/login');
    }

    public function showDoctors() {
        $doctors = DB::table('doctor')->get();
        return view('doctor', compact('doctors'));
    }

    public function showAppointmentForm($DID) {
        $doctor = DB::table('doctor')->where('DID', $DID)->first();
        return view('appointment', compact('doctor'));
    }

    public function bookAppointment(Request $request) {
    $uid = Session::get('user')->UID;

    // Define allowed time slots
    $allowedTimes = ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '02:00', '02:30', '03:00'];

    // Validate basic inputs
    $request->validate([
        'day' => 'required|date',
        'time' => 'required|in:' . implode(',', $allowedTimes),
        'mode' => 'required|in:Online,Physical',
        'onlineEmail' => 'nullable|email'
    ]);

    // Validate date
    $selectedDate = \Carbon\Carbon::parse($request->day);
    if ($selectedDate->isPast() || $selectedDate->diffInDays(now()) > 14 || $selectedDate->isWeekend()) {
        return back()->with('error', 'Invalid date selected.');
    }

    // If mode is Online, email is required
    if ($request->mode === 'Online' && empty($request->onlineEmail)) {
        return back()->with('error', 'Please enter your email for the online session.');
    }

    // Book appointment
    DB::table('appointment')->insert([
        'UID' => $uid,
        'DID' => $request->DID,
        'AID' => 1, // placeholder admin
        'day' => $request->day,
        'time' => $request->time,
        'mode' => $request->mode,
        'online_email' => $request->mode === 'Online' ? $request->onlineEmail : null
    ]);

    return redirect('/user/dashboard')->with('success', 'Appointment booked successfully!');
}
}