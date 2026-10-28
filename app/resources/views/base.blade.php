<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
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
        @yield('styles')

        {{-- Pre scripts --}}
        @yield('pre_scripts')
    </head>
    <body class="bg-dark">
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
        @yield('header')
        @yield('content')
        @yield('footer')

        {{-- Post scripts --}}
        <script src="{{ assets('app/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ assets('app/index.js') }}" type="module"></script>
        <script type="module">
            const flashMessages = @json(session('success'));

            if (flashMessages) {
                window.alert.show(flashMessages, 'success');
            }
        </script>
        @yield('post_scripts')
    </body>
</html>
