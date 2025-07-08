<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegister() {
        return view('user.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:4'
        ]);

        $uid = DB::table('user')->insertGetId([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Account created. Please login.');
    }

    public function showLogin() {
        return view('user.login');
    }

    public function login(Request $request) {
        $user = DB::table('user')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
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
            ->leftJoin('payment', 'appointment.Anum', '=', 'payment.Anum')
            ->leftJoin('medical_records', 'appointment.Anum', '=', 'medical_records.Anum') // ✅ Join to check if record exists
            ->where('appointment.UID', $user->UID)
            ->select(
                'appointment.*',
                'appointment.appointment_status',
                'doctor.name as doctor_name',
                'payment.status as payment_status',
                'payment.type as payment_type',
                'payment.Amt as payment_amount',
                'medical_records.issue',
                'medical_records.medicine',
                'medical_records.notes',
                'medical_records.MRID as record_id'

                 // ✅ for View Record logic
            )
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

        $allowedTimes = ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:30', '14:00','14:30','15:00'];

        $request->validate([
            'day' => 'required|date',
            'time' => 'required|in:' . implode(',', $allowedTimes),
            'mode' => 'required|in:Online,Physical',
            'onlineEmail' => 'nullable|email|required_if:mode,Online'
        ]);

        $selectedDate = Carbon::parse($request->day);
        if ($selectedDate->isPast() || $selectedDate->diffInDays(now()) > 14 || $selectedDate->isWeekend()) {
            return back()->with('error', 'Invalid date selected.');
        }

        if ($request->mode === 'Online' && empty($request->onlineEmail)) {
            return back()->with('error', 'Please enter your email for the online session.');
        }

        $slotTaken = DB::table('appointment')
            ->where('DID', $request->DID)
            ->where('day', $request->day)
            ->where('time', $request->time)
            ->exists();

        if ($slotTaken) {
            return back()->with('error', 'This time slot is already booked. Please select a different one.');
        }

        $anum = DB::table('appointment')->insertGetId([
            'UID' => $uid,
            'DID' => $request->DID,
            'AID' => 1,
            'day' => $request->day,
            'time' => $request->time,
            'mode' => $request->mode,
            'online_email' => $request->mode === 'Online' ? $request->onlineEmail : null,
            'status' => $request->mode,
            'appointment_status' => 'Waiting',
            'payment_status' => 'notpaid'
        ]);

        $sid = DB::table('session')->insertGetId([
            'Anum' => $anum,
            'type' => $request->mode
        ]);

        $user = Session::get('user');
        $doctor = DB::table('doctor')->where('DID', $request->DID)->first();

        if ($request->mode === 'Online') {
            $meetLink = 'https://meet.google.com/' . Str::random(10);

            DB::table('online_session')->insert([
                'SID' => $sid,
                'email' => $request->onlineEmail,
                'meet_link' => $meetLink
            ]);

            // Email to user
            Mail::send('emails.session_link', [
                'name' => $user->name ?? 'User',
                'doctorName' => $doctor->name ?? 'Doctor',
                'link' => $meetLink,
                'day' => $request->day,
                'time' => $request->time
            ], function ($msg) use ($request) {
                $msg->to($request->onlineEmail)->subject('Your Therapy Session Link');
            });

            // Email to doctor
            Mail::send('emails.session_link', [
                'name' => $doctor->name ?? 'Doctor',
                'doctorName' => $doctor->name ?? 'Doctor',
                'link' => $meetLink,
                'day' => $request->day,
                'time' => $request->time
            ], function ($msg) use ($doctor) {
                $msg->to($doctor->email)->subject('New Online Appointment Booked');
            });

        } else {
            DB::table('inperson_session')->insert([
                'SID' => $sid,
                'clinic_address' => '3rd Floor, ABC Mental Health Center, Peshawar'
            ]);
        }

        return redirect('/user/dashboard')->with('success', 'Appointment booked successfully!');
    }

    public function getAvailableSlots(Request $request)
    {
        $doctorId = $request->query('doctor_id');
        $date = $request->query('date');

        $bookedSlots = DB::table('appointment')
            ->where('DID', $doctorId)
            ->where('day', $date)
            ->pluck('time')
            ->toArray();

        $allSlots = [
            '09:00', '09:30', '10:00', '10:30',
            '11:00', '11:30', '12:00',
            '02:00', '02:30', '03:00'
        ];

        $availableSlots = array_values(array_diff($allSlots, $bookedSlots));

        return response()->json($availableSlots);
    }

    public function viewMedicalRecord($Anum)
    {
        $user = Session::get('user');

        $appointment = DB::table('appointment')
            ->where('Anum', $Anum)
            ->where('UID', $user->UID)
            ->first();

        if (!$appointment) {
            return back()->with('error', 'Record not found.');
        }

        $record = DB::table('medical_records')->where('Anum', $Anum)->first();

        return view('user.medical_record', compact('appointment', 'record'));
    }
}
