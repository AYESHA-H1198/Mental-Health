<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // Show the payment form
    public function showPaymentForm($Anum)
    {
        $appointment = DB::table('appointment')->where('Anum', $Anum)->first();
        return view('payment.form', compact('appointment'));
    }

    // Process the payment
    public function processPayment(Request $request)
    {
        $user = Session::get('user');

        // Validate input
        $request->validate([
            'Anum' => 'required|exists:appointment,Anum',
            'type' => 'required|in:Cash,Credit,Online,Mobile',
            'Amt' => 'required|numeric|min:0',

            // Easypaisa validation
            'easypaisa_txn_id' => 'required_if:type,Online',
            'easypaisa_screenshot' => 'required_if:type,Online|file|image|max:2048',

            // JazzCash validation
            'jazzcash_txn_id' => 'required_if:type,Mobile',
            'jazzcash_screenshot' => 'required_if:type,Mobile|file|image|max:2048',
        ]);

        // If credit selected, do not process — Stripe handles it separately
        if ($request->type === 'Credit') {
            return redirect()->route('user.dashboard')->with('info', 'Stripe payment handled separately.');
        }

        $txn_id = null;
        $proof = null;

        // Handle Easypaisa
        if ($request->type === 'Online') {
            $txn_id = $request->easypaisa_txn_id;
            if ($request->hasFile('easypaisa_screenshot')) {
                $proof = $request->file('easypaisa_screenshot')->store('payments', 'public');
            }
        }

        // Handle JazzCash
        if ($request->type === 'Mobile') {
            $txn_id = $request->jazzcash_txn_id;
            if ($request->hasFile('jazzcash_screenshot')) {
                $proof = $request->file('jazzcash_screenshot')->store('payments', 'public');
            }
        }

        // Insert payment record
        $pid = DB::table('payment')->insertGetId([
            'UID'    => $user->UID,
            'Anum'   => $request->Anum,
            'type'   => $request->type,
            'Amt'    => $request->Amt,
            'txn_id' => $txn_id,
            'proof'  => $proof,
            'status' => 'pending', // default status for admin review
        ]);

        // Insert into sub-payment table
        $type = strtolower($request->type);
        if ($type === 'cash') {
            DB::table('cash')->insert(['PID' => $pid]);
        } elseif ($type === 'online') {
            DB::table('onlinepayment')->insert(['PID' => $pid]);
        } elseif ($type === 'mobile') {
            DB::table('mobilefinance')->insert(['PID' => $pid]);
        }

        // Mark appointment as paid
        DB::table('appointment')->where('Anum', $request->Anum)->update([
            'status' => 'paid',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Payment submitted successfully. Awaiting admin approval.');
    }
}
