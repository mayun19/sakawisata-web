@extends('layouts.admin')

@section('title', 'Detail Pemesanan')

@section('konten')

	<div class="dashboard-heading">
		<h2 class="dashboard-title">Detail Pemesanan</h2>
		<p class="dashboard-subtitle">
			<a href="{{ url('admin/pemesanan') }}">Pemesanan </a> / <strong>Detail</strong>
		</p>
  </div>
  <div class="dashboard-content">
		<div class="row mt-4">
			<div class="col-12 col-md-11 col-xl-10 mb-3">
				@if (session('pesan'))
				<div class="alert alert-success">
					{{ session('pesan') }}
				</div>
				@elseif(session('error'))
				<div class="alert alert-danger">
					{{ session('error') }}
				</div>
				@elseif ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div class="card">
					<div class="card-body" id="tambah">
						<div class="section-pemesanan">
							<form action="{{ url("admin/pemesanan/simpan_pemesanan/".$pemesanan->id_pemesanan) }}" method="post">
								@csrf
								{{-- ambil max paket --}}
								<input type="text" id="kapasitas_max" value="{{ $pemesanan->kapasitas_max }}">
								<div class="row">
									<div class="col-12 col-md-12 col-xl-6 info-pemesanan">
										<p>Informasi Pemesanan</p>
										<div class="form-group row">
												<div class="col-5 col-md-4 col-lg-4 ">
													<label>Kunjungan ID</label>
												</div>
												<div class="col-1 col-md-1 col-lg-1 ">:</div>
												<div class="col-12 col-md-7 col-lg-7 ">
													<input type="text" name="id-kunjungan" class="form-control" value="{{ $pemesanan->kode_kunjungan }}" readonly />
												</div>
										</div>
										<div class="form-group row">
											<div class="col-5 col-md-4 col-lg-4">
												<label>Paket Kujungan </label>
											</div>
											<div class="col-1 col-md-1 col-lg-1">:</div>
											<div class="col-12 col-md-7 col-lg-7">
												<input type="text" name="nama-paket" class="form-control" value="{{ $pemesanan->nama_paket }}"readonly />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-5 col-md-4 col-lg-4">
												<label>Jumlah Wisatawan</label>
											</div>
											<div class="col-1 col-md-1 col-lg-1">:</div>
											<div class="col-12 col-md-7 col-lg-7">
												<input type="number" name="jumlah_wisatawan"  class="form-control" id="inputWisatawan" value="{{ $pemesanan->jumlah_wisatawan }}" />
												@error('jumlah_wisatawan')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<div class="col-5 col-md-4 col-lg-4">
												<label>Jumlah Paket</label>
											</div>
											<div class="col-1 col-md-1 col-lg-1">:</div>
											<div class="col-12 col-md-7 col-lg-7">
												<input type="number" name="jumlah_paket" class="form-control" id="inputJmlPaket" value="{{ $pemesanan->jumlah_paket }}" readonly />
												@error('jumlah_paket')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<div class="col-5 col-md-4 col-lg-4">
												<label>Jumlah Wisatawan Tambahan</label>
											</div>
											<div class="col-1 col-md-1 col-lg-1">:</div>
											<div class="col-12 col-md-7 col-lg-7">
												<input type="number" name="jumlah_wisatawan_tambahan" class="form-control" id="inputJmlTambahan" value="{{ $pemesanan->jumlah_wisatawan_tambahan }}" readonly />
											</div>
										</div>
									</div>
									<div class="col-md-12 col-xl-6 info-tambahan">
											<p>Informasi Tambahan</p>
											<div class="form-group row">
												<div class="col-5 col-md-4 col-lg-4">
													<label>Nama Pemesan</label>
												</div>
												<div class="col-1 col-md-1 col-lg-1">:</div>
												<div class="col-12 col-md-7 col-lg-7">
													<input type="text" name="nama_member" class="form-control" value="{{ $pemesanan->nama_member }}" readonly />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-5 col-md-4 col-lg-4">
													<label>Nama Instansi/TL</label>
												</div>
												<div class="col-1 col-md-1 col-lg-1">:</div>
												<div class="col-12 col-md-7 col-lg-7">
													<input type="text" name="asal_instansi_pemesanan" class="form-control" value="@if(!empty($pemesanan->nama_tl_pemesanan)) {{ $pemesanan->asal_instansi_pemesanan }} - {{ $pemesanan->nama_tl_pemesanan }} @else {{ $pemesanan->asal_instansi_pemesanan }} @endif " readonly/>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-5 col-md-4 col-lg-4">
													<label>Keterangan</label>
												</div>
												<div class="col-1 col-md-1 col-lg-1">:</div>
												<div class="col-12 col-md-7 col-lg-7">
													<textarea class="form-control name="keterangan_pemesanan" rows="5">
														{{ $pemesanan->keterangan_pemesanan }}
													</textarea>
												</div>
											</div>
									</div>
								</div>
								<div class="row info-pemandu">
									<div class="col-12 col-md-12 col-xl-6">
										<p>Informasi Pemandu</p>
									@if(count($pemandu_pemesanan) != 0) 
										@foreach($pemandu_pemesanan as $key => $value)
										<div class="form-group row">
											<div class="col-5 col-md-4 col-lg-4">
												<label>Pemandu {{$key+1}}</label>
											</div>
											<div class="col-1 col-md-1 col-lg-1">:</div>
											<div class="col-md-7">
												<select name="id_pemandu[]" id="" class="form-control" required>
													<option value="">--Pilih Pemandu--</option>
													@foreach ($pemandu as $item)
													<option value="{{$item->id_pemandu}}" 
														@if($item->id_pemandu == $value->id_pemandu)
														selected
														@endif
														>{{ $item->nama_pemandu }}</option>
													@endforeach
												</select>
												@error('id_pemandu')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</div>
										</div>
										@endforeach
									@else
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label>Pemandu</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<select name="id_pemandu[]" id="" class="form-control" required>
												<option value="">--Pilih Pemandu--</option>
												@foreach ($pemandu as $item)
												<option value="{{$item->id_pemandu}}" 
													>{{ $item->nama_pemandu }}</option>
												@endforeach
											</select>
											@error('id_pemandu[]')
											<span class="text-danger">{{$message}}</span>
										@enderror
										</div>
									</div>
									@endif
									@if(count($pemandu_pemesanan)<2)
									<div id="pemandu-tambahan">---</div>
									@endif
									</div>
								</div>
								<input type="hidden" name="biaya_pemesanan" class="form-control" id="inputBiayaPemesanan_Temp" value="{{ $pemesanan->biaya_pemesanan }}" readonly/>
								<input type="hidden" name="biaya_tambahan" class="form-control" id="inputBiayaTambahan_Temp"  value="{{ $pemesanan->biaya_tambahan }} " readonly/>
								<input type="hidden" name="total_pemesanan" id="inputTotBayar_Temp" class="form-control" value="{{ $pemesanan->total_pemesanan }}" readonly/>
								<div class="row">
									<div class="col text-right">
										<button type="submit" class="btn btn-tambah px-3">
											Simpan
										</button>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				{{-- script pemandu tambahan --}}
				@push('addon-script')
					<script>
						var template = `<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label>Pemandu 2</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<select name="id_pemandu[]" id="" class="form-control">
												<option value="">--Pilih--</option>
												@foreach ($pemandu as $item)
												<option value="{{$item->id_pemandu}}">{{ $item->nama_pemandu }}</option>
												@endforeach
											</select>
										</div>
									</div>`;	
						//ketika inputWisatawan diubah
						$("#inputWisatawan").on('change keyup', function() {
							//ambil isinya
							var jumlah_wisatawan = $(this).val();

							// console.log(jumlah_wisatawan)

							//jika jumlah_wisatawan diatas 30, maka tambahkan input pemandu
							if (jumlah_wisatawan > 30) {
								$("#pemandu-tambahan").html(template)
							} else if (jumlah_wisatawan < 30) {
								$("#pemandu-tambahan").html('')
							}
						})
					</script>		
				@endpush

				<div class="card mt-3">
					<form action="{{ url("admin/pemesanan/input_pembayaran/".$pemesanan->id_pemesanan) }}" method="post">
						@csrf
						<div class="card-body" id="tambah">
							<div class="row section-pemesanan">
								<div class="col-12 col-md-12 col-xl-6">
									<p>Informasi Pembayaran</p>
								</div>
							</div>
							<div class="row">
								<input type="hidden" placeholder="harga_paket" id="harga_paket" value="{{$pemesanan->harga_paket}}">
								<div class="col-12 col-md-12 col-xl-6">
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label>Biaya Pemesanan</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
												<input type="text" name="biaya_pemesanan" class="form-control uang" id="inputBiayaPemesanan" value="{{ $pemesanan->biaya_pemesanan }}" readonly/>
											</div>
										</div>
									</div>
								</div>
								{{-- <input type="number" name="min_dp" class="form-control" id="minDP" value="" readonly> --}}
								<div class="col-12 col-md-12 col-xl-6">
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label>Input Pembayaran</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
												<input type="text" id="inputTelahDibayar" name="jumlah_pembayaran" class="form-control uang" value="{{ 30/100 *($pemesanan->total_pemesanan) }}" min="50000" max="{{ $pemesanan->total_pemesanan - $telah_dibayar }}"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row info-bayar">
								<div class="col-12 col-md-12 col-xl-6">
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label for="inputBiayaTambahan" >Biaya Tambahan</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
												<input type="text" name="biaya_tambahan" class="form-control uang" id="inputBiayaTambahan"  value="{{ $pemesanan->biaya_tambahan }} " readonly/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-12 col-xl-6">
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label>Telah Di Bayar</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
												<input type="text" name="telah_dibayar" class="form-control uang" value="{{ $telah_dibayar }}" readonly/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-12 col-xl-6">
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label>Total Tagihan</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<div class="input-group">
												<div class="input-group-prepend">	<span class="input-group-text">Rp</span></div>
												<input type="text" name="total_pemesanan" id="inputTotBayar" class="form-control uang" value="{{ $pemesanan->total_pemesanan }}" readonly/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-12 col-xl-6">
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<label>Perlu Di Bayar</label>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
												<input type="text" name="" class="form-control uang" value="{{$pemesanan->total_pemesanan - $telah_dibayar}}" readonly/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-12 col-xl-6">
									<div class="form-group row">
										<div class="col-5 col-md-4 col-lg-4">
											<p style="color: #c18b8f; font-weight: 500">Minimal DP</p>
										</div>
										<div class="col-1 col-md-1 col-lg-1">:</div>
										<div class="col-md-7">
											<div class="input-group input-group-sm">
												<div class="input-group-prepend">
													<span class="input-group-text" style="color: #c18b8f; font-weight: 500">Rp</span>
												</div>
												<input type="text" name="" class="form-control form-control-sm" value="{{number_format(30/100 *($pemesanan->total_pemesanan))}}" style="color: #c18b8f; font-weight: 500" readonly/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col text-right">
									<button type="submit" class="btn btn-tambah px-3">
										Update Pembayaran
									</button>	
								</div>
							</div>							
						</div>
					</form>
					<div class="card-body">
						<table class="table table-responsive">
							<thead class="thead-dark">
								<tr>
									<th scope="col">No</th>
									<th scope="col">Jenis Pembayaran</th>
									<th scope="col">Pembayaran</th>
									<th scope="col">Jumlah Pembayaran</th>
									<th scope="col">Bukti Bayar</th>
									<th scope="col">Keterangan Pembayaran</th>
									<th scope="col" id="aksi">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								// echo "<pre>";
								// 	print_r ($pembayaran);
								// echo"</pre>";	
								?>
								@foreach ($pembayaran as $key => $bayar)	
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $bayar->tipe_pembayaran }}</td>
									<td>{{ $bayar->status_pembayaran }}</td>
									<td>Rp. {{ number_format($bayar->jumlah_pembayaran) }}</td>
									<td>
										@if (($bayar->bukti_pembayaran) == '-')
										{{ $bayar->bukti_pembayaran }}
										@else
										<div class="xzoom-container">
											<img src="{{ asset('img/pemesanan/'.$bayar->bukti_pembayaran) }}" class="xzoom w-100" xoriginal="{{  asset('img/pemesanan/'.$bayar->bukti_pembayaran) }}" style="object-fit: cover; max-height: 250px;"/>
											  <div class="xzoom-thumbs mt-2">
                          <a href="{{ asset('img/pemesanan/'.$bayar->bukti_pembayaran) }}"><img class="xzoom-gallery" width="80" src="{{ asset('img/pemesanan/'.$bayar->bukti_pembayaran) }}"  xpreview="{{ asset('img/pemesanan/'.$bayar->bukti_pembayaran) }}" title="The description goes here" hidden></a>
                          <a href="{{ asset('img/pemesanan/'.$bayar->bukti_pembayaran) }}" target="_blank" rel="noopener noreferrer" download>Download</a>
                        </div>
										</div>
										@endif
									</td>
									<td>
										{{ $bayar->nama_rekening }} <br>
										{{ $bayar->no_rekening }} - {{ $bayar->nama_bank }} <br>
									</td>
									<td>
										@if ($bayar->status_pembayaran == 'Pending')								
										<div class="d-flex flex-row">
											<a href="{{ url('admin/pemesanan/verifikasi_pembayaran/'.$bayar->id_pembayaran) }}" class="btn btn-success btn-sm px-3 mr-2">Verifikasi</a>
											<a href="{{ url('admin/pemesanan/ubah_pembayaran/'.$bayar->id_pembayaran) }}" class="btn btn-info btn-sm px-3" data-toggle="tooltip" title="Ubah Nominal Pembayaran"><i class="fas fa-edit"></i></a>
										</div>
										@else
										-
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
  </div>
