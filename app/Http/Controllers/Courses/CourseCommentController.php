<?php

namespace App\Http\Controllers\Courses;

use App\Course;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseCommentController extends Controller
{
    public function index(Course $course)
    {
        return CommentResource::collection(
            // @todo add children relationship
            $course->comments()->with(['user'])->get()
        );
    }
}
