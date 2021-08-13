<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>SAKAWISATA - Tiket Kunjungan {{$pemesanan->kode_kunjungan}}</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}"/>

  </head>

  <style>
    body {
        font-family:'Assistant', Tahoma, Geneva, Verdana, sans-serif;
    }
  </style>
  <body>
    <div class="section-tiket mt-4 mb-3">
      <div class="container d-flex justify-content-center">
        <div class="col-lg-6 mt-2">
          <div class="card card-tiket mb-3">
            <div class="card-body" id="tambah">
              <h2 class="tiket text-center">E-Ticket Kampung Wisata Kauman</h2>
              <div class="ticket-heading mt-3">
                <div class="col">
                  <h5 class="member-name">Hi, {{ $pemesanan->nama_member }}</h5>
                  <p class="ticket-subtitle">
                    Tiket digital kamu sudah berhasil dicetak. <br>
                    Kunjungan ID <strong>#{{ $pemesanan->kode_kunjungan }}</strong>
                  </p>
                </div>
              </div>
              <div class="detail-paket mt-3">
                <div class="col">
                  <table style="width:100%">
                    <tr>
                      <td colspan="3">Detail Paket</td>
                    </tr>
                    <tr>
                      <td><strong>Paket Kunjungan</strong></td>
                      <td style="text-align: right">{{ $paket->nama_paket }}</td>
                    </tr>
                    <tr>
                      <td><strong>Jumlah Wisatawan</strong></td>
                      <td style="text-align: right">{{ $pemesanan->jumlah_wisatawan }}</td>
                    </tr>
                    <tr>
                      <td><strong>Jumlah Paket</strong></td>
                      <td style="text-align: right">{{ $pemesanan->jumlah_paket }} Paket</td>
                    </tr>
                    <tr>
                      <td><strong>Jumlah Tambahan</strong></td>
                      <td style="text-align: right">{{ $pemesanan->jumlah_wisatawan_tambahan }} Orang</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="detail-kunjungan mt-3 mb-3">
                <div class="col ">
                  <table style="width:100%">
                    <tr>
                      <td>Detail Kunjungan</td>
                    </tr>
                    <tr>
                      <td><strong>Tanggal</strong></td>
                      <td style="text-align: right">
                        <?php  echo date("d M Y", strtotime( $pemesanan->tgl_kunjungan))?>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Waktu</strong></td>
                      <td style="text-align: right">{{ $paket->waktu_kunjungan_paket }}</td>
                    </tr>
                    @foreach ($pemandu as $key => $pemandu)
                    <tr>
                      <td><strong>Pemandu {{ $key+1 }}</strong></td>
                      <td style="text-align: right"><a href="{{ url('$pemandu->link_wa_pemandu') }}">{{ $pemandu->nama_pemandu }}</a></td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
              <div class="row notes">
                <div class="col text-center">
                  <p class="notes text-center">
                    Harap datang ke lokasi kunjungan 30 menit <br> sebelum Jelajah di mulai
                  </p>
                </div>
              </div>
              <div class="contact mt-3 mb-3">
                <div class="col ">
                  <table style="width:100%">
                    <tr>
                      <td colspan="3">Butuh Bantuan?</td>
                    </tr>
                    <tr>
                      <td  width="50">
                        <img src="{{ asset('img/ic_support.png') }}" alt="">
                      </td>
                      <td>sakawisata@gmail.com 
                        <br> 
                        084424242424
                      </td>
                    </tr>
                  </table>
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        window.print();
    </script>
  </body>
</html>
