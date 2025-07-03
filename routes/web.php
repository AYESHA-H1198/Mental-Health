<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PaymentController;



Route::get('/', function () {
    return view('welcome');
});
// ================== Admin Routes ==================
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'checkLogin'])->name('admin.login');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/doctors/create', [AdminController::class, 'createDoctor'])->name('admin.doctors.create');
Route::post('/admin/doctors', [AdminController::class, 'storeDoctor'])->name('doctors.store');
Route::delete('/admin/doctors/{id}', [AdminController::class, 'deleteDoctor'])->name('doctors.destroy');
Route::get('/admin/doctors', [AdminController::class, 'listDoctors'])->name('doctors.index');
Route::get('/admin/doctors/create', [AdminController::class, 'createDoctor'])->name('doctors.create');
Route::get('/admin/doctors/search', [AdminController::class, 'searchDoctors'])->name('doctors.search');
Route::get('/admin/doctors/{id}/appointments', [AdminController::class, 'viewDoctorAppointments'])->name('doctor.appointments');

// ================== User Routes ==================
Route::get('/register', [UserController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/doctors', [UserController::class, 'showDoctors'])->name('doctors');
Route::get('/appointment/form/{DID}', [UserController::class, 'showAppointmentForm'])->name('appointment.form');
Route::post('/appointment/book', [UserController::class, 'bookAppointment'])->name('appointment.book');

// ================== Doctor Routes ==================
Route::get('/doctor/login', [DoctorController::class, 'showLogin'])->name('doctor.login.form');
Route::post('/doctor/login', [DoctorController::class, 'login'])->name('doctor.login');
Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
Route::get('/doctor/logout', [DoctorController::class, 'logout'])->name('doctor.logout');
Route::post('/appointment/update-status', [DoctorController::class, 'updateStatus'])->name('appointment.updateStatus');
//payment
Route::get('/payment/form/{Anum}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/admin/appointments', [AdminController::class, 'viewAppointments'])->name('admin.viewAppointments');
Route::get('/admin/payments', [AdminController::class, 'viewPayments'])->name('admin.viewPayments');

