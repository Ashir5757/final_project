@extends('partials.web-pages.layout')

@section('title', 'Home')

@section('content')

    <main>

        <div class="container marketing">
            <div class="row my-5">

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">
                                <span class="badge bg-primary ">Question <span id="current">1</span> of <span
                                        id="total">{{ $total }}</span></span>
                            </h4>

                            <div id="msg"></div>

                            <h5 id="question">Q. {{ $question->text }}</h5>

                            @csrf
                            <ul class="list-group">
                                @foreach ($question->choices as $choice)
                                    <li class="list-group-item">
                                        <label class="d-block">
                                            <input class="with-gap" name="choice" id="choice_id_{{ $loop->iteration }}"
                                                value="{{ $choice->id }}" type="radio">
                                            <span id="choice_text_{{ $loop->iteration }}">{{ $choice->text }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            <button class="btn btn-primary mt-2" id="btn-submit">Submit</button>
                            <a href="{{ route('home') }}" class="btn btn-primary mt-2 d-none" id="btn-back">Home</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2>Live Evaluation</h2>
                            <ol id="list">
                            </ol>
                        </div>
                    </div>
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

        const btnSubmitElement = document.getElementById('btn-submit');
        const btnBackElement = document.getElementById('btn-back');
        const questionElement = document.getElementById('question');
        const currentElement = document.getElementById('current');

        const choiceIdOneElement = document.getElementById('choice_id_1');
        const choiceIdTwoElement = document.getElementById('choice_id_2');
        const choiceIdThreeElement = document.getElementById('choice_id_3');
        const choiceIdFourElement = document.getElementById('choice_id_4');

        const choiceTextOneElement = document.getElementById('choice_text_1');
        const choiceTextTwoElement = document.getElementById('choice_text_2');
        const choiceTextThreeElement = document.getElementById('choice_text_3');
        const choiceTextFourElement = document.getElementById('choice_text_4');

        currentQuestion = 1;
        btnSubmitElement.addEventListener('click', function() {
            const selectedElement = document.querySelector('input[name="choice"]:checked');
            const tokenElement = document.querySelector('input[name="_token"]');
            const token = tokenElement.value;

            let selectedValue = '';
            if (selectedElement) {
                selectedValue = selectedElement.value;
            }

            if (selectedElement) {
                const data = {
                    choice_id: selectedValue,
                    currentQuestion: currentQuestion,
                    _token: token,
                };

                fetch('{{ route('question.check') }}', {
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
                        const listElement = document.getElementById('list');

                        if (result.status == 'Correct') {
                            listElement.innerHTML += '<li class="text-success">Correct</li>';
                        } else {
                            listElement.innerHTML += '<li class="text-danger">Incorrect</li>';
                        }

                        selectedElement.checked = false;

                        if (result.end == true) {

                            tokenElement.remove();
                            btnSubmitElement.remove();
                            btnBackElement.classList.remove('d-none');
                        } else {
                            tokenElement.value = result['new_token'];
                            currentQuestion++;

                            questionElement.innerText = 'Q. ' + result.next_question.text;

                            choiceIdOneElement.value = result.choices[0].id;
                            choiceIdTwoElement.value = result.choices[1].id;
                            choiceIdThreeElement.value = result.choices[2].id;
                            choiceIdFourElement.value = result.choices[3].id;

                            choiceTextOneElement.innerText = result.choices[0].text;
                            choiceTextTwoElement.innerText = result.choices[1].text;
                            choiceTextThreeElement.innerText = result.choices[2].text;
                            choiceTextFourElement.innerText = result.choices[3].text;

                            currentElement.innerText = currentQuestion;

                        }

                        // console.log(currentQuestion);
                        // console.table(result);
                    });
            } else {
                const msgElement = document.getElementById('msg');
                const alertElement =
                    `<div class="alert alert-danger alert-dismissible fade show" role="alert">Please select any choice!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
                msgElement.innerHTML = alertElement;
            }
        });
    </script>
@endsection
