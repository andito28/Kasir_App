<?php

include("koneksi.php");

  $data_barang = $koneksi->query('SELECT * FROM barang');
  $data_cart = $koneksi->query("SELECT barang.nama_barang,barang.harga,cart.qty,cart.kode FROM barang INNER JOIN cart ON barang.kode = cart.kode_barang");


  // while($row = $data_barang->fetch(PDO::FETCH_ASSOC)){

  //   $test = $row['nama_barang'];
  //  }
  
 
  $total = 0;
  
?>
 

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Kasir_App</title>
  </head>
  <body>

<div class="container">

  <nav class="navbar bg-success">
  <a class="navbar-brand text-white" href="#">
    Kasir App
  </a>
  </nav>

<div class="row pt-4">
  <div class="col-md-4">
  <div class="card">
  <div class="card-header bg-success">
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

  <button type="submit" class="btn btn-success btn-sm">Tambahkan</button>
</form>
  </div>
</div>
  </div>

  <div class="col-md-8">

  <div class="card">
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
  <form action="">
  <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Barang</th>
              <th scope="col">Harga</th>
              <th scope="col">Qty</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php while($row = $data_cart->fetch(PDO::FETCH_OBJ)):?>
            <tr>
              <td><?=$row->nama_barang?></td> 
              <td><?=$row->harga?></td>
              <td><input type="text" name="qty" value="<?=$row->qty?>" style="width:50px"></td>
              <td><a href="action.php?kode=<?=$row->kode?>" class="text-white bg-danger pl-3 pr-3 pt-1 pb-1"><b>X</b></a></td>
            </tr>
            <?php $total += $row->qty ?>
            <?php endwhile; ?>
          </tbody>
        </table>
        <button class="btn btn-success btn-sm">Cetak</button>
  </div>
  </form>
</div>

  
  </div>

</div>

<div class="footer pt-3">
  <footer class="bg-success text-center p-3"></footer>
</div>

</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>