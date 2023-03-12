@extends('partials.admin.layout')

@section('title', 'Edit Subject')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h3 mb-3">Edit Subject</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.subjects') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('partials.flash-messages')
                            <form action="{{ route('admin.subject.edit', $subject) }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ? old('name') : $subject->name }}" placeholder="Enter the subject name!">

                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Description</label>

                                    <textarea class="form-control" name="description" id="description" cols="30" rows="3" placeholder="Enter the subject description!">{{ old('description') ? old('description') : $subject->description }}</textarea>
                                </div>

                                <div>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    <input type="reset" class="btn btn-dark" value="Reset">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
