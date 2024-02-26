<div class="d-flex align-items-center gap-1">
    <a href='{{ route('tasks.edit', $task->id) }}' class='btn btn-secondary'>Edit</a>

    <form class="delete-record-form" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" class='btn btn-danger delete-record'>Delete</button>
    </form>
</div>
