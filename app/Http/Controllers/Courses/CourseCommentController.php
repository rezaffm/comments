<?php

namespace App\Http\Controllers\Courses;

use App\Course;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseCommentController extends Controller
{
    public function index(Course $course)
    {
        return CommentResource::collection(
            $course->comments()->with(['user', 'children'])->paginate(1)
        );
    }

    public function store(Request $request, Course $course)
    {
        $this->validate($request, [
            'body' => 'required|max:5000'
        ]);

        $comment = $course->comments()->make([
            'body' => $request->body
        ]);

        $request->user()->comments()->save($comment);

        return new CommentResource($comment);
    }
}
