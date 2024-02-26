<div class="d-flex align-items-center gap-1">
    <a href='{{ route('blogs.edit', $blog->id) }}' class='btn btn-secondary'>Edit</a>

    <form class="delete-record-form" action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" class='btn btn-danger delete-record'>Delete</button>
    </form>
</div>
