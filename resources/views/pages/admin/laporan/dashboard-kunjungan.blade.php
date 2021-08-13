@extends('layouts.admin')

@section('title', 'Kunjungan')

@section('konten')
 @php
  $status = request()->get('status');
  $tipe = request()->get('tipe');
  $tanggal_mulai = request()->get('tanggal_mulai');
  $tanggal_selesai = request()->get('tanggal_selesai');
  $bulan = request()->get('bulan');
  $tahun = request()->get('tahun');

  $url_parameter = "?status=$status&?tipe=$tipe&tanggal_mulai=$tanggal_mulai&tanggal_selesai=$tanggal_selesai&bulan=$bulan&tahun=$tahun";
 @endphp
<div class="dashboard-heading">
  <h2 class="dashboard-title">Laporan Kunjungan</h2>  
  <p class="dashboard-subtitle">
  </p>
</div>
<div class="dashboard-content">
  <div class="row">
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <div class="dashboard-card-title">Jumlah Kunjungan</div>
          <div class="dashboard-card-subtitle">{{ $tot_kunjungan }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <div class="dashboard-card-title">Jumlah Kunjungan Batal</div>
          <div class="dashboard-card-subtitle">{{ $tot_kunjungan_batal }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <div class="dashboard-card-title">Jumlah Wisatawan</div>
          <div class="dashboard-card-subtitle">{{ $tot_wisatawan }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <div class="dashboard-card-title">Jumlah Wisatawan Batal</div>
          <div class="dashboard-card-subtitle">{{ $tot_wisatawan_batal }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12 col-md-8 col-xl-5 mb-3">
      <div class="section-filter">
        <form action="" method="GET">
          <div class="d-flex justify-content-around">
            <div class="custom-control custom-radio">
              <input type="radio" name="tipe" id="semua" value="semua" @if (request()->get('tipe') == 'semua'|| empty(request()->get('tipe'))) checked="checked"
              @endif class="custom-control-input">
              <label class="custom-control-label text-dark mr-2" for="semua">Semua</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="mingguan" type="radio" name="tipe" value="mingguan" class="custom-control-input" 
              @if( request()->get('tipe') == 'mingguan' ) checked="checked" @endif>
              <label class="custom-control-label text-dark mr-2" for="mingguan">Custom</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="bulanan" type="radio" name="tipe" value="bulanan" class="custom-control-input"  @if( request()->get('tipe') == 'bulanan' ) checked="checked" @endif>
              <label class="custom-control-label text-dark mr-2" for="bulanan">Bulanan</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="tahunan" type="radio" name="tipe" value="tahunan" class="custom-control-input"  @if( request()->get('tipe') == 'tahunan' ) checked="checked" @endif>
              <label class="custom-control-label text-dark mr-2" for="tahunan">Tahunan</label>
            </div>
          </div>
          <hr>

          {{-- form filter --}}
          <div class="form-group row form-status">
            <div class="col-md-12 col-lg-10" id="input-status">
              <label for="bulan">Status Pemesanan</label>
                <select id="status" class="form-control" name="status">
                  {{-- <option selected>Pilih Status Pemesanan</option> --}}
                  <option value="semua" @if (request()->get('status') == 'semua') selected @endif>Semua</option>
                  <option value="selesai" @if (request()->get('status') == 'selesai') selected @endif>Selesai</option>
                  <option value="batal" @if (request()->get('status') == 'batal') selected @endif>Batal</option>
                </select>
            </div>
          </div>
          <div id="form-mingguan">
            <div class="form-group row">
              <div class="col-md-6 col-lg-6">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control tanggal-picker" value="{{ request()->get('tanggal_mulai') }}">
              </div>
              <div class="col-md-6 col-lg-6">
                <label for="tanggal_selesai">Tanggal Mulai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control tanggal-picker" value="{{ request()->get('tanggal_selesai') }}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12 col-lg-12" id="input-bulan">
              <label for="bulan">Bulan</label>
              <input type="text" class="bulanan form-control" name="bulan" id="bulan" value="{{ request()->get('bulan') }}">
            </div>
            <div class="col-md-12 col-lg-12" id="input-tahun">
              <label for="tahun">Tahun</label>
              <input type="text" class="date-own form-control" name="tahun" id="tahun" value="{{ request()->get('tahun') }}">
            </div>
          </div>

          <div class="row btn-ajukan">
            <div class="col-md-12 text-right">
              <button type="submit" class="btn btn-sm btn-success px-3">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12 col-lg-11 mt-2">
      <div class="card mb-3">
        <div class="card-body">
          @if (empty($tipe) || $tipe=='semua')
          <h5>Kunjungan Terbaru</h5>
          @elseif($tipe== 'mingguan')
          <h5>Kunjungan {{ date('d M Y', strtotime($tanggal_mulai)) }} s/d {{ date('d M Y', strtotime($tanggal_selesai)) }}</h5>
          @elseif($tipe== 'bulanan')
          <h5>Kunjungan Bulan {{ $bulan}}</h5>
          @elseif($tipe== 'tahunan')
          <h5>Kunjungan Tahun {{ $tahun}}</h5>
          @endif
          <div class="table-responsive-xl">
            <table class="table">
              <thead class="thead-dark">
                <tr class="">
                  <th scope="col">No</th>
                  <th scope="col">ID Kunjungan</th>
                  <th scope="col">Nama Pemesan</th>
                  <th scope="col" id="aksi">Tanggal Kunjungan</th>
                  <th scope="col">Paket Kunjungan</th>
                  <th scope="col" id="aksi">Jumlah Wisatawan</th>
                  <th scope="col" id="aksi">Status Pemesanan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kunjungan as $key => $item )
                  <tr>
                    <td scope="row">{{ $key+1 }}</td>
                    <td>{{ $item->kode_kunjungan }}</td>
                    <td>{{ $item->nama_member }}</td>
                    <td id="aksi">{{ date('d M Y', strtotime  ($item->tgl_kunjungan))}} <br> {{ $item->waktu_kunjungan_paket }}</td>
                    <td>{{ $item->nama_paket }}</td>
                    <td id="aksi">{{ ($item->jumlah_wisatawan) }}</td>
                    <td id="aksi">{{ ($item->status_pemesanan) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <hr />
            {!! $kunjungan->links() !!}
          </div>
            <a target="_blank" href="{{ url('admin/laporan/kunjungan/cetak' . $url_parameter)  }}" class="btn btn-success">
              <i class="fa fa-print"></i> Cetak
            </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <style>
    .ui-datepicker-calendar {
    display: none !important;
    }
  </style>
@endpush

@push('addon-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<script>
  var dp = $('.bulanan').datepicker({
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
    //  minViewMode: 2,
    //  format: 'yyyy'
  });

  dp.on('changeMonth', function (e) {    
   //do something here
   alert("Month changed");
});

      $('.date-own').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });

  function cek_tipe(tipe) {
    if (tipe == 'semua' || !tipe) {
      // if (window.location.search != ""){
      //   window.location.href = window.location.pathname;
      // }
      $("#tanggal_mulai").prop('required', false);
      $("#tanggal_selesai").prop('required', false);
      $("#form-status").hide();
      $("#form-mingguan").hide();
      $("#input-bulan").hide();
      $("#input-tahun").hide();
      $("button[type=submit]").show();
    } else if (tipe == 'mingguan') {
      $("#tanggal_mulai").prop('required', true);
      $("#tanggal_selesai").prop('required', true);
      $("#form-mingguan").show();
      $("#input-bulan").hide();
      $("#input-tahun").hide();
      $("button[type=submit]").show();
    } else if (tipe == 'bulanan') {
      $("#tanggal_mulai").prop('required', false);
      $("#tanggal_selesai").prop('required', false);
      $("#form-mingguan").hide();
      $("#input-bulan").show();
      $("#input-tahun").hide();
      $("button[type=submit]").show();
    } else if (tipe == 'tahunan') {
      $("#tanggal_mulai").prop('required', false);
      $("#tanggal_selesai").prop('required', false);
      $("#form-mingguan").hide();
      $("#input-bulan").hide();
      $("#input-tahun").show();
      $("button[type=submit]").show();
    }
  }

  var tipe = "{{request()->get('tipe')}}";
  cek_tipe(tipe);

  $("input[type=radio]").on('change click', function(){
    var tipe = $(this).val();
    cek_tipe(tipe);

  })

  
</script>
    
@endpush