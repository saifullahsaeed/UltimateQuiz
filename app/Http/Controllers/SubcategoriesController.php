<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubcategoriesController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories() {
    	$categories = Category::paginate(12);
        return view('subcategories')->with([
        	'categories'=>$categories
        ]);
    }

    /**
     * Show the subcategories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function subcategories($id) {
    	$subcategories = Subcategory::where('category_id', '=', $id)->paginate(10);
        return view('manage_subcategories')->with([
        	'subcategories'=>$subcategories,
            'categoryId'=>$id
        ]);
    }

    /**
     * Create New Subcategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function newSubcategory(Request $request, $id) {
        if (!empty($request->image_url)) {
            $new_name = time() . $request->file('image_url')->getClientOriginalName();
            $request->image_url->move('uploads/subcategories/', $new_name);
            $subcategory = Subcategory::create([
            'name' => $request->name,
            'image_url' => $new_name,
            'category_id' => $id,
            ]);
            Session::flash('success', 'New Subcategory created successfully!');
            return redirect()->back();
        } else {
        	Session::flash('error', 'Please enter a valid infos!');
            return redirect()->back();
        }
    }

    /**
     * Delete Subcategory.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteSubcategory($id) {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        Session::flash('success', 'This subcategory had been deleted successfully!');
        return redirect()->back();
    }

    /**
     * Update Subcategory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateSubcategory(Request $request, $id)
    {
        $subcategory = Subcategory::find($id);
        if (!empty($request->image_url)) {
            @unlink('/uploads/subcategories/'.$subcategory->image_url);
            $new_name = time() . $request->file('image_url')->getClientOriginalName();
            $request->image_url->move('uploads/subcategories/', $new_name);
            $subcategory->image_url = $new_name;
        }
        $subcategory->name = $request->name;
        $subcategory->save();
        Session::flash('success', 'Your subcategory had been updated successfully!');
        return redirect()->back();
    }
}
