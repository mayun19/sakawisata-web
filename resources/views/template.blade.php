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

    <title>SAKAWISATA Kampung Kauman Yogyakarta</title>
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
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="{{ asset('img/logo_sakawis.png') }}" alt="" class="my-4" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ url('admin') }}"
              class="list-group-item list-group-item-action active"
              >Dashboard</a
            >
            <a
              href="{{ url('admin/member') }}"
              class="list-group-item list-group-item-action"
              >Member</a
            >
            <a
              href="{{ url('admin/paket') }}"
              class="list-group-item list-group-item-action"
              >Paket Kunjungan</a
            >
            <a
              href="{{ url('admin/situs') }}"
              class="list-group-item list-group-item-action"
              >Situs Jelajah</a
            >
            <a
              href="{{ url('admin/profil') }}"
              class="list-group-item list-group-item-action"
              >Profil</a
            >
            <a
              href="{{ url('admin/pemandu') }}"
              class="list-group-item list-group-item-action"
              >Pemandu</a
            >
            <a
              href="{{ url('admin/sesi') }}"
              class="list-group-item list-group-item-action"
              >Sesi Kunjungan</a
            >
            <a
              href="{{ url('admin/fasilitas') }}"
              class="list-group-item list-group-item-action"
              >Fasilitas</a
            >
            <a
              href="{{ url('admin/pemesanan') }}"
              class="list-group-item list-group-item-action"
              >Pemesanan</a
            >
            <div class="dropdown">
              <a href="#" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown">
                Laporan
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('admin/laporan/transaksi') }}">Transaksi</a>
                <a class="dropdown-item" href="{{ url('admin/laporan/kunjungan') }}">Kunjungan</a>
              </div>
            </div>
            <a
              href="{{ url('admin/laporan/transaksi') }}"
              class="list-group-item list-group-item-action"
              >Laporan</a
            >
            <a
              href="{{ url('admin/buku-tamu') }}"
              class="list-group-item list-group-item-action"
              >Buku Tamu</a
            >
            <a
              href="{{ url('admin/event') }}"
              class="list-group-item list-group-item-action"
              >Event</a
            >
            <a
              href="{{ url('admin/faq') }}"
              class="list-group-item list-group-item-action"
              >FAQ</a
            >
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
                  <a class="dropdown-item" href="{{ url('dashboard.html') }}"
                    >Profil Admin</a
                  >
                  <a class="dropdown-item" href="{{ url('admin/pengaturan') }}"
                    >Pengaturan</a
                  >
                  <div class="dropdown-divider"></div>
                    <form action="{{ url('/logout') }}" method="post">
                      @csrf
                      <button class="dropdown-items mb-0" >Keluar</button>
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
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- show sidebar menu-->
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
		<script>
			CKEDITOR.replace("#editor");
    </script>
    <script>
      $(document).ready(function () {
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              // $('#blah').attr('src', e.target.result);
              $('#letak_foto').html("<img class='mb-3' src='"+e.target.result+"'  width='100'>")
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }

        $("input[type=file]").on('change',function() {
          readURL(this);
        });
      })
    </script>
  </body>
</html>
