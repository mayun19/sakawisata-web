@extends('layouts.member')

@section('title', 'Konfirmasi Pembatalan')

@push('addon-style')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endpush

@section('konten')
  <div class="member">
    <div class="row container d-flex justify-content-center mb-4">
      <div class="col-12 col-lg-9 mb-3">
        @if (session('pesan'))
				<div class="alert alert-success">
					{{ session('pesan') }}
				</div>
        {{-- @else
          @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
          @endforeach --}}
				@endif
        <div class="card">
          <div class="card-body" id="tambah">
            <div class="member-content mt-5 mb-3">
              <div class="konfirmasi-bayar">
                <div class="row">
                  <div class="container d-flex justify-content-center">
                    <div class="col-md-5">
                      <img class="w-100" src="{{ asset('img/ic_batal.png') }}" alt="">
                    </div>
                    <div class="col-12 col-md-7">
                      <div class="member-heading">
                       <h3 class="member-title">Pembatalan Kunjungan</h3>
                       <hr class="member-line mt-0">
                      </div>
                      <div class="table-responsive pembatalan-content mt-2">
                        <table class="table table-borderless" style="width:100%">
                          <tr>
                            <td><b>Detail Pemesanan</b></td>
                          </tr>
                          <tr>
                            <td>Nama Pemesan</td>
                            <td style="text-align: right">{{$member->nama_member}}</td>
                          </tr>
                          <tr>
                            <td>ID Kunjungan</td>
                            <td style="text-align: right"><b>#{{ $pemesanan->kode_kunjungan }}</b></td>
                          </tr>
                          <tr>
                            <td>Tanggal Kunjungan</td>
                            <td style="text-align: right"><?php  echo date("d M Y", strtotime( $pemesanan->tgl_kunjungan))?></td>
                          </tr>
                          <tr>
                            <td>Sesi Kunjungan</td>
                            <td style="text-align: right">{{ $pemesanan->waktu_kunjungan_paket }}</td>
                          </tr>
                          <tr>
                            <td>Paket Kunjungan</td>
                            <td style="text-align: right">{{ $pemesanan->nama_paket }}</td>
                          </tr>
                          <tr>
                            <td>Jumlah Paket </td>
                            <td style="text-align: right">{{ $pemesanan->jumlah_paket }}&nbsp; Paket</td>
                          </tr>
                          <tr>
                            <td>Total Pembayaran </td>
                            <td style="text-align: right">Rp &nbsp; {{number_format( $pemesanan->total_pemesanan) }}</td>
                          </tr>
                        </table>
                        <hr>
                        <form action="{{ url('member/pembatalan/proses/'.$pemesanan->id_pemesanan) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="container">
                            <div class="row flex-column refund mt-2 mb-3">
                              <p>Informasi Refund</p>
                              <div class="form-group">
                                <label for="">Nama Bank Refund</label>
                                <select class="form-control select2" name="nama_bank_refund" style="color: #2e0a0c !important;">
                                  <option value="">-- Pilih Nama Bank --</option>
                                  <option value="BANK BRI">BANK BRI</option>
                                  <option value="BANK MANDIRI">BANK MANDIRI</option>
                                  <option value="BANK BNI">BANK BNI</option>
                                  <option value="BANK BCA">BANK BCA</option>
                                  <option value="BANK DANAMON">BANK DANAMON</option>
                                  <option value="PERMATA BANK">PERMATA BANK</option>
                                  <option value="BANK PANIN">BANK PANIN</option>
                                  <option value="CITIBANK N.A.">CITIBANK N.A.</option>
                                  <option value="BANK DBS INDONESIA">BANK DBS INDONESIA</option>
                                  <option value="BANK TABUNGAN PENSIUNAN NASIONAL">BANK TABUNGAN PENSIUNAN NASIONAL</option>
                                  <option value="BANK BUKOPIN">BANK BUKOPIN</option>
                                  <option value="BANK SYARIAH INDONESIA">BANK SYARIAH INDONESIA</option>
                                  <option value="BANK SYARIAH MEGA">BANK SYARIAH MEGA</option>
                                  <option value="LINKAJA">LINKAJA</option>
                                  <option value="RABOBANK INTERNASIONAL INDONESIA">RABOBANK INTERNASIONAL INDONESIA</option>
                                  <option value="BANK MAYAPADA">BANK MAYAPADA</option>
                                  <option value="BANK JABAR">BANK JABAR</option>
                                  <option value="BANK DKI">BANK DKI</option>
                                  <option value="BPD DIY">BPD DIY</option>
                                  <option value="BANK JATENG">BANK JATENG</option>
                                  <option value="BANK JATIM">BANK JATIM</option>
                                  <option value="BPD JAMBI">BPD JAMBI</option>
                                  <option value="BPD ACEH">BPD ACEH</option>
                                  <option value="BANK SUMUT">BANK SUMUT</option>
                                  <option value="BANK RIAU">BANK RIAU</option>
                                  <option value="bank-sumsel">BANK SUMSEL</option>
                                  <option value="BANK LAMPUNG">BANK LAMPUNG</option>
                                  <option value="BPD KALSEL">BPD KALSEL</option>
                                  <option value="BPD KALIMANTAN BARAT">BPD KALIMANTAN BARAT</option>
                                  <option value="BPD KALTIM">BPD KALTIM</option>
                                  <option value="BPD KALTENG">BPD KALTENG</option>
                                  <option value="BPD SULSEL">BPD SULSEL</option>
                                  <option value="BANK SULUT">BANK SULUT</option>
                                  <option value="BPD NTB">BPD NTB</option>
                                  <option value="BPD BALI">BPD BALI</option>
                                  <option value="BANK NTT">BANK NTT</option>
                                  <option value="BANK MALUKU">BANK MALUKU</option>
                                  <option value="BPD PAPUA">BPD PAPUA</option>
                                  <option value="BPD SULAWESI TENGAH">BPD SULAWESI TENGAH</option>
                                  <option value="lainnya">Bank Lainnya</option>
                                </select>
                                <input type="text" class="form-control" style="display: none;" name="nama_bank_lainnya"  placeholder="isikan nama bank">
                                <div class="text-info small ">Pilih <strong>"Bank Lainnya"</strong> bila nama bank mu tidak ada dalam pilihan</div>
                                <div class="col-sm-7">
                                  @error('nama_bank_refund')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                                {{-- <input type="text" class="form-control" style="display: none;" name="nama_bank_lainnya"  placeholder="isikan nama bank"> --}}
                              </div>
                              <div class="form-group">
                                <label for="">Nomor Rekening Refund</label>
                                <input type="text" name="no_rekening_refund" class="form-control" placeholder="isikan nomor rekening tujuan refund dana pembatalan">
                                @error('no_rekening_refund')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="">Nama Pemilik Rekening</label>
                                <input type="text" name="nama_pemilik_refund" class="form-control" placeholder="isikan mama pemilik rekening tujuan refund dana pembatalan">
                                @error('nama_pemilik_refund')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="">Alasan Pembatalan</label>
                                <textarea name="alasan_pembatalan" class="form-control" id="alasan_pembatalan" rows="5"></textarea>
                                @error('alasan_pembatalan')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="form-group col-12 text-right mb-3">
                                <button type="submit" class="btn btn-sm btn-danger ">Batalkan Kunjungan</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> --}}

  <script type="text/javascript">
   $(document).ready(function() {
     $('.select2').select2();

     $("select[name=nama_bank_refund]").on('change', function() {
       var bank_dipilih = $(this, "option:selected").val();
       if(bank_dipilih == 'lainnya') {
         $("input[name=nama_bank_lainnya]").show(200);
        } else {
         $("input[name=nama_bank_lainnya]").hide(200);
       }
    });
  });
  </script>
@endpush
