<div class="box-show_thubong row no-gutters">
	<?php foreach ($arProduct as $key => $value): ?>
		<div class="col c-12 m-4 l-3 l-5nam">
			<div class="thubong">
				<img  class="thubong-img" src="/uploads/product/<?php echo $value['avatar'];?>">
				<span class="thubong-id" hidden><?php echo $value['id']?></span>
				<a href="pokemart/SoftToy/SoftToy/ProductDetail/<?php echo $value['id']?>" target = "_ blank" class="thubong-name"><?php echo $value['name'] ?></a>
				<div class="thubong-price">
					<span class="thubong-oldprice">size: <?php echo $value['size']?>cm</span>
					<span class="thubong-nowprice"><?php echo number_format($value['price']);?> vnđ</span>
				</div>
				<div class="thubong-discount">
					<span class="discount-value">40%</span>
					<span class="discount-status">Giảm</span>
				</div>
				<div class="thubong-love <?php if($value['itemsLove']){echo "active";}?>">
					<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"/></svg>
					<span class="love-status">yêu thích</span>
				</div>
				<div class="thubong-cart">
					<button class="addcart">thêm</button>
					<button class="cancelcart">hủy</button>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
<script>
	if (document.querySelectorAll('.addcart')) {
		var addcart = document.querySelectorAll('.addcart').forEach( function(element, index) {
			element.onclick = function(event) {
				var parentElement = element.parentElement.parentElement;
				var productID = parentElement.querySelector('.thubong-id').innerText;
				$.ajax({
					url: 'pokemart/SoftToy/SoftToy/InitOrderByUser/'+productID,
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
		});
	}
</script>