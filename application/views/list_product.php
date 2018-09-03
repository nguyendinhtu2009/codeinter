<div class="card-box">
	<div class="table-responsive">
		<table class="table table-centered mb-0">
			<thead class="font-13 bg-inverse text-muted">
			<tr>
				<th class="font-weight-medium">STT</th>
				<th class="font-weight-medium">Tên Sản Phẩm </th>
				<th class="font-weight-medium">Mã Sản Phẩm</th>
				<th class="font-weight-medium">SKV</th>
				<th class="font-weight-medium">Danh Mục</th>
				<th class="font-weight-medium">Ngày Đăng</th>
				<th class="font-weight-medium">Xóa</th>
				<th class="font-weight-medium">Sửa</th>

					<i class="mdi mdi-pencil"></i>


			</tr>
			</thead>
			<?php
				$stt=0;
				if($info !=""){
					foreach($info as $item){
						$stt++;
						echo "<tr>";
						echo "<th>$stt</th>";
						echo "<th>$item[product_name]</th>";
						echo "<th>$item[product_msp]</th>";
						echo "<th>$item[product_skv]</th>";
						echo "<th>Danh Mục</th>";
						echo "<th>$item[product_date]</th>";
						echo "<th><a href='".base_url()."/addproduct/del/$item[id]'>X</a></th>";
						echo "<th><a href='".base_url()."/addproduct/edit/$item[id]'><i class=\"mdi mdi-pencil\"></i></a></th>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</div>
</div>
