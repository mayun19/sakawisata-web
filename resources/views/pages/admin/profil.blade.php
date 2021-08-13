@extends('layouts.admin')

@section('title', 'Profil Admin')

@push('addon-style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@endpush

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Profil Admin</h2>
    <p class="dashboard-subtitle">
      Informasi terkait profil admin SAKAWISATA
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-12 col-md-12 col-lg-10 mt-2">
        @if (session('pesan'))
          <div class="alert alert-success">
            {{ session('pesan') }}
          </div>
				@endif
        <div class="card mb-3">
          <div class="card-body" id="tambah">
            <form action="{{ url('admin/profil-admin/update') }}" method="post" enctype="multipart/form-data">
               @csrf
              <div class="row mb-3">
                <div class="col-md-4">
                  <div class="item-foto text-center">
                    <div class="row gallery-container mt-2 mb-2">
                      @if (!empty($profil->foto_admin))
                      <img class="profil-img-top my-auto rounded-circle" src="{{ asset('img/profil/'.$profil->foto_admin) }}" alt="Profil Admin"/>
                      @else
                      <img class="profil-img-top my-auto rounded-circle" src="{{ asset('img/profil/icon-user.png') }}" alt="Profil Admin"/>
                      @endif
                    </div>
                    <row class="mt-3 d-flex justify-content-center">
                      <span class="btn btn-sm btn-profil">
                      Ganti Foto Profil
                        <input type="file" id="foto_admin" name="foto_admin" id="">
                      </span> 
                    </row>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row profil mt-3">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Username Admin</label>
                        <input type="text" class="form-control" name="username_admin" id="username_admin"
                        value="{{ $profil->username_admin }}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Password Admin</label>
                        <div class="form-group">
                          <div class="input-group">
                            <input type="password" class="form-control input-pass" name="password_admin" id="password_admin" value="">
                            <div class="input-group-append">
                              <button class="btn btn-dark btn-show" type="button">
                                <i class="fa fa-fw fa-eye"></i>
                              </button>
                            </div>
                            
                          </div>
                          <div class="text-danger small">Kosongkan jika tidak diisi</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Email Admin</label>
                        <input type="text" class="form-control" name="email_admin" id="email_admin" value="{{ $profil->email_admin }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-10 text-right">
                  <button type="submit" class="btn btn-tambah px-3">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
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
@endpush
