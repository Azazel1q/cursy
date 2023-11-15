<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Course::all();
        return view("index",["categories"=>$categories]);
    }

    public function create(Request $request){

            $request->validate([
                "title"=>"required|string",

            ],[
                "title.required"=>"Зполните поле",
                "title.string"=>"Зполните поле",
            ]);
        $category_info = $request->all();
        Category::create([
        "title" => $category_info["title"],
        ]);
    }
}
