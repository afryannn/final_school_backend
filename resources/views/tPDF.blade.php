<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>Hello, world!</title>
</head>

<body>
	<center>
		<img src="https://cdn.vuetifyjs.com/images/cards/cooking.png" style="width:200px;">
	</center>
	<br>
	<br>
	<center>
		<p><b>DATA PENJUAL<p></b>
	</center>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">Produk Yang Di Beli</th>
				<th scope="col">Data Produk</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Nama Produk</th>
				<td>{{$items->product_name}}</td>
			</tr>
			<tr>
				<th>Harga</th>
				<td>Rp.{{$items->product_price}}</td>
			</tr>
			<tr>
				<th>Penjual</th>
				<td>{{$items->store_name}}</td>
			</tr>
			<tr>
				<th>Alamat Penjual</th>
				<td style="width:380px !important;">{{$items->address_seller}}</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>{{$seller->email}}</td>
			</tr>
			<tr>
				<th>Telephone</th>
				<td>{{$seller->telephone}}</td>
			</tr>
		</tbody>
	</table>
	<br><br>
	<center>
		<p><b>DATA PEMBELI<p></b>
	</center>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">Info Pembeli</th>
				<th scope="col">Data Pembeli</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Nama Pembeli</th>
				<td>{{$items->visitor_name}}</td>
			</tr>
			<tr>
				<th>Alamat Pembeli</th>
				<td style="width:380px !important;">{{$items->address_customer}}</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>{{$user->email}}</td>
			</tr>
			<tr>
				<th>Telephone</th>
				<td>{{$user->telephone}}</td>
			</tr>
		</tbody>
	</table>
</body>

</html>