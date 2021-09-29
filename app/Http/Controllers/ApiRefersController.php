<?php

namespace App\Http\Controllers;

use App\Http\Resources\Refers\RefersCollection;
use App\Models\Refer;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiRefersController extends Controller
{
    /**
     * show player quizzes to continue
     *
     * @param  \App\Continuequiz $continuequiz
     * @return \Illuminate\Http\Response
     */
    public function getRefers($referred_source_id, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return RefersCollection::collection(Refer::where('referred_source_id', '=', $referred_source_id)->get());
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
