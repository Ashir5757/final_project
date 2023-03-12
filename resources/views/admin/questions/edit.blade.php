@extends('partials.admin.layout')

@section('title', 'Edit Question')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-6">
                    <h1 class="h3 mb-3">Edit Question</h1>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('admin.questions') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('partials.flash-messages')
                            <form action="{{ route('admin.question.edit', $question) }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <select class="form-select @error('subject') is-invalid @enderror" name="subject"
                                        id="subject">
                                        <option value="" selected disabled hidden>Please select the subject!</option>
                                        @foreach ($subjects as $subject)
                                            @if (old('subject'))
                                                @php
                                                    if ($subject->id == old('subject')) {
                                                        $subject_model = $subject;
                                                    }
                                                @endphp
                                            @else
                                                @php
                                                    if ($subject->id == $question->topic->subject_id) {
                                                        $subject_model = $subject;
                                                    }
                                                @endphp
                                            @endif

                                            <option value="{{ $subject->id }}"
                                                @if (old('subject')) {{ old('subject') == $subject->id ? 'selected' : '' }} @else {{ $question->topic->subject_id == $subject->id ? 'selected' : '' }} @endif>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('subject')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="topic" class="form-label">Topic</label>
                                    <select class="form-select @error('topic') is-invalid @enderror" name="topic"
                                        id="topic">
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
                                            @foreach ($topics as $topic)
                                                @if ($topic->subject_id == $question->topic->subject_id)
                                                    <option value="{{ $topic->id }}"
                                                        {{ $question->topic_id == $topic->id ? 'selected' : '' }}>
                                                        {{ $topic->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif

                                    </select>

                                    @error('topic')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Question</label>
                                    <textarea class="form-control @error('question') is-invalid @enderror" name="question" id="question" cols="30"
                                        rows="3" placeholder="Enter the question!">{{ old('question') ?? $question->text }}</textarea>

                                    @error('question')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @foreach ($question->choices as $choice)
                                    @php
                                        $choice_number = 'choice_' . $loop->iteration;
                                        if ($choice->is_correct == 1) {
                                            $correct_choice = $loop->iteration;
                                        }
                                    @endphp
                                    <div class="mb-3">
                                        <label for="" class="form-label">Choice #{{ $loop->iteration }}</label>
                                        <input type="text"
                                            class="form-control @error($choice_number) is-invalid @enderror"
                                            name="{{ $choice_number }}" id="{{ $choice_number }}"
                                            value="{{ old($choice_number) ?? $choice->text }}"
                                            placeholder="Enter the choice #{{ $loop->iteration }}!">

                                        @error($choice_number)
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="mb-3">
                                    <label for="" class="form-label">Correct Choice</label>
                                    <input type="number" class="form-control @error('correct_choice') is-invalid @enderror"
                                        name="correct_choice" id="correct_choice"
                                        value="{{ old('correct_choice') ?? $correct_choice }}"
                                        placeholder="Enter the correct choice!">

                                    @error('correct_choice')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Explanation</label>
                                    <textarea class="form-control @error('explanation') is-invalid @enderror" name="explanation" id="explanation"
                                        cols="30" rows="3" placeholder="Enter the explanation!">{{ old('explanation') ?? $question->explanation }}</textarea>

                                    @error('explanation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
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

    <script>
        const subjectElement = document.querySelector('#subject');
        const topicElement = document.querySelector('#topic');

        subjectElement.addEventListener('change', function() {
            const subjectElementValue = subjectElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            const data = {
                subjectId: subjectElementValue,
                _token: token,
            };

            fetch('{{ route('admin.subject.topics') }}', {
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
                });
        });
    </script>
@endsection
