<div class="card-box">
	<div class="table-responsive">
		<table class="table table-centered mb-0">
			<thead class="font-13 bg-inverse text-muted">
			<tr>
				<th class="font-weight-medium">STT</th>
				<th class="font-weight-medium">SKU</th>
				<th class="font-weight-medium">Tên Sản Phẩm </th>
				<th class="font-weight-medium">Mã Sản Phẩm</th>
				<th class="font-weight-medium">Tiền Tệ</th>
				<th class="font-weight-medium">Tiền Việt Nam</th>
				<th class="font-weight-medium">Chênh</th>
				<th class="font-weight-medium">Giá Bán LazaDa</th>
				<th class="font-weight-medium">Danh Mục</th>
				<th class="font-weight-medium">Ngày Đăng</th>
				<th class="font-weight-medium">Xóa</th>
				<th class="font-weight-medium">Sửa</th>
			</tr>
			</thead>
			<?php
				$stt=0;
				if($info !=""){
					foreach($info as $item){
						$stt++;
						echo "<tr>";
						echo "<th>$stt</th>";
						echo "<th>$item[product_skv]</th>";
						echo "<th>$item[product_name]</th>";
						echo "<th>$item[product_msp]</th>";
						echo "<th>$item[product_te]</th>";
						echo "<th>".$item['product_te']*3.7*1.07."</th>";
						if($item['product_vn']<=20){
							echo "<th>1.6</th>";
						}
						
						echo "<th>$item[product_date]</th>";
						echo "<th><a href='".base_url()."addproduct/del/$item[id]'>X</a></th>";
						echo "<th><a href='".base_url()."addproduct/edit/$item[id]'><i class=\"mdi mdi-pencil\"></i></a></th>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</div>
</div>
