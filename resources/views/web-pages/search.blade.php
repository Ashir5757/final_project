@extends('partials.web-pages.layout')

@section('title', 'search')

@section('content')

    <main>

        <center>

            <div class="p-5 mb-4 bg-light rounded-3 ">
                <div class="container py-5">
                    <div class="col s12 center-align">
                        <h1>Search Questions</h1>
                        <p>Enter the question to search from our database!</p>
                        <div class="container h-100">
                            <div class="d-flex justify-content-center h-100">
                                <form action="{{ route('questions.search') }}" method="GET">
                                    <div class="searchbar">

                                        <input class="search_input" type="text" name="query" placeholder="Search...">
                                        <button type="submit" class="search_icon"><i class="fas fa-search"></i></button>


                                        <div class="card shadow border-secondary mt-5">
                                            <div class="card-body">

                                            </div>
                                            @if (count($questions) > 0)
                                            <p>Search results for "{{ $query }}":</p>
                                            <ul>
                                                @foreach ($questions as $question)
                                                    <li>{{ $question->text }}</li>
                                                    <ul>
                                                        @foreach ($question->choices as $choice)
                                                            <li>{{ $choice->text }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No search results found for "{{ $query }}".</p>
                                        @endif

                                            </div>

                                        </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
        </center>




        @include('partials.web-pages.footer')
    </main>

@endsection
