@extends('layouts.admin')

@section('title', 'Fasilitas')

@section('konten')
  <div class="dashboard-heading">
  	<h2 class="dashboard-title">Tambah Fasilitas Paket</h2>
  	<p class="dashboard-subtitle">
      <a href="{{ url('admin/fasilitas') }}">Kembali ke Halaman Fasilitas Paket </a>
  	</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-md-8 col-lg-5">
        <form action="{{ url("admin/fasilitas/simpan") }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-11 col-lg-10">
                  <div class="form-group">
                    <label for="">Nama Fasilitas</label>
                    <input type="text" class="form-control"         name="nama_fasilitas">
                  </div>                 
                </div>
                <div class="col-md-11 col-lg-10 mb-4">
                  <div class="form-group">
                    <label for="">Icon Fasilitas</label>
                    <input type="file" class="form-control-file" name="icon_fasilitas">
                  </div>
                </div>
                <br>
                <div class="col-md-11 col-lg-10 text-right">
                  <button type="submit" class="btn btn-tambah px-3">Simpan</button>                 
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection