<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContinueQuizzes\ContinueQuizzesCollection;
use App\Models\Continuequiz;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiContinueQuizzesController extends Controller
{
    /**
     * show player quizzes to continue
     *
     * @param  \App\Continuequiz $continuequiz
     * @return \Illuminate\Http\Response
     */
    public function getPlayerContinueQuizzes($player_id, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return ContinueQuizzesCollection::collection(Continuequiz::where('player_id', '=', $player_id)->get());
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
