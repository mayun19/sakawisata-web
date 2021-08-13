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
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;600;700&family=Kalam:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

</head>

<body>
  <main class="login-container">
      <div class="row no-gutters page-login d-flex align-items-center">
        <div class="section-left col-12 col-md-7">
          <div class="container d-flex justify-content-center">
            <div class="login-heading">
              <h1>Kampung Wisata <span>Kauman</span></h1>
              <p>Wisata Blusukkan Jelajah #WisataReligi, Kampung Sejarah, <br> dan Masjid Gedhe Kauman bersama SAKAWISATA</p>
            </div>
          </div>
        </div>
        <div class="section-right col-12 col-md-5">
          <div class="row login-form d-flex justify-content-center  mx-2">
            <div class="col-md-8">
              <div class="form-login p-3 mt-3">
                <div class="logo text-center">
                  <a href="{{ url('/') }}">
                    <img src="{{ asset('img/sakawisata_logo.svg') }}" alt="" class="mb-5">
                  </a>
                </div>
                <form action="{{ url('login?redirect='. urlencode(request()->query('redirect')) ) }}" method="post">
                @csrf
                @if (session('pesan'))
                  <div class="alert alert-success">
                    {{ session('pesan') }}
                  </div>
                @elseif(session('gagal'))
                  <div class="alert alert-danger">
                    {{ session('gagal') }}
                  </div>
                @endif
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username" value="{{ $username }}">
                </div>
                <div class="form-group input-group">
                  <input type="password" class="form-control input-pass" name="password" placeholder="Password" value="{{ $password }}">
                  <div class="input-group-append">
                    <button class="btn btn-dark btn-show" type="button">
                      <i class="fa fa-fw fa-eye"></i>
                    </button>
                  </div>
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="ingkat" name="remember">
                  <label class="form-check-label" for="ingkat">Ingatkan saya</label>
                </div>
                <p class="text-right">
                  <a href="{{ url('reset_password') }}">Lupa <b>Password</b> ?</a>
                </p>
                <div class="col text-center">
                  <button class="btn btn-login-auth btn-block">Login</button>
                </div>
                </form>
                <p class="text-center mt-2">Belum punya akun ? 
                  <a href="{{ url('daftar') }}"><b>Daftar</b></a>
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>
  </main>

  <script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".btn-show").on('click',function(){
        var type = $(".input-pass").attr("type");
        if(type=="password"){
          $(".input-pass").attr("type", "text");
        }else{
          $(".input-pass").attr("type", "password");
        }
      });
    })
  </script>
</body>
</html>