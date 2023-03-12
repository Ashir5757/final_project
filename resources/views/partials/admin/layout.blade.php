<!DOCTYPE html>
<html lang="en">

@include('partials.admin.head')

<body>
    <div class="wrapper">
        @include('partials.admin.side-navbar')

        <div class="main">
            @include('partials.admin.top-navbar')

            @yield('main')

            {{-- <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Heading</h1>
                </div>
            </main> --}}

            @include('partials.admin.footer')
        </div>
    </div>

    @include('partials.admin.modals')
    <script src="{{ asset('template/js/app.js') }}"></script>
</body>

</html>
