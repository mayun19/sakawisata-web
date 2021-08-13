@extends('layouts.admin')

@section('title', 'Paket Kunjungan')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Paket Kunjungan</h2>
		<p class="dashboard-subtitle">
			<a href="{{ url('admin/paket') }}">Paket </a> / Edit Paket
		</p>
  </div>
  <div class="dashboard-content">
		<?php 
			$centang_fasilitas = array();
			foreach ($paket_fasilitas as $key => $value) {
				$centang_fasilitas[] = $value->id_fasilitas;
			}
			$centang_situs = array();
			foreach ($paket_situs as $key => $value) {
				$centang_situs[] = $value->id_situs;
			}
			$centang_sesi = array();
			foreach ($paket_sesi as $key => $value) {
				$centang_sesi[] = $value->id_sesi;
			}
			?>
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/paket/update/".$paket->id_paket) }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<img class="img-fluid" src="{{asset('img/paket/' . $paket->foto_paket)}}" alt="foto paket" style="max-height: 250px; width: 100%; object-fit: cover;">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Paket</label>
										<input
											type="text"
											name="nama_paket"
											class="form-control" value="{{ $paket->nama_paket }}" 
										/>
									</div>
                </div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Foto Paket</label>
										<input
											type="file"
											class="form-control-file"
											name="foto_paket"
										/>
									</div>
                </div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Harga</label>
										<input
											type="text"
											class="form-control uang"
											name="harga_paket"  value="{{ $paket->harga_paket }}" 
										/>
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
													name="kap_min_paket"
													 value="{{ $paket->kapasitas_min_paket }}" 
												/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Kapasitas Maksimal</label>
												<input
													type="number"
													class="form-control"
													name="kap_max_paket"
													value="{{ $paket->kapasitas_max_paket }}"
												/>
											</div>
										</div>
									</div>
                </div>
								<div class="col-md-4">
									<div class="item-tambah">Fasilitas</div>
									@foreach ($fasilitas as $item)
										<div class="custom-control custom-checkbox">
											<input <?php echo in_array($item->id_fasilitas, $centang_fasilitas) ? "checked": ""; ?>
												type="checkbox" name="id_fasilitas[]" value="{{ $item->id_fasilitas }}"
						
											/>
											<label>{{ $item->nama_fasilitas }}
                  	  </label>
										</div>
									@endforeach
                </div>
								<div class="col-md-4">
									<div class="item-tambah">Rute</div>
									@foreach ($situs as $item)
									<div class="custom-control custom-checkbox">
										<input <?php echo in_array($item->id_situs, $centang_situs) ? "checked": ""; ?>
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
										<input <?php echo in_array($item->id_sesi, $centang_sesi) ? "checked": ""; ?>
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
										<label for="">Deskripsi Paket</label>
										<textarea
											name="deskripsi_paket"
											id=""
											rows="5"
											class="form-control"
										>{{ $paket->deskripsi_paket }}</textarea>
									</div>
								</div>               
              </div>
							<div class="row">
								<div class="col text-right">
									<button type="submit" class="btn btn-tambah px-3">
										Simpan Paket
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