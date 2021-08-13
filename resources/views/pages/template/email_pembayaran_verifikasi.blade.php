<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SAKAWISATA - Konfirmasi Pembayaran Kunjungan ID Pemesanan {{ $pemesanan->kode_pemesanan }}</title>
	</head>

	<body style="font-family: Assistant, Tahoma, Geneva, Verdana, sans-serif">
		<center
			class="wrapper"
			style="
				width: 100%;
				table-layout: fixed;
				background-color: #f6f9fc;
				padding-bottom: 40px;
			"
		>
			<div class="webkit" style="max-width: 600px; background-color: #ffffff">
				<table
					align="center"
					class="outer"
					style="
						margin: 0 auto;
						width: 100%;
						max-width: 600px;
						border-spacing: 0;
						font-family: Assistant, Tahoma, Geneva, Verdana, sans-serif;
						color: rgb(46, 10, 12) !important;
					"
				>
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
							<p
								style="
									font-family: Kalam, cursive;
									color: rgb(130, 204, 121);
									font-weight: 650;
									font-size: 18px;
								"
							>
								Konfirmasi Pembayaran Kunjungan SAKAWISATA
							</p>
						</td>
					</tr>

					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								<tr>
									<td><h4 style="margin: 10px 10px 0">Hi, Admin SAKAWISATA</h4></td>
								</tr>
								<tr>
									<td>
										<p style="margin: 10px 10px 0">
											Pemesanan kunjungan <strong>#{{ $pemesanan->kode_pemesanan }}</strong> telah dibayarkan. <br />
											Berikut adalah detailnya:
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- detail paket -->
					<tr>
						<td style="padding: 10px 20px 10px">
							<table
								width="70%"
								style="
									border: solid 1px #f2e8e9;
									border-radius: 7px;
									padding: 10px;
									border-spacing: 0;
								"
							>
								<tr>
									<td style="width: 170px;"">
										<p style="font-weight: 500; margin-bottom: 5px; color: #c18b8f">
											Informasi Pembayaran
										</p>
									</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Total Tagihan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">Rp &nbsp; {{ number_format($pemesanan->total_pemesanan) }}</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Nominal Pembayaran</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">Rp &nbsp; {{ number_format($pembayaran->jumlah_pembayaran) }}</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Tipe Pembayaran</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $pembayaran->tipe_pembayaran }}</td>
								</tr>
								<tr>
									<td>
										<p style="font-weight: 500; margin: 15px 0 5px; color: #c18b8f">
											Detail Kunjungan
										</p>
									</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">ID Pemesanan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">#{{ $pemesanan->kode_pemesanan }}</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Nama Pemesan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $member->nama_member }}</td>
								</tr>
								<tr>
									<td style="width: 120px; padding-bottom: 5px">Nama Paket</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $pemesanan->nama_paket }}</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Jumlah Wisatawan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $pemesanan->jumlah_wisatawan }} &nbsp; orang</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Tanggal Kunjungan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px"><?php  echo date("d M Y", strtotime( $pemesanan->tgl_kunjungan))?></td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Sesi Kunjungan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $pemesanan->waktu_kunjungan_paket }}</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- keterangan -->
					<tr>
						<td style="padding: 10px 20px 20px">
							<table width="100%">
								<tr>
									<td align="center" style="padding: 10px; border-spacing: 0">
										<p
											style="
												color: rgb(112, 112, 112) !important;
												font-weight: 600;
												padding: 10px 10px 5px;
											"
										>
											Klik tombol dibawah ini untuk konfirmasi pembayaran pemesanan kunjungan 
										</p>
										<a
											href="{{url('admin/pemesanan/detail_pemesanan/' . $pemesanan->id_pemesanan)}}"
											style="
												background-color: #af7c7f; color: #f9eef0; text-decoration: none; padding: 5px 15px; border-radius: 5px; font-weight: 400;
											"
											>Verifikasi Pembayaran</a
										>
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
