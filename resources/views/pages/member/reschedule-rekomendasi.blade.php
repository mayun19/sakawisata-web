@extends('layouts.member-alternate')
@section('title', ' Rekomendasi Reschedule')

@section('content')
<div class="section-tiket  mt-4 mb-3">
  <div class="container d-flex justify-content-center">
    <div class="col-lg-6">
      <div class="card reschedule mb-2">
        <div class="card-body" id="tambah">
          <div class="row">
            <div class="col-10  member-heading">
              <h3 class="member-title">Reschedule Kunjungan</h3>
              <hr class="member-line mt-0">
              <p class="member-subtitle">
                Maaf, tanggal reschedule kamu <strong>tidak tersedia</strong> .  <br> Kami memberikan rekomendasi opsi jadwal kunjungan yang bisa kamu pilih dibawah ini :
              </p>
            </div>
          </div>
          <form action="{{ url('member/konfirmasi_rekomendasi/'.$id_reschedule) }}" method="post">
            @csrf
            <div class="row list-jadwal justify-content-center mt-2">
              <div class="col-12 col-lg-10 ">
                <h4 class="content-title">Pilih Jadwal Kunjungan</h4>
                <table class="table table-borderless" style="width: 100%">
                  @foreach ($rekomendasi as $item)         
                  <tr class="form-check mt-0">
                    <td scope="row">
                      <input class="form-check-input" type="radio" name="id_rekomendasi_jadwal" value="{{ $item->id_rekomendasi_jadwal }}" id="defaultCheck-{{ $loop->iteration }}">
                    </td>
                    <label class="form-check-label" for="defaultCheck-{{ $loop->iteration }}">
                      <td scope="row">
                        <?php echo date("d F Y", strtotime($item->tanggal_rekomendasi)) ?>
                      </td>
                      <td scope="row">{{ $item->nama_sesi }}</td>
                    </label>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-9 col-md-5 col-lg-8 col-xl-7 text-right">
                <button type="submit" class="btn btn-tambah px-3">Pilih Jadwal</button>
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
    $(document).ready(function(){
      $("form-check-input").on("change", function() {
      var input = $(this).val();

      if (input == ""){
        $("button").prop('disabled', true);
      }else{
        $("button").prop('disabled', false);
      }
      })
    })
  </script>
@endpush