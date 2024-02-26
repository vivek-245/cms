@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">

            <p><strong>Title</strong></p>
            <p>{{ $blog->title }}</p>
            <hr>

            <p><strong>Content</strong></p>
            <p>{!! nl2br($blog->content) !!}</p>

            <p><strong>Published</strong></p>
            <p>
                {{ !is_null($blog->published_at) ? date('d M Y h:i A', strtotime($blog->published_at)) : 'not yet.'  }}
            </p>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
