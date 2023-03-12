@extends('partials.web-pages.layout')

@section('title', 'Home')

@section('content')

    <main>

        <div class="container marketing">
            <div class="row my-5">

                <div class="col-md-3">

                    @foreach ($subject->topics as $topic)
                        <div class="card mb-2">
                            <div class="">
                                <a href="{{ route('prepare', [$topic->subject, $topic]) }}"
                                    class="d-block text-decoration-none text-dark p-2">{{ $topic->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-9">
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-10">
                                            <h5>{{ $loop->iteration . '. ' . $question->text }}</h5>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-dark" onclick="toggle({{ $question->id }})">Show Answer</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <ol>
                                                @foreach ($question->choices as $choice)
                                                    @if ($choice->is_correct == 1)
                                                        @php
                                                            $correct = $choice->text;
                                                            $number = $loop->iteration;
                                                        @endphp
                                                    @else
                                                    @endif
                                                    <li>{{ $choice->text }}</li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <p class="border rounded p-2 d-none" id="{{ $question->id }}">{{ $number . '. ' . $correct }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card border shadow text-bg-danger">
                            <div class="card-body">
                                No Questions Found
                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div><!-- /.container -->


        @include('partials.web-pages.footer')
    </main>

    <script>
        function toggle(id) {
            let correctElement = document.getElementById(id);
            correctElement.classList.toggle('d-none');
        }
    </script>
@endsection
