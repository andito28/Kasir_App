<?php
include("koneksi.php");

if(isset($_POST['kode_barang'])){

    $add = $koneksi->prepare("INSERT INTO cart(kode_barang,qty) VALUE(:kode_barang,:qty)");

    $result = $add->execute([':kode_barang'=>$_POST['kode_barang'],':qty'=>1]);

    header('location:index.php');

}elseif(isset($_GET['kode'])){

    $delete = $koneksi->prepare("DELETE FROM cart WHERE(kode = :kode)");

    $delete->execute([':kode'=>$_GET['kode']]);

    header('location:index.php');
    
}elseif($_GET['update']){

    // $update = $koneksi->prepare("UPDATE cart SET qty =:kode WHERE(kode=:kode)");

    var_dump($_GET['qty']);

}else{

    header('location:index.php');
}