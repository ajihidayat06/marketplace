<div class="col-md-10 offset-md-2">
<nav class="navbar navbar-expand-lg navbar-light shadow-sm p-3 mb-3 bg-white rounded" style="background-color:white">
        <a style="color: #0C65F0;" class="navbar-brand" href="/dashboard">
            <span class="" style="font-weight: bold;">Marketplace Penyewaan Barang</span>
        </a>
        
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
            {{-- <form class="form-inline" action="{{ route('search') }}" method="GET">
                <input class="form-control mr-sm-2" type="text" name="search" id="search" value="{{ request()->input('search') }}" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
            <ul class="navbar-nav p-2">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</span></a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/pengaturan_admin">Pengaturan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Bantuan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
            </ul>
                
        </div>
</nav>
</div>