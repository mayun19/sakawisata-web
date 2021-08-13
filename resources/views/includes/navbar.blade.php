    <div class="container">
      <nav class="row navbar navbar-sakwis navbar-expand-lg navbar-light bg-white" data-aos="fade-down">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logo_sakawisata.png') }}" alt="Logo sakawisata_logo"/>
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
          <ul class="navbar-nav ml-auto mr-3">
            <li class="nav-item mx-md-2 {{ Request::segment(1) == '' ? 'active' : '' }}">
              <a href="{{ url('/') }}" class="nav-link">Beranda</a>
            </li>
            <li class="nav-item dropdown {{ Request::segment(1) == 'tentang' ||  Request::segment(1) == 'pemandu' ? 'active' : '' }}">
              <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Tentang</a>
              <div class="dropdown-menu">
                <a href="{{ url('tentang') }}" class="dropdown-item">Profil</a>
                <a href="{{ url('pemandu') }}" class="dropdown-item">Pemandu</a>
              </div>
            </li>
            <li class="nav-item dropdown {{ Request::segment(1) == 'paket' ||  Request::segment(1) == 'situs' ||  Request::segment(1) == 'bukutamu' || Request::segment(1) == 'tamu' ? 'active' : ''}}">
              <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Jelajah</a>
              <div class="dropdown-menu">
                <a href="{{ url('paket') }}" class="dropdown-item">Paket Kunjungan</a>
                <a href="{{ url('situs') }}" class="dropdown-item">Situs Jelajah</a>
                <a href="{{ url('bukutamu') }}" class="dropdown-item">Buku Tamu</a>
              </div>
            </li>
            <li class="nav-item dropdown {{ Request::segment(1) == 'event' || Request::segment(1) == 'faq' ? 'active' : ''}}">
              <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Informasi</a>
              <div class="dropdown-menu">
                <a href="{{ url('event') }}" class="dropdown-item">Event</a>
                <a href="{{ url('faq') }}" class="dropdown-item">FAQ</a>
              </div>
            </li>
          </ul>

          @if(session('level') == null)

          <!-- Mobile Button -->
          <form class="form-inline d-sm-block d-md-none">
            <button class="btn btn-login my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{ url('login') }}';">Masuk</button>
          </form>

          <!-- Desktop Button -->
          <form class="form-inline my-2 my-lg-0 d-none d-md-block">
            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{ url('login') }}';">
              Masuk
            </button>
          </form>

          @else
            <ul class="navbar-nav d-lg-flex">
              <li class="nav-item dropdown">
                <a
                  class="nav-link"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  @if(file_exists(public_path('img/member/'.session('foto'))))
                  <img
                    src="{{ asset('img/member/'.session('foto')) }}"
                    alt=""
                    class="rounded-circle mr-2 profile-picture"
                  />
                  @elseif(file_exists(public_path('img/profil/'.session('foto'))))
                  <img
                    src="{{ asset('img/profil/'.session('foto')) }}"
                    alt=""
                    class="rounded-circle mr-2 profile-picture"
                  />
                  @else
                  <?php
                    $words = explode(" ", session('name'));
                    $acronym = "";
                    foreach ($words as $w){
                      $acronym .= $w[0];
                    }
                  ?>
                  
                  <button class="btn btn-primary rounded-circle">{{$acronym}}</button>
                  @endif

                  Hi, {{ session('name') }}
                </a>
                @if (session('level') == 'member')
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('member') }}"
                    >Informasi Member</a
                  >
                  <a class="dropdown-item" href="{{ url('member/pemesanan') }}"
                    >Riwayat Pemesanan</a
                  >
                  <div class="dropdown-divider"></div>
                   <form action="{{ url('/logout') }}" method="post">
                      @csrf
                      <button class="dropdown-item mb-0" >Keluar</button>
                    </form>
                </div>
                @elseif(session('level') == 'admin')
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('admin') }}"
                    >Dashboard Admin</a
                  >
                  <a class="dropdown-item" href="{{ url('admin/profil-admin') }}"
                    >Profil Admin</a
                  >
                  {{-- <a class="dropdown-item" href="{{ url('admin/pengaturan') }}"
                    >Pengaturan</a
                  > --}}
                  <div class="dropdown-divider"></div>
                    <form action="{{ url('/logout') }}" method="post">
                      @csrf
                      <button class="dropdown-item" >Keluar</button>
                    </form>
                </div>
                @else
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                </div>
                @endif
              </li>
            </ul>
          @endif
        </div>
      </nav>
    </div>