<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller {
    public function __construct() {
        //$this->middleware('auth');
    }
    // Funcionalidades:
    public function index() {
        //$user = auth()->user();   ToDo --> Usar el Auth Token, Lo Hago aqui para probarlo primero.
        $user = User::find(1);
        return view('stripe.form-pay', [
            'intent' => $user->createSetupIntent()
        ]);
    }
    public function singleCharge(Request $request) {
        // Check Payments: https://dashboard.stripe.com/test/payments
        //return $request->all();
        $amount = $request->amount * 100;
        $payment_method = $request->payment_method;
        //$user = auth()->user();
        $user = User::find(1);
        $user->createOrGetStripeCustomer();
        $payment_method = $user->addPaymentMethod($payment_method);
        $user->charge($amount, $payment_method->id);
        // Note: Call The ->name() of The Route.
        return redirect()->route('index');
    }
}
