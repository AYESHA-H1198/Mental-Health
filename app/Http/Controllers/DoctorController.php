<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    public function showLogin() {
        return view('doctor.login');
    }

    public function login(Request $request) {
        $doctor = DB::table('doctor')->where('email', $request->email)->first();

        // REMOVE password check if not in DB
        if ($doctor /* && $request->password == $doctor->password */) {
            Session::put('doctor', $doctor);
            return redirect()->route('doctor.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function dashboard() {
        $doctor = Session::get('doctor');

        $appointments = DB::table('appointment')
            ->join('user', 'appointment.UID', '=', 'user.UID')
            ->where('appointment.DID', $doctor->DID)
            ->select('appointment.*', 'user.name as patient_name')
            ->get();

        return view('doctor.dashboard', compact('doctor', 'appointments'));
    }

    public function updateStatus(Request $request) {
        DB::table('appointment')
            ->where('Anum', $request->Anum)
            ->update(['status' => $request->status]);

        return back()->with('success', 'Status updated');
    }

    public function logout() {
        Session::forget('doctor');
        return redirect('/doctor/login');
    }
}
