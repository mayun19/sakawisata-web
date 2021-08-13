{{-- @extends('theme') --}}
@extends('layouts.app')

@section('title', 'Form Pemesanan')

@section('konten')
    <main>
      <!-- Header -->
      <section class="section-header text-center">
      </section>
      
      <section class="section-form-pesan">
        <div class="container">
          <div class="row">
            <div class="col-10 p-0">
              <nav>
                <ol class="breadcrumb"> 
                  <li class="breadcrumb-item">Jelajah</li>
                  <li class="breadcrumb-item"><a href="{{ url('/paket') }}">Paket Jelajah</a></li>
                  <li class="breadcrumb-item active">Form Pemesanan</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-9 pl-lg-0">
              <div class="card card-situs">
                <div class="pesan-heading text-center">
                  <h1>Form Pemesanan Kunjungan </h1>
                  <hr>
                </div>
                <div class="form-content mx-auto my-5">
                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif
                  <form action="{{url('paket/proses_pesan/' . $paket->id_paket)}}" method="POST">
                  @csrf
                    <div class="form-group row">
                      <label for="inputNama" class="col-sm-4 col-form-label">Nama Lengkap Pemesan</label>
                      <div class="col-sm-6">
                        <input type="text"  readonly class="form-control-plaintext" id="inputNama" placeholder="Calista Wijaya"  value="{{$member->nama_member}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputTelp" class="col-sm-4 col-form-label">No. Telepon</label>
                      <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="inputTelp" placeholder="081329295503" value="{{$member->telp_member}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                      <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="inputEmail" placeholder="wijaya.cali@gmail.com" value="{{$member->email_member}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputInstansi" class="col-sm-4 col-form-label">Asal Instansi *</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputInstansi" placeholder="Asal Instansi Pemesan" name="asal_instansi_pemesanan">
                      </div>
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="checkTL">
                      <label class="form-check-label" for="checkTL">Pemesanan dilakukan oleh TL (Tour Leader)</label>
                    </div>
                    <div class="form-group row" style="display: none;" id="TL">
                      <label for="inputTl" class="col-sm-4 col-form-label">Nama/Instansi TL</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="" id="inputTl" placeholder="Nama/Instansi TL" name="nama_tl_pemesanan">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tanggal-kunjungan" class="col-sm-4 col-form-label">Tanggal Kunjungan</label>
                      <div class="col-sm-6">
                        <input type="text" class="datepicker form-control" placeholder="Pilih Tanggal Kunjungan" name="tgl_kunjungan" id="tanggal-kunjungan" value="{{request()->query('tgl_kunjungan')}}">
                      </div>
                    </div>
                    <div class="form-group row form-time">
                      <label for="inputWaktu" class="col-sm-4 col-form-label">Waktu Kunjungan</label>
                      <div class="input-group col-sm-6">
                        <select id="inputWaktu" class="form-control" name="waktu_kunjungan_pemesanan">
                          {{-- <option>Pilih Waktu Kunjungan</option> --}}
                          @foreach ($paket->sesi as $sesi)
                          <option
                            @if ( request()->query('waktu_kunjungan_pemesanan') == $sesi->id_sesi )
                            selected
                            @endif
                           value="{{$sesi->id_sesi}}">{{$sesi->nama_sesi}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPaket" class="col-sm-4 col-form-label">Paket Kunjungan</label>
                      <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext"  id="inputPaket" value="{{$paket->nama_paket}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputWisatawan" class="col-sm-4 col-form-label">Jumlah Wisatawan</label>
                      <div class="col-sm-6">
                        <input type="number" min="1" max="60" class="form-control" id="inputWisatawan" placeholder="Masukkan Jumlah Wisatawan" name="jumlah_wisatawan" value="{{ request()->query('jumlah_wisatawan') }}">
                      </div>
                    </div>
                    <input type="hidden" id="kapasitas_max_paket" value="{{ $paket->kapasitas_max_paket }}">
                    <div class="form-group row">
                      <label for="inputJmlPaket" class="col-sm-4 col-form-label">Jumlah Paket</label>
                      <div class="col-sm-6">
                        <input type="number" min="1" class="form-control" readonly id="inputJmlPaket" value="1"  name="jumlah_paket">
                      </div>
                    </div>
                    <input type="hidden" placeholder="harga_paket" id="harga_paket" value="{{$paket->harga_paket}}">
                    <div class="form-group row">
                      <label for="inputBiayaPemesanan" class="col-sm-4 col-form-label">Biaya Pemesanan</label>
                      <div class="col-sm-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                    				<span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" min="1" class="form-control uang" readonly id="inputBiayaPemesanan" name="biaya_pemesanan" value="{{$paket->harga_paket}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputJmlTambahan" class="col-sm-4 col-form-label">Jumlah Wisatawan Tambahan</label>
                      <div class="col-sm-6">
                        <input type="number" readonly class="form-control" id="inputJmlTambahan" value="0" name="jumlah_wisatawan_tambahan">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputBiayaTambahan" class="col-sm-4 col-form-label">Biaya Tambahan</label>
                      <div class="col-sm-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="number" class="form-control uang" readonly id="inputBiayaTambahan" value="0" name="biaya_tambahan">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputTotBayar" class="col-sm-4 col-form-label">Total Bayar</label>
                      <div class="col-sm-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" readonly class="form-control uang" id="inputTotBayar"  name="total_pemesanan" value="{{$paket->harga_paket}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputKet" class="col-sm-4 col-form-label">Catatan</label>
                      <div class="col-sm-6">
                        <textarea class="form-control" id="inputKet" rows="5" name="keterangan_pemesanan" placeholder="Tulis catatan pemesanan Anda.."></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-10 d-flex justify-content-end">
                        <button type="submit" class="btn btn-pesan px-3 mt-2">Pesan Kunjungan</button>
                      </div>
                    </div>
                    <div class="note-pesan">
                      <div class="col-sm-11 row">
                        <h5>Ketentuan</h5>
                        <p>
                          Biaya wisatawan tambahan per pax yaitu 5% dari harga paketnya <br>
                          * wajib diisi
                        </p>
                      </div>
                    </div>
                  </form>
                
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
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
      var sesi_terpilih ="{{ request()->query('sesi') }}";

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
            },success:function(hasil){
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

        $(".datepicker").on("change", function() {
          var tanggal = $(this).val();
          var jumlah = $("input[name=jumlah_wisatawan]").val();
          var token= $("input[name=_token]").val();
          var id_paket = '{{ $paket->id_paket }}';

          $("#inputWaktu").prop("disabled", true);

          $.ajax({
            type:'post',
            url:'{{url('ajax/cek_sesi')}}',
            data:'&tanggal='+tanggal+'&jumlah='+jumlah+'&_token='+token+'&id_paket='+id_paket,
            success:function(hasil){
              console.log(hasil);{
                var sesis = $.parseJSON(hasil);

                var isi = "<option value=''>Pilih Sesi Kunjungan</option>";
                $.each(sesis, function(index, value){
                  if(value['status_ketersediaan']=="penuh"){
                    isi+= "<option value='"+value['id_sesi']+"' disabled='disabled' style='color: red; font-size: 13px; font-style: italic;'>"+value["nama_sesi"]+"</option>";
                  }else{
                    if (value['id_sesi'] == sesi_terpilih) {
                      isi+= "<option selected value='"+value['id_sesi']+"'>"+value["nama_sesi"]+"</option>";
                    }else{
                      isi+= "<option value='"+value['id_sesi']+"'>"+value["nama_sesi"]+"</option>";
                    }
                  }
                });
                $("select[name=waktu_kunjungan_pemesanan]").html(isi);
                $("#inputWaktu").prop("disabled", false);
              }
            }
          })
          
        })
        // function cek_sesi() {
        //   var tanggal = $(".datepicker").val();
        //   var jumlah = $("input[name=jumlah_wisatawan]").val();
        //   var token= $("input[name=_token]").val();
        //   var id_paket = '{{ $paket->id_paket }}';

        //   $.ajax({
        //     type:'post',
        //     url:'{{url('ajax/cek_sesi')}}',
        //     data:'&tanggal='+tanggal+'&jumlah='+jumlah+'&_token='+token+'&id_paket='+id_paket,
        //     success:function(hasil){
        //       console.log(hasil);{
        //         var sesis = $.parseJSON(hasil);

        //         var isi = "<option value=''>Pilih Sesi Kunjungan</option>";
        //         $.each(sesis, function(index, value){
        //           if(value['status_ketersediaan']=="penuh"){
        //             isi+= "<option value='"+value['id_sesi']+"' disabled='disabled' style='color: red; font-size: 13px; font-style: italic;'>"+value["nama_sesi"]+"</option>";
        //           }else{
        //             if (value['id_sesi'] == sesi_terpilih) {
        //               isi+= "<option selected value='"+value['id_sesi']+"'>"+value["nama_sesi"]+"</option>";
        //             }else{
        //               isi+= "<option value='"+value['id_sesi']+"'>"+value["nama_sesi"]+"</option>";
        //             }
        //           }
        //         });
        //         $("select[name=waktu_kunjungan_pemesanan]").html(isi);
        //       }
        //     }
        //   })
        // }

        // cek_sesi();

        // $(".datepicker").on("change",cek_sesi)
      })
    </script>
    <script type="text/javascript">
      var max_paket = "{{ $paket->kapasitas_max_paket }}"
      var max_wisatawan = "{{ pengaturan('kuota_mak_sesi') }}"
      var tambahan = (1/ max_paket);

      $(function() {
        // ketika input checkout id="checkTL" di klik
        $("#checkTL").on('click', function(){

          if ($(this).is(":checked"))
          {
            console.log('nyala');
            // kalau inputan ini di ceklis, munculkan input nama TL
            $("#TL").show(200);
            
          } else {
            console.log('mati');
            $("#TL").hide(200);
          }
        }) 


        function kalkulasiBiayaPemesanan() {
          var jumlah_wisatawan = parseInt($("#inputWisatawan").val());
          var per_paket = parseInt($("#kapasitas_max_paket").val());
          var jumlah_paket = 1;
          var sisa = 0;

          console.log('jml wis', jumlah_wisatawan)
          console.log('perpaket', per_paket)
          console.log('maks paket', max_paket)
          console.log('maks wisatawan', max_wisatawan)
          console.log('tambahan wisatawan', tambahan)

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

          //jika jumlah wisatawan dibawah jumlah per pakaet
          if (jumlah_wisatawan <= per_paket) {
            jumlah_paket = 1;
            sisa = 0;
          }else{
            //sebaliknya
            sisa = jumlah_wisatawan % per_paket;
            jumlah_paket = Math.floor(jumlah_wisatawan / per_paket);
          }

          console.log('sisa', sisa)
          console.log('jml paket', jumlah_paket)

          var harga_paket = $("#harga_paket").val();
          var biaya_pemesanan = jumlah_paket * harga_paket;

          var biaya_tambahan = (tambahan * harga_paket) * sisa;

          var total_bayar = biaya_pemesanan + biaya_tambahan;

          console.log('tambahan', biaya_tambahan);

          //update inputan
          $("#inputJmlPaket").val(jumlah_paket);
          $("#inputJmlTambahan").val(sisa);

          $("#inputBiayaPemesanan").val(biaya_pemesanan); 
          $("#inputBiayaTambahan").val(biaya_tambahan); 
          $("#inputTotBayar").val( total_bayar); 
        }
        
        kalkulasiBiayaPemesanan();
        $("#inputWisatawan").on('change keyup', kalkulasiBiayaPemesanan) ;
        $("#tanggal-kunjungan").on('change keyup', kalkulasiBiayaPemesanan);
        $("#inputWaktu").on('change', kalkulasiBiayaPemesanan);
        
        $("input[name=jumlah_wisatawan]").on('change keyup', function() {
          console.log('jumlah wisatatan diubah', $(this).val())
          // $("#inputBiayaPemesanan").val(biaya_pemesanan); 
          $("input[name=biaya_pemesanan]").trigger('input');
          $("input[name=biaya_tambahan]").trigger('input');
          $("input[name=total_pemesanan]").trigger('input');
        })
      });
    </script>
@endpush