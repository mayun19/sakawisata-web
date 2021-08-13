@extends('layouts.admin')

@section('title', 'Pemandu')

@section('konten')
	<div class="dashboard-heading">
    <h2 class="dashboard-title">Pemandu</h2>
    <p class="dashboard-subtitle">
      <a href="{{ url('admin/pemandu') }}"> Pemandu </a> / Detail Pemandu
  	</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <div class="card">
          <div class="card-body" id="tambah">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Nama Pemandu</label>
                  <input type="text" class="form-control"         name="nama_pemandu" value="{{ $pemandu->nama_pemandu }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Link Whatsapp Pemandu</label>
                  <input type="text" class="form-control"         name="link_wa_pemandu" value="{{ $pemandu->link_wa_pemandu }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
									<label>Bahasa</label>
									<input
										type="text"
										name="bahasa_pemandu"
										class="form-control" value="{{ $pemandu->bahasa_pemandu }}" readonly
									/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
									<label>Tahun Bergabung</label>
									<input
										type="text"
										name="tahun_gabung_pemandu"
										class="form-control" value="{{ $pemandu->tahun_gabung_pemandu }}" readonly
									/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="item-detail-foto">Foto Pemandu</div>
                <div class="row foto-pemandu mt-3">
                  <div class="col-md-6">
										<div class="gallery-container">
											<img
												src="{{ asset('img/pemandu/'.$pemandu->foto_pemandu) }}"
												alt="Card image cap"
												class="foto-pemandu"
											/>
										</div>                    
                  </div>
                </div>
                {{-- <div class="form-group">
                  <label for="">Foto</label>
                  <input type="file" class="form-control-file"         name="foto_pemandu">
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection