<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AppointmentController;

// ================== Welcome Page ==================
Route::get('/', function () {
    return view('welcome');
});

// ================== Admin Routes ==================
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'checkLogin'])->name('admin.login');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin: Doctor Management
Route::get('/admin/doctors', [AdminController::class, 'listDoctors'])->name('doctors.index');
Route::get('/admin/doctors/search', [AdminController::class, 'searchDoctors'])->name('doctors.search');
Route::get('/admin/doctors/{id}/appointments', [AdminController::class, 'viewDoctorAppointments'])->name('doctor.appointments');
Route::delete('/admin/doctors/{id}', [AdminController::class, 'deleteDoctor'])->name('doctors.destroy');

// ✅ Doctor creation now handled in DoctorController
Route::get('/admin/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
Route::post('/admin/doctors', [DoctorController::class, 'store'])->name('doctors.store');

// Admin: Payment & Appointment Approval
Route::get('/admin/appointments', [AdminController::class, 'viewAppointments'])->name('admin.viewAppointments');
Route::get('/admin/payments', [AdminController::class, 'viewPayments'])->name('admin.viewPayments');
Route::get('/admin/appointment/status/{Anum}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
Route::post('/admin/appointment/mark-paid/{Anum}', [AdminController::class, 'markAsPaid'])->name('admin.markPaid');
Route::put('/admin/approve-payment/{PID}', [AdminController::class, 'approvePayment'])->name('admin.approve.payment');

// ================== User Routes ==================
Route::get('/register', [UserController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

// User: Appointments & Doctors
Route::get('/doctors', [UserController::class, 'showDoctors'])->name('doctors');
Route::get('/appointment/form/{DID}', [UserController::class, 'showAppointmentForm'])->name('appointment.form');
Route::post('/appointment/book', [UserController::class, 'bookAppointment'])->name('appointment.book');
Route::get('/available-slots', [UserController::class, 'getAvailableSlots'])->name('appointment.slots');

// User: View Medical Record
Route::get('/user/appointment/{Anum}/record', [UserController::class, 'viewMedicalRecord'])->name('user.record.view');

// ================== Doctor Routes ==================
// Doctor login, dashboard, logout
Route::get('/doctor/login', [DoctorController::class, 'showLogin'])->name('doctor.login.form');
Route::post('/doctor/login', [DoctorController::class, 'login'])->name('doctor.login');
Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
Route::get('/doctor/logout', [DoctorController::class, 'logout'])->name('doctor.logout');

// Doctor: Appointment status update
Route::post('/appointment/update-status', [DoctorController::class, 'updateStatus'])->name('appointment.updateStatus');

// Doctor: Rescheduling
Route::get('/doctor/appointment/{Anum}/reschedule', [DoctorController::class, 'showRescheduleForm'])->name('doctor.reschedule.form');
Route::post('/doctor/appointment/reschedule', [DoctorController::class, 'rescheduleAppointment'])->name('doctor.reschedule.submit');

// Doctor: Medical Records
Route::get('/doctor/record/{Anum}', [DoctorController::class, 'showRecordForm'])->name('doctor.record.form');
Route::post('/doctor/appointment/{Anum}/record', [DoctorController::class, 'storeRecord'])->name('doctor.record.store');

// ================== Payment Routes ==================
Route::get('/payment/form/{Anum}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
