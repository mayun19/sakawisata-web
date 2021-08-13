<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <link rel="stylesheet" href="{{ asset('style/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('xzoom/xzoom.css') }}">
    
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/redmond/jquery-ui.css">
    

  </head>
  <body>
    <!-- Navbar -->
    <div class="container">
      <nav
        class="row navbar navbar-sakwis navbar-expand-lg navbar-light bg-white"
        data-aos="fade-down"
      >
        <a href="{{ url('/') }}" class="navbar-brand">
          <img
            src="{{ asset('img/logo_sakawisata.png') }}"
            alt="Logo sakawisata_logo"
          />
        </a>
        <button
          class="navbar-toggler navbar-toggler-right"
          type="button"
          data-toggle="collapse"
          data-target="#navb"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
          <ul class="navbar-nav ml-auto mr-3">
            <li class="nav-item active mx-md-2">
              <a href="#" class="nav-link">Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                id="navbardrop"
                data-toggle="dropdown"
                >Tentang
              </a>
              <div class="dropdown-menu">
                <a href="{{ url('tentang') }}" class="dropdown-item">Profil</a>
                <a href="{{ url('pemandu') }}" class="dropdown-item">Pemandu</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                id="navbardrop"
                data-toggle="dropdown"
                >Jelajah
              </a>
              <div class="dropdown-menu">
                <a href="{{ url('paket') }}" class="dropdown-item">Paket Kunjungan</a>
                <a href="{{ url('situs') }}" class="dropdown-item">Situs Kunjungan</a>
                <a href="{{ url('bukutamu') }}" class="dropdown-item">Buku Tamu</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                id="navbardrop"
                data-toggle="dropdown"
                >Informasi
              </a>
              <div class="dropdown-menu">
                <a href="{{ url('event') }}" class="dropdown-item">Event</a>
                <a href="{{ url('faq') }}" class="dropdown-item">FAQ</a>
              </div>
            </li>
          </ul>

          @if (session('level') == null)
              
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
              <img
                src="{{ asset('img/icon-user.png') }}"
                alt=""
                class="rounded-circle mr-2 profile-picture"
              />
              Hi, {{ session('name') }}
            </a>
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
                <button class="dropdown-item" >Keluar</button>
              </form>
            </div>
          </li>
          @endif
        </div>
      </nav>
    </div>

    @yield('konten')

    <footer class="section-footer border-top">
      <div class="container-fluid">
        <div
          class="row border-top justify-content-center align-items-center pt-2"
        >
          <div class="col-md-5 text-left font-weight-light">
            <p>©2020 Copyright SAKAWISATA. All Right Reseved.</p>
          </div>
          <div class="col-md-5 text-right font-weight-light">
            <p>
              Crafted with <img src="{{ asset('img/heart.png')}}" alt="" /> by
              CodebyNuya
            </p>
          </div>
        </div>
      </div>
    </footer>

    {{-- <script src="{{ url('js/jquery-3.5.1.min') }}"></script>  --}}
    
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
    {{-- <script src="{{ asset('js/jquery-3.4.1.min') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('xzoom/xzoom.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
      AOS.init();
    </script>

    <script>
      $(document).ready(function() {
        $('.xzoom, .xzoom-gallery').xzoom({
          zoomWidth: 500,
          title: false,
          tint: '#333',
          Xoffset: 10 
        });
      });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

    <script>
      $(document).ready(function(){
        $("input[name=jumlah_wisatawan]").on("keyup", function(){
          var rombonganku= $(this).val();
          var token= $("input[name=_token]").val();

          // alert(rombonganku);

          $.ajax({
            type:'post',
            url:'{{url('ajax/cek_tanggal')}}',
            data:'rombonganku='+rombonganku+'&_token='+token,
            success:function(hasil)
            {
              // console.log(hasil);
              var disabledDates = $.parseJSON(hasil);
             $('.datepicker').datepicker({
                minDate: 3,
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ disabledDates.indexOf(string) == -1 ]
                }
              });
            }
          })
        });

        $(".datepicker").on("change", function(){
          var tanggal = $(this).val();
          var jumlah = $("input[name=jumlah_wisatawan]").val();
          var token= $("input[name=_token]").val();
          var id_paket = '{{ $paket->id_paket }}';
          $.ajax({
            type:'post',
            url:'{{url('ajax/cek_sesi')}}',
            data:'tanggal='+tanggal+'&jumlah='+jumlah+'&_token='+token+'&id_paket='+id_paket,
            success:function(hasil){
              console.log(hasil);{
                var sesis = $.parseJSON(hasil);

                var isi = "<option value=''>Pilih Sesi Kunjungan</option>";
                $.each(sesis, function(index, value){
                  if(value['status_ketersediaan']=="penuh"){
                    isi+= "<option value='"+value['id_sesi']+"' disabled='disabled'>"+value["nama_sesi"]+"</option>";
                  }else{
                    isi+= "<option value='"+value['id_sesi']+"'>"+value["nama_sesi"]+"</option>";
                  }
                });
                $("select[name=sesi]").html(isi);
              }
            }
          }
          )
        })
      })
    </script>

    <script type="text/javascript">

      $(function() {
        // ketika input checkout id="checkTL" di klik
        $("#checkTL").on('click', function(){

          if ($(this).is(":checked"))
          {
            console.log('nyala');
            // kalau inputan ini di ceklis, munculkan input nama TL
            $("#TL").show(200);
            
          } else {
            console.log('mati');
            $("#TL").hide(200);
          }
        }) 

        $("#inputWisatawan").on('change keyup', function(){
          var jumlah_wisatawan = parseInt($(this).val());
          var per_paket = 20;
          var jumlah_paket = 1;
          var sisa = 0;

          console.log('jml wis', jumlah_wisatawan)
          console.log('perpaket', per_paket)

          //mengatur maksimal wisatawan per sesi
          if ( jumlah_wisatawan > 60 ) {
            alert('Jumlah maksimum wisatawan per sesi hanya 60 orang.');
            $(this).val(60);
            jumlah_wisatawan = 60;
          }

          //jika jumlah wisatawan dibawah jumlah per pakaet
          if (jumlah_wisatawan <= per_paket) {
            jumlah_paket = 1;
            sisa = 0;
          }else{
            //sebaliknya
            sisa = jumlah_wisatawan % per_paket;
            jumlah_paket = Math.floor(jumlah_wisatawan / per_paket);
          }

          console.log('sisa', sisa)
          console.log('jml paket', jumlah_paket)

          var harga_paket = $("#harga_paket").val();
          var biaya_pemesanan = jumlah_paket * harga_paket;

          var biaya_tambahan = (5/100 * harga_paket) * sisa;

          var total_bayar = biaya_pemesanan + biaya_tambahan;

          console.log('tambahan', biaya_tambahan);

          //update inputan
          $("#inputJmlPaket").val(jumlah_paket);
          $("#inputJmlTambahan").val(sisa);

          $("#inputBiayaPemesanan").val(biaya_pemesanan); 
          $("#inputBiayaTambahan").val(biaya_tambahan); 
          $("#inputTotBayar").val( total_bayar); 
        })
      });
    </script>
  </body>
</html>
