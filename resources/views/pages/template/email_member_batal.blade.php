<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SAKAWISATA - Pembatalan Kunjungan ID Pemesanan</title>
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
								Pembatalan Kunjungan SAKAWISATA
							</p>
						</td>
					</tr>

					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								<tr>
									<td><h4 style="margin: 10px 10px 0">Hi, {{ $pemesanan->nama_member }} !</h4></td>
								</tr>
								<tr>
									<td>
										<p style="margin: 10px 10px 0">
											Pengajuan pembatalan kunjungan dengan ID <strong>#{{ $pemesanan->kode_kunjungan }}</strong> telah
											kami terima.
										</p>
										<p style="margin: 10px 10px 0">
											Refund dana kunjungan akan segera kami kirimkan ke rekening anda.
											<br />
											Untuk informasi lebih lanjut dapat menghubungi wa admin SAKAWISATA.
										</p>
									</td>
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
												padding: 10px;
											"
										>
											klik tombol dibawah ini untuk melihat detail
											<span style="color: #ae5259">pembatalan</span> kunjungan mu.
										</p>
										<a
											href="{{ url('member/pembatalan-detail/'.$pemesanan->id_pemesanan) }}"
											style="
												background-color: #ae5259;
												color: #f9eef0;
												text-decoration: none;
												padding: 10px 15px;
												border-radius: 5px;
												font-weight: 400;
											"
											>Pembatalan Kunjungan</a
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
