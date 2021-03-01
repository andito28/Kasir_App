<?php

$daftar_barang = $koneksi->query("SELECT * FROM barang");
$no = 1;
?>
<div class="col-md-12 pt-3 pl-0">

 <!-- Modal tambah barang-->
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
          <form action="action.php" method="POST">
          <div class="form-group">
              <label for="nama">Kode Barang</label>
              <input type="text" class="form-control" id="kode" name="kode" required>
            </div>
            <div class="form-group">
              <label for="nama">Nama Barang</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <button type="sumbit" class="btn btn-sm text-white" name="tambah_barang" style="background-color:#34495E"><i class="fas fa-plus-circle"></i>Tambah</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- akhir modal tambah barang -->


    <div class="card">
    <div class="card-header">
    <button type="button" class="btn text-white btn-sm" data-toggle="modal" data-target="#exampleModal" style="background-color:#34495E">
      <i class="fas fa-plus-square"></i> Tambah Barang 
    </button>
    </div>
    <div class="card-body">
    <table class="table table-striped table-bordered data">
			<thead>
				<tr>			
					<th width="20%">No</th>
					<th width="20%">Kode Barang</th>
					<th width="20%">Nama Barang</th>
					<th width="20%">Harga</th>
          <th width="20%">Aksi</th>
				</tr>
			</thead>
			<tbody>
      <?php while($row = $daftar_barang->fetch(PDO::FETCH_OBJ)) :?>
				<tr>				
					<td><?=$no?></td>
					<td><?=$row->kode?></td>
					<td><?=$row->nama_barang?></td>
					<td>Rp. <?=number_format($row->harga)?></td>
          <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_edit<?=$row->kode?>"><i class="fas fa-edit"></i>Edit</button> &emsp;
         <a href="action.php?hapus_barang=<?=$row->kode?>"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Hapus</button></a></td>
				</tr>

        
    <!-- Modal edit barang-->
    <div class="modal fade" id="modal_edit<?=$row->kode?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="action.php" method="POST">
                        <?php
                        $kode = $row->kode; 
                        $query_edit = $koneksi->query("SELECT * FROM barang WHERE kode ='$kode'");
                        while ($row = $query_edit->fetch(PDO::FETCH_ASSOC)) {  
                        ?>
              <input type="hidden" name="kode_lama" value="<?=$row['kode']?>">
              <div class="form-group">
                  <label for="nama">Kode Barang</label>
                  <input type="text" class="form-control" id="kode" name="kode" value="<?=$row['kode']?>">
                </div>
                <div class="form-group">
                  <label for="nama">Nama Barang</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="<?=$row['nama_barang']?>">
                </div>
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="number" class="form-control" id="harga" name="harga" value="<?=$row['harga']?>">
                </div>
                <button type="sumbit" class="btn btn-sm text-white" name="edit_barang" style="background-color:#34495E"><i class="fas fa-edit"></i>Update</button>
                <?php 
                        }
                        ?>        

              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir modal edit barang -->
        <?php $no++; endwhile;?>
			</tbody>
		</table>
    </div>
    </div>

<!-- Button trigger modal -->
<script src="asset/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>