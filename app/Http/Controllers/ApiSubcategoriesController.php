<?php

namespace App\Http\Controllers;

use App\Http\Resources\Subcategories\SubcategoriesCollection;
use App\Models\Setting;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ApiSubcategoriesController extends Controller
{
    /**
     * show popular categories
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function showSubcategories($id, $key) {
    	$api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
        	return SubcategoriesCollection::collection(Subcategory::where('category_id', $id)->get());
        } else {
        	$result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
