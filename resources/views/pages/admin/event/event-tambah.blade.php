@extends('layouts.admin')

@section('title', 'Event')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Tambah Event</h2>
		<p class="dashboard-subtitle">
			Buat event baru di Kampung Wisata Kauman
		</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        @if (session('pesan'))
          <div class="alert alert-success">
            {{ session('pesan') }}
          </div>
				@endif
        <form action="{{ url("admin/event/simpan") }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Event</label>
										<input
											type="text"
											name="nama_event" id="nama_event"
											class="form-control"
										/>
									</div>
                </div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Foto Event</label>
										<input
											type="file"
											class="form-control-file"
											name="foto_event" id="foto_event"
										/>
									</div>
                </div>
								<div class="col-md-6">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Tanggal Mulai</label>
                      <input
                        type="date"
                        class="form-control"
                        name="tgl_mulai_event" id="tgl_mulai_event"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tanggal Selesai</label>
                      <input
                        type="date"
                        class="form-control"
                        name="tgl_selesai_event" id="tgl_selesai_event"
                      />
                    </div>
                  </div>
                </div>
								<div class="col-md-6">
									<div class="row">
                    <div class="form-group col-md-6">
                      <label for="">Waktu</label>
                      <input
                        type="time"
                        class="form-control"
                        name="jam_event" id="jam_event"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label for="">Penulis</label>
                      <input
                        type="text"
                        class="form-control"
                        name="author" id="author"
                      />
                    </div>
									</div>
                </div>
								<div class="form-group col-md-4">
									<label>Link Twitter</label>
                  <input type="url" class="form-control"  name="" id="twitter_event"/>
                </div>
								<div class="form-group col-md-4">
									<label>Link Whatsapp</label>
                  <input type="url" class="form-control" id="wa_event"/>
                </div>
								<div class="form-group col-md-4">
									<label> Link Facebook </label>
                  <input type="url" class="form-control"  id="fb_event"/>
                </div>
								<div class="col-md-12">
									<div class="form-group mt-3">
										<label for="">Deskripsi Event</label>
										<textarea
											name="deskripsi_event"
											id="deskripsi_event"
											rows="6"
											class="form-control"
										></textarea>
									</div>
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
		<script>
			CKEDITOR.replace( 'deskripsi_event' );
    </script>
@endpush