<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SAKAWISATA - Aktivasi Pendaftaran Akun</title>
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
									font-weight: 600;
									font-size: 18px;
								"
							>
								Aktivasi Akun Pendaftaran SAKAWISATA
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								<tr>
									<td>
										<p style="margin: 10px 10px 0">
											Selamat Datang di SAKAWISATA, <strong>{{ $member['nama_member'] }}!</strong>
										</p>
									</td>
								</tr>
								<tr>
									<td>
										<p style="margin: 10px 10px 0">
											Saat ini kamu telah terdaftar di
											<span style="font-weight: 500; margin-bottom: 5px; color: #c18b8f"
												>SAKAWISATA</span
											>, klik link berikut untuk mengaktifkan akun mu dan maksimalkan fitur
											member di website kami.
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
										<a
											href="{{ url('aktivasi/'.$member['kode'])}}"
											style="
												background-color: #82cc79;
												color: #fafafa;
												text-decoration: none;
												padding: 5px 15px;
												border-radius: 5px;
												font-weight: 400;
											"
											>Aktifkan Akun</a
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
