@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">

            <p><strong>Title</strong></p>
            <p>{{ $task->title }}</p>
            <hr>

            <p><strong>Description</strong></p>
            <p>{!! nl2br($task->description) !!}</p>
            <hr>

            <p><strong>Due Date</strong></p>
            <p>
                {{ date('d M Y h:i A', strtotime($task->due_date))}}
            </p>
            <hr>

            <p><strong>Status</strong></p>
            <p>{{ ucfirst($task->status) }}</p>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
