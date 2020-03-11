@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="mb-3">{{ $course->name }}</h3>
                <comments endpoint="http://comments.test:8000/courses/course-a/comments" />
            </div>
        </div>
    </div>
@endsection

