@extends('layouts.admin')

@section('title', 'Sesi Kunjungan')

@section('konten')
  <div class="dashboard-heading">
  	<h2 class="dashboard-title">Sesi Kunjungan</h2>
  	<p class="dashboard-subtitle">
  		Tambah Sesi
  	</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-md-8 col-lg-5">
        <form action="{{ url("admin/sesi/simpan") }}" method="post">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-11 col-lg-10 mb-4">
                  <div class="form-group">
                    <label for="">Nama Sesi</label>
                    <input type="text" class="form-control" name="nama_sesi" required>
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