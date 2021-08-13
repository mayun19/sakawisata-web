<?php 
	$hari['Sunday'] = "Minggu";
	$hari['Monday'] = "Senin";
	$hari['Tuesday'] = "Selasa";
	$hari['Wednesday'] = "Rabu";
	$hari['Thursday'] = "Kamis";
	$hari['Friday'] = "Jumat";
	$hari['Saturday'] = "Sabtu";


?>

@extends('layouts.admin')

@section('title', 'Event')

@section('konten')
<div class="dashboard-heading">
	<h2 class="dashboard-title">Event</h2>
	<p class="dashboard-subtitle">
		Kelola event yang ada di Kampung Wisata Kauman
	</p>
</div>
<div class="dashboard-content">
	<div class="row">
		<div class="col-12">
			<a
				href="{{ url('admin/event/tambah') }}"
				class="btn btn-add-paket"
				>Tambah Event</a
			>
		</div>
	</div>
	<div class="row mt-2">
		@if (session('pesan'))
			<div class="alert alert-success">
			{{ session('pesan') }}  
			</div>  
		@endif
	</div>
	<div class="row mt-4">
		@foreach ($event as $item)
		<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
			<div class="card card-dashboard-event">
				<img
					src="{{ asset('img/event/'.$item->foto_event) }}"
					class="w-100 mb-2"
					alt="Card image cap"
				/>
				<div class="card-body">
					<div class="event-nama">
						<h3>{{ $item->nama_event }}</h3>
					</div>
					<div class="row">
						@if (!empty($item->author_event))
						<div class="col-5 event-author">
							oleh: <b>{{ $item->author_event }}</b>
						</div>
						-
							@if (!empty($item->tgl_selesai_event))
							<div class="col-6 event-date">
								<?php $day = date("l", strtotime($item->tgl_mulai_event)); echo $hari[$day];?>, {{ date('d M Y', strtotime($item->tgl_mulai_event)) }} - {{ date('d M Y', strtotime($item->tgl_selesai_event)) }}
							</div>
							@else
							<div class="col-6 event-date">
								<?php $day = date("l", strtotime($item->tgl_mulai_event)); echo $hari[$day];?>, {{ date('d M Y', strtotime($item->tgl_mulai_event)) }}
							</div>
							@endif 
						@else
							@if (!empty($item->tgl_selesai_event))
							<div class="col-12 event-date">
								<?php $day = date("l", strtotime($item->tgl_mulai_event)); echo $hari[$day];?>, {{ date('d M Y', strtotime($item->tgl_mulai_event)) }} - {{ date('d M Y', strtotime($item->tgl_selesai_event)) }}
							</div>
            	@else
							<div class="col-12 event-date">
								<?php $day = date("l", strtotime($item->tgl_mulai_event)); echo $hari[$day];?>, {{ date('d M Y', strtotime($item->tgl_mulai_event)) }}
							</div>
            	@endif 
						@endif
					</div>
					<div class="event-short-deskripsi">
						{!!  Str::limit($item->deskripsi_event, 150)  !!}
					</div>
					<div class="row row-option justify-content-center mt-4">
						<a href="{{ url('admin/event/edit/'.$item->id_event) }}"	class="btn btn-option-edit mx-2 px-4">Edit</a>
						<a onclick="return confirm('Apakah anda yakin hapus Event?')"	href="{{ url('admin/event/hapus/'.$item->id_event) }}"	class="btn btn-option-hapus px-3 mx-2">Hapus</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