@endsection

@push('prepend-style')
  <link rel="stylesheet" href="{{ asset('xzoom/xzoom.css') }}">
@endpush

@push('addon-script')
	<script type="text/javascript">
    var max_wisatawan = "{{ pengaturan('kuota_mak_sesi') }}"

	$(function(){
	  $("#inputWisatawan").on('change keyup', function(){
			var jumlah_wisatawan = parseInt($(this).val());
			var per_paket = $('#kapasitas_max').val();
			var jumlah_paket = 1;
			var sisa = 0;
			console.log('jml wis', jumlah_wisatawan)
			console.log('perpaket', per_paket)
			console.log('maks wisatawan', max_wisatawan)
			//mengatur maksimal wisatawan per sesi
			if ( jumlah_wisatawan > max_wisatawan ) {
				alert('Jumlah maksimum wisatawan per sesi hanya '+max_wisatawan+' orang.');
				$(this).val(max_wisatawan);
				jumlah_wisatawan = max_wisatawan;
			}
			//jika jumlah wisatawan dibawah jumlah per pakaet
			if (jumlah_wisatawan <= per_paket) {
				jumlah_paket = 1;
				sisa = 0;
			}else{
				//sebaliknya
				sisa = jumlah_wisatawan % per_paket;
				jumlah_paket = Math.floor(jumlah_wisatawan / per_paket);
			}
			console.log('sisa', sisa)
			console.log('jml paket', jumlah_paket)
			var harga_paket = $("#harga_paket").val();
			var biaya_pemesanan = jumlah_paket * harga_paket;
			var biaya_tambahan = (5/100 * harga_paket) * sisa;
			var total_bayar = biaya_pemesanan + biaya_tambahan;
			console.log('tambahan', biaya_tambahan);
			
			//update inputan
			$("#inputJmlPaket").val(jumlah_paket);
			$("#inputJmlTambahan").val(sisa);
			$("#inputBiayaPemesanan").val(biaya_pemesanan); 
			$("#inputBiayaPemesanan_Temp").val(biaya_pemesanan); 

			$("#inputBiayaTambahan").val(biaya_tambahan); 
			$("#inputBiayaTambahan_Temp").val(biaya_tambahan); 

			$("#inputTotBayar").val( total_bayar); 
			$("#inputTotBayar_Temp").val( total_bayar); 

			//tambah tamu
			var telah_dibayar = $("#inputTelahDibayar").val();

			var perlu_dibayar = total_bayar - telah_dibayar;

			$("#inputPerluDibayar").val( perlu_dibayar); 

  	})
	})
	</script>

	<script src="{{ asset('xzoom/xzoom.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.xzoom, .xzoom-gallery').xzoom({
        zoomWidth: 500,
        title: false,
        tint: '#333',
        Xoffset: 10 
      });
    });
  </script>
@endpush