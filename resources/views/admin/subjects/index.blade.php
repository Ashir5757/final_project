@extends('partials.admin.layout')

@section('title', 'Subjects')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h3 mb-3">Subjects</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.subject.create') }}" class="btn btn-outline-primary">Add Subject</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('partials.flash-messages')
                            @if (count($subjects))
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Topics</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>{{ $subject->slug }}</td>
                                                <td>{{ count($subject->topics) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.subject.edit', $subject) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        onclick="deleteSubject({{ $subject }})">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger">
                                    No record Found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function deleteSubject(subject) {
            const deleteFormElement = document.getElementById('deleteForm');
            var url = "{{ route('admin.subject.delete', ':id') }}";
            url = url.replace(':id', subject.id);
            deleteFormElement.action = url;
        }
    </script>
@endsection
