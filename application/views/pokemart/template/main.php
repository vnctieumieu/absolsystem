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
</head>
<body>	
	<?php
	 	if ($arProductType) {
	 		include 'navbar.php';
	 	}
	 	else {
	 		echo "Load Dữ Liệu Thất Bại";
	 	}
	 ?>
	<div class="container">
		<div class="container-contents grid wide" id="container-contents">
			<!-- Star -->
			<!-- search -->
			<form class="content-form_search" id="content-form_search" method="post">
				<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
				<input class="info_search" name="info_search" type="text" placeholder="tên vật phẩm">
				<button>tìm kiếm</button>
			</form>
			<!-- end search -->
			<!-- Content -->

			<!-- end Content -->
			<!-- End -->
		</div>
	</div>
	<script>
		document.getElementById('content-form_search').onsubmit = function(event) {
			event.preventDefault();
			$infoSearch = this.querySelector('.info_search').value;
			$.ajax({
				url: '/pokemart/SoftToy/SoftToy/LoadViewSoftToySearch',
				type: 'POST',
				dataType: 'html',
				data: {
					infoSearch: $infoSearch,
				},
			})
			.done(function(data) {
				if (document.querySelector('.box-show_thubong')) {
					document.querySelector('.box-show_thubong').remove();
				}
				$('#container-contents').append(data);
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
</html