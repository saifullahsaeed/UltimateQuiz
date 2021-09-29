<?php

namespace App\Http\Controllers;

use App\Http\Resources\AudioQuestions\AudioQuestionsCollection;
use App\Http\Resources\Dailies\DailiesResource;
use App\Http\Resources\ImageQuestions\ImageQuestionsCollection;
use App\Http\Resources\TextQuestions\TextQuestionsCollection;
use App\Models\AudioQuestion;
use App\Models\Daily;
use App\Models\ImageQuestion;
use App\Models\Setting;
use App\Models\TextQuestion;
use Illuminate\Http\Request;

class ApiDailyController extends Controller
{
    /**
     * show recent quizzes
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function getDailyQuiz(Request $request) {
    	$api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
            $daily = DailiesResource::collection(Daily::where('id', '=', 1)->get());
            echo json_encode($daily);
        } else {
        	$result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * show recent quizzes
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function getDailyQuizTextQuestions($id, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        $questions = TextQuestion::where('quiz_id', '=', $id)->get();
        if ($key==$api_key) {
            return TextQuestionsCollection::collection($questions);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * show recent quizzes
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function getDailyQuizImageQuestions($id, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        $questions = ImageQuestion::where('quiz_id', '=', $id)->get();
        if ($key==$api_key) {
            return ImageQuestionsCollection::collection($questions);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * show recent quizzes
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function getDailyQuizAudioQuestions($id, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        $questions = AudioQuestion::where('quiz_id', '=', $id)->get();
        if ($key==$api_key) {
            return AudioQuestionsCollection::collection($questions);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
