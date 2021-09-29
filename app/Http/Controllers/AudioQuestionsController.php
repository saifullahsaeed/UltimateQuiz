<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Subcategory;
use App\Models\AudioQuestion;
use Illuminate\Support\Facades\Session;

class AudioQuestionsController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories() {
    	$categories = Category::paginate(12);
        return view('audioquestions_categories')->with([
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
        return view('audioquestions_subcategories')->with([
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
        return view('audioquestions_quizzes')->with([
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
        $questions = AudioQuestion::where(['category_id'=>$category, 'subcategory_id'=>$subcategory, 'quiz_id'=>$quiz])->paginate(20);
        return view('audioquestions_questions')->with([
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
    public function addAudioQuestion(Request $request) {
        if (!empty($request->question_audio_url)) {
        $new_name = time() . $request->file('question_audio_url')->getClientOriginalName();
        $request->question_audio_url->move('uploads/questions/', $new_name);
        $questionaudio= AudioQuestion::create([
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
        'question_audio_url' => $new_name,
        'premium_or_not' => "no",
        ]);
            Session::flash('success', 'Audio Question created successfully!');
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
    public function deleteAudioQuestion(Request $request)
    {
        $question = AudioQuestion::find($request->question);
        $question->delete();
        Session::flash('success', 'This Audio Question had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAudioQuestion(Request $request) {
        $questionn = AudioQuestion::find($request->id);
        if (!empty($request->question_audio_url)) {
            @unlink('/uploads/questions/'.$questionn->question_audio_url);
            $new_name = time() . $request->file('question_audio_url')->getClientOriginalName();
            $request->question_audio_url->move('uploads/questions/', $new_name);
            $questionn->question_audio_url = $new_name;
        }
        $questionn->points = $request->points;
        $questionn->seconds = $request->seconds;
        $questionn->hint = $request->hint;
        $questionn->true_answer = $request->true_answer;
        $questionn->false1 = $request->false1;
        $questionn->false2 = $request->false2;
        $questionn->false3 = $request->false3;
        $questionn->save();
        Session::flash('success', 'Audio Question updated successfully!');
        return redirect()->back();
    }
}
