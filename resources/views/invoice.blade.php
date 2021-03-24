<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DotNetTec - Invoice html template bootstrap</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header" style="background:#28df99; color:white;">
                <strong>INVOICE</strong>
                {{-- <span class="float-right"> <strong>Status:</strong> Pending</span> --}}
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div style="color:#28df99;">
                            <strong>DotNetTec</strong>
                        </div>
                        <div>Madalinskiego 8</div>
                        <div>71-101 Szczecin, Poland</div>
                        <div>Email: info@dotnettec.com</div>
                        <div>Phone: +91 9800000000</div>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        <div style="color:#28df99;">
                            <strong>Robert Maxwel</strong>
                        </div>
                        <div>Attn: Daniel Marek</div>
                        <div>43-190 Mikolow, Poland</div>
                        <div>Email: robert@daniel.com</div>
                        <div>Phone: +48 123 456 349</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr style="color:#28df99;">
                                <th class="center">#</th>
                                <th>Gambar Produk</th>
                                <th>Nama Produk</th>
                                <th>Nama Toko</th>
                                <th>No.tlp Toko</th>
                                <th class="right">Harga produk</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="center">1</td>
                                <td class="left strong">Origin License</td>
                                <td class="left">Kursi malas - kayu jati</td>
                                <td class="left">Siraj Meuble</td>
                                <td class="right">08970025959</td>
                                <td class="center">Rp.2300000</td>
                                <td class="right">$999,00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">$8.497,00</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount (20%)</strong>
                                    </td>
                                    <td class="right">$1,699,40</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>VAT (10%)</strong>
                                    </td>
                                    <td class="right">$679,76</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>$7.477,36</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>