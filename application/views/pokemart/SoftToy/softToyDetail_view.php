<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Absol Pokemart</title>
	<link rel="stylesheet" href="/vendor/css/pokemart.css">
	<link rel="stylesheet" href="/vendor/css/grid.css">
	<link rel="icon" href="/vendor/img/pokemart.png">
	<script src="/vendor/js/jquery-3.5.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300&family=Roboto+Condensed&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div class="header_navbar grid wide">
			<div class="navbar-logo">
				<img src="/vendor/img/absol.png">
				<span>APM</span>
			</div>
			<div class="navbar-menu_box">
				<a href="/pokemart" class="menu-title">
					<img src="/vendor/img/pokemart.png">
					<span>Pokemart</span>
				</a>
				<div class="menu-list">
				   	<span>^^ Quá dễ thương, quá đẹp mua ngay</span>
				</div>
			</div>
			<div class="navbar-customer">
				<a href="/pokemart/SoftToy/SoftToy/LoadUserCartView" class="customer">
					<svg class="" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" class="svg-inline--fa fa-shopping-cart fa-w-18" role="img" viewBox="0 0 576 512"><path fill="currentColor" d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"/></svg>
				</a>
			<!-- 	<span class="cart_count">1</span> -->
				<?php if ($this->session->userdata('account')): ?>
					<span class="nameuser"><?php echo $this->session->userdata('account')['userName'];?></span>
					<a class="logout" href="/AccountAuthentic/LogOut">đăng xuất</a>
				<?php endif ?>
			</div>
		</div>
	</header>
	 <div class="container">
		<div class="container-contents grid wide" id="container-contents"> 
			<div class="box_product row no-gutters">
				<div class="product_inner col c-12">
					<div class="c-4 product_img_view">
						<img src="/uploads/product/<?php echo $productInfo['avatar'];?>">
					</div>
					<div class="c-8 product_info">
						<span class="product_info-id" hidden><?php echo $productInfo['id'];?></span>
						<span class="product_info-name">Tên sản phẩm: <?php echo $productInfo['name'];?></span>
						<span class="product_info-price">Giá: <?php echo number_format($productInfo['price'])?> vnđ</span>
						<span class="product_info-size">Size: <?php echo $productInfo['size'];?>cm</span>
						<span class="product_info-type">Loại: <?php echo $productInfo['typeName'];?></span>
						<span class="product_info-description">
							<?php echo $productInfo['description'];?>
						</span>
						<span class="product_info_buy">mua ngay</span>
					</div>
				</div>
				<div class="product_list_picture col c-12">
					<?php foreach ($arProductPicture as $key => $value): ?>
						<div class="picture_items c-1">
							<img src="/uploads/product/<?php echo $value['picture'];?>">
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
	<script>
		if (document.querySelector('.picture_items')) {
			document.querySelectorAll('.picture_items').forEach( function(element, index) {
				element.onclick = function(event) {
					var newSrc = element.querySelector('img').src;
					document.querySelector('.product_img_view img').src = newSrc;
				}
			});
		}
		document.querySelector('.product_info_buy').onclick = function(event) {
			var productID = this.parentElement.querySelector('.product_info-id').innerText;
			$.ajax({
				url: '/pokemart/SoftToy/SoftToy/InitOrderByUser/'+productID,
				type: 'POST',
				dataType: 'json',
			})
			.done(function(data) {
				if (data.status  == false) {
					alert(data.msg);
					window.open('/','_blank');
				}
				if (data.status  == true) {
					alert(data.msg);
					var parentElement = document.querySelector('.navbar-customer');
					var customer = parentElement.querySelector('.customer');
					var flag = false;
					for (value of parentElement.querySelector('.customer svg').classList) {
						if (value == "active") {
							flag = true;
						}
					}
					if (flag == false) {
						parentElement.querySelector('.customer svg').classList.add("active");
					}
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