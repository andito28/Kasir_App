<?php
include("koneksi.php");

  $data_barang = $koneksi->query('SELECT * FROM barang');
  $data_cart = $koneksi->query("SELECT barang.nama_barang,barang.harga,cart.qty,cart.kode FROM barang INNER JOIN cart ON barang.kode = cart.kode_barang");
  $harga = $koneksi->query("SELECT barang.harga,cart.qty FROM barang INNER JOIN cart ON barang.kode = cart.kode_barang");

  $total = 0;

  while($row = $harga->fetch(PDO::FETCH_ASSOC)){

    $subtotal = ($row['harga'] * $row['qty']);

    $total += $subtotal;

   }

  
?>
 

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">

    <title>Kasir_App</title>
  </head>
  <body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="form-group">
          <label for="nama">Nama Barang</label>
          <input type="email" class="form-control" id="nama" name="nama"  aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="harga">Harga</label>
          <input type="number" class="form-control" id="harga" name="harga">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-sm text-white" style="background-color:#34495E">Tambah</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <!-- <i class="fas fa-cash-register fa-2x"></i> KasirApp  -->
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#34495E">
  <a class="navbar-brand text-white" href="index.php">
  <i class="fas fa-cash-register fa-2x" style="color:white"></i> KasirApp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" >
      <li class="nav-item active pt-3">
      <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus-square"></i> Barang 
      </button>
        <!-- <a class="nav-link pt-4 text-white" href="#"><i class="fas fa-plus-square"></i> Barang <span class="sr-only">(current)</span></a> -->
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light btn-sm my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="row pt-4">
  <div class="col-md-4">
  <div class="card">
  <div class="card-header" style="background-color:#34495E">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link disabled text-white" href="#" tabindex="-1" aria-disabled="true">Transaction</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
  <form action="action.php" method="POST">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Kode Barang</label>
    <select class="form-control" id="exampleFormControlSelect1" name="kode_barang">
    <option disabled selected> Kode Barang </option>
    <?php while($row = $data_barang->fetch(PDO::FETCH_OBJ)) : ?>
      <option value="<?=$row->kode?>"><?=$row->kode?></option>
    <?php endwhile; ?>
    </select>
  </div>

  <button type="submit" class="btn text-white btn-sm" style="background-color:#34495E" >Tambahkan <i class="fas fa-cart-plus"></i> </button>
</form>
  </div>
</div>
  </div>

  <div class="col-md-8">

  <div class="card" id="ref-cart">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h6>TOTAL HARGA :</h6></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h6>RP <?=number_format($total,2)?></h6></a>
      </li>
    </ul>
  </div> 
  <div class="card-body">
  <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" width="30%">Barang</th>
              <th scope="col" width="25%">Harga</th>
              <th scope="col" width="10%">Qty</th>
              <th scope="col" width="25%">Subtotal</th>
              <th scope="col" width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
          
          <?php while($row = $data_cart->fetch(PDO::FETCH_OBJ)):?>
            <tr>
              <td><?=$row->nama_barang?></td> 
              <td>Rp <?=number_format($row->harga)?></td>

              <td>
              <form id="frm<?=$row->kode?>">
                <input type="hidden" name="kode" value="<?=$row->kode?>">
                <input type="number" name="qty" value="<?=$row->qty?>" style="width:55px;" 
                onchange="updcart(<?=$row->kode?>)" onkeyup="updcart(<?=$row->kode?>)">
              </form>
              </td>
              <td>Rp <?=number_format($row->harga * $row->qty)?></td>
              <td><a href="action.php?kode=<?=$row->kode?>" class="bg-danger pl-3 pr-3 pt-1 pb-1"><i class="fas fa-times" style="color:white"></i></a></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <button class="btn btn-sm text-white" style="background-color:#34495E"><i class="fas fa-print"></i> Cetak</button>
  </div>
</div>

  
  </div>

</div>

<div class="footer pt-3">
  <footer class="text-center text-white p-3" style="background-color:#34495E">&#169;N763</footer>
</div>

</div>

    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  
    <script type="text/javascript">
    function updcart(id){
      $.ajax({
        url :'action.php',
        type :'POST',
        data :$("#frm"+id).serialize(),
        success:function(res){
          console.log(id)
          window.location.href = '/kasir_app'
        }
      });
    }
    </script>
  </body>
</html>