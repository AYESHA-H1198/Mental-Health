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

        DB::table('appointment')->insert([
            'UID' => $uid,
            'DID' => $request->DID,
            'AID' => 1, // placeholder admin
            'day' => $request->day,
            'time' => $request->time
        ]);

        return redirect('/user/dashboard')->with('success', 'Appointment booked!');
    }
}
