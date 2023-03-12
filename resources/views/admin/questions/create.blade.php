@extends('partials.admin.layout')

@section('title', 'Add Question')

@section('main')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-6">
                    <h1 class="h3 mb-3">Add Question</h1>
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
                            <form action="{{ route('admin.question.create') }}" method="post">
                                @csrf

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
                                            <option value="" selected disabled hidden>Please select the subject first!
                                            </option>
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
                                        rows="3" placeholder="Enter the question!">{{ old('question') }}</textarea>

                                    @error('question')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @for ($i = 1; $i < 5; $i++)
                                    @php
                                        $choice = 'choice_' . $i;
                                    @endphp
                                    <div class="mb-3">
                                        <label for="" class="form-label">Choice #{{ $i }}</label>
                                        <input type="text" class="form-control @error($choice) is-invalid @enderror"
                                            name="{{ $choice }}" id="{{ $choice }}"
                                            value="{{ old($choice) }}"
                                            placeholder="Enter the choice #{{ $i }}!">

                                        @error($choice)
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endfor

                                <div class="mb-3">
                                    <label for="" class="form-label">Correct Choice</label>
                                    <input type="number" class="form-control @error('correct_choice') is-invalid @enderror"
                                        name="correct_choice" id="correct_choice" value="{{ old('correct_choice') }}"
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
                                        cols="30" rows="3" placeholder="Enter the explanation!">{{ old('explanation') }}</textarea>

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
                    // console.log(result);
                    topicElement.innerHTML = result;
                });
        });
    </script>
@endsection
