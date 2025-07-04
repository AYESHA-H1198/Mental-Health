<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    // Show payment form
    public function showPaymentForm($Anum)
    {
        $appointment = DB::table('appointment')->where('Anum', $Anum)->first();
        return view('payment.form', compact('appointment'));
    }

    // Process the payment
    public function processPayment(Request $request)
    {
        $user = Session::get('user');

        // Step 1: Insert payment
        $pid = DB::table('payment')->insertGetId([
            'UID' => $user->UID,
            'Anum' => $request->Anum,
            'type' => $request->type,
            'Amt'  => $request->Amt,
        ]);

        // Step 2: Insert PID into correct sub-table
        $type = strtolower($request->type);

        if ($type === 'credit') {
            DB::table('credit')->insert(['PID' => $pid]);
        } elseif ($type === 'debit') {
            DB::table('debit')->insert(['PID' => $pid]);
        } elseif ($type === 'online') {
            DB::table('onlinepayment')->insert(['PID' => $pid]);
        } elseif ($type === 'mobile') {
            DB::table('mobile')->insert(['PID' => $pid]);
        } elseif ($type === 'finance') {
            DB::table('finance')->insert(['PID' => $pid]);
        }

        // Step 3: Mark appointment as Paid
        

        return redirect()->route('user.dashboard')->with('success', 'Payment successful!');
    }
}
