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
              <input type="text" class="form-control" id="kode" name="kode">
            </div>
            <div class="form-group">
              <label for="nama">Nama Barang</label>
              <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga">
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button>
    </div>
    <div class="card-body">
    <table class="table table-striped table-bordered data">
			<thead>
				<tr>			
					<th>Nama</th>
					<th>Alamat</th>
					<th>Pekerjaan</th>
					<th>Usia</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<tr>				
					<td>Andi</td>
					<td>Jakarta</td>
					<td>Web Designer</td>
					<td>21</td>
					<td>Aktif</td>
				</tr>
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