<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Subcategory;
use App\Models\ImageQuestion;
use Illuminate\Support\Facades\Session;

class ImageQuestionsController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories() {
    	$categories = Category::paginate(12);
        return view('imagequestions_categories')->with([
        	'categories'=>$categories
        ]);
    }

    /**
     * Show the subcategories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function subcategories($category) {
        $subcategories = Subcategory::where('category_id', '=', $category)->paginate(12);
        return view('imagequestions_subcategories')->with([
            'subcategories'=>$subcategories,
            'categoryId'=>$category
        ]);
    }

    /**
     * Show the subcategories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function quizzes($category, $subcategory) {
        $quizzes = Quiz::where(['category_id'=>$category, 'subcategory_id'=>$subcategory])->paginate(12);
        return view('imagequestions_quizzes')->with([
            'quizzes'=>$quizzes,
            'categoryId'=>$category,
            'subcategoryId'=>$subcategory,
        ]);
    }


    /**
     * Show the subcategories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function questions($category, $subcategory, $quiz) {
        $questions = ImageQuestion::where(['category_id'=>$category, 'subcategory_id'=>$subcategory, 'quiz_id'=>$quiz])->paginate(20);
        return view('imagequestions_questions')->with([
            'questions'=>$questions,
            'category'=>$category,
            'subcategory'=>$subcategory,
            'quiz'=>$quiz,
        ]);
    }

    /**
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function addImageQuestion(Request $request) {
        if (!empty($request->question_image_url)) {
        $new_name = time() . $request->file('question_image_url')->getClientOriginalName();
        $request->question_image_url->move('uploads/questions/', $new_name);
        $questionimage= ImageQuestion::create([
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'quiz_id' => $request->quiz_id,
        'points' => $request->points,
        'seconds' => $request->seconds,
        'hint' => $request->hint,
        'true_answer' => $request->true_answer,
        'false1' => $request->false1,
        'false2' => $request->false2,
        'false3' => $request->false3,
        'question_image_url' => $new_name,
        'premium_or_not' => "no",
        ]);
            Session::flash('success', 'Image Question created successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Please enter a valid infos!');
            return redirect()->back();
        }
    }

    /**
     * Delete Text Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteImageQuestion(Request $request)
    {
        $question = ImageQuestion::find($request->question);
        $question->delete();
        Session::flash('success', 'This Image Question had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateImageQuestion(Request $request) {
        $questionn = ImageQuestion::find($request->id);
        if (!empty($request->question_image_url)) {
            @unlink('/uploads/questions/'.$questionn->question_image_url);
            $new_name = time() . $request->file('question_image_url')->getClientOriginalName();
            $request->question_image_url->move('uploads/questions/', $new_name);
            $questionn->question_image_url = $new_name;
        }
        $questionn->points = $request->points;
        $questionn->seconds = $request->seconds;
        $questionn->hint = $request->hint;
        $questionn->true_answer = $request->true_answer;
        $questionn->false1 = $request->false1;
        $questionn->false2 = $request->false2;
        $questionn->false3 = $request->false3;
        $questionn->save();
        Session::flash('success', 'Image Question updated successfully!');
        return redirect()->back();
    }
}
