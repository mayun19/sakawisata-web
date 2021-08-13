@extends('layouts.admin')

@section('title', 'Fasilitas')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Fasilitas Paket</h2>
    <p class="dashboard-subtitle">
      <a href="{{ url('admin/fasilitas') }}">Fasilitas </a> / Edit Fasilitas
    </p>

    </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-md-8 col-lg-5 mb-3">
        <form action="{{ url("admin/fasilitas/update/".$fasilitas->id_fasilitas) }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row mb-3">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-11 col-lg-10">
                      <div class="form-group">
                        <label for="">Nama Fasilitas</label>
                        <input type="text" class="form-control" name="nama_fasilitas" value="{{ $fasilitas->nama_fasilitas }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-11 col-lg-10">
                      <div class="item-detail-foto">Icon Fasilitas Lama</div>
                      <div class="row icon-fasilitas mt-3 my-2">
                        <div class="col-md-12">
                          <div class="gallery-container">
                            <img
                              src="{{ asset('img/fasilitas/'.$fasilitas->icon_fasilitas) }}"
                              alt="Card image cap"
                              class="mx-auto d-block icon-fasilitas"
                            />
                          </div>                          
                        </div>
                      </div>
                      <div class="row my-3 d-flex justify-content-center">
                        <span class="btn btn-gallery">
                          Ganti Icon Fasilitas
                          <input type="file"name="icon_fasilitas" id="">
                        </span>                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-11 col-lg-10">
                      <button type="submit" class="btn btn-tambah px-3 btn-block">Simpan Fasilitas</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>  
@endsection