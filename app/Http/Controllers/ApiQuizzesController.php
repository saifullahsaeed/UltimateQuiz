<?php

namespace App\Http\Controllers;

use App\Http\Resources\Quizzes\QuizzesCollection;
use App\Models\Quiz;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiQuizzesController extends Controller
{
    /**
     * show recent quizzes
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function showRecentQuizzes($key) {
    	$api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
        	return QuizzesCollection::collection(Quiz::orderBy('id', 'desc')->take(30)->get());
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
    public function getSubcategoryQuizzes($subcategory, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            $quizzes = Quiz::where('subcategory_id', '=', $subcategory)->get();
            return QuizzesCollection::collection($quizzes);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
