@if (session()->has('message') && session('type'))
    <div class="alert alert-{{ session('type') ?? 'warning' }} alert-dismissible fade show" role="alert">
        <strong>{{ session('title') }}</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
