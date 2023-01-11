<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
            .body-main {
        background: #ffffff;
        border-bottom: 15px solid #1E1F23;
        border-top: 15px solid #1E1F23;
        margin-top: 30px;
        margin-bottom: 30px;
        padding: 40px 30px !important;
        position: relative ;
        box-shadow: 0 1px 21px #808080;
        font-size:10px;
        
        
        
    }

    .main thead {
		background: #1E1F23;
        color: #fff;
		}
    .img{
        height: 100px;}
    h1{
       text-align: center;
    }

    
    </style>
</head>
<body>
    <div class="container">

        
        
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 body-main">
                    <div class="col-md-12">
                       <div class="row">
                            <div class="col-md-4">
                                <img class="img" alt="Invoce Template" src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png" />
                            </div>
                            <div class="col-md-8 text-right">
                                <h4 style="color: #F81D2D;"><strong>Toko Sangar</strong></h4>
                                <p>Jl. Taman Jambangan</p>
                                <p>(0823) 38938580</p>
                                <p>rizdhanhr@gmail.com</p>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>INVOICE</h2>
                                <h5>#{{ $no_trx }}</h5>
                            </div>
                        </div>
                        <br />
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th ><h5>Produk</h5></th>
                                        <th><h5>Jumlah</h5></th>
                                        <th><h5>Subtotal</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice as $i)
                                    <tr>
                                        <td class="col-md-9">{{ $i->nama_barang }}</td>
                                        <td class="col-md-3">{{ $i->jumlah }}</td>
                                        <td class="col-md-3">@currency($i->subtotal)</td>
                                    </tr>
                                    @endforeach
                                    @foreach($total as $t)
                                    <tr>
                                        <td class="text-left" colspan="3">
                                        <p>
                                            <strong>Total : @currency($t->harga)</strong>
                                        </p>
                                        <p>
                                            <strong>Bayar : @currency($t->bayar) </strong>
                                        </p>
                                        <p>
                                            <strong>Kembalian : @currency($t->kembali)</strong>
                                        </p>
                                        </td>
                                    
                                    </tr>
                                    @endforeach
                                    @foreach($total as $t)
                                    <tr>
                                        <td colspan="3" class="text-left" style="color: #F81D2D;">
                                            <h4><strong>Total: </strong>@currency($t->harga),00</h4>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                        @foreach($tgl as $ta)
                            <div class="col-md-12">
                                <p><b>Tgl : </b>{{ date('d F Y',strtotime($ta->tgl_buat)) }}</p>
                                <br />
                                <p><b>Admin : </b>{{ $ta->nama_user }}</p>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        window.print()
    </script>
</body>
</html>