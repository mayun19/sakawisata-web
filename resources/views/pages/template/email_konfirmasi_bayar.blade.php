<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>
			SAKAWISATA - Konfirmasi Pembayaran {{$kode_pembayaran}}
		</title>
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
							<h3 style="font-family: Kalam, cursive; color: rgb(130, 204, 121)">
								Konfirmasi Pembayaran Kampung Wisata Kauman
							</h3>
						</td>
					</tr>

					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								<tr>
									<td><h4 style="margin: 0">Hi, {{$member->nama_member}}</h4></td>
								</tr>
								<tr>
									<td>
										Selamat, Pembayaran kunjungan dengan ID <strong>#{{ $pemesanan->kode_pemesanan }}</strong> telah kami
										terima.
										<br />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- detail paket -->
					<tr>
						<td>
							<table width="100%" style="padding: 10px; border-spacing: 0">
								<tr>
									<td style="color: #c18b8f; font-weight: 500">Detail Pembayaran</td>
								</tr>
								<tr>
									<td><strong>ID Pembayaran</strong></td>
									<td style="text-align: right">{{ $id_pembayaran }}</td>
								</tr>
								<tr>
									<td><strong>Tanggal Pembayaran</strong></td>
									<td style="text-align: right"><?php  echo date("d M Y", strtotime( $tgl_pembayaran))?></td>
								</tr>
								<tr>
									<td><strong>Jumlah Bayar</strong></td>
									<td style="text-align: right">Rp {{number_format($jumlah_pembayaran)}}</td>
								</tr>
								<tr>
									<td><strong>Tipe Pembayaran</strong></td>
									<td style="text-align: right">{{ $tipe_pembayaran }}</td>
								</tr>
								<tr>
									<td><strong>Metode Pembayaran</strong></td>
									<td style="text-align: right">{{ $jenis_pembayaran }}</td>
								</tr>
								<tr>
									<td><strong>Sisa Tagihan</strong></td>
									<td style="text-align: right">Rp {{number_format($pemesanan->total_pemesanan - $telah_dibayar->jumlah)}}</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- Regret -->
					<tr>
						<td width="100%">
							<table style="margin-bottom: 50px; border-spacing: 0">
								<p style="padding: 10px 10px; margin: 15px 10px 0">
									Terimakasih, <br />
									<span style="color: #a56c70; font-weight: 550"
										>SAKAWISATA Kampung Kauman Yogykarta</span
									>
								</p>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</center>
	</body>
</html>
