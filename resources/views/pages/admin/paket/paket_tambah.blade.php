@extends('layouts.admin')

@section('title', 'Paket Kunjungan')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Tambah Paket</h2>
		<p class="dashboard-subtitle">
			Buat paket kunjungan baru di Kampung Wisata Kauman
		</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/paket/simpan") }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="card card-dashboard-paket">
            <div class="card-body" id="tambah">
              <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Paket *</label>
										<input
											type="text"
											name="nama_paket"
											class="form-control"
										/>
										@error('nama_paket')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
									</div>
                </div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Foto Paket *</label>
										<input
											type="file"
											class="form-control-file"
											name="foto_paket"
										/>
										@error('foto_paket')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
									</div>
                </div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Harga *</label>
										<input
											type="text"
											class="form-control uang"
											name="harga_paket"
										/>
										@error('harga_paket')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
									</div>
                </div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Kapasitas Minimal</label>
												<input
													type="number"
													class="form-control"
													name="kapasitas_min_paket"
												/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Kapasitas Maximal</label>
												<input
												type="number"
												class="form-control"
												name="kapasitas_max_paket"
												/>
											</div>
										</div>
									</div>
                </div>
								<div class="col-md-4">
									<div class="item-tambah">Fasilitas</div>
									@foreach ($fasilitas as $item)
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="id_fasilitas[]" value="{{ $item->id_fasilitas }}"/>
											<label>{{ $item->nama_fasilitas }}
                  	  </label>
										</div>
									@endforeach
                </div>
								<div class="col-md-4">
									<div class="item-tambah">Rute</div>
									@foreach ($situs as $item)
									<div class="custom-control custom-checkbox">
										<input
											type="checkbox" name="id_rute[]"
											value="{{ $item->id_situs }}"
										/>
										<label
											>{{ $item->nama_situs }}</label>
									</div>
									@endforeach
                </div>
								<div class="col-md-4">
									<div class="item-tambah">
										Waktu Kunjungan
									</div>
									@foreach ($sesi as $item)
									<div class="custom-control custom-checkbox">
										<input
											type="checkbox" name="id_sesi[]"
											value="{{ $item->id_sesi }}"
										/>
										<label
											>{{ $item->nama_sesi }}</label>
									</div>
									@endforeach
                </div>
								<div class="col-md-12">
									<div class="form-group mt-3">
										<label for="">Deskripsi Paket *</label>
										<textarea
											name="deskripsi_paket"
											id=""
											rows="5"
											class="form-control"
										></textarea>
											@error('deskripsi_paket')
											<span class="text-danger">{{$message}}</span>
											@enderror
									</div>
								</div> 
								<div class="col-md-12">
									<label>Keterangan : </label>
									<p><strong>*</strong> wajib diisikan</p>
								</div>              
              </div>
							<div class="row">
								<div class="col text-right">
									<button type="submit" class="btn btn-tambah px-3">
										Tambah Paket
									</button>
								</div>
							</div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection