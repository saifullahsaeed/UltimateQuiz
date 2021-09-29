<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories() {
    	$categories = Category::paginate(10);
        return view('categories')->with([
        	'categories'=>$categories
        ]);
    }

    /**
     * Create New Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function newCategory(Request $request) {
        if (!empty($request->category_img)) {
            $new_name = time() . $request->file('category_img')->getClientOriginalName();
            $request->category_img->move('uploads/categories/', $new_name);
            $category = Category::create([
            'category_name' => $request->category_name,
            'category_img' => $new_name,
            'popular_or_not' => $request->popular_or_not,
            ]);
            Session::flash('success', 'New Category created successfully!');
            return redirect()->back();
        } else {
        	Session::flash('error', 'Please enter a valid infos!');
            return redirect()->back();
        }
    }

    /**
     * Update Category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request, $id)
    {
    	$category = Category::find($id);
        if (!empty($request->category_img)) {
            @unlink('/uploads/categories/'.$category->category_img);
            $new_name = time() . $request->file('category_img')->getClientOriginalName();
            $request->category_img->move('uploads/categories/', $new_name);
            $category->category_img = $new_name;
        }
        $category->category_name = $request->category_name;
        $category->popular_or_not = $request->popular_or_not;
        $category->save();
        Session::flash('success', 'Your Category had been updated successfully!');
        return redirect()->back();
    }

    /**
     * Delete Category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteCategory($id) {
    	$category = Category::find($id);
        $category->delete();
        Session::flash('success', 'This category had been deleted successfully!');
        return redirect()->back();
    }
}
