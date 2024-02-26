@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Blogs</h5>
                        <div>
                            <a class="btn btn-primary" href="{{ route('blogs.create') }}">Create</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
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
                url: route('blogs.index'),
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
                    data: 'published_at'
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
