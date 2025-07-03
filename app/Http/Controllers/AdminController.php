<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Show login form
    public function login()
    {
        return view('admin.login');
    }

    // Handle login POST
    public function checkLogin(Request $request)
    {
        $admin = DB::table('admin')->where('email', $request->email)->first();

        if ($admin && $request->password == 'admin123') { // TEMP PASSWORD
            Session::put('admin', $admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

   public function dashboard()
{
    if (!Session::has('admin')) {
        return redirect()->route('admin.login');
    }

    $appointmentCount = DB::table('appointment')->count();
    $paymentTotal = DB::table('payment')->sum('Amt');

    return view('admin.dashboard', compact('appointmentCount', 'paymentTotal'));
}


    // Admin logout
    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('admin.login');
    }

    // AdminController.php

public function viewAppointments() {
    $appointments = DB::table('appointment')
        ->join('user', 'appointment.UID', '=', 'user.UID')
        ->join('doctor', 'appointment.DID', '=', 'doctor.DID')
        ->select('appointment.*', 'user.name as user_name', 'doctor.name as doctor_name')
        ->get();

    return view('admin.appointments', compact('appointments'));
}

public function viewPayments() {
    $payments = DB::table('payment')
        ->join('user', 'payment.UID', '=', 'user.UID')
        ->join('appointment', 'payment.Anum', '=', 'appointment.Anum')
        ->select('payment.*', 'user.name as user_name', 'appointment.time', 'appointment.day')
        ->get();

    return view('admin.payments', compact('payments'));
}
public function createDoctor()
{
    return view('admin.doctors.create'); // Make sure this Blade view exists
}
public function storeDoctor(Request $request)
{
    // Validation
    
    $validated = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:doctor,email',
    'phone' => 'required|string|max:20',
]);


    // Insert into DB
    DB::table('doctor')->insert([
        'name' => $validated['name'],
        'phone' => $validated['phone'],
        'email' => $validated['email'],
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Doctor added successfully!');
}
public function deleteDoctor($id)
{
    DB::table('doctor')->where('DID', $id)->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Doctor deleted successfully!');
}

public function listDoctors() {
    $doctors = DB::table('doctor')->get();
    return view('admin.doctors.index', compact('doctors'));

}

public function searchDoctors(Request $request)
{
    $query = $request->input('query');

    $doctors = DB::table('doctor')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();

    return view('admin.doctors.index', compact('doctors'));
}

public function viewDoctorAppointments($id)
{
    $doctor = Doctor::with(['appointments.user'])->findOrFail($id);
    return view('admin.doctors.appointments', compact('doctor'));
    
}

}
