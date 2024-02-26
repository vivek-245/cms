@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ $record->id > 0 ? 'Update Tasks' : 'Create Tasks' }}
                </div>
                <div class="card-body">
                    <form action="{{ $record->id > 0 ? route('tasks.update', $record->id) : route('tasks.store') }}" method="POST">
                        @csrf

                        @if ($record->id > 0)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="Title" class="form-label">Title</label>
                            <input type="title" class="form-control" name="title" id="Title" value="{{ old("title", $record->title) }}">
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="content" rows="10">{{ old("description", $record->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old("due_date", $record->due_date) }}">
                            @error('due_date')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">-- Select --</option>
                                @foreach (config('site.task_statuses') as $value => $label)
                                    <option {{ $value == old("status", $record->status) ? "selected" : "" }} value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
