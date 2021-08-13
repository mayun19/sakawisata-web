
<style>
    body {
        font-family:'Assistant', Tahoma, Geneva, Verdana, sans-serif;
    }
    table tr th,
    table tr td {
        padding: 10px 20px;

    }
    .no {
        text-align: center;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Tamu - Kunjungan {{$bukutamu[0]->kode_kunjungan}}</title>
    <link rel="icon" href="{{ asset('img/sakawisata_logo.svg') }}" type="image/svg"/>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}"/>
</head>
<body>

    <div class="header">
        <h2 style="text-align: center; font-family: Assistant, sans-serif; font-weight: 600; line-height: 1.33;">Buku Tamu SAKAWISATA</h2>
        
    </div>

    <div class="informasi mt-3">
      <div class="container">
        <div class="row">
          <div class="col">
            <table style="width: 100%">
              <tr>
                <td width="150">ID Kunjungan</td>
                <td width="20">:</td>
                <td >{{ $bukutamu[0]->kode_kunjungan }}</td>
              </tr>
              <tr>
                <td width="150">Pemesan</td>
                <td width="20">:</td>
                <td >{{ $pemesanan->nama_member }} - {{ $pemesanan->asal_instansi_pemesanan }}</td>
              </tr>
              <tr>
                <td width="150">Nama Paket</td>
                <td width="20">:</td>
                <td >{{ $pemesanan->nama_paket }}</td>
              </tr>
            </table>
          </div>
          <div class="col">
            <table style="width: 100%">
              <tr>
                <td width="150">Tanggal Kunjungan</td>
                <td width="20">:</td>
                <td >{{  date('d M Y', strtotime($pemesanan->tgl_kunjungan) )}}</td>
              </tr>
              <tr>
                <td width="150">Waktu</td>
                <td width="20">:</td>
                <td >{{ $pemesanan->nama_member }} - {{ $pemesanan->asal_instansi_pemesanan }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <div class="content-tamu">
      <div class="container">
        <table style="width: 100%; border-collapse: collapse" border="1">
          <thead>
              <tr>
                  <th width="50">No.</th>
                  <th>Nama Tamu</th>
                  <th>Kesan Pesan</th>
              </tr>
          </thead>
          <tbody>
              @foreach  ($bukutamu as $item)
              <tr>
                  <td class="no">{{$loop->iteration}}</td>
                  <td>{{$item->nama_tamu}}</td>
                  <td>{{$item->pesan_tamu}}</td>
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