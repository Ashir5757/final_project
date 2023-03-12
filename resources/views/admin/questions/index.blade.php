@extends('partials.admin.layout')

@section('title', 'Questions')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h3 mb-3">Questions</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.question.create') }}" class="btn btn-outline-primary">Add Question</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            @include('partials.flash-messages')

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <select class="form-select @error('subject') is-invalid @enderror" name="subject"
                                    id="subject">
                                    <option value="" selected disabled hidden>Please select the subject!</option>
                                    @foreach ($subjects as $subject)
                                        @php
                                            if ($subject->id == old('subject')) {
                                                $subject_model = $subject;
                                            }
                                        @endphp
                                        <option value="{{ $subject->id }}"
                                            {{ old('subject') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mb-3">
                                <label for="topic" class="form-label">Topic</label>
                                <select class="form-select" name="topic" id="topic">
                                    @if (old('subject') || old('topic'))
                                        @if (count($subject_model->topics) > 0)
                                            <option value="" selected disabled hidden>Please select the topic!
                                            </option>
                                            @foreach ($topics as $topic)
                                                @if ($topic->subject_id == old('subject'))
                                                    <option value="{{ $topic->id }}"
                                                        {{ old('topic') == $topic->id ? 'selected' : '' }}>
                                                        {{ $topic->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="" selected disabled hidden>No Topic Found!
                                            </option>
                                        @endif
                                    @else
                                        <option value="" selected disabled hidden>Please select the subject first!
                                        </option>
                                    @endif

                                </select>
                            </div>

                            <div id="all_questions">
                            </div>

                            {{--
                            @if (count($questions))
                                @foreach ($questions as $question)
                                    <div class="card shadow-lg">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    Subject: {{ $question->topic->subject->name }}
                                                </div>
                                                <div class="col-md-6">
                                                    Topic: {{ $question->topic->name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-header pb-0">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5>Question: {{ $question->text }}</h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="{{ route('admin.question.edit', $question) }}" class="btn btn-primary">Edit</a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        onclick="deleteQuestion({{ $question }})">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <ol>
                                                        @foreach ($question->choices as $choice)
                                                        <li>
                                                            {{ $choice->text }} {{ $choice->is_correct == 1 ? "(Corrrect)" : "" }}
                                                        </li>
                                                        @endforeach

                                                    </ol>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Explanation: {{ $question->explanation }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    No record Found!
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function deleteQuestion(question) {
            const deleteFormElement = document.getElementById('deleteForm');
            var url = "{{ route('admin.question.delete', ':id') }}";
            url = url.replace(':id', question.id);
            deleteFormElement.action = url;
        }
    </script>


    {{-- To fetch all topics --}}
    <script>
        const subjectElement = document.querySelector('#subject');
        const topicElement = document.querySelector('#topic');

        subjectElement.addEventListener('change', function() {
            const subjectElementValue = subjectElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            const data = {
                subjectId: subjectElementValue,
                _token: token,
            }

            fetch('{{ route('admin.question.subject.topic') }}', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(result) {
                    topicElement.innerHTML = result;
                })
        })
    </script>

    {{-- To fetch all questions --}}
    <script>

        const topicsElement = document.querySelector('#topic');
        const questionElement = document.querySelector('#all_questions');

        topicsElement.addEventListener('change', function() {
            const topicElementValue = topicsElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            const data = {
                topicId: topicElementValue,
                _token: token,
            }
            // console.log(data);
            fetch('{{ route('admin.question.topic.questions') }}', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(result) {
                    questionElement.innerHTML = result;
                    // console.log(result);
                })
        })
    </script>
@endsection
