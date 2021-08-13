@extends('layouts.admin')

@section('title', 'Event')

@section('konten')

	<div class="dashboard-heading">
		<h2 class="dashboard-title">Event SAKAWISATA</h2>
		<p class="dashboard-subtitle">
			<a href="{{ url('admin/event') }}">Event</a> / Edit Event
		</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/event/update/".$event->id_event) }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="form-group col-md-12">
                  <label>Nama Event</label>
                  <input
                    type="text"
                    name="nama_event" id="nama-event"
                    class="form-control" value="{{ $event->nama_event }}"
                  />
                </div>
                <div class="form-group col-md-12">
                  <label>Foto Event</label>
                  <div class="row icon-fasilitas mt-3 my-2">
                    <div class="col-md-12">
                      <div class="gallery-container">
                        <img
                          src="{{ asset('img/event/'.$event->foto_event) }}"
                          alt="Card image cap"
                          class="img-fluid w-100" style="max-height: 200px; object-fit: cover;"
                        />
                      </div>                          
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-md-12">
                      <span class="btn btn-sm btn-gallery btn-block">
                        Ganti Icon Partner
                        <input type="file" name="foto_event" id="foto-event">
                      </span>                        
                    </div>
                  </div>
                </div>
								<div class="col-md-6">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Tanggal Mulai</label>
                      <input
                        type="date"
                        class="form-control"
                        name="tgl_mulai_event" id="tgl-mulai-event" value="{{ $event->tgl_mulai_event }}"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tanggal Selesai</label>
                      <input
                        type="date"
                        class="form-control"
                        name="tgl_selesai_event" id="tgl-selesai-event"
                        value="{{ $event->tgl_selesai_event }}"
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
                        name="jam_event" id="jam-event" value="{{ request()->query('jam_event') }}"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label for="">Penulis</label>
                      <input
                        type="text"
                        class="form-control"
                        name="author" id="author" value="{{ $event->author_event }}"
                      />
                    </div>
									</div>
                </div>
								<div class="form-group col-md-4">
									<label>Link Twitter</label>
                  <input type="text" class="form-control"  name="twitter_event" id="twitter-event" value="{{ $event->twitter_event }}"/>
                </div>
								<div class="form-group col-md-4">
									<label>Link Whatsapp</label>
                  <input type="text" class="form-control" name="wa_event" value="{{ $event->wa_event }}"/>
                </div>
								<div class="form-group col-md-4">
									<label> Link Facebook </label>
                  <input type="text" class="form-control"  name="fb_event" value="{{ $event->fb_event }}"/>
                </div>
								<div class="col-md-12">
									<div class="form-group mt-3">
										<label for="">Deskripsi Event</label>
										<textarea
											name="deskripsi_event"
											id="deskripsi_event"
											rows="6"
											class="form-control"
										>{{ $event->deskripsi_event }}</textarea>
									</div>
								</div>               
              </div>
							<div class="row">
								<div class="col text-right">
									<button type="submit" class="btn btn-tambah btn-block px-3">
										Simpan Event
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