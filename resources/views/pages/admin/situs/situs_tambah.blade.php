@extends('layouts.admin')

@section('title', 'Situs Jelajah')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Situs Jelajah</h2>
		<p class="dashboard-subtitle">
			Tambah Situs
		</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/situs/simpan") }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control"       name="nama_situs">
                    @error('nama_situs')
											<span class="text-danger">{{$message}}</span>
										@enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" class="form-control-file" name="foto_situs">
                    @error('foto_situs')
											<span class="text-danger">{{$message}}</span>
										@enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea class="form-control" rows="5" id="editor" name="deskripsi_situs"></textarea>
                    @error('deskripsi_situs')
											<span class="text-danger">{{$message}}</span>
										@enderror
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
		<script>
			CKEDITOR.replace( 'editor' );
    </script>
@endpush