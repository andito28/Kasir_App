<?php
include("koneksi.php");

if(isset($_POST['tambah_barang'])){
    
    $add = $koneksi->prepare("INSERT INTO barang VALUE(:kode,:nama,:harga)");

    $add->execute([':kode'=>$_POST['kode'],':nama'=>$_POST['nama'],':harga'=>$_POST['harga']]);
    
    header('location:index.php?page=daftar_barang');
    
}elseif(isset($_POST['kode_barang'])){

    $add = $koneksi->prepare("INSERT INTO cart(kode_barang,qty) VALUE(:kode_barang,:qty)");

    $result = $add->execute([':kode_barang'=>$_POST['kode_barang'],':qty'=>1]);

    header('location:index.php');

}elseif(isset($_POST['edit_barang'])){

    $update = $koneksi->prepare("UPDATE barang SET kode =:kode,nama_barang = :nama, harga = :harga WHERE(kode=:kode_lama)");

    $update->execute([':kode'=>$_POST['kode'],':nama'=>$_POST['nama'],':harga'=>$_POST['harga'],':kode_lama'=>$_POST['kode_lama']]);

    header('location:index.php?page=daftar_barang');
    
}elseif(isset($_GET['kode'])){

    $delete = $koneksi->prepare("DELETE FROM cart WHERE(kode = :kode)");

    $delete->execute([':kode'=>$_GET['kode']]);

    header('location:index.php');
    
}else if($_GET['hapus_barang']){

    $delete = $koneksi->prepare("DELETE FROM barang WHERE(kode = :kode)");

    $delete->execute([':kode'=>$_GET['hapus_barang']]);

    header('location:index.php?page=daftar_barang');
    
}else if($_POST['kode']){

    $kode = $_POST['kode'];
    $qty = $_POST['qty'];

    if($qty === ""){
        $qty = 0;
    }

    $update = $koneksi->prepare("UPDATE cart SET qty =:qty WHERE(kode=:kode)");

    $update->execute([':qty'=>$qty,':kode'=>$kode]);

}else{

    header('location:index.php');
}