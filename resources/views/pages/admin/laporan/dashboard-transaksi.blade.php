@extends('layouts.admin')

@section('title', 'Transaksi')

@section('konten')
 @php
     $tipe = request()->get('tipe');
     $tanggal_mulai = request()->get('tanggal_mulai');
     $tanggal_selesai = request()->get('tanggal_selesai');
     $bulan = request()->get('bulan');
     $tahun = request()->get('tahun');

     $url_parameter = "?tipe=$tipe&tanggal_mulai=$tanggal_mulai&tanggal_selesai=$tanggal_selesai&bulan=$bulan&tahun=$tahun";
 @endphp
<div class="dashboard-heading">
  <h2 class="dashboard-title">Laporan Transaksi</h2>  
  <p class="dashboard-subtitle">
  </p>
</div>
<div class="dashboard-content">
  <div class="row">
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <div class="dashboard-card-title">Pendapatan</div>
          <div class="dashboard-card-subtitle">Rp {{number_format($total_pendapatan)}}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <div class="dashboard-card-title">Jumlah Transaksi</div>
          <div class="dashboard-card-subtitle">{{ $tot_transaksi }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-2">
        <div class="card-body">
          <div class="dashboard-card-title">Paket Favorit</div>
          <div class="dashboard-card-subtitle"><span style="font-size: 15px;">{{$paket_favorit}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12 col-md-8 col-xl-5 mb-3">
      <div class="section-filter">
        <form action="" method="GET">
          <div class="d-flex justify-ccontent-around">
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
          <div id="form-mingguan">
            <div class="form-group row">
              <div class="col-6 col-lg-6">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control tanggal-picker" value="{{ request()->get('tanggal_mulai') }}">
              </div>
              <div class="col-6 col-lg-6">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control tanggal-picker" value="{{ request()->get('tanggal_selesai') }}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 col-lg-12" id="input-bulan">
              <label for="bulan">Bulan dan Tahun</label>
              <input type="text" class="bulanan form-control" name="bulan" id="bulan">
            </div>
            <div class="col-12 col-lg-12" id="input-tahun">
              <label for="tahun">Tahun</label>
              <input type="text" class="date-own form-control" name="tahun" id="tahun">
              {{-- <input type="number" min="2010" max="{{date('Y')}}" class="form-control" name="tahun" id="tahun" value="{{date('Y')}}"> --}}
            </div>
          </div>

          <div class="row btn-ajukan">
            <div class="col-12 text-right">
              <button type="submit" class="btn btn-sm btn-success px-3">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-11 mt-2">
      <div class="card mb-3">
        <div class="card-body">
          @if (empty($tipe) || $tipe=='semua')
          <h5>Transaksi Terbaru</h5>
          @elseif($tipe== 'mingguan')
          <h5>Transaksi {{ date('d M Y', strtotime($tanggal_mulai)) }} s/d {{ date('d M Y', strtotime($tanggal_selesai)) }}</h5>
          @elseif($tipe== 'bulanan')
          <h5>Transaksi Bulan {{ $bulan}}</h5>
          @elseif($tipe== 'tahunan')
          <h5>Transaksi Tahun {{ $tahun}}</h5>
          @endif
          <div class="table-responsive-xl">
            <table class="table">
              <thead class="thead-dark">
                <tr class="">
                  <th scope="col">No</th>
                  <th scope="col">ID Kunjungan</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Tanggal Pesan</th>
                  <th scope="col">Tanggal Kunjungan</th>
                  <th scope="col">Paket Kunjungan</th>
                  <th scope="col" width="120">Total Bayar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaksi as $key => $item )
                <tr>
                  <th scope="row">{{ $key+1 }}</th>
                  <td>{{ $item->kode_kunjungan }}</td>
                  <td>{{ $item->nama_member }}</td>
                  <td>{{ $item->tgl_pemesanan }}</td>
                  <td>{{ date('d M Y', strtotime($item->tgl_kunjungan)) }} <br> {{ $item->waktu_kunjungan_paket }}</td>
                  <td>{{ $item->nama_paket }}</td>
                  <td>Rp {{ number_format($item->total_pemesanan) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <hr />
            {!! $transaksi->links() !!}
          </div>
            <a target="_blank" href="{{ url('admin/laporan/transaksi/cetak'. $url_parameter) }}" class="btn btn-success">
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
      if (window.location.search != ""){
        window.location.href = window.location.pathname;
      }
      $("#form-mingguan").hide();
      $("#input-bulan").hide();
      $("#input-tahun").hide();
      $("button[type=submit]").hide();
    } else if (tipe == 'mingguan') {
      $("#form-mingguan").show();
      $("#input-bulan").hide();
      $("#input-tahun").hide();
      $("button[type=submit]").show();
    } else if (tipe == 'bulanan') {
      $("#form-mingguan").hide();
      $("#input-bulan").show();
      $("#input-tahun").hide();
      $("button[type=submit]").show();
    } else if (tipe == 'tahunan') {
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