<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function showPaymentForm($Anum) {
        $appointment = DB::table('appointment')->where('Anum', $Anum)->first();
        return view('payment.form', compact('appointment'));
    }

    public function processPayment(Request $request) {
        $user = Session::get('user');

        DB::table('payment')->insert([
            'UID' => $user->UID,
            'Anum' => $request->Anum,
            'type' => $request->type,
            'Amt' => $request->Amt
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Payment successful!');
    }
}
