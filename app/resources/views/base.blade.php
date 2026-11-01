<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
    <head>
        {{-- Meta --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')

        {{-- Title --}}
        <title>@yield('title', 'Starter')</title>

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ assets('styles/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ assets('styles/app.css') }}">
        <link type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
        @yield('styles')

        {{-- Pre scripts --}}
        @yield('pre_scripts')
    </head>
    <body class="bg-light">
        {{-- Alerts --}}
        <div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"></div>
        </div>

        {{-- Loading spinner --}}
        <div class="loading-container d-none">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        {{-- Page content --}}
        @include('navbar')
        @yield('header')
        @yield('content')
        @yield('footer')

        {{-- Post scripts --}}
        <script src="{{ assets('app/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ assets('app/index.js') }}" type="module"></script>
        <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2"></script>
        <script type="module">
            const flashMessages = @json(session('success'));
            const errors = @json($errors->all());

            if (flashMessages) {
                window.alert.show(flashMessages, 'success');
            } else if (errors.length) {
                window.alert.show(errors.join('<br> '), 'danger');
            }
        </script>
        @yield('post_scripts')
    </body>
</html>
