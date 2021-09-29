<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuizzesController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories() {
    	$categories = Category::paginate(12);
        return view('quizzes')->with([
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
        return view('quizzes_subcategories')->with([
            'subcategories'=>$subcategories,
            'categoryId'=>$category
        ]);
    }

    /**
     * Show the subcategories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function quizzesGet($category, $id) {
        $quizzes = Quiz::where('subcategory_id', '=', $id)->paginate(10);
        return view('manage_quizzes')->with([
            'quizzes'=>$quizzes,
            'subcategoryId'=>$id,
            'categoryId'=>$category,
        ]);
    }

    /**
     * Create New Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function newQuiz(Request $request, $category, $id) {
        if (!empty($request->image_url)) {
            $new_name = time() . $request->file('image_url')->getClientOriginalName();
            $request->image_url->move('uploads/quizzes/', $new_name);
            Quiz::create([
            'name' => $request->name,
            'image_url' => $new_name,
            'category_id' => $category,
            'subcategory_id' => $id,
            ]);
            Session::flash('success', 'New Quiz created successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Please enter a valid infos!');
            return redirect()->back();
        }
    }

    /**
     * Delete quiz.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteMyQuiz($id) {
       $quiz = Quiz::find($id);
        $quiz->delete();
        Session::flash('success', 'This quiz had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Update quiz.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateQuiz(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        if (!empty($request->image_url)) {
            @unlink('/uploads/quizzes/'.$quiz->image_url);
            $new_name = time() . $request->file('image_url')->getClientOriginalName();
            $request->image_url->move('uploads/quizzes/', $new_name);
            $quiz->image_url = $new_name;
        }
        $quiz->name = $request->name;
        $quiz->save();
        Session::flash('success', 'Your quiz had been updated successfully!');
        return redirect()->back();
    }
}
