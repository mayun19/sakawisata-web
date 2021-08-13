@extends('layouts.member-alternate')
@section('title', 'Reschedule')

@section('content')
<div class="section-tiket  mt-4 mb-3">
  <div class="container d-flex justify-content-center">
    <div class="col-lg-6">
      <div class="card reschedule mb-2">
        <div class="card-body" id="tambah">
          <div class="row d-flex justify-content-center">
            <div class="col-8 member-heading">
              <h3 class="member-title">Reschedule Kunjungan</h3>
              <hr class="member-line mt-0">
            </div>
            @if (session('gagal'))
              <div class="alert alert-danger">
                {{ session('gagal') }}
              </div>    
            @endif
          </div>
          <form action="{{ url('member/proses_reschedule/'.$pemesanan->id_pemesanan) }}" method="post">
            @csrf
            <div class="row justify-content-center mt-4">
              <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id_pemesanan }}">
              <input type="hidden" name="jumlah_wisatawan" value="{{ $pemesanan->jumlah_wisatawan }}">
              <div class="col-8">
                <div class="form-group">
                  <label for="tanggal_reschedule">Ajukan Tanggal Kunjungan</label>
                    <input type="date" min="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+ 3 days')) }}" class="form-control col-12 " name="tanggal_reschedule" id="tanggal_reschedule">
                </div>
              </div>
              <div class="col-8">
                <div class="form-group">
                  <label for="sesi_reschedule">Waktu Kunjungan</label>
                    <select  class="form-control col-12" name="sesi_reschedule" id="sesi_reschedule">
                      <option>Pilih Waktu Kunjungan</option>
                      {{-- @foreach ($paket_sesi as $sesi)
                      <option value="{{$sesi->id_sesi}}">{{$sesi->nama_sesi}}</option>
                      @endforeach --}}
                    </select>  
                </div>
              </div>
            </div>
            <div class="row btn-ajukan">
              <div class="col-10 text-right">
                <button type="submit" class="btn btn-tambah px-3" disabled>Ajukan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="notes mt-5 mb-2">
        <p>**Pengajuan Reschedule maksimal H-3 kunjungan dan hanya dilakukan satu kali pengajuan.</p>
      </div>   
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script>
    $(document).ready(function() {
      $("#tanggal_reschedule").on("change", function() {
        var tanggal = $(this).val();
        var jumlah = $("input[name=jumlah_wisatawan]").val();
        var token = $("input[name=_token]").val();
        var id_paket = '{{ $id_paket }}';
        
        $.ajax({
          type: "POST",
          url: "{{url('ajax/cek_sesi')}}",
          data: 'tanggal=' + tanggal + '&jumlah=' + jumlah + '&_token=' + token + '&id_paket=' + id_paket,
          success:function(hasil){
            // console.log(hasil);
            var sesis = $.parseJSON(hasil);
            console.log(sesis);

            var isi = "<option value=''>Pilih Waktu Kunjungan</option>";
            $.each(sesis, function (index, value) {
              if (value['status_ketersediaan'] == "penuh") {
              isi += "<option value='" + value['id_sesi'] + "' disabled='disabled' style='color: red; font-size: 13px; font-style: italic;'>" + value["nama_sesi"] + "</option>";
              } else {
              isi += "<option value='" + value['id_sesi'] + "'>" + value["nama_sesi"] + "</option>";
              }
            });
            console.log(isi)
            $("#sesi_reschedule").html(isi);
          }
        })
      })

      $("#sesi_reschedule").on("change", function() {
        var sesi = $(this).val();

        if (sesi == ""){
          $("button").prop('disabled', true);
        }else{
          $("button").prop('disabled', false);
        }
      })
    })
  </script>
@endpush