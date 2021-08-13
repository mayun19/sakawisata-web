@extends('layouts.admin')

@section('title', 'Pemandu')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Pemandu</h2>
		<p class="dashboard-subtitle">
			Kelola pemandu wisata di Kampung Wisata Kauman
		</p>
	</div>
	<div class="dashboard-content">
		<div class="row">
			<div class="col-12">
				<a
					href="{{ url('admin/pemandu/tambah') }}"
					class="btn btn-add-paket"
					>Tambah Pemandu
				</a>
			</div>
		</div>
		<div class="row mt-4">
			@foreach ($pemandu as $item)
				<div class="col-11 col-sm-8 col-md-8 col-lg-6 col-xl-4 mb-3">
					<div class="card card-dashboard-pemandu d-block">
						<div class="card-body text-center">
							<img
								class="card-img-top my-auto rounded-circle"
								src="{{ asset('img/pemandu/'.$item->foto_pemandu) }}"
								alt="Card image cap"
							/>
							<div class="pemandu-nama mt-3">
								<h3>{{ $item->nama_pemandu}}</h3>
							</div>
							<p class="pemandu-job">Pemandu</p>

							<div class="row row-option justify-content-center mb-3">
								<a
									href="{{ url('admin/pemandu/detail/'.$item->id_pemandu) }}"
									class="btn btn-option-detail mx-2 px-3"
									>Detail</a
								>
								<a
									href="{{ url('admin/pemandu/edit/'.$item->id_pemandu) }}"
									class="btn btn-option-edit mx-2 px-4"
									>Edit</a
								>
								<a
									href="{{ url('admin/pemandu/hapus/'.$item->id_pemandu) }}"
									class="btn btn-option-hapus mx-2 px-3"
									>Hapus</a
								>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<div class="row mt-2 d-flex justify-content-center text-center">
			{!! $pemandu->links() !!}
		</div>
	</div>
@endsection
