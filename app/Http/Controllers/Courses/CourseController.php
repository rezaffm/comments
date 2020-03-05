<?php

namespace App\Http\Controllers\Courses;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
}
