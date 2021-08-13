<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>SAKAWISATA - Tiket Kunjungan {{$pemesanan->kode_kunjungan}}</title>

		<!--     <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}"/> -->
	</head>

	<style type="text/css">
		/* table {
			border-spacing: 0;
		}
		td {
			padding: 0;
		}
		img {
			border: 0;
		} */
	</style>

	<body style="font-family: Assistant, Tahoma, Geneva, Verdana, sans-serif">
		<center class="wrapper" style="width: 100%; table-layout: fixed; background-color: #f6f9fc; padding-bottom: 40px;">
			<div class="webkit" style="max-width: 600px;
			background-color: #ffffff;">
				<table align="center" class="outer" style="margin: 0 auto;
			width: 100%;
			max-width: 600px;
			border-spacing: 0;
			font-family: Assistant, Tahoma, Geneva, Verdana, sans-serif;
			color: rgb(46, 10, 12) !important;">
					<tr>
						<td>
							<table width="100%" style="border-spacing: 0">
								<!-- logo sakwis -->
								<tr>
									<td style="padding: 10px; text-align: center">
										<a href=""><img src="images/logo_sakawis.png" alt="" /></a>
									</td>
								</tr>
							</table>
							<hr style="border-style: dashed; color: #b1b1b1" />
						</td>
					</tr>
					<!-- Judul -->
					<tr>
						<td style="padding: 10px; text-align: center">
							<h3 style="font-family: Kalam, cursive; color: rgb(130, 204, 121)">
								E-Ticket Kampung Wisata Kauman
							</h3>
						</td>
					</tr>
						<!-- nama wisatawan -->
					</tr>

					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								<tr>
									<td><h4 style="margin: 0">Hi, {{ $member->nama_member }}</h4></td>
								</tr>
								<tr>
									<td>Ini tiket digitalmu dengan kunjungan ID <strong>#{{ $pemesanan->kode_kunjungan }}</strong></td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- detail paket -->
					<tr>
						<td>
							<table width="100%" style="padding: 10px; border-spacing: 0">
								<tr>
									<td>Detail Paket</td>
								</tr>
								<tr>
									<td><strong>Paket Kunjungan</strong></td>
									<td style="text-align: right">{{ $paket->nama_paket }}</td>
								</tr>
								<tr>
									<td><strong>Jumlah Wisatawan</strong></td>
									<td style="text-align: right">{{ $pemesanan->jumlah_wisatawan }} wisatawan</td>
								</tr>
								<tr>
									<td><strong>Jumlah Paket</strong></td>
									<td style="text-align: right">{{ $pemesanan->jumlah_paket }} paket</td>
								</tr>
								@if (!empty($pemesanan->jumlah_wisatawan_tambahan))
								<tr>
									<td><strong>Jumlah Tambahan</strong></td>
									<td style="text-align: right">{{ $pemesanan->jumlah_wisatawan_tambahan }} wisatawan</td>
								</tr>
								@endif
							</table>
						</td>
					</tr>
					<!-- detail kunjungan -->
					<tr>
						<td>
							<table width="100%" style="padding: 10px; border-spacing: 0">
								<tr>
									<td>Detail Kunjungan</td>
								</tr>
								<tr>
									<td><strong>Tanggal Kunjungan</strong></td>
									<td style="text-align: right"><?php  echo date("d M Y", strtotime( $pemesanan->tgl_kunjungan))?> </td>
								</tr>
								<tr>
									<td><strong>Waktu Kunjungan</strong></td>
									<td style="text-align: right">{{ $paket->waktu_kunjungan_paket }}</td>
								</tr>
								@if ($cek_pemandu != 0)				
								<tr>
									<td><strong>Pemandu</strong></td>
									<td style="text-align: right">{{ $pemandu->nama_pemandu }}</td>
								</tr>
								@else
								-
								@endif
							</table>
						</td>
					</tr>
					<!-- keterangan -->
					<tr>
						<td>
							<table width="100%">
								<tr>
									<td align="center" style="padding: 15px 10px; border-spacing: 0">
										<p
											style="
												color: rgb(112, 112, 112) !important;
												font-weight: 600;
												padding: 10px;
											"
										>
											Harap datang ke lokasi kunjungan 30 menit <br />
											Jelajah di mulai
										</p>
										<a href="{{ pengaturan('link_gmaps') }}" style="background-color: rgb(130, 204, 121); color: rgb(250, 250, 250); text-decoration: none; padding: 12px 15px; border-radius: 5px; font-weight: bold;">Direct Maps</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- kontak -->
					<tr>
						<td width="100%">
							<p style="padding: 10px 10px; margin: 15px 10px 0">Butuh Bantuan ?</p>
						</td>
					</tr>
					<tr>
						<td>
							<table style="padding: 0 10px 40px; border-spacing: 0" width="100">
								<tr>
									<td>
										<img src="images/ic_support.png" style="padding: 0 10px" alt="" />
									</td>
									<td>
										<table>
											<tr style="vertical-align: top">
												<td>
													<p style="margin: 5px">{{ pengaturan('email_saka') }}</p>
												</td>
											</tr>
											<tr>
												<td>
													<p style="margin: 5px">{{ pengaturan('notelp_saka') }}</p>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</center>
	</body>
</html>
