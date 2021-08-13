<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>SAKAWISATA - Transaksi </title>

    <link rel="icon" href="{{ asset('img/sakawisata_logo.svg') }}" type="image/svg"/>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}"/>

  </head>

  <style>
    body {
        font-family:'Assistant', Tahoma, Geneva, Verdana, sans-serif;
    }

    .table thead th {
    vertical-align: top;
}
  </style>
  <body>
    <div class="header mt-2">
      <h2 style="text-align: center; font-family: Assistant, sans-serif; font-weight: 600; line-height: 1.33;">Laporan Transaksi SAKAWISATA</h2>
    </div>

    <div class="informasi mt-4">
      <div class="container">
        <div class="row">
          <div class="col">
            <table style="width: 100%">
              <tr>
                <td width="150">Jenis Laporan</td>
                <td width="20">:</td>
                @if(empty($tipe) || $tipe=='semua')
                  <td>Semua Transaksi</td>
                @elseif($tipe=='mingguan')
                  <td>Transaksi {{$tanggal_mulai}} s/d {{$tanggal_selesai}} </td>
                @elseif($tipe=='bulanan')
                  <td>Transaksi Bulan {{$bulan}}</td>
                @elseif($tipe=='tahunan')
                  <td>Transaksi Tahun {{$tahun}}</td>
                @endif
              </tr>
              <tr>
                <td width="150">Paket Favorit</td>
                <td width="20">:</td>
                <td >{{$paket_favorit}}</td>
              </tr>
            </table>
          </div>
          <div class="col">
            <table style="width: 100%">
              <tr>
                <td width="150">Jumlah Transaksi</td>
                <td width="20">:</td>
                <td>{{ $tot_transaksi }} &nbsp; transaksi</td>
              </tr>
              <tr>
                <td width="150">Total Pendapatan</td>
                <td width="20">:</td>
                <td >Rp &nbsp; {{number_format($total_pendapatan)}} </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <div class="content-tamu">
      <div class="container table-responsive">
        <table class="table table-bordered mt-3" style="width: 100%; border-collapse: collapse;" border="1">
          <thead>
              <tr>
                  <th width="50">No.</th>
                  <th  width="50" scope="col">ID Kunjungan</th>
                  <th scope="col">Nama Pemesan</th>
                  <th scope="col">Tanggal Pesan</th>
                  <th scope="col">Tanggal Kunjungan</th>
                  <th scope="col">Sesi Kunjungan</th>
                  <th scope="col">Paket Kunjungan</th>
                  <th scope="col" width="120">Total Bayar</th>
              </tr>
          </thead>
          <tbody>
              @foreach  ($transaksi as $key => $item)
              <tr>
                  <td class="no">{{ $key+1 }}</td>
                  <td>{{$item->kode_pemesanan}}</td>
                  <td>{{$item->nama_member}}</td>
                  <td>{{date('d M Y', strtotime($item->tgl_pemesanan))}}</td>
                  <td>{{date('d M Y', strtotime($item->tgl_kunjungan))}}</td>
                  <td>{{ $item->waktu_kunjungan_paket }}</td>
                  <td>{{$item->nama_paket}}</td>
                  <td>Rp {{number_format($item->total_pemesanan)}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>


    <script>
      window.print();
    </script>
  </body>
</html>
