@extends('layouts.app')

@section('title', 'Event')

@section('konten')
<?php 
	$hari['Sunday'] = "Minggu";
	$hari['Monday'] = "Senin";
	$hari['Tuesday'] = "Selasa";
	$hari['Wednesday'] = "Rabu";
	$hari['Thursday'] = "Kamis";
	$hari['Friday'] = "Jumat";
	$hari['Saturday'] = "Sabtu";

?>
  <main>
    <!-- Header -->
    <section class="section-situs-header text-center">
    </section>
    
    <section class="section-paket-content">
      <div class="container">
        <div class="row">
          <div class="col-10 p-0">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Informasi</li>
                <li class="breadcrumb-item active">Event</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-11 pl-lg-0">
            <div class="card card-situs">
              <div class="situs-heading text-center">
                <h1>Event </h1>
                <hr>
                <div class="col-sm-6 col-md-6  col-lg-7  mx-auto event-deskripsi">
                  <p>
                    Informasi agenda event wisata yang ada di Kampung Wisata Kauman
                  </p>
                </div>
              </div>
              <div class="content-situs">
                <div class="row row-situs-item justify-content-center">
                 @foreach ($event as $item)
                 <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                   <div class="card card-dashboard-event d-block">
                     @if (!empty($item->foto_event))
                     <img
                       src="{{ asset('img/event/'.$item->foto_event) }}"
                       class="w-100 mb-2"
                       alt="Card image cap"
                     />
                     @endif
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
                         {!! Str::limit($item->deskripsi_event, 150) !!}
                       </div>
                       <div class="row row-option justify-content-center mt-4">
                         <a
                           href="{{ url('event/detail/'.$item->id_event.$item->nama_event) }}"
                           class="btn btn-selengkapnya px-3 mx-2"
                           >Selengkapnya</a
                         >
                       </div>
                     </div>
                   </div>
                 </div>
                 @endforeach
                 <div class="d-flex justify-content-center text-center">
                      
                 </div>
                </div>
                <div class="col-lg-8 mx-auto ">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection