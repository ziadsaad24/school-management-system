<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @yield('css')


     <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- لو عندك CSS/JS أساسي هنا ضيفه بـ asset --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.scss') }}">
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Themify Icons -->
<link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">

    <script src="{{ asset('assets/js/main.js') }}"></script>

    @include('layouts.head')
</head>
@yield('js')


<body>

    <div class="wrapper">

        <!--=================================
        preloader -->
        <div id="pre-loader">
            <img src="{{ asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>
        <!--=================================
        preloader -->

        @include('layouts.main-header')
        @include('layouts.main-sidebar')

        <!--=================================
        Main content -->
        <div class="content-wrapper">
            @yield('page-header')
            @yield('content')

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>

    <!--=================================
    footer -->

    @include('layouts.footer-scripts')
    @livewireScripts

</body>

</html>
