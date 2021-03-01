<?php
include_once("koneksi.php");
 $cart = $koneksi->query("SELECT * FROM cart");
 if($cart->rowCount() > 0){
   
   $count = $cart->rowCount();

 }else{

   $count = 0;
 }
 $page = isset($_GET['page'])?$_GET['page']:false;
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
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="asset/DataTables/datatables.min.css"/>
    

    <title>Kasir_App</title>
  </head>
  <body>



<!-- container -->
<div class="container">
  <!-- <i class="fas fa-cash-register fa-2x"></i> KasirApp  -->
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#34495E">
  <a class="navbar-brand text-white" href="index.php">
  <i class="fas fa-cash-register" style="color:white;font-size:33px;"></i> KasirApp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" >
      <!-- <li class="nav-item active pt-2">
      <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus-square"></i> Barang 
      </button>
        <a class="nav-link pt-4 text-white" href="#"><i class="fas fa-plus-square"></i> Barang <span class="sr-only">(current)</span></a>
      </li> -->

      <li class="nav-item active pb-1">
      <a class="nav-link pt-4 text-white" href="index.php?page=daftar_barang"><i class="fas fa-clipboard-list"></i> Daftar Barang  <span class="sr-only">(current)</span></a>
      </button>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <i class="fas fa-cart-arrow-down" style="color:white; font-size:20px;"> <span class="bg-danger" style="color:#white;padding-right:7px; padding-left:7px; padding-bottom:2px;  border-radius:50%; font-size:20px;"><?=$count?></span>
    </i>
    </form>
  </div>
</nav>

<div class="content">

    <?php

    $file_name = "$page.php";

    if(file_exists($file_name)){
      include_once($file_name);
    }else{
      include_once("kasir.php");
    }

    ?>

</div>

<div class="footer pt-3">
  <footer class="text-center text-white p-3" style="background-color:#34495E">&#169;N763</footer>
</div>

</div>

 
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script type="text/javascript" src="asset/DataTables/datatables.min.js"></script>