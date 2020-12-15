<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <!-- CSS custom -->
    <link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
    <title>@yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('datepicker')
</head>

<body style="background-color:#FFFAFA">
    @yield('nav')

    <div class="container py-3 shadow-sm p-3 bg-white rounded"" style="">
    @yield('konten')
    </div>
    <footer class=" navbar-light py-4" style="background-image: linear-gradient(to bottom right, #23CBFA, #11647A);">
        <div class="container">
            <a style="color: white" class="navbar-brand" href="/">
                <img class="logo" src="{{ asset('img/logo2.png') }}" alt="">
                <span class="border-left">@Copyright 2020.</span>
            </a>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>

</html>