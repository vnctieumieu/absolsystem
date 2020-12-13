<div class="slidebar">
	<ul class="slidebar_menu">
		<li class="menu_items">
			<div class="menu_items-button">
				<img src="/vendor/img/pokemart.png">
				<span>Pokemart Manage</span>
			</div>
			<ul class="menu_child">
				<li id="product_manage" class="menu_child-items">Product Manage</li>
				<li id="order_manage" class="menu_child-items">Order Manage</li>
				<li class="menu_child-items"></li>
			</ul>
		</li>
	</ul>
</div>

<script>
	document.querySelectorAll('.menu_items-button').forEach( function(element, index) {
		element.onclick = function(event) {
			element.parentElement.querySelector('.menu_child').classList.add("active");
		}
	});
	// document.querySelectorAll('.menu_items-button.menu_items-single').forEach( function(element, index) {
	// 	element.onclick = function(event) {
	// 		element.classList.add("active");
	// 	} 
	// });
</script>