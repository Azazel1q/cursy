<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view("index",["courses"=>$courses]);
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

    public function show($id) {
        $category = Category::find($id)->courses()->get();
        return view("categoriesdetail", ['courses'=>$category]);
    }
}
