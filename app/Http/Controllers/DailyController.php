<?php

namespace App\Http\Controllers;

use App\Models\AudioQuestion;
use App\Models\Category;
use App\Models\Daily;
use App\Models\ImageQuestion;
use App\Models\Quiz;
use App\Models\Subcategory;
use App\Models\TextQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DailyController extends Controller
{
    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function dailyQuiz() {
    	$dailyquiz = Daily::find(1);
    	$categories = Category::all();
    	$subcategories = Subcategory::all();
    	if ($dailyquiz) {
    		$quiz = Quiz::where([
    			'image_url'=>$dailyquiz->image_url,
    			'category_id'=>$dailyquiz->category_id,
    			'subcategory_id'=>$dailyquiz->subcategory_id,
    		])->first();
    	$img = $quiz->imagequestions()->count();
        $text = $quiz->textquestions()->count();
        $audio = $quiz->audioquestions()->count();
        $numberQuestions = $img + $text + $audio;
    		return view('dailyquiz')->with([
        	'exist'=>"1",
        	'categories'=>$categories,
        	'subcategories'=>$subcategories,
        	'dailyquiz'=>$dailyquiz,
            'number_questions'=>$numberQuestions,
            'quizz'=>$quiz,
        ]);
    	} else {
    		return view('dailyquiz')->with([
        	'exist'=>"0",
        	'categories'=>$categories,
        	'subcategories'=>$subcategories
        ]);
    	}
    }

    /**
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDailyQuiz(Request $request) {
        if (!empty($request->image_url)) {
            $new_name = time() . $request->file('image_url')->getClientOriginalName();
            $request->image_url->move('uploads/quizzes/', $new_name);
            $quizz = Quiz::create([
            'name' => $request->name,
            'image_url' => $new_name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            ]);
            $daily = Daily::create([
            'name' => $request->name,
            'image_url' => $new_name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'quiz_id' => $quizz->id,
            ]);
            Session::flash('success', 'Daily Quiz created successfully!');
            return redirect()->back();
        } else {
        	Session::flash('error', 'Please enter a valid infos!');
            return redirect()->back();
        }
    }

    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function deleteDailyQuiz($image) {
    	$dailyquiz = Daily::find(1);
    	$quiz = Quiz::where('image_url', '=', $image)->first();
    	//$quiz->questions()->delete();
    	$dailyquiz->delete();
    	$quiz->delete();
    	Session::flash('success', 'Daily Quiz deleted successfully!');
        return redirect()->back();
    }

    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function addDailyQuizTextQuestionView() {
    	$dailyquiz = Daily::find(1);
    	$quiz = Quiz::where([
    			'image_url'=>$dailyquiz->image_url,
    			'category_id'=>$dailyquiz->category_id,
    			'subcategory_id'=>$dailyquiz->subcategory_id,
    		])->first();
    	$category_id = $dailyquiz->category_id;
    	$subcategory_id = $dailyquiz->subcategory_id;
    	$quiz_id = $quiz->id;
    	$quiz_name = $quiz->name;
    	$categoryy = Category::find($category_id)->first();
    	$subcategoryy = Subcategory::find($subcategory_id)->first();
    		return view('add_dailyquiz_textquestion')->with([
        	'category_id'=>$category_id,
        	'category_name'=>$categoryy->category_name,
        	'subcategory_id'=>$subcategory_id,
        	'subcategory_name'=>$subcategoryy->name,
        	'quiz_id'=>$quiz_id,
        	'quiz_name'=>$quiz_name
        ]);
    }

    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function addDailyQuizImageQuestionView() {
        $dailyquiz = Daily::find(1);
        $quiz = Quiz::where([
                'image_url'=>$dailyquiz->image_url,
                'category_id'=>$dailyquiz->category_id,
                'subcategory_id'=>$dailyquiz->subcategory_id,
            ])->first();
        $category_id = $dailyquiz->category_id;
        $subcategory_id = $dailyquiz->subcategory_id;
        $quiz_id = $quiz->id;
        $quiz_name = $quiz->name;
        $categoryy = Category::find($category_id)->first();
        $subcategoryy = Subcategory::find($subcategory_id)->first();
            return view('add_dailyquiz_imagequestion')->with([
            'category_id'=>$category_id,
            'category_name'=>$categoryy->category_name,
            'subcategory_id'=>$subcategory_id,
            'subcategory_name'=>$subcategoryy->name,
            'quiz_id'=>$quiz_id,
            'quiz_name'=>$quiz_name
        ]);
    }

    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function addDailyQuizAudioQuestionView() {
        $dailyquiz = Daily::find(1);
        $quiz = Quiz::where([
                'image_url'=>$dailyquiz->image_url,
                'category_id'=>$dailyquiz->category_id,
                'subcategory_id'=>$dailyquiz->subcategory_id,
            ])->first();
        $category_id = $dailyquiz->category_id;
        $subcategory_id = $dailyquiz->subcategory_id;
        $quiz_id = $quiz->id;
        $quiz_name = $quiz->name;
        $categoryy = Category::find($category_id)->first();
        $subcategoryy = Subcategory::find($subcategory_id)->first();
            return view('add_dailyquiz_audioquestion')->with([
            'category_id'=>$category_id,
            'category_name'=>$categoryy->category_name,
            'subcategory_id'=>$subcategory_id,
            'subcategory_name'=>$subcategoryy->name,
            'quiz_id'=>$quiz_id,
            'quiz_name'=>$quiz_name
        ]);
    }


    /**
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDailyQuizTextQuestion(Request $request) {
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
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDailyQuizImageQuestion(Request $request) {
        if (!empty($request->question_image_url)) {
            $new_name = time() . $request->file('question_image_url')->getClientOriginalName();
            $request->question_image_url->move('uploads/questions/', $new_name);
            ImageQuestion::create([
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
            Session::flash('error', 'Please enter a valid image!');
            return redirect()->back();
        }
    }

    /**
     * Create New Daily Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDailyQuizAudioQuestion(Request $request) {
        if (!empty($request->question_audio_url)) {
            $new_name = time() . $request->file('question_audio_url')->getClientOriginalName();
            $request->question_audio_url->move('uploads/questions/', $new_name);
            AudioQuestion::create([
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
            Session::flash('error', 'Please enter a valid audio file!');
            return redirect()->back();
        }
    }

    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function dailyQuizQuestions($quiz) {
        $questionsText = TextQuestion::where('quiz_id', '=', $quiz)->get();
        $questionsImages = ImageQuestion::where('quiz_id', '=', $quiz)->get();
        $questionsAudio = AudioQuestion::where('quiz_id', '=', $quiz)->get();
        return view('dailyquizquestions')->with([
            'questionsText'=>$questionsText,
            'questionsImages'=>$questionsImages,
            'questionsAudio'=>$questionsAudio,
        ]);
    }

    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function deleteDailyQuizQuestions($id, $type) {
        if ($type == "text") {
            $qt = TextQuestion::where('id', '=', $id)->first();
            $qt->delete();
            Session::flash('success', 'Question deleted successfully!');
            return redirect()->back();
        }
        if ($type == "image") {
            $qi = ImageQuestion::where('id', '=', $id)->first();
            $qi->delete();
            Session::flash('success', 'Question deleted successfully!');
            return redirect()->back();
        }
        if ($type == "audio") {
            $qa = AudioQuestion::where('id', '=', $id)->first();
            $qa->delete();
            Session::flash('success', 'Question deleted successfully!');
            return redirect()->back();
        }
    }

    /**
     * Show the daily Quiz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function showViewDailyQuizQuestions($id, $type) {
        if ($type == "text") {
            $qt = TextQuestion::where('id', '=', $id)->first();
            return view('edit_dailyquiztextquestion')->with([
                'question'=>$qt,
                'type'=>"text",
                'category_name'=>Category::find($qt->category_id)->category_name,
                'subcategory_name'=>Subcategory::find($qt->subcategory_id)->name,
                'quiz_name'=>Quiz::find($qt->quiz_id)->name
            ]);
        }
        if ($type == "image") {
            $qi = ImageQuestion::where('id', '=', $id)->first();
            return view('edit_dailyquizimagequestion')->with([
                'question'=>$qi,
                'type'=>"image",
                'category_name'=>Category::find($qi->category_id)->category_name,
                'subcategory_name'=>Subcategory::find($qi->subcategory_id)->name,
                'quiz_name'=>Quiz::find($qi->quiz_id)->name
                
            ]);
        }
        if ($type == "audio") {
            $qa = AudioQuestion::where('id', '=', $id)->first();
            return view('edit_dailyquizaudioquestion')->with([
                'question'=>$qa,
                'type'=>"audio",
                'category_name'=>Category::find($qa->category_id)->category_name,
                'subcategory_name'=>Subcategory::find($qa->subcategory_id)->name,
                'quiz_name'=>Quiz::find($qa->quiz_id)->name
                
            ]);
        }
    }

     /**
     * Update Category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateDailyQuizTextQuestion(Request $request, $id)
    {
        $question = TextQuestion::find($id);
        $question->category_id = $request->category_id;
        $question->subcategory_id = $request->subcategory_id;
        $question->quiz_id = $request->quiz_id;
        $question->points = $request->points;
        $question->seconds = $request->seconds;
        $question->hint = $request->hint;
        $question->true_answer = $request->true_answer;
        $question->false1 = $request->false1;
        $question->false2 = $request->false2;
        $question->question_text = $request->question_text;
        $question->save();
        Session::flash('success', 'Your Question had been updated successfully!');
        return redirect()->back();
    }

    /**
     * Update Category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateDailyQuizImageQuestion(Request $request, $id)
    {
        $question = ImageQuestion::find($id);
        if (!empty($request->question_image_url)) {
            @unlink('/uploads/questions/'.$question->question_image_url);
            $new_name = time() . $request->file('question_image_url')->getClientOriginalName();
            $request->question_image_url->move('uploads/questions/', $new_name);
            $question->question_image_url = $new_name;
        }
        $question->category_id = $request->category_id;
        $question->subcategory_id = $request->subcategory_id;
        $question->quiz_id = $request->quiz_id;
        $question->points = $request->points;
        $question->seconds = $request->seconds;
        $question->hint = $request->hint;
        $question->true_answer = $request->true_answer;
        $question->false1 = $request->false1;
        $question->false2 = $request->false2;
        $question->false3 = $request->false3;
        $question->save();
        Session::flash('success', 'Your Question had been updated successfully!');
        return redirect()->back();
    }

    /**
     * Update Category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateDailyQuizAudioQuestion(Request $request, $id)
    {
        $question = AudioQuestion::find($id);
        if (!empty($request->question_audio_url)) {
            @unlink('/uploads/questions/'.$question->question_audio_url);
            $new_name = time() . $request->file('question_audio_url')->getClientOriginalName();
            $request->question_audio_url->move('uploads/questions/', $new_name);
            $question->question_audio_url = $new_name;
        }
        $question->category_id = $request->category_id;
        $question->subcategory_id = $request->subcategory_id;
        $question->quiz_id = $request->quiz_id;
        $question->points = $request->points;
        $question->seconds = $request->seconds;
        $question->hint = $request->hint;
        $question->true_answer = $request->true_answer;
        $question->false1 = $request->false1;
        $question->false2 = $request->false2;
        $question->false3 = $request->false3;
        $question->save();
        Session::flash('success', 'Your Question had been updated successfully!');
        return redirect()->back();
    }

}
