<nav class="navbar navbar-expand-lg navbar-light shadow-sm p-3 bg-white rounded" style="background-color:white">
    <div class="container">
        <a style="color: #1A97BA;" class="navbar-brand" href="/">
            <img class="logo" src="{{ asset('img/logo1.png') }}" alt="">
            <span class="border-left" style="font-weight: bold;">Marketplace Penyewaan Barang</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav" style="margin-left: auto">
                <a style="font-weight: bold;" class="navigasi tombol-nav pink rounded" href="/home">Beranda <span class="sr-only">(current)</span></a>
                <a style="font-weight: bold;" class="navigasi tombol-nav pink rounded" href="/pengaturan">Pengaturan <span class="sr-only">(current)</span></a>
            </div>
        </div> --}}
        @auth
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
            <form class="form-inline" action="{{ route('search') }}" method="GET">
                <input class="form-control mr-sm-2" type="text" name="search" id="search" value="{{ request()->input('search') }}" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="navbar-nav p-2">
                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/pengaturan">Pengaturan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Bantuan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
            </ul>
                
        </div>
            
        @endauth

        @guest
        
            {{-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav" style="margin-left: auto">
                    <a style="font-weight: bold" class="navigasi tombol-konten pink rounded" href="/login">Masuk <span class="sr-only">(current)</span></a>
                    <a style="font-weight: bold;" class="navigasi1 tombol-konten utu rounded" href="/register">Daftar</a>
        
                        <a style="color: #650AF6; width: 80px; text-align: center; font-weight: bold;" class="nav-link" href="#">Bantuan</a>
                </div>
            </div> --}}
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            </ul>
        @endguest
</nav>

<div class="container">
    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{session()->get('success_message')}}
        </div>
    @endif
    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        
    @endif
</div>