@extends('layouts.member')

@section('title', 'Edit Member')


@section('konten')
  <div class="col-12 col-lg-10 member mt-5 ">
    <div class="member-heading mt-4">
     <h3 class="member-title">Ubah Akun</h3>
     <hr class="member-line mt-0">
    </div>
    <div class="member-content mt-2 mb-5">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>    
          @endforeach
        </ul>
      </div>
      @endif
      @if(session('sukses'))
      <div class="alert alert-success">
        {{session('sukses')}}
      </div>
      @endif
      @if(session('gagal'))
      <div class="alert alert-danger">
        {{session('gagal')}}
      </div>
      @endif
      <form action="{{url('update_member/' . $member->id_member)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row container d-flex justify-content-between">
          <div class="info-akun col-12 col-lg-6 mt-4">
            <h5 class="content-title">Informasi Akun</h5>
            <hr>
            <div class="item-akun mb-5">
              <div class="form-group row align-items-center">
                <div class="col-sm-4">
                  <div class="row gallery-container px-3">
                  @if(file_exists(public_path('img/member/'.session('foto'))))
                  <img
                    src="{{ asset('img/member/'.$member->foto_member) }}"
                    alt=""
                    class="rounded-circle mr-2 profile-picture img-fluid"
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
                  </div> 
                </div>
                <div class="col-sm-8 mt-2">
                  <input type="file" name="foto_member" id="">
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_member" class="col-sm-4 col-form-label">Nama Lengkap</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control" id="nama_member" name="nama_member" value="{{ $member->nama_member }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="username_member" class="col-sm-4 col-form-label">Username</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control" id="username_member" value="{{ $member->username_member }}" autocomplete="username" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="telp_member" class="col-sm-4 col-form-label">No Telepon</label>
                <div class="col-sm-8">
                  <input type="telp"  class="form-control" id="telp_member" name="telp_member" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" value="{{ $member->telp_member }}">
                  <small>Format: 08xx-xxxx-xxxx. <br> Nomor yang terkoneksi dengan WhatsApp </small>
                </div>
              </div>
              <div class="form-group row">
                <label for="email_member" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control" id="email_member" name="email_member" value="{{ $member->email_member }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="alamat_member" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                  <textarea name="alamat_member" class="form-control" id="alamat_member" rows="5">{{ $member->alamat_member }}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="info-akun col-12 col-lg-5 mt-4">
            <h5 class="content-title">Ubah Password</h5>
            <hr>
            <div class="item-akun mb-5">
              <div class="form-group row">
                <label for="password_lama" class="col-sm-5 col-form-label">Password Lama</label>
                <div class="col-sm-7 input-group">
                  {{-- <input type="password" class="form-control input-pass-lagi" name="password_lama" autocomplete="current-password"> --}}
                  <input type="password" class="form-control input-pass-lagi" name="password_lama" autocomplete="off">
                  <div class="input-group-append">
                    <button class="btn btn-secondary btn-lihat" type="button">
                      <i class="fa fa-fw fa-eye"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="password_baru" class="col-sm-5 col-form-label">Password Baru</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control input-pass-baru" id="password_baru" name="password_baru"  autocomplete="new-password">
                  {{-- <div class="input-group-append">
                    <button class="btn btn-secondary btn-lihat" type="button">
                      <i class="fa fa-fw fa-eye"></i>
                    </button>
                  </div> --}}
                </div>
              </div>
              <div class="form-group row">
                <label for="password_baru_konfirmasi" class="col-sm-5 col-form-label">Konfirmasi Password</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control" id="password_baru_konfirmasi" name="password_baru_konfirmasi" autocomplete="new-password">
                </div>
              </div>
              <div class="pesan mb-3"></div>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-9 col-md-10 col-lg-11  text-right">
            <button type="submit" class="btn btn-sm btn-edit-akun px-4">
              Simpan
            </button>	
          </div>
        </div>
      </form>

    </div>
  </div>
@endsection

@push('addon-style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@endpush

@push('addon-script')
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.10.0/echo.js"></script> --}}
  <script type="text/javascript">
    $(document).ready(function() {
    
    $("#password_baru_konfirmasi").on("keyup", function(){
      var password_baru_konfirmasi = $(this).val();
      var password_baru = $("#password_baru").val();

      if (password_baru_konfirmasi !== password_baru) {
        console.log(password_baru_konfirmasi);
        console.log(password_baru);

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
@endpush