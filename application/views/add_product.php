<!DOCTYPE html>
<html>
<title><?php echo $title; ?></title>
<!-- Mirrored from coderthemes.com/minton/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2005], Fri, 24 Aug 2018 17:23:03 GMT -->
<head>
<body>
<form action="<?php echo base_url();?>addproduct/add" method="post" enctype="multipart/form-data"/>
<section>
	<div class="form-group clearfix">
		<label class="control-label " for="skv">SKU *</label>
		<div class="">
			<input class="form-control required" id="skv" name="skv" type="text" size="200px">
		</div>
	</div>
	<div class="form-group clearfix">
		<label class="control-label " for="nameproduct"> Tên Sản Phẩm *</label>
		<div class="">
			<input id="password" name="nameproduct" class="required form-control" type="text" size="200px>

		</div>
	</div>

	<div class="form-group clearfix">
		<label class="control-label " for="maproduct">Mã Sản Phẩm *</label>
		<div class="">
			<input id="confirm" name="maproduct" class="required form-control" type="text" size="200px>
		</div>
	</div><br>
		<div class="form-group row" >
			<label class="col-2 col-form-label">Text area</label>
			<div class="col-12">
				<textarea class="form-control" rows="10" name="mtprodcut" style="margin-bottom:10px"></textarea>
			</div>
		</div>
			<div class="fileupload btn btn-success waves-effect waves-light btn-sm mb-3">
				<span><i class="ion-upload m-r-5"></i>Upload Files</span>
				<input class="upload" type="file" name="files[]" id="files" multiple>

			</div><br>

			<a href="#"><button type="submit" class="btn btn-primary">Submit</button></a>
</section>

</body>
</html>
