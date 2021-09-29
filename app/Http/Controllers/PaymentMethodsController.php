<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentMethodsController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function paymentmethods() {
    	$paymentmethods = PaymentMethod::paginate(10);
        return view('paymentmethods')->with([
        	'paymentmethods'=>$paymentmethods,
        ]);
    }

    /**
     * Delete Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletePaymentMethod(PaymentMethod $paymentmethod)
    {
        $paymentmethod->delete();
        Session::flash('success', 'This Payment Method had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Delete Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPaymentMethod(Request $request)
    {
        PaymentMethod::create([
            'method'=>$request->method
        ]);
        Session::flash('success', 'This Payment Method had been created successfully!');
        return redirect()->back();
    }
}
