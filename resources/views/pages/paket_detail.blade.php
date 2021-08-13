<?php 
  // echo "<pre>";
  // print_r ($paket);
  // echo "</pre>";
?>

@extends('layouts.app')

@section('title', 'Paket Kunjungan')

@section('konten')
  <main>
    <!-- Header -->
    <section class="section-detailPaket-header text-center">
    </section>
    
    <section class="section-detailp-content">
      <div class="container">
        <div class="row">
          <div class="col-10 p-0">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Jelajah</li>
                <li class="breadcrumb-item"><a href="{{ url('paket') }}">Paket Kunjungan</a></li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 pl-lg-0">
            <div class="card card-detailp">
              <h4>PAKET</h4>
              <h1>{{ $paket->nama_paket }}</h1>
              <div class="gallery-paket">
                <div class="xzoom-container">
                  <img src="{{ asset('img/paket/'. $paket->foto_paket) }}" class="xzoom" id="xzoom-default" xoriginal="{{ asset('img/paket/'. $paket->foto_paket) }}">
                </div>
              </div>
              <div class="features">
                <div class="row">
                  @foreach ($fasilitas as $item)
                    <div class="col-md-6">
                      <div class="row px-2">
                        <img src="{{ asset('img/fasilitas/'. $item->icon_fasilitas) }}" alt="" class="feature-image">
                        <div class="feature-desc my-auto">
                         <h3>{{ $item->nama_fasilitas }}</h3>
                        </div>
                      </div>
                    </div>                       
                  @endforeach
                </div>
                <hr>
              </div>
              <div class="features">
                <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-1">
                          <img src="{{ asset('img/ic_rutee.png') }}" alt="" class="feature-image">
                        </div>
                        <div class="col-md-8">
                          <div class="feature-desc my-auto">
                            <h3>Rute</h3>
                            <p>
                              @foreach ($situs as $item)
                              {{ $item->nama_situs }} -
                              @endforeach
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>                       
                </div>
                <hr>
              </div>
              <h2>Deskripsi Paket Jelajah</h2>
              <p>{{ $paket->deskripsi_paket }}</p>
            </div>
            <div class="term">
              <div class="container">
                <h4>Syarat & Ketentuan</h4>
                <p>Konfirmasi: 
                  <br> 
                  Anda akan menerima invoice pemesanan kunjungan via email, mohon cek folder Spam atau beri tahu kami via email bila tidak mendapatkan email. <br>
                </p>
                <p>Pembatalan: 
                  <br>
                  Full refund akan diberikan untuk pembatalan yang dilakukan setidaknya H-3 sebelum kegiatan berlangsung</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card card-right">
              <div class="container">
                <h2>Rp &ensp; {{ number_format($paket->harga_paket) }}</h2>
                <li class="list-unstyled"><img src="{{ asset('img/user-paket.png') }}" alt="">
                  <span class="kapasitas">{{ $paket->kapasitas_min_paket }} - {{ $paket->kapasitas_max_paket }} orang</span>
                </li>
                  <form action="{{url('paket/pesan/'.$item->id_paket)}}" method="GET">
                  @csrf
                  <div class="form-group">
                    <label for="inputWisatawan">Jumlah Rombongan</label>
                    <input type="number" min="1" max="60" class="form-control" name="jumlah_wisatawan" id="inputWisatawan" >
                  </div>
                  <div class="form-group form-tanggal">
                    <label for="tanggal-kunjungan">Pilih Tanggal Kunjungan</label>
                    <div class="input-group">
                      <img src="{{ asset('img/ic_date.png') }}" width="38">
                      <input type="text"  name="tgl_kunjungan" class="datepicker form-control" autocomplete="off" id="tanggal-kunjungan">
                    </div>
                  </div>                  
                  <div class="form-group form-time">
                    <label for="inputWaktu">Pilih Waktu Kunjungan</label>
                    <div class="input-group">
                      <img src="{{asset('img/ic_time.png') }}" width="38">
                      <select name="waktu_kunjungan_pemesanan" id="inputWaktu" class="form-control">
                        <option value="">-- Pilih Sesi --</option>
                        @foreach ($sesi as $item)
                        <option value="{{$item->id_sesi}}">{{ $item->nama_sesi}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
              </div>
            </div>
            <div class="join-container">
              <button class="btn btn-block btn-join-now mt-2 py-2" id="lanjutkan" disabled>Lanjutkan Pemesanan</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@push('prepend-style')
{{-- <link rel="stylesheet" href="{{ asset('xzoom/xzoom.css') }}"> --}}
@endpush

@push('addon-style')
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/redmond/jquery-ui.css">
@endpush


@push('addon-script')

  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
      var disabled = [];

      function DisableDates(date) {
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [disabled.indexOf(string) == -1];
      }

      $(document).ready(function(){
        var bindDatePicker = function(element) {
          $(element).datepicker({
            minDate: 3,
            beforeShowDay: DisableDates
          });
        }

        bindDatePicker(".datepicker");

        $("input[name=jumlah_wisatawan]").on("change", function(e){
          var rombonganku= $(this).val();
          var token= $("input[name=_token]").val();

          // alert(rombonganku);
          $("#tanggal-kunjungan").val("");
          $("#tanggal-kunjungan").prop("disabled", true);
          $("#inputWaktu").val("");
          $("#inputWaktu").prop("disabled", true);

          $.ajax({
            type:'post',
            url:'{{url('ajax/cek_tanggal')}}',
            data:'rombonganku='+rombonganku+'&_token='+token,
            async: false,
            dataType: 'json',
            cache: false,
            beforeSend: function() {
              console.log('checking tanggal...');
              $("#tanggal-kunjungan").prop('disabled', true);
              $("#loading").css('display', 'block');
            }, success:function(hasil){
              console.log('selesai checking tanggal...');
              console.log(hasil);
              disabled = hasil;
              if (disabled.length > 0) {
                bindDatePicker(".datepicker");
              }
              $("#tanggal-kunjungan").prop('disabled', false);
              $("#loading").css('display', 'none');
            },
            error: function(xhr, status, error) {
              console.log(error);
            }
          })
          e.stopImmediatePropagation();
          return false;
        });

        $(".datepicker").on("change", function(){
          var tanggal = $(this).val();
          var jumlah = $("input[name=jumlah_wisatawan]").val();
          var token= $("input[name=_token]").val();
          var id_paket = '{{ $paket->id_paket }}';

          $("#inputWaktu").prop("disabled", true);
          
          $.ajax({
            type:'post',
            url:'{{url('ajax/cek_sesi')}}',
            data:'tanggal='+tanggal+'&jumlah='+jumlah+'&_token='+token+'&id_paket='+id_paket,
            success:function(hasil){
              var sesis = $.parseJSON(hasil);
              console.log(hasil);{

                var isi = "<option value=''>Pilih Sesi Kunjungan</option>";
                $.each(sesis, function(index, value){
                  if(value['status_ketersediaan']=="penuh"){
                    isi+= "<option value='"+value['id_sesi']+"' disabled='disabled' style='color: red;font-style: italic;'>"+value["nama_sesi"]+"</option>";
                  }else{
                    isi+= "<option value='"+value['id_sesi']+"'>"+value["nama_sesi"]+"</option>";
                  }
                });
                $("select[name=waktu_kunjungan_pemesanan]").html(isi);
                $("#inputWaktu").prop("disabled", false);
              }
            }
          })
        })

        /* dafinisi varible ambil dari db pengaturan kuota mak sesi */
        var max_wisatawan = "{{ pengaturan('kuota_mak_sesi') }}"

        function cek_inputan() {
          var jumlah_wisatawan = parseInt($('#inputWisatawan').val());
          
          console.log('maks wisatawan', max_wisatawan) 

          //mengatur maksimal wisatawan per sesi
          if ( jumlah_wisatawan > max_wisatawan ) {
            alert('Jumlah maksimum wisatawan per sesi hanya '+ max_wisatawan+ ' orang.' );
            $(this).val(max_wisatawan);
            jumlah_wisatawan = max_wisatawan;
          }

          //cek inputan
          var inputWisatawan = $("#inputWisatawan").val();
          var inputtanggalkunjungan = $("#tanggal-kunjungan").val();
          var inputWaktu = $("#inputWaktu").val();

          if (inputWisatawan != "" && inputtanggalkunjungan != "" && inputWaktu != "") {
            $("button").prop('disabled', false);
          }else{
            $("button").prop('disabled', true);
          }
        }
        //jalankan fuc u/ cek inputan
        $("input[name=jumlah_wisatawan]").on('change keyup', cek_inputan);
        $("#tanggal-kunjungan").on('change keyup', cek_inputan);
        $("#inputWaktu").on('change', cek_inputan);
      })
    </script>
@endpush