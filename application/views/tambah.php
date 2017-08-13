
		
		<div class="row">

			<div class="col-lg-7">
				<h1 class="page-header">Data Member</h1>
			</div>
			
		</div><!--/.row-->
		
		
		<div class="row">
		
			<div class="col-sm-10">
				<div class="panel panel-default animated fadeInRight" >
					<div class="panel-heading">Tambah</div>
					<div class="panel-body">
					
						<div class="col-md-12">
							 <form role="form" method="post" name="formtambah" id="formtambah" action="<?php echo base_url();?>index.php/frontend/tambah" enctype="multipart/form-data">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" class="form-control" name="first_name" placeholder="Nama Depan">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input class="form-control" name="last_name" placeholder="Nama Belakang">
								</div>
								<div class="form-group">
										<label>Language</label>
										<select class="form-control" name="language">
											<option value="HTML">HTML</option>
											<option value="CSS">CSS</option>
											<option value="Javascript">Javascript</option>
											<option value="PHP">PHP</option>
										</select>
									</div>
								
								<div class="form-group">
									<label>Upload</label>
									<input type="file" name="file">
									<p class="help-block">Upload File Dokumen Anda Disini.</p>
								</div>
								
								</form>
								<button type="button" onclick="$('#formtambah').submit();" class="btn btn-md btn-primary">Simpan</button>
								<button type="button" onclick="batal();" class="btn btn-md btn-danger">Batal</button>
								</div>
							
							
						</div>
					</div>
				</div><!-- /.panel-->
			</div>
		</div><!--/.row-->
		<script type="text/javascript">
			

			$("#formtambah").submit(function(event){
						  event.preventDefault();
						  var formData = new FormData($(this)[0]);
						   $.ajax({
						   url: $(this).attr('action'),
						    type: 'POST',
						    data: formData,
						    async: false,
						    cache: false,
						    contentType: false,
						    processData: false,
						    success: function (data) {
						      $('.main').html(data);
						    }
						  });
						 
						  return false;
						});
						
			 function batal(){
			 	$(".main").load('<?php echo base_url(); ?>index.php/frontend/tampil');
			}
		</script>