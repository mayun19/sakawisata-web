@extends('layouts.admin')

@section('title', 'Situs Jelajah')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Situs Jelajah</h2>
		<p class="dashboard-subtitle">
			Kelola situs jelajah yang ada di Kampung Wisata Kauman
		</p>
	</div>
	<div class="dashboard-content">
		<div class="row">
			<div class="col-12">
				<a
					href="{{ url('admin/situs/tambah') }}"
					class="btn btn-add-paket"
					>Tambah Situs</a
				>
			</div>
			@if (session('pesan'))
				<div class="alert alert-success">
					{{ session('pesan') }}
				</div>
			@endif
		</div>
		<div class="row mt-4">
	    @foreach ($situs as $key => $item)
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3">
				<div class="card card-dashboard-situs d-block">
					<div class="card-body">
						<img
							src="{{ asset('img/situs/'.$item->foto_situs) }}"
							class="w-100 mb-2 foto-situs"
							alt=""
						/>
						<div class="situs-nama mt-3">
							<h3>{{ $item->nama_situs}}</h3>
						</div>

						<div class="row row-option justify-content-center mb-3">
							<a
								href="{{ url('admin/situs/detail/'.$item->id_situs) }}"
								class="btn btn-option-detail mx-1 px-3"
								>Detail</a
							>
							<a
								href="{{ url('admin/situs/edit/'.$item->id_situs) }}"
								class="btn btn-option-edit mx-1 px-3"
								>Edit</a
							>
							<a
								href="{{ url('admin/situs/hapus/'.$item->id_situs) }}"
								class="btn btn-option-hapus mx-1 px-3" onclick="return confirm('Apakah anda yakin ingin menghapus paket situs ?')"
								>Hapus</a
							>
						</div>
					</div>
				</div>
	    </div>
	    @endforeach
		</div>
		<div class="row d-flex justify-content-center text-center">
      {!! $situs->links() !!}   
    </div>
	</div>
@endsection
