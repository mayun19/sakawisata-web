@extends('layouts.admin')

@section('title', 'Partners')

@section('konten')
  <div class="dashboard-heading">
  	<h2 class="dashboard-title">Tambah Partners</h2>
  	<p class="dashboard-subtitle">
      <a href="{{ url('admin/partners') }}">Kembali ke Halaman Partners SAKAWISATA </a>
  	</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-12 col-md-10 col-lg-10 mb-3">
        <form action="{{ url("admin/partners/simpan") }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Partners</label>
                    <input type="text" class="form-control"         name="nama_partner">
                  </div>                 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Link Website Partners</label>
                    <input type="url" class="form-control"      name="link_partner">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Icon Partners</label>
                    <input type="file" class="form-control-file" name="foto_partner">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-right">
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