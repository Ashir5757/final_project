@extends('partials.web-pages.layout')

@section('title', 'Home')

@section('content')

    <main>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container py-5">
                <h1 class="display-5 fw-bold text-center">Something</h1>
                <p class="col-md-8 fs-4">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum excepturi obcaecati quod tenetur eveniet
                    dolor odit quo officiis, natus similique repudiandae facilis quae beatae, odio corrupti, quaerat autem
                    amet sequi.
                </p>
            </div>
        </div>

        <div class="container marketing">

            <h1 class="text-center">Select the subject</h1>

            <div class="row my-5">
                @if (count($subjects) > 0)
                    @foreach ($subjects as $subject)
                        <div class="col-md-4">
                            <div class="card border shadow">
                                <div class="card-body">
                                    <a href="{{ route($route, $subject) }}" style="text-decoration: none;"
                                        class="d-block text-decoration-none h4 text-center">{{ $subject->name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-4 mx-auto">
                        <div class="card border shadow text-bg-danger">
                            <div class="card-body">
                                No Subjects Found
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div><!-- /.container -->


        @include('partials.web-pages.footer')
    </main>

@endsection
