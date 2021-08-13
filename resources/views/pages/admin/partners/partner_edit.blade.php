@extends('layouts.admin')

@section('title', 'Partners')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Partner Paket</h2>
    <p class="dashboard-subtitle">
      <a href="{{ url('admin/partners') }}">Partner </a> / Edit Partner
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-12 col-md-8 col-lg-8 mb-3">
        <form action="{{ url("admin/partners/update/".$partners->id_partner) }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Partner</label>
                    <input type="text" class="form-control" name="nama_partner" value="{{ $partners->nama_partner }}">
                  </div>
                  <div class="form-group">
                    <label for="">Link Partner</label>
                    <input type="url" class="form-control" name="link_partner" value="{{ $partners->link_partner}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="item-detail-foto text-center">Icon Partner Lama</div>
                  <div class="row icon-fasilitas mt-3 my-2">
                    <div class="col-md-12">
                      <div class="gallery-container">
                        <img
                          src="{{ asset('img/partners/'.$partners->foto_partner) }}"
                          alt="Card image cap"
                          class="mx-auto d-block icon-fasilitas"
                        />
                      </div>                          
                    </div>
                  </div>
                  <div class="row my-3 d-flex justify-content-center">
                    <span class="btn btn-gallery">
                      Ganti Icon Partner
                      <input type="file" name="foto_partner" id="">
                    </span>                        
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-tambah px-3 btn-block">Simpan Partner</button>
                  </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>  
@endsection