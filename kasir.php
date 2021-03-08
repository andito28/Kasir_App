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
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h6>RP. <?=number_format($total)?></h6></a>
        <input type="hidden" id="total_bayar" value="<?=$total?>">
      </li>
    </ul>
  </div> 
  <div class="card-body">

  <?php
  if(isset($_GET['gagal'])){
    echo"<div class='alert alert-danger' role='alert'>
   Barang sudah ada dalam keranjang
  </div>";
  }

  ?>
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
              <td>Rp. <?=number_format($row->harga)?></td>

              <td>
              <form id="frm<?=$row->kode?>">
                <input type="hidden" name="kode" value="<?=$row->kode?>">
                <input type="number" name="qty" value="<?=$row->qty?>" style="width:55px;" 
                onchange="updcart(<?=$row->kode?>)" onkeyup="updcart(<?=$row->kode?>)">
              </form>
              </td>
              <td>Rp. <?=number_format($row->harga * $row->qty)?></td>
              <td><a href="action.php?kode=<?=$row->kode?>" class="bg-danger pl-3 pr-3 pt-1 pb-1"><i class="fas fa-times" style="color:white"></i></a></td>
            </tr>
            <?php endwhile; ?>
            <tr>
              <td colspan="5" style="padding-bottom:0;padding-top:20px;"> 
              <div class="form-group row">
                <label for="inputPassword" class="col-form-label pl-3" style="color:#6C6D6D"><h6>BAYAR :</h6></label>
               <div class="col-4">
                  <input type ="number" class="form-control" id="bayar" onchange="bayar()" onkeyup="bayar()">
                </div>
                <label for="kembalian" class="col-form-label pl-3" style="color:#6C6D6D"><h6>KEMBALIAN : </h6></label>
                <div class="col-4">
                  <input type ="text" class="form-control" id="kembalian" disabled>
                </div>
              </div>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- <button class="btn btn-sm text-white" style="background-color:#E67E22"><i class="fas fa-calculator"></i> Hitung</button>&emsp; -->
        <a href="cetak.php"><button class="btn btn-sm text-white" style="background-color:#34495E"><i class="fas fa-print"></i> Cetak</button></a>
  </div>
</div>
  
  </div>

</div>


<!-- akhir container -->
    <script type="text/javascript">
          function updcart(id){
            $.ajax({
              url :'action.php',
              type :'POST',
              data :$("#frm"+id).serialize(),
              success:function(res){
                console.log(id)
                window.location.href = 'index.php'
              }
            });
          }

          function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
          }

          function bayar(){
              var total_bayar = document.getElementById('total_bayar').value;
              var bayar = document.getElementById('bayar').value;

              var kembalian = (bayar-total_bayar);

              document.getElementById('kembalian').value = "RP. "+formatNumber(kembalian);
              console.log(bayar);
          }
    </script>
