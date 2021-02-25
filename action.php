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
    
}else if($_POST['kode'] && $_POST['qty']){

    $kode = $_POST['kode'];
    $qty = $_POST['qty'];

    $update = $koneksi->prepare("UPDATE cart SET qty =:qty WHERE(kode=:kode)");

    $update->execute([':qty'=>$qty,':kode'=>$kode]);

}else{

         header('location:index.php');

}