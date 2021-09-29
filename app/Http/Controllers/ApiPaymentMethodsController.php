<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethods\PaymentMethodsCollection;
use App\Models\PaymentMethod;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiPaymentMethodsController extends Controller
{
    /**
     * show player quizzes to continue
     *
     * @param  \App\Continuequiz $continuequiz
     * @return \Illuminate\Http\Response
     */
    public function paymentMethods($key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return PaymentMethodsCollection::collection(PaymentMethod::all());
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
