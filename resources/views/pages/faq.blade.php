@extends('layouts.app')

@section('title', 'FAQ')

@section('konten')
  <main>
    <!-- Header Page Tentang -->
    <section class="section-faq-header text-center">
      <div class="container">
        <h1>FAQ</h1>
      </div>
    </section>

    <!-- Content Page Pemandu -->
    <section class="section-pemandu-content pb-2">
      <div class="container">
        <div class="faq-judul row py-4 justify-content-center">
          <div class="container">
            <h3 class="text-center">Pertanyaan yang Sering Diajukan</h3>
          </div>
        </div>
        <div class="content-faq mt-4 row justify-content-center">
          <div id="main">
            <div class="container">
              <div class="accordion" id="faq">
                @foreach ($faq as $item) 
                <div class="card">
                  <div class="card-header" id="faqhead1{{ $item->id_faq }}">
                    <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1{{ $item->id_faq }}" aria-expanded="true" aria-controls="faq1{{ $item->id_faq }}">
                      {{ $item->pertanyaan }}
                    </a>
                  </div>
                  <div id="faq1{{ $item->id_faq }}" class="collapse" aria-labelledby="faqhead1{{ $item->id_faq }}" data-parent="#faq">
                    <div class="card-body" id="tambah"> 
                      {!! $item->jawaban !!}
                    </div>
                  </div>
                </div>
                @endforeach
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