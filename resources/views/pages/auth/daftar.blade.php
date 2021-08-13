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
      r/>
    <script src="{{ url('js/jquery-3.5.1.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

</head>
<body class="daftar-container">
  <div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light">
      <div class="navbar-nav ml-auto mr-auto mr-sm-auto mr-lg-auto mr-md-auto">
        <a href="{{ url('/') }}" class="navbar-brand">
          <img src="{{ asset('img/logo_sakawisata.png') }}"
              alt="Logo sakawisata_logo"/>
        </a>
      </div>
    </nav>
  </div>

  <div class="section-daftar">
    <div class="row page-daftar d-flex justify-content-center">
      <div class="col-10 col-md-4">
        <div class="card card-daftar mt-4 mb-3">
          <div class="card-body mb-3" id="daftar">
            <form action="" method="post">
              @csrf
              <div class="daftar-content container d-flex justify-content-center mb-2">
                <div class="col-12 col-xl-10">
                  <h3 class="daftar mt-2">Daftar Akun Baru</h3>
                      @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
                  <div class="form-daftar mt-4">
                    <div class="form-group">
                      <input type="text" class="form-control" id="nama" name="nama_member" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control"   name="username_member" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" name="email_member" placeholder="Email">
                    </div>
                    <div class="form-group">
                     <input type="password" class="form-control input-pass" name="password_member" placeholder="Password">
                    </div>
                    <div class="form-group input-group">
                     <input type="password" class="form-control input-pass-lagi" name="password_member" placeholder="Konfirmasi Password">
                     <div class="input-group-append">
                       <button class="btn btn-outline-secondary btn-lihat" type="button">
                         <i class="fa fa-fw fa-eye"></i>
                       </button>
                     </div>
                    </div>
                    <div class="pesan mb-3"></div>
                    <div class="form-group">
                     <input type="tel" class="form-control" name="telp_member" placeholder="No. Telepon" >
                     <small>Nomor yang terkoneksi dengan WhatsApp </small>
                    </div>
                    <div class="form-group">
                     <textarea class="form-control" id="alamat" name="alamat_member" rows="3">Alamat</textarea>
                    </div>
                  </div>
                  {{-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check-form-daftar" name="setuju">
                    <label class="form-check-label" for="check-form-daftar">Saya menyetujui Syarat dan Ketentuan yang berlaku.</label>
                  </div> --}}
                  <div class="row">
                    <div class="col text-center">
                      <button type="submit" class="btn btn-daftar btn-block">Daftar</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col text-center">
                      <p class="mt-4">Sudah punya akun ? 
                        <a href="{{ url('login') }}"><b>Masuk</b></a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>      
  </div>
  
  <footer class="section-footer">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center pt-2">
        <div class="col-md-5 text-center font-weight-light">
          <p>©2020 Copyright SAKAWISATA. All Right Reseved.</p>
        </div>
      </div>
    </div>
  </footer>
  {{-- <main class="daftar-container">
  </main> --}}
</body>

<script>
  $(document).ready(function() {
    
    $(".input-pass-lagi").on("keyup", function(){
      var input_pass_lagi = $(this).val();
      var input_pass = $(".input-pass").val();

      if (input_pass_lagi !== input_pass) {
        console.log(input_pass_lagi);
        console.log(input_pass);

        $(".pesan").html("password tidak sama");
        $(".pesan").removeClass("bg-primary");
        $(".pesan").addClass("bg-danger p-3 text-white");
        $(".btn-daftar").hide();
      }else{
        $(".pesan").html("password sama");
        $(".pesan").removeClass("bg-danger");
        $(".pesan").addClass("bg-primary p-3 text-white");
        $(".btn-daftar").show();
      }
    });

    $(".btn-lihat").on('click',function(){
      var type = $(".input-pass-lagi").attr("type");
      if(type=="password"){
        $(".input-pass-lagi").attr("type", "text");
      }else{
         $(".input-pass-lagi").attr("type", "password");
      }
    })
  })
</script>
</html>
