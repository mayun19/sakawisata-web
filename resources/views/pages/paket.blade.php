@extends('layouts.app')

@section('title', 'Paket Kunjungan')

@section('konten')
<main>
  <!-- Header -->
  <section class="section-paket-header text-center">
  </section>
  <section class="section-paket-content">
    <div class="container">
      <div class="row">
        <div class="col-10 p-0">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Jelajah</li>
              <li class="breadcrumb-item active">Paket Kunjungan</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-11 pl-lg-0">
          <div class="card card-paket">
            <div class="paket-heading text-center ">
              <h1>Paket Kunjungan </h1>
              <hr>
            </div>
            <div class="content-paket">
              <div class="row row-content-paket justify-content-center">
                @foreach ($paket as $item)
                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="card card-item-paket d-flex flex-column">
                      <img src="{{ url('img/paket/' . $item->foto_paket) }}" class="w-100 foto-paket mb-2" alt="">
                      <div class="item-paket">
                        <h4>PAKET</h4>
                        <h3>{{ $item->nama_paket }}</h3>
                        <h2> Rp &ensp; {{ number_format($item->harga_paket) }} </h2>
                        <li class="list-unstyled">
                          <img src="{{ asset('img/user-paket.png') }}" alt="">
                          <span class="kapasitas">
                            {{ $item->kapasitas_min_paket }} - {{ $item->kapasitas_max_paket }} orang
                          </span>
                        </li>
                        <div class="item-paket-button mt-3 text-center">
                          <a href="{{ url('paket/detail/' . $item->id_paket) }}" class="btn btn-detail-paket btn-block"> Lihat Detail
                          </a>
                        </div>
                        <form action="{{ url('paket/pesan/' . $item->id_paket) }}" method="GET">
                          <h3>Pemesanan Langsung</h3>
                          @csrf
                          <div class="form-group form-rombongan">
                            <label for="inputWisatawan-{{ $item->id_paket }}">Jumlah Rombongan</label>
                            <div class="input-group">
                              <input type="number" class="form-control jumlah_wisatawan" min="1" max="60" name="jumlah_wisatawan" id="inputWisatawan-{{ $item->id_paket }}">
                            </div>
                          </div>
                          <div class="form-group form-tanggal">
                            <label for="tanggal-kunjungan-{{ $item->id_paket }}">Pilih Tanggal Kunjungan</label>
                            <div class="input-group">
                              <img src="{{ asset('img/ic_date.png') }}" width="31">
                              <input type="text" name="tgl_kunjungan" paket_id="{{ $item->id_paket }}" class="datepicker form-control" autocomplete="off" disabled>
                            </div>
                          </div>
                          <div class="form-group form-time">
                            <label for="inputWaktu-{{ $item->id_paket }}">Pilih Waktu Kunjungan</label>
                            <div class="input-group">
                              <img src="{{ asset('img/ic_time.png') }}" width="31">
                              <select name="waktu_kunjungan_pemesanan" id="inputWaktu-{{ $item->id_paket }}" class="form-control form-control-sm select_sesi" disabled>
                              </select>
                            </div>
                          </div>
                          <div class="item-paket-button mt-auto d-flex justify-content-center">
                            <button class="btn btn-item-paket btn-block mt-2 py-2">Lanjutkan Pemesanan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="d-flex justify-content-center text-center">
                {!! $paket->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection


@push('addon-style')
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/redmond/jquery-ui.css">
@endpush


@push('addon-script')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

  <script>
    var disabled = [];

    function DisableDates(date) {
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [disabled.indexOf(string) == -1];
    }

    $(document).ready(function() {

      var bindDatePicker = function(element) {
        $(element).datepicker({
          minDate: 3,
          beforeShowDay: DisableDates
        });
      }
      bindDatePicker(".datepicker");

      $(".jumlah_wisatawan").each(function(index) {

            // var datepick = $(this).closest('form').find('.datepicker')[0];
            // $(datepick).prop('disabled', true)

        $(this).on("change", function() {

          var thisIndex = index;

          $(".jumlah_wisatawan").each(function(i) {
            if (i !== thisIndex) {
              $(".jumlah_wisatawan")[i].value = "";
              $(".jumlah_wisatawan").closest('form').find('.datepicker')[i]
                  .value = "";
              $(".jumlah_wisatawan").closest('form').find('.select_sesi')[i]
                  .value = "";
            }
          })

          $(".jumlah_wisatawan").closest('form').find('.datepicker').prop('disabled', true)
          $(this).closest('form').find('.datepicker')[0].value = "";
          $(".jumlah_wisatawan").closest('form').find('.select_sesi').prop('disabled', true)
          $(this).closest('form').find('.select_sesi')[0].value = "";

          var rombonganku = $(this).val();
          var token = $("input[name=_token]").val();

          // alert(token);
          //cari datepicker yang terkait jml wisatawan yg di keyup
          var datepicker = $(this).closest('form').find('.datepicker')[0];

          $.ajax({
              type: 'post',
              url: '{{ url('ajax/cek_tanggal') }}',
              data: 'rombonganku=' + rombonganku + '&_token=' + token,
              async: false,
              dataType: 'json',
              //   enctype: 'multipart/form-data',
              cache: false,
              success: function(hasil) {
                  console.log('selesai checking tanggal...')
                  console.log(hasil)
                  disabled = hasil;
                  console.log(datepicker)
                  $(datepicker).prop("disabled", false);
                  if (disabled.length > 0) {
                      bindDatePicker(datepicker);
                  }
              }
          })
        });
      })

      $(".datepicker").each(function() {
        $(this).on("change", function() {

          $(".datepicker").closest('form').find('.select_sesi').prop('disabled', true)

            var tanggal = $(this).val();
            var jumlah = $(this).closest('form').find('.jumlah_wisatawan')[0].value;
            var token = $("input[name=_token]").val();
            var id_paket = $(this).attr('paket_id');

            //cari select sesi yg terkait gn datepicker yg dikeyup
            var select_sesi = $(this).closest('form').find('.select_sesi')[0];

            // console.log(select_sesi);

            $.ajax({
              type: 'post',
              url: '{{ url('ajax/cek_sesi') }}',
              data: 'tanggal=' + tanggal + '&jumlah=' + jumlah + '&_token=' +token + '&id_paket=' + id_paket,
              success: function(hasil) {
                var sesis = $.parseJSON(hasil);
                console.log(hasil); {
                var isi = "<option value=''>Pilih Sesi Kunjungan</option>";
                $.each(sesis, function(index, value) {
                  if (value['status_ketersediaan'] =="penuh") {
                    isi += "<option value='"+value['id_sesi']+"' disabled='disabled' style='color: red;font-style: italic;'>" + value["nama_sesi"] + "</option>";
                  } else {
                    isi += "<option value='" + value['id_sesi'] + "'>" + value["nama_sesi"] + "</option>";
                  }
                });
                $(".select_sesi").html(isi);
                // $("select[name=sesi]").html(isi);
                $(select_sesi).prop('disabled', false);
                }
              }
            })
        })
      })

      var max_wisatawan = "{{ pengaturan('kuota_mak_sesi') }}"
      console.log('maks wisatawan', max_wisatawan)
      
      $(".jumlah_wisatawan").on('change keyup', function() {
        var jumlah_wisatawan = parseInt($(this).val());

        //mengatur maksimal wisatawan per sesi
        if (jumlah_wisatawan > max_wisatawan) {
            alert('Jumlah maksimum wisatawan per sesi hanya '+ max_wisatawan+ ' orang.' );
            $(this).val(max_wisatawan);
            jumlah_wisatawan = max_wisatawan;
        }
      })
    })
  </script>
@endpush