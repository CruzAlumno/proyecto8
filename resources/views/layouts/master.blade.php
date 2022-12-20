<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Web Page to Calcule Fast Routes and Do Blablacar">
    <meta name="keywords" content="HTML5, CSS, JavaScript, EcoMaps, Calc Routes, Calc Gas, Blablacar">
    <meta name="author" content="KavX">
    <title>EcoMaps</title>
    <link rel="icon" type="image/svg+xml" href="/favicon_kvx.svg" sizes="any">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- BS4 Dependencyes -->
    <link rel="stylesheet" type="text/css" href="/assets/BS4/bootstrap.min.css"/>
    <!-- My Code -->
    <link rel="stylesheet" type="text/css" href="/MainStyleSheet.css"/>
    <script src="/assets/js/script.js"></script>
</head>
<body>
    <main role="main" class="container-fluid">
        <!-- Header -->
        @include('partials.header')
        <!-- Nav -->
        @if(Auth::check())
            @include('partials.menu')
        @endif
        <!-- Principal Content -->
        <section class="row main-content-container">
            @yield('content')
        </section>
    </main>
    <!-- Footer -->
    @include('partials.footer')
    <!-- BS4 JQUery & Popper.js -->
    <script src="/assets/BS4/popper.min.js"></script>
    <!-- <script src="/assets/BS4/bootstrap.bundle.min.js"></script>
    <script src="/assets/BS4/vendor/jquery-slim.min.js"></script>
    <script type="text/javascript" src="/assets/BS4/bootstrap.min.js"></script> -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>
</body>
</html>
