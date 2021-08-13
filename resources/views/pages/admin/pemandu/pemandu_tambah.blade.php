@extends('layouts.admin')

@section('title', 'Pemandu')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Tambah Pemandu</h2>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/pemandu/simpan") }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Pemandu</label>
                    <input type="text" class="form-control"         name="nama_pemandu">
                    @error('nama_pemandu')
											<span class="text-danger">{{$message}}</span>
										@enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Link Whatsapp Pemandu</label>
                    <input type="text" class="form-control"         name="link_wa_pemandu">
                    @error('link_wa_pemandu')
											<span class="text-danger">{{$message}}</span>
										@enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
										<label>Bahasa</label>
										<input
											type="text"
											name="bahasa_pemandu"
											class="form-control"
										/>
                    @error('bahasa_pemandu')
											<span class="text-danger">{{$message}}</span>
										@enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
										<label>Tahun Bergabung</label>
										<input
											type="text"
											name="tahun_gabung_pemandu"
											class="form-control"
										/>
                    @error('tahun_gabung_pemandu')
											<span class="text-danger">{{$message}}</span>
										@enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" class="form-control-file"         name="foto_pemandu">
                    @error('foto_pemandu')
											<span class="text-danger">{{$message}}</span>
										@enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-right">
                  <button type="submit" class="btn btn-tambah px-3">Tambah Pemandu</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection