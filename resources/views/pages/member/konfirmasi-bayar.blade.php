@extends('layouts.member')

@section('title', 'Konfirmasi Pembayaran')

@push('addon-style')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endpush

@section('konten')
  <div class="member">
    <div class="row info-payment">
      <div class="col-11 col-lg-9 mt-4 mb-2">
        <div class="card">
          <div class="card-body">
            <div class="row d-flex justify-content-center">
              <div class="member-heading">
               <h4 class="member-title">Informasi Pembayaran #{{ $pemesanan->kode_pemesanan }}</h4>
               <hr class="member-line mt-0">
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6 table table-borderless">
                <table class="konfirmasi-bayar" style="width:100%">
                  <tr>
                    <td width="180">Nama Paket</td>
                    <td width="20">:</td>
                    <td class="text-right">{{ $paket->nama_paket }}</td>
                  </tr>
                  <tr>
                    <td width="180">Jumlah Wisatawan</td>
                    <td width="20">:</td>
                    <td class="text-right">{{ $pemesanan->jumlah_wisatawan }}</td>
                  </tr>
                  <tr>
                    <td width="180">Jumlah Paket</td>
                    <td width="20">:</td>
                    <td class="text-right">{{ $pemesanan->jumlah_paket }}</td>
                  </tr>
                  <tr>
                    <td width="180">Jumlah Tambahan</td>
                    <td width="20">:</td>
                    <td class="text-right">{{$pemesanan->jumlah_wisatawan_tambahan }}</td>
                  </tr>
                  <tr id="DP">
                    <td width="180">Minimal DP</td>
                    <td width="20">:</td>
                    <td class="text-right">Rp {{number_format(30/100 *($pemesanan->total_pemesanan)) }}</td>
                    <input type="hidden" id="minimal-dp" value="{{ (30/100 *($pemesanan->total_pemesanan)) }}">
                  </tr>
                </table>
              </div>
              <div class="col-12 col-lg-6 table table-borderless">
                <table class="konfirmasi-bayar" style="width:100%">
                  <tr>
                    <td width="180">Biaya Paket</td>
                    <td width="20">:</td>
                    <td class="text-right">Rp {{ number_format($pemesanan->biaya_pemesanan) }}</td>
                  </tr>
                  <tr>
                    <td width="180">Biaya Tambahan</td>
                    <td width="20">:</td>
                    <td class="text-right">Rp {{ number_format($pemesanan->biaya_tambahan) }}</td>
                  </tr>
                  <tr id="total_bayar">
                    <td width="180">Total Pembayaran</td>
                    <td width="20">:</td>
                    <td class="text-right">Rp {{ number_format($pemesanan->total_pemesanan) }}</td>
                  </tr>
                  <tr id="telah_bayar">
                    <td width="180">Telah Dibayar</td>
                    <td width="20">:</td>
                    <td class="text-right">Rp {{number_format($telah_dibayar->jumlah) }}</td>
                  </tr>
                  <tr id="perlu_bayar">
                    <td width="180">Perlu Dibayar</td>
                    <td width="20">:</td>
                    <td class="text-right">Rp {{number_format($pemesanan->total_pemesanan - $telah_dibayar->jumlah) }}</td>
                    <input type="hidden" id="minimal-lunas" value="{{ ($pemesanan->total_pemesanan - $telah_dibayar->jumlah) }}">
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row section-konfirmasi-bayar mb-4">
      <div class="col-11 col-lg-9 mb-3">
        @if (session('pesan'))
				  <div class="alert alert-success">
				  	{{ session('pesan') }}
				  </div>
				@endif
        <div class="card">
          <div class="card-body" id="tambah">
            <div class="row d-flex justify-content-center">
              <div class="member-heading">
               <h4 class="member-title">Konfirmasi Pembayaran</h4>
               <hr class="member-line mt-0">
              </div>
            </div>
            <div class="member-content mt-4 mb-3">
              <div class="konfirmasi-bayar">
                <form action="{{ url('member/simpan_pembayaran') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row justify-content-center">
                    <input type="hidden" class="form-control" name="id_pemesanan" value="{{ $pemesanan->id_pemesanan }}">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="kode_pembayaran">Booking ID</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="kode_pembayaran" value="{{ $pemesanan->kode_pemesanan }}">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="nama_rekening">Nama Pemilik Rekening</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="nama_rekening">
                      	@error('nama_rekening')
											  	<span class="text-danger">{{$message}}</span>
												@enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="no_rekening">No. Rekening</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="no_rekening">
                        @error('no_rekening')
											  	<span class="text-danger">{{$message}}</span>
												@enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label" for="nama_bank">Bank</label>
                      <div class="col-sm-7">
                        <select class="form-control select2" name="nama_bank" style="color: #2e0a0c !important;">
                          <option value="BANK BRI">BANK BRI</option>
                          <option value="BANK MANDIR">BANK MANDIRI</option>
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
                        <div class="text-danger small">Pilih <strong>"Bank Lainnya"</strong> bila nama bank mu tidak ada dalam pilihan</div>
                        @error('nama_bank')
                          <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="tipe_bayar">Pembayaran</label>
                        <div class="col-sm-7">
                          @if ($telah_dibayar->jumlah > 0)
                          <input type="text" name="tipe_pembayaran" class="form-control" value="Lunas" id="" readonly> 
                          @else
                          <select class="form-control" name="tipe_pembayaran">
                            <option value="DP">DP</option>
                            <option value="Lunas">Lunas</option>
                          </select>  
                          @endif
                        </div>
                        @error('tipe_pembayaran')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jumlah_bayar">Jumlah Bayar</label>
                        <div class="col-sm-7">
                          @if ($telah_dibayar->jumlah > 0)
                            <input type="text" class="form-control uang" name="jumlah_pembayaran" value="{{ $pemesanan->total_pemesanan - $telah_dibayar->jumlah }}" readonly>
                          @else
                          <input class="form-control uang" type="text" name="jumlah_pembayaran" value="{{(30/100 *($pemesanan->total_pemesanan))}}">
                          @endif
                          @error('jumlah_pembayaran')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="bukti_pembayaran">Tanggal Pembayaran</label>
                        <div class="col-sm-7">
                          <input type="date" class="form-control" name="tgl_pembayaran">
                        </div>
                        @error('tgl_pembayaran')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="bukti_pembayaran">Bukti Pembayaran</label>
                        <div class="col-sm-7">
                          <input type="file" class="form-control-file" name="bukti_pembayaran">
                        </div>
                        @error('bukti_pembayaran')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-3">
                    <div class="col-md-11 text-right">
                      <button type="submit" class="btn btn-sm btn-tambah px-3">Submit</button>
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
@endsection


