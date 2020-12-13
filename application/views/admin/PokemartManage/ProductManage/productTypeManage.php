<table class="table table-product_type" id="table-product_type">
	<tr>
		<th>Mã Loại</th>
		<th>Tên Loại</th>
		<th>Trạng Thái</th>
		<th>Công Cụ</th>
	</tr>
	<?php foreach ($arProductType as $key => $value): ?>
		<tr class="box_type_product">
			<td class="edit_type_id"><?php echo $value['id']?></td>
			<td class="edit_type_name"><?php echo $value['typeName']?></td>
			<td class="edit_status">
				<span class="status-now">
					<?php if ($value['status']) {
						echo "Mở";
						}else {
							echo "Đóng";
						}
					?>
				</span>	
				<select class="edit_status_combobox" name="edit_status" id="">
					<option value="1">Mở</option>
					<option value="0">Đóng</option>
				</select>
			</td>
			<td>
				<span class="material-icons trash">delete</span>
				<span class="material-icons done">done</span>
				<span class="material-icons clear">clear</span>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<!-- Form Add -->
<form action="" class="form_insert-type_product" id="form_insert-type_product">
		<span class="formTitle">Thêm Loại Sản Phẩm</span>
		<div>
			<input class="form_insert-type_name" name="typeName" type="text" placeholder="tên loại">
			<select class="form_insert-status" name="status">
				<option value="1">Mở</option>
				<option value="0">Đóng</option>
			</select>
			<input class="form_insert-submit" type="submit" value="thêm">
			<button class="form_insert-cancel" type="text">hủy</button>
		</div>
