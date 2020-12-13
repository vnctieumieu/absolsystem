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
			<form action="" class="form_change_password" id="form_change_password">
				<span class="form_title">Thay Đổi Mật Khẩu</span>
				<input name="old_password" type="password" placeholder="nhập mật khẩu hiện tại">
				<input name="new_password" type="password" placeholder="nhập mật mới">
				<input name="renew_password" type="password" placeholder="nhập lại mật mới">
				<input type="submit" value="xác nhận">
			</form>
		</div>
	</div>
	<script type="text/javascript">
		document.getElementById('form_change_password').onsubmit = function(event) {
			event.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '/AccountAuthentic/ChangPassword',
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