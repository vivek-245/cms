@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ $record->id > 0 ? 'Update Blog' : 'Create Blog' }}
                </div>
                <div class="card-body">
                    <form action="{{ $record->id > 0 ? route('blogs.update', $record->id) : route('blogs.store') }}" method="POST">
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
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="content" rows="10">{{ old("content", $record->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">-- Select --</option>
                                @foreach (config('site.statuses') as $value => $label)
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
