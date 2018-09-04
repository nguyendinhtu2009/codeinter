<div class="port m-b-20">
	<div class="portfolioContainer">
		<div class="col-sm-6 col-lg-3 col-md-4 webdesign illustrator">
			<?php
				foreach ($info as $item){
					echo "<div class='gal-detail thumb'>";
					if($item['product_img'] !=""){
						$img = explode(',', $item['product_img']);
						for($i=1;$i<count($img);$i++){
							echo "<img src='".base_url()."uploads/uploads_product/$img[$i]' width='150' style='margin-bottom:10px'/>";
						}
					}
					echo "</div>";
				}
			?>
		</div>
	</div>
</div>


