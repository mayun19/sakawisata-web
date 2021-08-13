<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SAKAWISATA Admin - @yield('title')</title>

    @stack('prepend-style')
    <link
      rel="icon"
      href="{{ asset('img/sakawisata_logo.svg') }}"
      type="image/svg"
    />


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="{{ asset('bootstrap/bootstrap.css') }}"
    />
    <link href="{{ asset('style/main.css') }}" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;600;700&family=Kalam:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    
    @stack('addon-style')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <a href="{{ url('/') }}">
            <div class="sidebar-heading text-center">
              <img src="{{ asset('img/logo_sakawis.png') }}" alt="" class="my-4" style="max-width:150px;"/>
            </div>
          </a>
          <div class="list-group list-group-flush">
            <a href="{{ url('admin') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == '' ? 'active' : ''}}">
              Dashboard
            </a>
            <a href="{{ url('admin/member') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'member' ? 'active' : ''}}">
              Member
            </a>
            <a href="{{ url('admin/paket') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'paket' ? 'active' : ''}}">
              Paket Kunjungan
            </a>
            <a href="{{ url('admin/situs') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'situs' ? 'active' : ''}}">
              Situs Jelajah
            </a>
            <a href="{{ url('admin/profil-kauman') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'profil-kauman' ? 'active' : ''}}">
              Profil
            </a>
            <a href="{{ url('admin/pemandu') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'pemandu' ? 'active' : ''}}">
              Pemandu
            </a>
            <a href="{{ url('admin/sesi') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'sesi' ? 'active' : ''}}">
              Sesi Kunjungan
            </a>
            <a href="{{ url('admin/fasilitas') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'fasilitas' ? 'active' : ''}}">
              Fasilitas
            </a>
            <a href="{{ url('admin/pemesanan') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'pemesanan' ? 'active' : ''}}">
              Pemesanan
            </a>
            <div class="dropdown">
              <a href="#" class="list-group-item list-group-item-action dropdown-toggle {{ Request::segment(2) == 'laporan' ? 'active' : ''}}" data-toggle="dropdown">
                Laporan
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item {{ Request::segment(3) == 'transaksi' ? 'active' : ''}}" href="{{ url('admin/laporan/transaksi') }}">Transaksi</a>
                <a class="dropdown-item {{ Request::segment(3) == 'kunjungan' ? 'active' : ''}}" href="{{ url('admin/laporan/kunjungan') }}">Kunjungan</a>
              </div>
            </div>
            <a href="{{ url('admin/buku-tamu') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'buku-tamu' ? 'active' : ''}}">
              Buku Tamu
            </a>
            <a href="{{ url('admin/partners') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'partners' ? 'active' : ''}}">
              Partners
            </a>
            <a href="{{ url('admin/event') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'event' ? 'active' : ''}}">
              Event
            </a>
            <a href="{{ url('admin/faq') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'faq' ? 'active' : ''}}">
              FAQ
            </a>
          </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <nav
            class="navbar navbar-expand-lg navbar-light navbar-sakwis fixed-top"
            data-aos="fade-down"
            aria-label="Navbar"
          >
            <div class="container-fluid">
              <button
                class="btn btn-secondary d-md-none mr-auto mr-2"
                id="menu-toggle"
              >
                &laquo; Menu
              </button>

              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex ml-auto">
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
                    @if (file_exists(public_path('img/profil/'.session('foto'))))
                      <img class="rounded-circle mr-2 img-fluid profile-picture" src="{{ asset('img/profil/'.session('foto')) }}" alt="Profil Admin"/>
                    @else
                      <img
                        src="{{ asset('img/icon-user.png') }}"
                        alt=""
                        class="rounded-circle mr-2 profile-picture"
                      />
                    @endif
                      Hi, Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ url('admin/profil-admin') }}"
                        >Profil Admin</a
                      >
                      <a class="dropdown-item" href="{{ url('admin/pengaturan') }}"
                        >Pengaturan</a
                      >
                      <div class="dropdown-divider"></div>
                        <form action="{{ url('/logout') }}" method="post">
                          @csrf
                          <button class="dropdown-item" >Keluar</button>
                        </form>
                      {{-- <a class="dropdown-item" href="/">Keluar</a> --}}
                    </div>
                  </li>
                </ul>

                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                  <li class="nav-item">
                    <a class="nav-link" href="#"> Hi, Admin </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"> Profil Admin </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"> Pengaturan </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/"> Keluar </a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

          <!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              @yield('konten')
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="section-footer mb-1">
        <div class="container-fluid">
          <div class="row justify-content-center align-items-center pt-2">
            <div class="col-sm-12 col-md-12  text-center font-weight-light">
            <p class="mb-2"> ©2020 Copyright SAKAWISATA. All Right Reseved.</p> 
            </div>
          </div>
        </div>
      </footer>
      
    </div>
    <!-- Bootstrap core JavaScript -->

    @stack('prepend-script')
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    

    <script>
      AOS.init();
    </script>
    <!-- show sidebar menu-->
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });

      $(document).ready(function() {
    $('#datatable').DataTable();
    } );

    //format uang
    $(document).ready(function() {
    // Format mata uang.
    if ($(".uang").length) {
        $('.uang').mask('000.000.000', {
            reverse: true
        });
      }
    });
    </script>
    {{-- script tambahfoto --}}
    @stack('addon-script')
  </body>
</html>
