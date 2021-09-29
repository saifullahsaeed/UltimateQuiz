<?php

namespace App\Http\Controllers;

use App\Http\Resources\Categories\CategoriesCollection;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiCategoriesController extends Controller
{
    /**
     * show popular categories
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function showPopularCategories($key) {
    	$api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
        	return CategoriesCollection::collection(Category::where('popular_or_not', 'yes')->get());
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
    public function showAllCategories($key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return CategoriesCollection::collection(Category::all());
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }
}
