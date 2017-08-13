
		
		<div class="row">

			<div class="col-lg-7">
				<h1 class="page-header">Data Member</h1>
			</div>
			<div class="col-lg-3" style="text-align: right;margin-top: 20px;">
			<a onclick="tambah()"><button type="button" class="btn btn-lg btn-primary">Tambah</button></a>
			</div>
		</div><!--/.row-->
		
		
		<div class="row">
		
			<div class="col-sm-10">
			<div class="panel panel-default animated fadeIn" >
			<div class="panel-body">
				<table class="table" id="table">
					<thead>
						<tr>
							<th onclick="sortTable(0)">#</th>
							<th onclick="sortTable(1)">First Name</th>
							<th onclick="sortTable(2)">Last Name</th>
							<th onclick="sortTable(3)">Language</th>
							<th>Upload</th>
							<th>Action</th>
						</tr>
					<thead>
					<tbody>
					<?php
					$no=1;
					 foreach ($member as $member){ 
						echo'
						<tr>
							<td>'.$no++.'</td>
							<td>'.$member->first_name.'</td>
							<td>'.$member->last_name.'</td>
							<td>'.$member->language.'</td>
							<td ><a href="'.base_url().'index.php/frontend/download/'.$member->id.'">'.$member->upload.'</a></td>
							<td><button type="button" class="btn btn-sm btn-success" onclick="edit('.$member->id.')">Edit</button>
							<button type="button" class="btn btn-sm btn-warning" onclick="hapus('.$member->id.')">Hapus</button></td>
						</tr>
						';
					}
						?>
					</tbody>
				</table>
				</div>
				</div>
			</div>
		</div><!--/.row-->
		<script type="text/javascript">
			function tambah(){
				$(".main").load('<?php echo base_url(); ?>index.php/frontend/tambah');
			}
			function edit(id){
				$(".main").load('<?php echo base_url(); ?>index.php/frontend/edit/'+id);
			}
			function hapus(id){
				tanya = confirm("Anda Yakin Akan Menghapus Data ?");
				if (tanya == true){
				$(".main").load('<?php echo base_url(); ?>index.php/frontend/hapus/'+id);
				} else return false;
			}


		</script>
		<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("table");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.getElementsByTagName("TR");
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>