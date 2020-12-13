<?php if (isset($arProduct)): ?>
	<?php if ($arProduct): ?>
		<table class="product_table" id="product_table">
			<tr>
				<th>Mã Sản Phẩm</th>
				<th>Tên Sản Phẩm</th>
				<th>Giá Sản Phẩm VNĐ</th>
				<th>Size(cm)</th>
				<th>Yêu thích Yes/No</th>
				<th>Trạng Thái Yes/No</th>
				<th>Album Hình</th>
				<th>Mô Tả</th>
			</tr>
			<?php foreach ($arProduct as $key => $value): ?>
				<tr class="product">
					<td class="id_product">
						<?php echo $value['id'];?>
					</td>
					<td class="name_product">
						<?php echo $value['name'];?>
					</td>
					<td class="price_product">
						<?php echo $value['price'];?>
					</td>
					<td class="size_product">
						<?php echo $value['size'];?>
					</td>
					<td class="items_Love">
						<?php 
							if ($value['itemsLove'] == true)
								echo "Y";
							else
								echo "N";
						 ?>
						
					</td>
					<td class="status">
						<?php 
							if ($value['status'] == true)
								echo "Y";
							else
								echo "N";
						 ?>
					</td>
					<td>	
						<span class="material-icons btn-icon picture_albume">photo_library</span>
					</td>
					<td>
						<span class="material-icons btn-icon description">more_horiz</span>
					</td>
					<td>
						<span class="material-icons btn-icon trash">delete</span>
						<span class="material-icons btn-icon done">done</span>
						<span class="material-icons btn-icon clear">clear</span>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
		<?php else: ?>
			<table class="product_table" id="product_table">
				<tr>
					<th>Mã Sản Phẩm</th>
					<th>Tên Sản Phẩm</th>
					<th>Giá Sản Phẩm VNĐ</th>
					<th>Size(cm)</th>
					<th>Yêu thích(Yes/No)</th>
					<th>Trạng Thái(Yes/No)</th>
					<th>Album Hình</th>
					<th>Mô Tả</th>
				</tr>
			</table>
	<?php endif ?>
	<span id="add" class="material-icons add">add</span>
	<div class="overlay"></div>
	<form action="" id="add_product_form" class="add_product_form" method="post">
		<Span>Thêm Sản Phẩm</Span>
		<input name="name" type="text" placeholder="tên sản phẩm">
		<input name="price" type="text" placeholder="giá sản phẩm">
		<input name="size" type="text" placeholder="kích thước (cm)">
		<input name="typeCode" hidden type="text" value="<?php echo $idTypeProduct;?>">
		<input type="submit" value="thêm">
	</form>
	<div class="update-description">
		<span class="description-title">Cập Nhật Mô Tả</span>
		<textarea name="" id="" class="description-textarea" cols="40" rows="10"></textarea>
		<input type="submit" class="description-btn" value="xác nhận">
	</div>
	<div class="update-picture">
		<span class="update-picture-title">Sản Phẩm: Charmander</span>
		<table class="table_picture" id="table_picture">
			<!-- <tr>	
				<th>STT</th>
				<th>Ảnh</th>
			</tr> -->
			<!-- <tr>
				<td><img src="/uploads/product/1.jpg"></td>
				<td><span class="material-icons btn-icon trash">delete</span></td>
			</tr> -->
		</table>
		<form action="" class="form_insert-picture" id="form_insert-picture" method="post" enctype="multipart/form-data">
			<span class="form_insert-picture-title">thêm ảnh mới</span>
			<input name="select-picture" class="select-picture" type="file">
			<input class="submit-insert" type="submit" value="thêm">
		</form>
	</div>
	<script>
		// Tạo trình quản lý hình
		document.querySelectorAll('.picture_albume').forEach( function(element, index) {
			var parentElement =  element.parentElement.parentElement;
			var productID = parentElement.querySelector('.id_product').innerText;
			var productName = parentElement.querySelector('.name_product').innerText;
			var toolsPicture = document.querySelector('.update-picture');
			var overlay = document.querySelector('.overlay');
			var insertPicture = document.getElementById('form_insert-picture');
			var stt = 1;
			element.onclick = function(event) {
				// hiện trình quản lý ảnh
				toolsPicture.querySelector('.update-picture-title').innerText = "sản phẩm: "+productName;
				overlay.classList.add("active");
				toolsPicture.classList.add("active");
				// lấy ảnh và xử lý
				$.ajax({
					url: 'admin/PokemartManage/ProductManage/ProductManage/GetProductPictureByID/'+productID,
					type: 'POST',
					dataType: 'json',
				})
				.done(function(data) {
					stt = 1;
					var thtdHTML = `
						<tr>	
							<th>STT</th>
							<th>Ảnh</th>
						</tr>
					`;
					$('#table_picture').append(thtdHTML);
					data.forEach( function(element, index) {
						var html = `
							<tr class = "picture">
								<td>${stt++}</td>
								<td><img src="/uploads/product/${element['picture']}"></td>
								<td><span class="material-icons btn-icon trash">delete</span></td>
							</tr>
						`;
						$('#table_picture').append(html);
					});

					// Thêm ảnh
					insertPicture.onsubmit = function(event) {
						event.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url: 'admin/PokemartManage/ProductManage/ProductManage/InsertPictureProduct/'+productID,
							type: 'POST',
							dataType: 'json',
							processData: false,
							contentType: false,
							data: formData, 
						})
						.done(function(data) {
							var html = `
								<tr>
									<td>${stt++}</td>
									<td><img src="/uploads/product/${data.picture}"></td>
									<td><span class="material-icons btn-icon trash">delete</span></td>
								</tr>
							`;
							$('#table_picture').append(html);
							// gắn sự kiện xóa
							document.querySelector('.table_picture tr:last-child .trash').onclick = function(event) {
								var nameFileMini = document.querySelector('.table_picture tr:last-child img').src;
								$.ajax({
									url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProductPictureByName/'+nameFileMini.substr(33),
									type: 'POST',
									dataType: 'json',
								})
								.done(function(data) {
									document.querySelector('.table_picture tr:last-child').remove();
								})
								.fail(function() {
									console.log("error");
								})
								.always(function() {
									console.log("complete");
								});
							}
							//End Xóa ảnh
						})
						.fail(function() {
							console.log("error");
						})
						.always(function() {
							console.log("complete");
						});
					}
					// Xóa ảnh
					document.querySelectorAll('.picture').forEach( function(element, index) {
						element.querySelector('.trash').onclick = function(event) {
							var nameFile = element.querySelector('img').src;
							$.ajax({
								url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProductPictureByName/'+nameFile.substr(nameFile.lastIndexOf("/")+1),
								type: 'POST',
								dataType: 'json',
							})
							.done(function(data) {
								element.remove();
							})
							.fail(function() {
								console.log("error");
							})
							.always(function() {
								console.log("complete");
							});
						}
					});
					// End done
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
		});
		// Tạo trình thêm nội dung.
		document.querySelectorAll('.description').forEach( function(element, index) {
			element.onclick = function(event) {
				var parentElement = element.parentElement.parentElement;
				var id_product = parentElement.querySelector('.id_product').innerText;
				document.querySelector('.overlay').classList.add("active");
				document.querySelector('.update-description').classList.add("active");
				var textarea = document.querySelector('.update-description .description-textarea');
				var textareaBTN = document.querySelector('.update-description .description-btn');
				var thisBTN = document.querySelector('.update-description');
				// lấy mô tả gốc
				$.ajax({
					url: 'admin/PokemartManage/ProductManage/ProductManage/GetDescriptionProduct/'+id_product,
					type: 'POST',
					dataType: 'json',
				})
				.done(function(data) {
					textarea.value = data.description;
					// AJax update
					textareaBTN.onclick = function(event) {
						event.preventDefault();
						$.ajax({
							url: 'admin/PokemartManage/ProductManage/ProductManage/UpdateDescription/'+id_product,
							type: 'POST',
							dataType: 'json',
							data: {
								strDescription: textarea.value,
							},
						})
						.done(function(data) {
							if (data.status) {
								alert(data.msg);
								document.querySelector('.overlay').classList.remove("active");
								thisBTN.classList.remove("active");
							}else {
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
					// End Ajax update
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				// end lấy mô tả gốc
			}
		});
		// Tạo edit content trực tiếp
		document.querySelectorAll('.name_product').forEach( function(element, index) {
			element.ondblclick = function (event) {
				var old_data = element.innerText; 
				element.old_data = old_data;
				element.contentEditable = "true";
			}
		});
		document.querySelectorAll('.price_product').forEach( function(element, index) {
			element.ondblclick = function (event) {
				var old_data = element.innerText; 
				element.old_data = old_data;
				element.contentEditable = "true";
			} 
		});
		document.querySelectorAll('.size_product').forEach( function(element, index) {
			element.ondblclick = function (event) {
				var old_data = element.innerText; 
				element.old_data = old_data;
				element.contentEditable = "true";
			} 
		});
		document.querySelectorAll('.items_Love').forEach( function(element, index) {
			element.ondblclick = function (event) {
				var old_data = element.innerText; 
				element.old_data = old_data;
				element.contentEditable = "true";
			} 
		});
		document.querySelectorAll('.status').forEach( function(element, index) {
			element.ondblclick = function (event) {
				var old_data = element.innerText; 
				element.old_data = old_data;
				element.contentEditable = "true";
			} 
		});
		// Hiện trình sửa chữa
		document.querySelectorAll('.product').forEach( function(element, index) {
			element.onclick = function (event) {
				var id_product = element.querySelector('.id_product').innerText;
				var name_product = element.querySelector('.name_product');
				var price_product = element.querySelector('.price_product');
				var size_product = element.querySelector('.size_product');
				var items_Love = element.querySelector('.items_Love');
				var status = element.querySelector('.status');
				var trash = element.querySelector('.trash');
				var done = element.querySelector('.done');
				var clear = element.querySelector('.clear');
				if (name_product.contentEditable == "true" || price_product.contentEditable == "true" || size_product.contentEditable == "true" || items_Love.contentEditable == "true" || status.contentEditable == "true") {
					trash.classList.add('unactive');
					done.classList.add('active');
					clear.classList.add('active');
				}
			}
		});
		// Hoàn tác or update
		document.querySelectorAll('.product').forEach( function(element, index) {
				var id_product = element.querySelector('.id_product').innerText;
				var name_product = element.querySelector('.name_product');
				var price_product = element.querySelector('.price_product');
				var size_product = element.querySelector('.size_product');
				var items_Love = element.querySelector('.items_Love');
				var status = element.querySelector('.status');
				var trash = element.querySelector('.trash');
				var done = element.querySelector('.done');
				var clear = element.querySelector('.clear');
			clear.onclick = function(event) {
				if (name_product.old_data) {
					name_product.innerText = name_product.old_data;
					name_product.contentEditable = "false";
				}
				if (price_product.old_data) {
					price_product.innerText = price_product.old_data;
					price_product.contentEditable = "false";
				}
				if (size_product.old_data) {
					size_product.innerText = size_product.old_data;
					size_product.contentEditable = "false";
				}
				if (items_Love.old_data) {
					items_Love.innerText = items_Love.old_data;
					items_Love.contentEditable = "false";
				}
				if (status.old_data) {
					status.innerText = status.old_data;
					status.contentEditable = "false";
				}
				trash.classList.remove("unactive");
				done.classList.remove("active");
				clear.classList.remove("active");
			}
			done.onclick = function(event) {
				$.ajax({
					url: 'admin/PokemartManage/ProductManage/ProductManage/UpdateProduct/'+id_product,
					type: 'POST',
					dataType: 'json',
					data:{
						name: name_product.innerText,
						price: price_product.innerText,
						items_Love: items_Love.innerText,
						size_product: size_product.innerText,
						status: status.innerText
					},
				})
				.done(function(data) {
					if (data.statusJS) {
						name_product.innerText = data.name;
						price_product.innerText = data.price;
						size_product.innerText = data.size;

						if (data.itemsLove==1) {
							items_Love.innerText = "Y";
						}else
							items_Love.innerText = "N";

						if (data.status==0) {
							status.innerText = "N";
						}else
							status.innerText = "Y";

						trash.classList.remove("unactive");
						done.classList.remove("active");
						clear.classList.remove("active");
					}else {
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
		// Xuất hiện khung thêm sản phẩm
		document.querySelector('.add').onclick = function (event) {
			document.querySelector('.overlay').classList.add("active");
			document.querySelector('.add_product_form').classList.add("active");
		}
		// Thu lại khungg thêm sản phẩm & description
		document.querySelector('.overlay').onclick = function (event) {
			document.querySelector('.overlay').classList.remove("active");
			document.querySelector('.add_product_form').classList.remove("active");
			var description = document.querySelector('.update-description');
			var updatePicture = document.querySelector('.update-picture');
			var innerTable = document.getElementById('table_picture');
			for (value of description.classList) {
				if (value == "active") {
					description.classList.remove("active");
				}
			}

			for (value of updatePicture.classList) {
				if (value == "active") {
					updatePicture.classList.remove("active");
				}
			}

			if (innerTable.innerText != "") {
				innerTable.innerText = "";
			}
		}
		// Xóa sản phẩm
		document.querySelectorAll('.trash').forEach( function(element, index) {
			element.onclick = function (event) {
				var parentElement = element.parentElement.parentElement;
				$.ajax({
					url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProduct/'+parentElement.querySelector('.id_product').innerText,
					type: 'POST',
					dataType: 'json',
				})
				.done(function(data) {
					parentElement.remove();
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});	
			}
		});
		// Thêm sản phẩm theo loại đang follow
		document.getElementById('add_product_form').onsubmit = function (event) {
			event.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: 'admin/PokemartManage/ProductManage/ProductManage/InsertProduct',
				type: 'POST',
				dataType: 'json',
				processData: false,
				contentType: false,
				data: formData,
			})
			.done(function(data) {
				var html =`
					<tr class="product">
						<td class="id_product">
							${data.id}
						</td>
						<td class="name_product">
							${data.name}
						</td>
						<td class="price_product">
							${data.price}
						</td>
						<td class="size_product">
							${data.size}
						</td>
						<td class="items_Love">
							N
						</td>
						<td class="status">
							Y
						</td>
						<td>	
							<span class="material-icons btn-icon picture_albume">photo_library</span>
						</td>
						<td>
							<span class="material-icons btn-icon description">more_horiz</span>
						</td>
						<td>
							<span class="material-icons btn-icon trash">delete</span>
							<span class="material-icons btn-icon done">done</span>
							<span class="material-icons btn-icon clear">clear</span>
						</td>
					</tr>
					`;
				$('#product_table tbody').append(html);
				document.querySelector('.overlay').classList.remove("active");
				document.querySelector('.add_product_form').classList.remove("active");
				// gắn sự kiện xóa cho sp mới
				document.querySelector('.product:last-child .trash').onclick = function (event) {
					var parentElement = this.parentElement.parentElement;
					$.ajax({
						url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProduct/'+parentElement.querySelector('.id_product').innerText,
						type: 'POST',
						dataType: 'json',
					})
					.done(function(data) {
						parentElement.remove();
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});	
				}
				// Tạo trình quản lý hình
				document.querySelector('.product:last-child .picture_albume').onclick = function(event) {
					var parentElement =  this.parentElement.parentElement;
					var productID = parentElement.querySelector('.id_product').innerText;
					var productName = parentElement.querySelector('.name_product').innerText;
					var toolsPicture = document.querySelector('.update-picture');
					var overlay = document.querySelector('.overlay');
					var insertPicture = document.getElementById('form_insert-picture');
					var stt = 1;
					// hiện trình quản lý ảnh
					toolsPicture.querySelector('.update-picture-title').innerText = "sản phẩm: "+productName;
					overlay.classList.add("active");
					toolsPicture.classList.add("active");
					// lấy ảnh và xử lý
					$.ajax({
						url: 'admin/PokemartManage/ProductManage/ProductManage/GetProductPictureByID/'+productID,
						type: 'POST',
						dataType: 'json',
					})
					.done(function(data) {
						stt = 1;
						var thtdHTML = `
							<tr>	
								<th>STT</th>
								<th>Ảnh</th>
							</tr>
						`;
						$('#table_picture').append(thtdHTML);
						data.forEach( function(element, index) {
							var html = `
								<tr class = "picture">
									<td>${stt++}</td>
									<td><img src="/uploads/product/${element['picture']}"></td>
									<td><span class="material-icons btn-icon trash">delete</span></td>
								</tr>
							`;
							$('#table_picture').append(html);
						});

						// Thêm ảnh
						insertPicture.onsubmit = function(event) {
							event.preventDefault();
							var formData = new FormData(this);
							$.ajax({
								url: 'admin/PokemartManage/ProductManage/ProductManage/InsertPictureProduct/'+productID,
								type: 'POST',
								dataType: 'json',
								processData: false,
								contentType: false,
								data: formData, 
							})
							.done(function(data) {
								var html = `
									<tr>
										<td>${stt++}</td>
										<td><img src="/uploads/product/${data.picture}"></td>
										<td><span class="material-icons btn-icon trash">delete</span></td>
									</tr>
								`;
								$('#table_picture').append(html);
								// gắn sự kiện xóa
								document.querySelector('.table_picture tr:last-child .trash').onclick = function(event) {
									var nameFileMini = document.querySelector('.table_picture tr:last-child img').src;
									$.ajax({
										url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProductPictureByName/'+nameFileMini.substr(33),
										type: 'POST',
										dataType: 'json',
									})
									.done(function(data) {
										document.querySelector('.table_picture tr:last-child').remove();
									})
									.fail(function() {
										console.log("error");
									})
									.always(function() {
										console.log("complete");
									});
								}
								//End Xóa ảnh
							})
							.fail(function() {
								console.log("error");
							})
							.always(function() {
								console.log("complete");
							});
						}
						// Xóa ảnh
						document.querySelectorAll('.picture').forEach( function(element, index) {
							element.querySelector('.trash').onclick = function(event) {
								var nameFile = element.querySelector('img').src;
								$.ajax({
									url: 'admin/PokemartManage/ProductManage/ProductManage/DeleteProductPictureByName/'+nameFile.substr(33),
									type: 'POST',
									dataType: 'json',
								})
								.done(function(data) {
									element.remove();
								})
								.fail(function() {
									console.log("error");
								})
								.always(function() {
									console.log("complete");
								});
							}
						});
						// End done
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
				//Tạo edit content trực tiếp
				document.querySelector('tr:last-child .name_product').ondblclick = function (event) {
					console.log('1');
					var old_data = this.innerText; 
					this.old_data = old_data;
					this.contentEditable = "true";
				}
				document.querySelector('tr:last-child .price_product').ondblclick = function (event) {
					var old_data = this.innerText; 
					this.old_data = old_data;
					this.contentEditable = "true";
				} 	
				document.querySelector('tr:last-child .size_product').ondblclick = function (event) {
					var old_data = this.innerText; 
					this.old_data = old_data;
					this.contentEditable = "true";
				}
				document.querySelector('tr:last-child .items_Love').ondblclick = function (event) {
					var old_data = this.innerText; 
					this.old_data = old_data;
					this.contentEditable = "true";
				} 
				document.querySelector('tr:last-child .status').ondblclick = function (event) {
					var old_data = this.innerText; 
					this.old_data = old_data;
					this.contentEditable = "true";
				} 
				// Hiện Trình Sữa Chữa
				document.querySelector('.product:last-child').onclick = function (event) {
					var id_product = this.querySelector('.id_product').innerText;
					var name_product = this.querySelector('.name_product');
					var price_product = this.querySelector('.price_product');
					var size_product = this.querySelector('.size_product');
					var items_Love = this.querySelector('.items_Love');
					var status = this.querySelector('.status');
					var trash = this.querySelector('.trash');
					var done = this.querySelector('.done');
					var clear = this.querySelector('.clear');
					if (name_product.contentEditable == "true" || price_product.contentEditable == "true" || size_product.contentEditable == "true" || items_Love.contentEditable == "true" || status.contentEditable == "true") {
						trash.classList.add('unactive');
						done.classList.add('active');
						clear.classList.add('active');
					}
				}
				// Tạo trình thêm nội dung
				document.querySelector('.product:last-child .description').onclick = function(event) {
					var parentElement = this.parentElement.parentElement;
					var id_product = parentElement.querySelector('.id_product').innerText;
					document.querySelector('.overlay').classList.add("active");
					document.querySelector('.update-description').classList.add("active");
					var textarea = document.querySelector('.update-description .description-textarea');
					var textareaBTN = document.querySelector('.update-description .description-btn');
					var thisBTN = document.querySelector('.update-description');
					// lấy mô tả gốc
					$.ajax({
						url: 'admin/PokemartManage/ProductManage/ProductManage/GetDescriptionProduct/'+id_product,
						type: 'POST',
						dataType: 'json',
					})
					.done(function(data) {
						textarea.value = data.description;
						// AJax update
						textareaBTN.onclick = function(event) {
							event.preventDefault();
							$.ajax({
								url: 'admin/PokemartManage/ProductManage/ProductManage/UpdateDescription/'+id_product,
								type: 'POST',
								dataType: 'json',
								data: {
									strDescription: textarea.value,
								},
							})
							.done(function(data) {
								if (data.status) {
									alert(data.msg);
									document.querySelector('.overlay').classList.remove("active");
									thisBTN.classList.remove("active");
								}else {
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
						// End Ajax update
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
					// end lấy mô tả gốc
				}
				// Hoàn tác or update
				var prThis = document.querySelector('.product:last-child');
					var id_product = prThis.querySelector('.id_product').innerText;
					var name_product = prThis.querySelector('.name_product');
					var price_product = prThis.querySelector('.price_product');
					var size_product = prThis.querySelector('.size_product');
					var items_Love = prThis.querySelector('.items_Love');
					var status = prThis.querySelector('.status');
					var trash = prThis.querySelector('.trash');
					var done = prThis.querySelector('.done');
					var clear = prThis.querySelector('.clear');
				clear.onclick = function(event) {
					if (name_product.old_data) {
						name_product.innerText = name_product.old_data;
						name_product.contentEditable = "false";
					}
					if (price_product.old_data) {
						price_product.innerText = price_product.old_data;
						price_product.contentEditable = "false";
					}
					if (size_product.old_data) {
						size_product.innerText = size_product.old_data;
						size_product.contentEditable = "false";
					}
					if (items_Love.old_data) {
						items_Love.innerText = items_Love.old_data;
						items_Love.contentEditable = "false";
					}
					if (status.old_data) {
						status.innerText = status.old_data;
						status.contentEditable = "false";
					}
					trash.classList.remove("unactive");
					done.classList.remove("active");
					clear.classList.remove("active");
				}
				done.onclick = function(event) {
					console.log('1');
					$.ajax({
						url: 'admin/PokemartManage/ProductManage/ProductManage/UpdateProduct/'+id_product,
						type: 'POST',
						dataType: 'json',
						data:{
							name: name_product.innerText,
							price: price_product.innerText,
							items_Love: items_Love.innerText,
							size_product: size_product.innerText,
							status: status.innerText
						},
					})
					.done(function(data) {
						if (data.statusJS == true) {
							name_product.innerText = data.name;
							price_product.innerText = data.price;
							size_product.innerText = data.size;
							
							if (data.itemsLove== 1) {
								items_Love.innerText = "Y";
							}else
								items_Love.innerText = "N";

							if (data.status== 0) {
								status.innerText = "N";
							}else
								status.innerText = "Y";
							trash.classList.remove("unactive");
							done.classList.remove("active");
							clear.classList.remove("active");
						}
						if (data.statusJS == false) {
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
				//End
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});			
		}
	</script>
<?php endif ?>
