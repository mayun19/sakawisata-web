@extends('layouts.app')

@section('title', 'Event')

@push('addon-style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@endpush

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
                <li class="breadcrumb-item"><a href="{{ url('event') }}">Event</a></li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-9 pl-lg-0">
            <div class="card card-detail-event">
              <div class="event-heading text-center">
                <h1>{{ $event->nama_event }} </h1>
              </div>
              <div class="gallery text-center">
                @if (!empty($event->foto_event))
                <img src="{{ asset('img/event/'. $event->foto_event) }}" class="foto_event img-fluid w-100" alt="">
                @endif
              </div>
              <div class="event-info container mt-3">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-11">
                    <h5>Event Info</h5>
                    <hr>
                    <div class="event-date container">
                      <div class="date row mt-2">
                        <img src="{{ asset('img/date_icon.png') }}" class="px-2" alt="">
                        @if (!empty($event->tgl_selesai_event))
                        <?php  $day = date("l", strtotime($event->tgl_mulai_event)); echo $hari[$day]; ?> {{ date('d M Y', strtotime($event->tgl_mulai_event)) }} - <?php  $day = date("l", strtotime($event->tgl_selesai_event)); echo $hari[$day]; ?> {{ $event->tgl_selesai_event }}
                        @else
                         <?php  $day = date("l", strtotime($event->tgl_mulai_event)); echo $hari[$day]; ?> {{ date('d M Y', strtotime($event->tgl_mulai_event)) }}
                        @endif  
                      </div>
                      @if (!empty($event->jam_event))                          
                      <div class="time row mt-2">
                        <img src="{{ asset('img/time_icon.png') }}" class="px-2" alt="">
                        {{ date('H:i', strtotime($event->jam_event)) }}
                      </div>
                      @else   
                      @endif               
                    </div>
                  </div>
                </div>
              </div>
              <div class="content-event mt-4">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-10">
                    <div class="deskripsi-event">
                      {!! $event->deskripsi_event !!}
                    </div>
                  </div>
                </div>
              </div>
              <div class="sosmed-event container mt-3">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-11">
                    <hr>
                    <div class="row sosmed-item">
                      <div class="col-md-3 mb-2 share">Bagikan</div>
                      <div class="col-md-3 mb-2"><a href="{{ url($event->twitter_event) }}"><img src="{{ asset('img/twitter_share.png') }}" alt=""></a></div>
                      <div class="col-md-3 mb-2"><a href=""><img src="{{ asset('img/wa_share.png') }}" alt=""></a></div>
                      <div class="col-md-3 mb-2"><a href="{{ url($event->fb_event) }}"><img src="{{ asset('img/fb_share.png') }}" alt=""></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="event-lainnya container mt-5 mb-5">
                <div class="row justify-content-center">
                  @foreach ($all_event as $item)                     
                    <div class="col-12 col-md-5 mb-3">
                      <div class="card card-event">
                        <a href="{{ url('event/detail/'.$item->id_event.$item->nama_event) }}">
                          @if (!empty($item->foto_event))
                          <img src="{{ asset('img/event/'.$item->foto_event) }}" class="w-100 mb-2" alt="event-thumb"/>
                          @endif
                          <div class="content-thumb container">
                            <h5>{{ $item->nama_event }}</h5>
                            <p class="mt-2"><strong><?php  $day = date("l", strtotime($item->tgl_mulai_event)); echo $hari[$day]; ?>, {{ date('d M Y', strtotime($item->tgl_mulai_event)) }}</strong></p>
                          </div>
                        </a>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="row justify-content-center mt-3">
                  <a class="event-all" href="{{ url('event') }}">Event Lainnya &nbsp; <i class="fas fa-long-arrow-alt-right"></i> </a>
                </div>
              </div>
             </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection