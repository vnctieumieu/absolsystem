
<form action="" id="form_fillter_product" class="form_fillter_product" method="post">
	<select name="id_product_type">
		<?php foreach ($arProductType as $key => $value): ?>
			<option value="<?php echo $value['id']?>"><?php echo $value['typeName']?></option>
		<?php endforeach ?>
	</select>
	<input type="submit" value="lọc">
</form>
<script>
	document.getElementById('form_fillter_product').onsubmit = function (event) {
		event.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: 'admin/PokemartManage/ProductManage/ProductManage/LoadProductByType',
			type: 'POST',
			dataType: 'html',
			processData: false,
			contentType: false,
			data: formData,
		})
		.done(function(data) {
			if (document.getElementById('product_table')) {
				document.getElementById('product_table').remove();
			}
			if (document.getElementById('add')) {
				document.getElementById('add').remove();
			}
			if (document.getElementById('add_product_form')) {
				document.getElementById('add_product_form').remove();
			}
			$('#container_inner-body').append(data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
</script>