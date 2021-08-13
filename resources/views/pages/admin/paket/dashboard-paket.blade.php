@extends('layouts.admin')

@section('title', 'Paket Kunjungan')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Paket Kunjungan</h2>
			<p class="dashboard-subtitle">
				Kelola paket kunjungan yang ada di Kampung Wisata Kauman
			</p>
	</div>
	<div class="dashboard-content">
		<div class="row">
			<div class="col-12">
				<a
					href="{{ url('admin/paket/tambah') }}"
					class="btn btn-add-paket"
					>Tambah Paket</a
				>
			</div>
			@if (session('pesan'))
				<div class="alert alert-success">
					{{ session('pesan') }}
				</div>
			@endif
		</div>
		<div class="row mt-4">
			@foreach ($paket as $item)
			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3">
				<div class="card card-dashboard-paket d-block">
					<img
						src="{{ asset('img/paket/'.$item->foto_paket) }}"
						class="w-100 foto-paket mb-2"
						alt="foto paket"
					/>
					<div class="card-body">
						<h4>PAKET</h4>
						<div class="paket-nama"><h3>{{ $item->nama_paket }}</h3></div>
						<div class="paket-harga">Rp &ensp; {{ number_format($item->harga_paket) }}</div>
						<li class="list-unstyled">
							<img
								src="{{asset ('img/user-paket.png') }}"
								alt=""
							/><span class="kapasitas">{{ $item->kapasitas_min_paket }} - {{ $item->kapasitas_max_paket }} orang</span>
						</li>
						<div class="row row-option justify-content-center mt-4">
							<a
								href="{{ url('admin/paket/detail/'.$item->id_paket) }}"
								class="btn btn-option-detail px-2	mx-1"
								>Detail</a
							>
							<a
								href="{{ url('admin/paket/edit/'.$item->id_paket) }}"
								class="btn btn-option-edit mx-1 px-3"
								>Edit</a
							>
							<a
								href="{{ url('admin/paket/hapus/'.$item->id_paket) }}"
								class="btn btn-option-hapus px-2 mx-1" onclick="return confirm('Apakah anda yakin ingin menghapus paket kunjungan ?')"
								>Hapus</a
							>
						</div>
					</div>
				</div>
			</div>
			<hr>
			  {{-- {!! $pemesanan->links() !!}   --}}
			@endforeach
		</div>
		<div class="row mt-2 d-flex justify-content-center text-center">
			{!! $paket->links() !!}
		</div>
	</div>
@endsection
