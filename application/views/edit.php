
		<?php 	foreach ($member as $member){ ?>
		<div class="row">

			<div class="col-lg-7">
				<h1 class="page-header">Data Member</h1>
			</div>
			
		</div><!--/.row-->
		
		
		<div class="row">
		
			<div class="col-sm-10">
				<div class="panel panel-default animated fadeInUp" >
					<div class="panel-heading">Edit</div>
					<div class="panel-body">
					
						<div class="col-md-12">
							 <form role="form" method="post" name="formedit" id="formedit" action="<?php echo base_url();?>index.php/frontend/edit/<?php echo $member->id;?>" enctype="multipart/form-data" encoding='multipart/form-data'>
							 <input type="hidden" name="id" value="<?php echo $member->id;?>">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" class="form-control" name="first_name" placeholder="Nama Depan" value="<?php echo $member->first_name;?>">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input class="form-control" name="last_name" placeholder="Nama Belakang" value="<?php echo $member->last_name;?>">
								</div>
								<div class="form-group">
										<label>Language</label>
										<select class="form-control" name="language">
											<option value="HTML" <?php if( $member->language=='HTML'){echo' selected';}?>>HTML</option>
											<option value="CSS" <?php if( $member->language=='CSS'){echo' selected';}?>>CSS</option>
											<option value="Javascript" <?php if( $member->language=='Javascript'){echo' selected';}?>>Javascript</option>
											<option value="PHP" <?php if( $member->language=='PHP'){echo' selected';}?>>PHP</option>
										</select>
									</div>
								
								<div class="form-group">
									<label>Upload</label>
									<input type="file" name="file"> <?php echo  $member->upload;?>
									<p class="help-block">Biarkan Jika Tidak Ingin Mengganti Dokumen</p>
								</div>
								
								</form>
								<button type="button" onclick="$('#formedit').submit();" class="btn btn-md btn-primary">Simpan</button>
								<button type="button" onclick="batal();" class="btn btn-md btn-danger">Batal</button>
								</div>
							
							
						</div>
					</div>
				</div><!-- /.panel-->
			</div>
		</div><!--/.row-->
		<?php } ?>
		<script type="text/javascript">
			

			$("#formedit").submit(function(event){
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