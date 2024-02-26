@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Tasks</h5>
                        <div>
                            <a class="btn btn-primary" href="{{ route('tasks.create') }}">Create</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#datatable").DataTable({
            ajax: {
                url: route('tasks.index'),
                data: function(d) {
                },
                error: function(data) {
                },
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'title'
                },
                {
                    data: 'description'
                },
                {
                    data: 'status'
                },
                {
                    data: 'due_date'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'action'
                }
            ],
        });

        $("body").on("click", ".delete-record", function() {

            if (confirm('Are you sure!\nNote: This action cannot be undone.')) {
                $(this).parent('form').submit();
            }
        });
    </script>
@endsection
