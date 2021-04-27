<!DOCTYPE html>

<html>

<head>
    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />

    @stack('plugin-styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @stack('style')

    @livewireStyles
</head>

<body data-base-url="{{url('/')}}">

    <script src="{{ asset('assets/js/spinner.js') }}"></script>

    <div class="main-wrapper" id="app">

        {{-- Sidebar --}}
        <x-sidebar />

        <div class="page-wrapper">

            {{-- Header --}}
            <x-header />

            {{-- Content goes here --}}
            <div class="page-content">
                @yield('content')
            </div>

            {{-- Footer --}}
            <x-footer />

        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    @stack('plugin-scripts')

    <script src="{{ asset('assets/js/template.js') }}"></script>
    @stack('custom-scripts')
    @livewireScripts
</body>

</html>
