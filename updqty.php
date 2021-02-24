<?php
// session_start();
include("koneksi.php");

$kode = $_GET['kode'];
$qty = $_GET['qty'];

$update = $koneksi->prepare("UPDATE cart SET qty =:qty WHERE(kode=:kode)");

$update->execute([':qty'=>$qty,':kode'=>$kode]);

// $update = "UPDATE cart SET qty='$qty' WHERE kode='$kode' ";

// $koneksi->query($update);

