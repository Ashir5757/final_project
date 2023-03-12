@extends('partials.web-pages.layout')

@section('title', 'Home')

@section('content')

    <main>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container py-5">
                <h1 class="display-5 fw-bold">Start with PreparePSC</h1>
                <p class="col-md-8 fs-4">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum excepturi obcaecati quod tenetur eveniet dolor odit quo officiis, natus similique repudiandae facilis quae beatae, odio corrupti, quaerat autem amet sequi.
                </p>
                <button class="btn btn-primary btn-lg" type="button">Get Started</button>
            </div>
        </div>

        <div class="container marketing">

            <div class="row my-5">
                <div class="col-12">
                    <h1 class="text-center">3Ps, Preparation Tool</h1>
                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt magnam in dicta ut optio odit voluptates pariatur mollitia quos! Cumque sit molestiae repudiandae, exercitationem natus eligendi corrupti, magnam minus veritatis pariatur distinctio commodi? Nobis incidunt aut at quas exercitationem cumque suscipit dicta commodi earum, nulla perspiciatis sunt, laboriosam tempore inventore? Distinctio neque eos, facere veritatis accusantium, nisi earum animi ducimus consequuntur labore, corrupti maiores voluptatem. Quod debitis velit sit sunt necessitatibus aspernatur hic perspiciatis dicta. Unde rem suscipit fugiat corporis, eos accusantium, animi ullam iure maxime perspiciatis labore? Veritatis minima, voluptatum quasi repellendus natus amet illo ipsum voluptatibus repellat rem.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="fw-normal">Prepare</h2>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum excepturi obcaecati quod tenetur eveniet dolor odit quo officiis, natus similique repudiandae facilis quae beatae, odio corrupti, quaerat autem amet sequi.
                            </p>
                            <p><a class="btn btn-secondary" href="{{ route('select.subjects.prepare') }}">Start Diving &raquo;</a></p>
                        </div>
                    </div>

                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="fw-normal">Practice</h2>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum excepturi obcaecati quod tenetur eveniet dolor odit quo officiis, natus similique repudiandae facilis quae beatae, odio corrupti, quaerat autem amet sequi.
                            </p>
                            <p><a class="btn btn-secondary" href="{{ route('select.subjects.practice') }}">Dive Deeper &raquo;</a></p>
                        </div>
                    </div>

                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="fw-normal">Participate</h2>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum excepturi obcaecati quod tenetur eveniet dolor odit quo officiis, natus similique repudiandae facilis quae beatae, odio corrupti, quaerat autem amet sequi.
                            </p>
                            <p><a class="btn btn-secondary" href="#">Final Dive &raquo;</a></p>
                        </div>
                    </div>

                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->

        </div><!-- /.container -->


        @include('partials.web-pages.footer')
    </main>

@endsection
