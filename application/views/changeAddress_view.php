<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đổi Mật Khẩu</title>
	<link rel="icon" href="/vendor/img/absol.png">
	<link rel="stylesheet" href="/vendor/css/grid.css">
	<link rel="stylesheet" href="/vendor/css/homePage.css">
	<script src="/vendor/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<?php include 'template/navbar.php' ?>
	<div style="min-height: 100vh;" class="container">
		<div class="container_header grid wide">
			<form action="" class="form_change_address" id="form_change_address">
				<span class="form_title">Thay đổi địa chỉ</span>
				<span class="now_address">Địa chỉ hiện tại: <?php echo $this->session->userdata('account')['address'];?></span>
				<input name="new_address" type="text" placeholder="nhập địa chỉ mới">
				<input type="submit" value="xác nhận">
			</form>
		</div>
	</div>
	<script type="text/javascript">
		document.getElementById('form_change_address').onsubmit = function(event) {
			event.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '/Index/UpdateAddress',
				type: 'POST',
				dataType: 'json',
				processData: false,
				contentType: false,
				data: formData,
			})
			.done(function(data) {
				if (data.status == true) {
					alert(data.msg);
					window.open('/','_blank');
				} else {
					alert(data.msg);
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}
	</script>
</body>
</html>