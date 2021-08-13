@extends('layouts.admin')

@section('title', 'Pemandu')

@section('konten')
	<div class="dashboard-heading">
    <h2 class="dashboard-title">Edit Detail Pemandu</h2>
    <a href="{{ url('admin/pemandu') }}" style="text-decoration: none">
      <p class="dashboard-subtitle">
		  	Kembali ke Halaman Pemandu
		  </p>
    </a>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/pemandu/update/".$pemandu->id_pemandu) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-body edit-pemandu" id="tambah">
              <div class="row mb-3">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nama Pemandu</label>
                        <input type="text" class="form-control" name="nama_pemandu"
                        value="{{ $pemandu->nama_pemandu }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Link Whatsapp Pemandu</label>
                        <input type="text" class="form-control" name="link_wa_pemandu" value="{{ $pemandu->link_wa_pemandu }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
							        	<label>Tahun Bergabung</label>
							        	<input
							        		type="text"
							        		name="tahun_gabung_pemandu"
							        		class="form-control" value="{{ $pemandu->tahun_gabung_pemandu }}"
							        	/>
                      </div>
                      <div class="form-group">
							        	<label>Bahasa</label>
							        	<input
							        		type="text"
							        		name="bahasa_pemandu"
							        		class="form-control" value="{{ $pemandu->bahasa_pemandu }}"
							        	/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="item-detail-foto text-center">Foto Pemandu</div>
                      <div class="row foto-pemandu my-2">
                        <div class="col-md-12">
                          <div class="row gallery-container">
                            <img
                              src="{{ asset('img/pemandu/'.$pemandu->foto_pemandu) }}"
                              alt="Card image cap"
                              class="mx-auto d-block foto-pemandu"
                            />
                          </div> 
                          <div class="row mt-3 d-flex justify-content-center">
                            <span class="btn btn-gallery">
                            Ganti Foto Pemandu
                            <input type="file" name="foto_pemandu" id="">
                            </span> 
                          </div>                  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-right">
                  <button type="submit" class="btn btn-tambah px-3  btn-block">Simpan Pemandu</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection