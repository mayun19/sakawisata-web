@extends('layouts.app')

@section('title', 'Testimoni Wisatawan')

@section('konten')
  <main>
    <!-- Header Page Tentang -->
    <section class="section-testi-header text-center">
      <div class="container">
        <h1>Testimoni</h1>
      </div>
    </section>

    <!-- Content Page Pemandu -->
    <section class="section-testi-content pb-2">
      <div class="container">
        <div class="content-faq row justify-content-center">
          <div id="main" class="testimoni">
            <div class="container ">
              <div class="row testimoni-content" id="testimoni">
                @foreach ($testimoni as $testi)
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="card mb-3 d-flex flex-column">
                    <div class="container card-testimoni">
                      <p>"{{$testi->pesan_tamu}}"</p>
                      <h4>{{ $testi->nama_tamu }}</h4>
                      <h5>{{ $testi->asal_tamu }}</h5>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="row d-flex justify-content-center text-center">
                {!! $testimoni->links() !!} 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@push('addon-style')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<style>
/* #main {
  margin: 50px 0;
} */


  </style>
@endpush