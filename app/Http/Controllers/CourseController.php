<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CourseController extends Controller
{
    public function index(){
        $courses = Course::paginate(3);
        return view("index",["courses"=>$courses], compact('courses'));
    }

    public function create(Request $request){
        $request->validate([
            "title"=>"required|string",
            "description"=>"required|string",
            "duration"=>"required|integer",
            "cost"=>"required|integer",
            "image"=>"required",
        ],[
            "title.required"=>"Зполните поле",
            "description.required"=>"Зполните поле",
            "duration.required"=>"Зполните поле",
            "duration.integer"=>"Зполните поле",
            "cost.required"=>"Зполните поле",
            "cost.integer"=>"Зполните поле",
            "image.required"=>"Выберите картинку",
        ]);
        $course_info = $request->all();
        $file = $request->file("image");
        $file_name = md5($file->getClientOriginalName().time()) . "." . $file->getClientOriginalExtension();
        Storage::putFileAs("public/image", $file, $file_name);
        Course::create([
        "title" => $course_info["title"],
        "description" => $course_info["description"],
        "duration" => $course_info["duration"],
        "cost" => $course_info["cost"],
        "image" => $file_name,
        "category_id" => $course_info["category"],
        ]);
    }
}
