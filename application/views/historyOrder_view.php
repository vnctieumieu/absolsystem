<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lịch Sử Mua Hàng</title>
	<link rel="icon" href="/vendor/img/absol.png">
	<link rel="stylesheet" href="/vendor/css/grid.css">
	<link rel="stylesheet" href="/vendor/css/homePage.css">
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<?php include 'template/navbar.php' ?>
	<div style="min-height: 100vh;" class="container">
		<div class="container_header grid wide">
			<table class="table_history_order">
				<tr>
					<th colspan="7">Lịch Sử Đặt Hàng</th>
				</tr>
				<tr>
					<th>STT</th>
					<th>Mã Đơn</th>
					<th>Ngày Đặt</th>
					<th>Trạng Thái</th>
					<th>SL Sản Phẩm</th>
					<th>Sản Phẩm</th>
					<th>Tổng Giá</th>
				</tr>
				<?php foreach ($arHistory as $key => $value): ?>
					<tr>
						<td><?php echo $key+1;?></td>
						<td><?php echo $value['id'];?></td>
						<td><?php echo date("d/m/Y",$value['dateTime'])?></td>
						<td><?php if ($value['status']) {
							echo "Thành Công";
						}else {
							echo "Đang Đặt";
						} ?></td>
						<td><?php echo $value['sumAmoutProduct'];?></td>
						<td>
							<?php foreach ($value['nameProduct'] as $key => $value2): ?>
								<?php echo $value2,"<br>";?>
							<?php endforeach ?>
						</td>
						<td>
							<?php  echo number_format($value['sumProduct']);?> vnđ
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
	<?php include 'template/footer.php' ?>
</body>
</html>`