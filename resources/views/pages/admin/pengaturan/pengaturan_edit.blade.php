@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('konten')
  <div class="dashboard-heading">
  	<h2 class="dashboard-title">Pengaturan</h2>
  	<p class="dashboard-subtitle">
  		<a href="{{ url('admin/faq') }}">Pengaturan </a> / Edit Pengaturan
  	</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/pengaturan/update/".$pengaturan->id_pengaturan) }}" method="post">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-10 col-lg-10">
                  <div class="form-group">
                    <label for="">Nama Pengaturan</label>
                    <input type="text" class="form-control" name="nama_pengaturan" value="{{ $pengaturan->nama_pengaturan }}">
                  </div>                 
                </div>
                <div class="col-md-10 mb-4">
                  <div class="form-group">
                    <label for="">Isi</label>
                    <textarea class="form-control" rows="5" id="" name="isi_pengaturan">{{ $pengaturan->isi_pengaturan }}</textarea>
                  </div>                 
                </div>
                <div class="col-md-10 mb-3">
                  <button type="submit" class="btn btn-tambah px-3 btn-block">Simpan Pengaturan</button> 
                </div>
                <br>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection