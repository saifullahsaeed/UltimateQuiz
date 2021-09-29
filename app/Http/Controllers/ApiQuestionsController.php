<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompletedQuestion\CompletedQuizzesCollection;
use App\Models\Completedquestion;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiQuestionsController extends Controller
{
    /*
     * show recent quizzes
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
     
    public function checkIfTextQuestionIsCompleted(Request $request) {
    	$api_key = Setting::find(1)->api_secret_key;
        $completed_option = Setting::find(1)->completed_option;
        if ($request->key==$api_key) {
            if ($completed_option=="yes") {
                $completed = Completedquestion::where([
                    'question_type'=>"text",
                    'question_id'=>$request->question_id,
                    'player_id'=>$request->player_id,
                ])->first();
                if ($completed) {
                    $result['success'] = '0';
                    echo json_encode($result);
                } else {
                    $result['success'] = '1';
                    echo json_encode($result);
                }
            } else {
            $result['success'] = '1';
            echo json_encode($result);
            }
        } else {
        	$result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    public function checkIfImageQuestionIsCompleted(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $completed_option = Setting::find(1)->completed_option;
        if ($request->key==$api_key) {
            if ($completed_option=="yes") {
                $completed = Completedquestion::where([
                    'question_type'=>"image",
                    'question_id'=>$request->question_id,
                    'player_id'=>$request->player_id,
                ])->first();
                if ($completed) {
                    $result['success'] = '0';
                    echo json_encode($result);
                } else {
                    $result['success'] = '1';
                    echo json_encode($result);
                }
            } else {
            $result['success'] = '1';
            echo json_encode($result);
            }
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    public function checkIfAudioQuestionIsCompleted(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $completed_option = Setting::find(1)->completed_option;
        if ($request->key==$api_key) {
            if ($completed_option=="yes") {
                $completed = Completedquestion::where([
                    'question_type'=>"audio",
                    'question_id'=>$request->question_id,
                    'player_id'=>$request->player_id,
                ])->first();
                if ($completed) {
                    $result['success'] = '0';
                    echo json_encode($result);
                } else {
                    $result['success'] = '1';
                    echo json_encode($result);
                }
            } else {
            $result['success'] = '1';
            echo json_encode($result);
            }
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * show popular categories
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function getCompletedQuestionsForSingleQuiz($quiz, $player, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            $completed = Completedquestion::where([
                'player_id'=>$player,
                'quiz_id'=>$quiz,
            ])->get();
            return CompletedQuizzesCollection::collection($completed);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
