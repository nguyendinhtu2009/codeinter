<!DOCTYPE html>
<html>
<title><?php echo $title; ?></title>
<!-- Mirrored from coderthemes.com/minton/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2005], Fri, 24 Aug 2018 17:23:03 GMT -->
<head>
<body>
<form action="<?php echo base_url()."addproduct/edit/".$info['id'];?>" method="post" enctype="multipart/form-data"/>
<section>
	<div class="form-group clearfix">
		<label class="control-label " for="skv">SKU *</label>
		<div class="">
			<input class="form-control required" id="skv" name="skv" type="text" size="200px" value="<?php echo $info['product_skv'];?>">
		</div>
	</div>
	<div class="form-group clearfix">
		<label class="control-label " for="nameproduct"> Tên Sản Phẩm *</label>
		<div class="">
			<input id="password" name="nameproduct" class="required form-control" type="text" size="200px" value="<?php echo $info['product_name'];?>">

		</div>
	</div>

	<div class="form-group clearfix">
			<label class="control-label " for="maproduct">Mã Sản Phẩm *</label>
			<div class="">
				<input id="confirm" name="maproduct" class="required form-control" type="text" size="200px" value="<?php echo $info['product_msp'];?>">
		</div>
	</div><br>
	<div class="form-group row">
				<label class="col-2 col-form-label">Text area</label>
				<div class="col-12">
					<textarea class="form-control" rows="10" name="mtprodcut" value=""><?php echo $info['product_mt'];?></textarea>
				</div>
			</div>
			<br class="fileupload btn btn-success waves-effect waves-light btn-sm mb-3">

				<input class="upload" type="file"></ br>
				<?php
				$img = explode(',', $info['product_img']);
					for($i=1;$i<count($img);$i++){
					echo "<img src='".base_url()."/uploads/uploads_product/$img[$i]' width='150' />";
				}
				?>
			</div><br>
			<button type="submit" class="btn btn-primary" name="ok" value="submit">Update</button>
</section>
</body>
</html>
