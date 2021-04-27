<!DOCTYPE html>
<html lang="ID">

<head>
    <meta charset="utf-8">
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')

    <!-- favicon -->
    <link href="{{asset('images/logo_mini.svg')}}" rel="apple-touch-icon" sizes="144x144" />
    <link href="{{asset('images/logo_mini.svg')}}" rel="apple-touch-icon" sizes="114x114" />
    <link href="{{asset('images/logo_mini.svg')}}" rel="apple-touch-icon" sizes="72x72" />
    <link href="{{asset('images/logo_mini.svg')}}" rel="apple-touch-icon" />
    <link href="{{asset('images/logo_mini.svg')}}" rel="shortcut icon" />

    <!-- css -->
    <link rel="stylesheet" href="{{asset('css/socmedia.css')}}" />

    @livewireStyles

    @stack('custom-styles')
</head>

<body>
    @livewire('main.preloader')

    @livewire('main.menu')

    @livewire('main.aside')

    @yield('content')

    @livewire('main.footer')

    @livewireScripts
    <script src="{{asset('js/socmedia.js')}}"></script>

    {{-- plugins --}}
    <script src="{{asset('js/plugins/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('js/plugins/isotope.min.js')}}"></script>
    <script src="{{asset('js/plugins/swiper.min.js')}}"></script>
    <script src="{{asset('js/plugins/TweenMax.min.js')}}"></script>
    <script src="{{asset('js/plugins/odometer.min.js')}}"></script>
    <script src="{{asset('js/plugins/fancybox.min.js')}}"></script>
    <script src="{{asset('js/plugins/wow.min.js')}}"></script>
    <script src="{{asset('js/plugins/scripts.js')}}"></script>

    @stack('custom-scripts')
</body>

</html>
