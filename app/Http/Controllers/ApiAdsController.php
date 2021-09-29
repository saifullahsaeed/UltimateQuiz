<?php

namespace App\Http\Controllers;

use App\Http\Resources\Ads\AdsCollection;
use App\Models\Ad;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiAdsController extends Controller
{
    /**
     * show player quizzes to continue
     *
     * @param  \App\Continuequiz $continuequiz
     * @return \Illuminate\Http\Response
     */
    public function getadsIds($key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return AdsCollection::collection(Ad::find(1)->get());
            //echo Ad::find(1)->admob_app_id;
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * show player quizzes to continue
     *
     * @param  \App\Continuequiz $continuequiz
     * @return \Illuminate\Http\Response
     */
    public function lang($key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return AdsCollection::collection(Ad::find(1)->get());
        } else {
            $result['success'] = 'api_error';
            echo json_encode($result);
        }
    }
}
