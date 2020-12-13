document.addEventListener('DOMContentLoaded',function () {
	document.getElementById('product_manage').onclick = function (event) {
		document.getElementById('order_manage').classList.remove("active");
		document.getElementById('container_inner-header').innerText = "";
		document.getElementById('container_inner-body').innerText = "";
		this.classList.add("active");
		$.ajax({
			url: 'admin/PokemartManage/ProductManage/ProductManage/LoadProductManage',
			type: 'POST',
			dataType: 'html',
		})
		.done(function(data) {
			$('#container_inner-header').append(data);
			// Load QL LOại Sản Phẩm Inner
			document.getElementById('btn-product_type').onclick = function (event) {
				var flag = false;
				// For bỏ hàm this
				if (document.getElementById('btn-product')) {
					var product = document.getElementById('btn-product');
					for (value of product.classList) {
						if (value == "active") {
							product.classList.remove("active");
							document.getElementById('container_inner-body').innerText = "";
						}
					}
				}
				// For gọi hàm this
				for (value of this.classList) {
					if (value == "active") {
						flag = true;
					}
				}
				if (flag == false) {
					this.classList.add("active");
					$.ajax({
						url: 'admin/PokemartManage/ProductManage/ProductManage/LoadProductManageItem',
						type: 'POST',
						dataType: 'html',
					})
					.done(function(data) {
						$('#container_inner-body').append(data);
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			}
			// Load Quản Lý Sản Phẩm inner
			document.getElementById('btn-product').onclick = function (event) {
				var flag = false;
				var productType = document.getElementById('btn-product_type');
				// For bỏ hàm this
				for (value of productType.classList) {
					if (value == "active") {
						productType.classList.remove("active");
						document.getElementById('container_inner-body').innerText = "";
					}
				}
				// For gọi hàm this
				for (value of this.classList) {
					if (value == "active") {
						flag = true;
					}
				}
				if (flag == false) {
					this.classList.add("active");
					$.ajax({
						url: 'admin/PokemartManage/ProductManage/ProductManage/LoadProductManageInner',
						type: 'POST',
						dataType: 'html',
					})
					.done(function(data) {
						$('#container_inner-body').append(data);
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
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
	document.getElementById('order_manage').onclick = function(event) {
		this.classList.add("active");
		document.getElementById('product_manage').classList.remove("active");
		document.getElementById('container_inner-header').innerText = "";
		document.getElementById('container_inner-body').innerText = "";
		$.ajax({
			url: '/admin/PokemartManage/OrderManage/OrderManage/LoadOrderManageView',
			type: 'POST',
			dataType: 'html',
		})
		.done(function(data) {
			$('#container_inner-header').append(data);
			// new
			document.getElementById('btn-check_order').onclick = function (event) {
				var flag = false;
				if (flag == false) {
					this.classList.add("active");
					$.ajax({
						url: 'admin/PokemartManage/OrderManage/OrderManage/LoadShowOrderManageItems',
						type: 'POST',
						dataType: 'html',
					})
					.done(function(data) {
						$('#container_inner-body').append(data);
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			}
			// end
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}
})