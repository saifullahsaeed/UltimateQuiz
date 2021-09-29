<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\Subcategory;
use App\Models\TextQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TextQuestionsController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories() {
    	$categories = Category::paginate(12);
        return view('textquestions_categories')->with([
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
        return view('textquestions_subcategories')->with([
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
        return view('textquestions_quizzes')->with([
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
        $questions = TextQuestion::where(['category_id'=>$category, 'subcategory_id'=>$subcategory, 'quiz_id'=>$quiz])->paginate(20);
        return view('textquestions_questions')->with([
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
    public function addTextQuestion(Request $request) {
        TextQuestion::create([
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
        'question_text' => $request->question_text,
        'premium_or_not' => "no",
        ]);
        Session::flash('success', 'Text Question created successfully!');
        return redirect()->back();
    }

    /**
     * Delete Text Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteTextQuestion(Request $request)
    {
    	$question = TextQuestion::find($request->question);
    	$question->delete();
        Session::flash('success', 'This Text Question had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTextQuestion(Request $request) {
    	$questionn = TextQuestion::find($request->id);
    	$questionn->points = $request->points;
    	$questionn->seconds = $request->seconds;
    	$questionn->hint = $request->hint;
    	$questionn->true_answer = $request->true_answer;
    	$questionn->false1 = $request->false1;
    	$questionn->false2 = $request->false2;
    	$questionn->false3 = $request->false3;
    	$questionn->question_text = $request->question_text;
    	$questionn->save();
        Session::flash('success', 'Text Question updated successfully!');
        return redirect()->back();
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkImport(Request $request)
    {
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        TextQuestion::create([
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'quiz_id' => $request->quiz_id,
        'premium_or_not' => "no",
        'question_text' => $column[0],
        'true_answer' => $column[1],
        'false1' => $column[2],
        'false2' => $column[3],
        'false3' => $column[4],
        'points' => $column[5],
        'seconds' => $column[6],
        'hint' => $column[7],
        ]); 
        }
        Session::flash('success', 'Your Text Questions are added successfully');
        return redirect()->back();
    }
    }
}
