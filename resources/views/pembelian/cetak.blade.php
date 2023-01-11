<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <title>Invoice</title>
    
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
                                <p>Jl. Jambangan</p>
                                <p>(0823) 38939590 </p>
                                <p>tokoku@gmail.com</p>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>Bukti Pembelian</h2>
                                <h5># {{ $no_trx }}</h5>
                            </div>
                        </div>
                        <br />
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><h5>Produk</h5></th>
                                        <th><h5>Jumlah</h5></th>
                                        <th><h5>Subtotal</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice as $i)
                                    <tr>
                                        <td class="col-md-9">{{ $i->nama_barang }}</td>
                                        <td class="col-md-3">{{ $i->jumlah }}</td>
                                        <td class="col-md-3"> @currency($i->subtotal) </td>
                                    </tr>
                                    @endforeach
                                    @foreach($supplier as $s)
                                    <tr>
                                        <td colspan="3" class="text-left"> <h5><strong> Supplier :</strong>  {{ $s->nama_supplier }}</h5></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-right" style="color: #F81D2D;">
                                            <h4><strong>Total:</strong>  @currency($total),00</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="col-md-12">
                                @foreach ($tgl as $t)
                                <p><b>Tgl :</b> {{ date('d F Y H:i:s', strtotime($t->created_at)) }}</p>
                                @endforeach
                                <br />
                                @foreach ($admin as $ad)
                                <p><b>Admin : </b> {{ $ad->nama_user }}</p>
                                @endforeach
                            </div>
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