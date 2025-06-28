<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:doctors',
            'email' => 'required|email|unique:doctors',
        ]);

        Doctor::create($request->all());
        return redirect()->route('doctors.index')->with('success', 'Doctor Added Successfully!');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $doctors = Doctor::where('name', 'like', "%$search%")->get();
        return view('doctors.index', compact('doctors'));
    }
    public function showAppointments($doctor_id)
{
    $doctor = Doctor::with('appointments')->findOrFail($doctor_id);
    return view('doctors.appointments', compact('doctor'));
}

}