</form>
<!-- End Form Add -->
<script>
	// Click sửa tên loại
	document.querySelectorAll('.edit_type_name').forEach( function(element, index) {
		element.ondblclick = function (event) {
			element.data_old = element.innerText;
			element.contentEditable = "true";
			var trash = element.parentElement.querySelector('.trash').classList;
			var done  = element.parentElement.querySelector('.done').classList;
			var clear  = element.parentElement.querySelector('.clear').classList;
			var flag = false;
			for (value of trash) {
				if (value == "unactive") {
					$flag = true;
				}
			}
			if (flag == false) {
				trash.add("unactive");
				done.add("active");
				clear.add("active");
			}	
		}
	});
	// Sửa combobox
	document.querySelectorAll('.edit_status').forEach( function(element, index) {
		element.ondblclick = function (event) {
			element.querySelector('.edit_status_combobox').classList.add('active');
			element.querySelector('.status-now').classList.add('unactive');
			var trash = element.parentElement.querySelector('.trash').classList;
			var done  = element.parentElement.querySelector('.done').classList;
			var clear  = element.parentElement.querySelector('.clear').classList;
			var flag = false;
			for (value of trash) {
				if (value == "unactive") {
					$flag = true;
				}
			}
			if (flag == false) {
				trash.add("unactive");
				done.add("active");
				clear.add("active");
			}
		}
	});
	// Chỉnh sửa lên database 
	document.querySelectorAll('.done').forEach( function(element, index) {
			element.onclick = function(event) {
			var parentElement = element.parentElement.parentElement;
			var edit_type_id = parentElement.querySelector('.edit_type_id');
			var edit_type_name = parentElement.querySelector('.edit_type_name');
			var edit_status_combobox = parentElement.querySelector('.edit_status_combobox');
			var edit_status = parentElement.querySelector('.edit_status');
			var trash = parentElement.querySelector('.trash');
			var done = parentElement.querySelector('.done');
			var clear = parentElement.querySelector('.clear');
			//edit_status_combobox
			$.ajax({
				url: 'admin/PokemartManage/ProductManage/ProductManage/UpdateProductTypeByID',
				type: 'POST',
				dataType: 'json',
				data: {
					typeName: edit_type_name.innerText,
					status: edit_status_combobox.value,
					typeID: edit_type_id.innerText,
			},
			})
			.done(function(data) {
				edit_type_name.innerText = data.typeName;
				edit_status.querySelector('.status-now').innerText = data.status == 1 ? 'Mở' : 'Đóng';

				if (edit_type_name.contentEditable == "true") {
					edit_type_name.contentEditable = "false";
				}

				for (value of edit_status.querySelector('.status-now').classList) {
					if (value == "unactive") {
						edit_status.querySelector('.status-now').classList.remove("unactive");
						edit_status.querySelector('.edit_status_combobox').classList.remove("active");
					}
				}

				done.classList.remove("active");
				clear.classList.remove("active");
				trash.classList.remove("unactive");

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			// back tools
		}
	});
	// Ấn Clear hủy quá trình update
	document.querySelectorAll('.clear').forEach( function(element, index) {
			element.onclick = function(event) {
			let parentElement = element.parentElement.parentElement;
			let edit_type_name = parentElement.querySelector('.edit_type_name');
			let edit_status = parentElement.querySelector('.edit_status');
			let trash = parentElement.querySelector('.trash');
			let done = parentElement.querySelector('.done');
			let clear = parentElement.querySelector('.clear');

			if (edit_type_name.contentEditable == "true") {
				edit_type_name.contentEditable = "false";
				edit_type_name.innerText = edit_type_name.data_old;
			}
			//edit_status_combobox
			for (value of edit_status.querySelector('.status-now').classList) {
				if (value == "unactive") {
					edit_status.querySelector('.status-now').classList.remove("unactive");
					edit_status.querySelector('.edit_status_combobox').classList.remove("active");
				}
			}
			// back tools
			done.classList.remove("active");
			clear.classList.remove("active");
			trash.classList.remove("unactive");
		}
	});
	// Xóa 
	document.querySelectorAll('.trash').forEach( function(element, index) {
		element.onclick = function (event) {
			$.ajax({
				url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProductTypeByID/'+element.parentElement.parentElement.querySelector('.edit_type_id').innerText,
				type: 'POST',
				dataType: 'json',
			})
			.done(function(data) {
				if (data.status) {
					element.parentElement.parentElement.remove();
				}
				else {
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
	});
	// Thêm Sever
	document.getElementById('form_insert-type_product').onsubmit = function(event) {
		event.preventDefault();
		let dataForm = new FormData(this);
		console.log('Thành Công Load');
		$.ajax({
			url: 'admin/PokemartManage/ProductManage/ProductManage/InserProductType',
			type: 'POST',
			dataType: 'json',
			processData: false,
			contentType: false,
			data: dataForm,
		})
		.done(function(data) {
			data.status = data.status == 1 ? 'Mở' : 'Đóng';
			var dataAppend = 
			`<tr class="box_type_product">
				<td class="edit_type_id">${data.id}</td>
				<td class="edit_type_name">${data.typeName}</td>
				<td class="edit_status">
					<span class="status-now">
						 ${data.status}
					</span>	
					<select class="edit_status_combobox" name="edit_status" id="">
						<option value="1">Mở</option>
						<option value="0">Đóng</option>
					</select>
				</td>
				<td>
					<span class="material-icons trash">delete</span>
					<span class="material-icons done">done</span>
					<span class="material-icons clear">clear</span>
				</td>
			</tr>
			`;
			$('#table-product_type').append(dataAppend);
			// Gắn sự kiện mở khung sửa combobox
			document.querySelector('tr:last-child .edit_status').ondblclick = function (event) {
				this.querySelector('.edit_status_combobox').classList.add('active');
				this.querySelector('.status-now').classList.add('unactive');
				var trash = this.parentElement.querySelector('.trash').classList;
				var done  = this.parentElement.querySelector('.done').classList;
				var clear  = this.parentElement.querySelector('.clear').classList;
				var flag = false;
				for (value of trash) {
					if (value == "unactive") {
						$flag = true;
					}
				}
				if (flag == false) {
					trash.add("unactive");
					done.add("active");
					clear.add("active");
				}
			}
			// gắn sự kiện sửa tên loại
			document.querySelector('tr:last-child .edit_type_name').ondblclick = function (event) {
				this.data_old = this.innerText;
				this.contentEditable = "true";
				var trash = this.parentElement.querySelector('.trash').classList;
				var done  = this.parentElement.querySelector('.done').classList;
				var clear  = this.parentElement.querySelector('.clear').classList;
				var flag = false;
				for (value of trash) {
					if (value == "unactive") {
						$flag = true;
					}
				}
				if (flag == false) {
					trash.add("unactive");
					done.add("active");
					clear.add("active");
				}	
			}
			// hoàn tác thay đổi
			document.querySelector('tr:last-child .clear').onclick = function(event) {
				let parentElement = this.parentElement.parentElement;
				let edit_type_name = parentElement.querySelector('.edit_type_name');
				let edit_status = parentElement.querySelector('.edit_status');
				let trash = parentElement.querySelector('.trash');
				let done = parentElement.querySelector('.done');
				let clear = parentElement.querySelector('.clear');

				if (edit_type_name.contentEditable == "true") {
					edit_type_name.contentEditable = "false";
					edit_type_name.innerText = edit_type_name.data_old;
				}
				//edit_status_combobox
				for (value of edit_status.querySelector('.status-now').classList) {
					if (value == "unactive") {
						edit_status.querySelector('.status-now').classList.remove("unactive");
						edit_status.querySelector('.edit_status_combobox').classList.remove("active");
					}
				}
				// back tools
				done.classList.remove("active");
				clear.classList.remove("active");
				trash.classList.remove("unactive");
			}
			// Cập nhật online database
			document.querySelector('tr:last-child .done').onclick = function(event) {
				console.log('1');
				var parentElement = this.parentElement.parentElement;
				var edit_type_id = parentElement.querySelector('.edit_type_id');
				var edit_type_name = parentElement.querySelector('.edit_type_name');
				var edit_status_combobox = parentElement.querySelector('.edit_status_combobox');
				var edit_status = parentElement.querySelector('.edit_status');
				var trash = parentElement.querySelector('.trash');
				var done = parentElement.querySelector('.done');
				var clear = parentElement.querySelector('.clear');
				//edit_status_combobox
				$.ajax({
					url: 'admin/PokemartManage/ProductManage/ProductManage/UpdateProductTypeByID',
					type: 'POST',
					dataType: 'json',
					data: {
						typeName: edit_type_name.innerText,
						status: edit_status_combobox.value,
						typeID: edit_type_id.innerText,
				},
				})
				.done(function(data) {
					edit_type_name.innerText = data.typeName;
					edit_status.querySelector('.status-now').innerText = data.status == 1 ? 'Mở' : 'Đóng';

					if (edit_type_name.contentEditable == "true") {
						edit_type_name.contentEditable = "false";
					}

					for (value of edit_status.querySelector('.status-now').classList) {
						if (value == "unactive") {
							edit_status.querySelector('.status-now').classList.remove("unactive");
							edit_status.querySelector('.edit_status_combobox').classList.remove("active");
						}
					}

					done.classList.remove("active");
					clear.classList.remove("active");
					trash.classList.remove("unactive");

				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				// back tools
			}
			// Thêm Ajax Xóa
			document.querySelector('tr:last-child .trash').onclick = function (event) {
				var root = document.querySelector('tr:last-child .trash').parentElement.parentElement.querySelector('.edit_type_id').innerText;
				var  parentElement = this.parentElement.parentElement;
				$.ajax({
					url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProductTypeByID/'+root,
					type: 'POST',
					dataType: 'json',
				})
				.done(function(data) {
					if (data.status) {
						parentElement.remove();
					}
					else {
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

			// End Ajax Xóa
			// Thêm Update

			// End update


		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
</script>