<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;

// Doctor Routes
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
Route::get('/doctors/search', [DoctorController::class, 'search'])->name('doctors.search');
Route::get('/doctor/{id}/appointments', [DoctorController::class, 'showAppointments'])->name('doctor.appointments');

// Appointment Routes
Route::get('/doctor/{id}/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

