<table class="table_order_show">
	<tr>
		<th colspan="5" class="table_order_title">Danh Sách Đơn Hàng</th>
	</tr>
	<tr>
		<th>mã đơn</th>
		<th>tên user</th>
		<th>địa chỉ</th>
		<th>ngày đặt</th>
		<th>trạng thái</th>
	</tr>
	<?php if ($data): ?>	
		<?php foreach ($data as $key => $value): ?>	
			<tr>
				<td><?php echo $value['id'];?></td>
				<td><?php echo $value['userName'];?></td>
				<td><?php echo $value['address'];?></td>
				<td><?php echo date("d/m/Y",$value['dateTime']);?></td>
				<td><?php if ($value['status']) {
					echo "hoàn tất";
				} else {
					echo "đang đặt";
				} ?></td>
			</tr>
		<?php endforeach ?>
	<?php endif ?>
</table>