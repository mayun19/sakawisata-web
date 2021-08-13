@extends('layouts.admin')

@section('title', 'Paket Kunjungan')

@section('konten')
<?php 
      // echo "<pre>";
      // print_r($paket);
      // print_r($fasilitas);
      // print_r($situs);
      // print_r($sesi);
      // echo "</pre>";
?>
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Paket Kunjungan</h2>
		<p class="dashboard-subtitle">
			<a href="{{ url('admin/paket') }}">Paket </a> / Detail Paket
		</p>
  </div>
  <div class="dashboard-content">
		<div class="row mt-4">
			<div class="col-12 col-md-11 col-xl-10 mb-3">
				@if (session('pesan'))
				<div class="alert alert-success">
					{{ session('pesan') }}
				</div>
				@endif
				<div class="card">
					<div class="card-body" id="tambah">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Paket</label>
									<input
										type="text"
										name="nama-paket"
										class="form-control"
										value="{{ $paket->nama_paket }}"
										readonly
									/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Harga</label>
									<input
										type="text"
										class="form-control"
										name="harga_paket"
										value="{{number_format( $paket->harga_paket) }}"
										readonly
									/>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Kapasitas Minimal</label>
											<input
												type="number"
												class="form-control"
												name="kap_min_paket"
												value="{{ $paket->kapasitas_min_paket }}"
												readonly
											/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Kapasitas Maksimal</label>
											<input
												type="number"
												class="form-control"
												name="kap_min_paket"
												value="{{ $paket->kapasitas_max_paket }}"
												readonly
											/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="item-paket-tambah">Fasilitas</div>
								<ul class="paket-fasilitas">
									@foreach ($fasilitas as $item)
									<li>{{ $item->nama_fasilitas }}</li>
									@endforeach
									
								</ul>
							</div>
							<div class="col-md-4">
								<div class="item-paket">Rute</div>
								<ul class="paket-rute">
									@foreach ($situs as $item)
									<li>{{ $item->nama_situs }}</li>
									@endforeach
								</ul>
							</div>
							<div class="col-md-4">
								<div class="item-paket">Waktu Kunjungan</div>
								<ul class="paket-waktu">
									@foreach ($sesi as $item)
									<li>{{ $item->nama_sesi }}</li>
									@endforeach
								</ul>
							</div>
							<div class="col-md-12">
								<div class="row foto-paket my-3">
									<div class="col-12">
										<div class="item-paket-foto mb-2">
											Foto Paket
										</div>
										<div class="gallery-container">
											<img class="w-100 mb-2" src="{{asset('img/paket/' . $paket->foto_paket)}}" alt="foto paket" style="max-height: 350px; object-fit: cover;">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mt-3">
									<label for="">Deskripsi Paket</label>
									<textarea
										name="deskripsi-paket"
										id=""
										rows="5"
										class="form-control"
										readonly
									>{{ $paket->deskripsi_paket }}</textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col text-right">
								<a href="{{ url('admin/paket/edit/'.$paket->id_paket) }}" type="submit" class="btn btn-tambah px-3 btn-block">Edit Paket</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
@endsection