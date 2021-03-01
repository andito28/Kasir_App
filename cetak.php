<?php
include_once("koneksi.php");
$data_barang = $koneksi->query('SELECT * FROM barang');
$data_cart = $koneksi->query("SELECT barang.nama_barang,barang.harga,cart.qty,barang.kode FROM barang INNER JOIN cart ON barang.kode = cart.kode_barang");
$harga = $koneksi->query("SELECT barang.harga,cart.qty FROM barang INNER JOIN cart ON barang.kode = cart.kode_barang");

$total = 0;

while($row = $harga->fetch(PDO::FETCH_ASSOC)){

  $subtotal = ($row['harga'] * $row['qty']);

  $total += $subtotal;

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            font-size: 25px;
        }
        
        th{
            text-align: left;
        }
    </style>
</head>
<body>

<div class="cetak">

    <table align="center" cellpadding="5">
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>quantity</th>
            <th>Harga</th>
        </tr>
        <?php while($row = $data_cart->fetch(PDO::FETCH_OBJ)):?>
        <tr>
            <td><?=$row->kode?></td>
            <td><?=$row->nama_barang?></td>
            <td><?=$row->qty?></td>
            <td><?=number_format($row->harga)?></td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="4"><hr></td>
        </tr>
        <tr>
            <td colspan="3">Total Harga</td>
            <td><?=number_format($total)?></td>
        </tr>
    </table>
 </div>
 
 <script>
  window.print();
 </script>
</body>
</html>


 
