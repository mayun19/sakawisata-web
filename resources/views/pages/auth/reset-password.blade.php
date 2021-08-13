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

</head>
<body>
  <main class="login-container">
      <div class="row page-login d-flex align-items-center">
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
              <div class="form-reset p-3">
                <div class="header text-center mb-3">
                  <h3 class="reset mb-4">Lupa password mu?</h3>
                  <p class="subtitle mb-5">Masukkan emailmu yang telah terdaftar</p>
                </div>
                <form action="{{ url('new_password') }}" method="post">
                @csrf
                @if (session('pesan'))
                  <div class="alert alert-danger">
                    {{ session('pesan') }}
                  </div>
                @endif
                <div class="form-reset mt-3">
                  <div class="form-group">
                    <input type="text" class="form-control" name="email_member" placeholder="Email">
                  </div>
                  <div class="col text-center mt-4">
                    <button class="btn btn-reset btn-block mt-4">Reset Password</button>
                  </div>
                </div>
                </form>
                <p class="text-center mt-3">Kembali 
                  <a href="{{ url('login') }}"><b>Masuk</b></a>
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>
  </main>
</body>
</html>