@push('addon-script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> --}}

  <script type="text/javascript">
   $(document).ready(function() {
     $('.select2').select2();

     $("select[name=nama_bank]").on('change', function() {
       var bank_dipilih = $(this, "option:selected").val();
       if(bank_dipilih == 'lainnya') {
         $("input[name=nama_bank_lainnya]").show(200);
        } else {
         $("input[name=nama_bank_lainnya]").hide(200);
       }
    });
  });
  </script>
  <script>
     $(document).ready(function(){
      //ambil min dp
      var min_dp = $("#minimal-dp").val();
      var min_lunas = $("#minimal-lunas").val();

      // if ($(".uang").length) {
      //   $('.uang').mask('000.000.000', {
      //     reverse: true
      //   });
      //}

      

      // $('.uang').mask('000.000.000', {
      //     reverse: true,
      //     onChange: function(cep) {
      //         console.log('cep changed! ', cep);
      //     }
      // // });


      $("select[name=tipe_pembayaran]").on('change', function() {
        if ($(this).val() == 'Lunas') {
          $("input[name=jumlah_pembayaran]").val(min_lunas);
          $("input[name=jumlah_pembayaran]").prop("readonly", true);
        } else {
          $("input[name=jumlah_pembayaran]").val(min_dp);
          $("input[name=jumlah_pembayaran]").prop("readonly", false);
        }
        $("input[name=jumlah_pembayaran]").trigger('input');
      })
     })   
  </script>
@endpush