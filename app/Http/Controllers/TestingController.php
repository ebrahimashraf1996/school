<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Student;
use App\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function  index() {
        $user = User::find(1);
//        return $user-> categories;

        $category = Category::first();
        //return $category->students;

        $student = Student::with('columns')->first();
        return $student;
    }
}
