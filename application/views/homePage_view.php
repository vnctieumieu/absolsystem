<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Absol</title>
	<link rel="icon" href="/vendor/img/absol.png">
	<link rel="stylesheet" href="/vendor/css/grid.css">
	<link rel="stylesheet" href="/vendor/css/homePage.css">
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<?php include 'template/navbar.php' ?>
	<div class="container">
		<div class="container_header grid wide">
			<span hidden class="idvideo"><?php echo $homePageVideo['id'];?></span>
			<iframe src="https://www.youtube.com/embed/<?php echo $homePageVideo['code'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			<svg class="editvideo-pencil" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pencil-alt" class="svg-inline--fa fa-pencil-alt fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"/></svg>
		</div>
		<div class="container_body grid wide">
			<h1 class="body-title">Tin nổi bật trong tuần</h1>
			<div class="body-box_content row no-gutters">
				<?php foreach ($homePagePoster as $key => $value): ?>
					<div class="col c-12 m-6">
						<div class="contents">
							<span hidden class="contents-id"><?php echo $value['id'];?></span>
							<span class="contents_title"><?php echo $value['title'];?>
								<svg class="edit-pencil" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pencil-alt" class="svg-inline--fa fa-pencil-alt fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"/></svg>
							</span>
							<span class="contents_time"> <span>Ngày đăng:</span><?php echo date("d/m/Y",$value['datepost'])?></span>
							<span class="contents_content"><?php echo $value['content'];?>
							</span>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div class="box-form_edit">
		<form action="" class="form_edit">
			<input type="text" hidden name="hidden_id" class="hidden_id">
			<input class="edit-title" name="edit-title" type="text">
			<div class="edit-content">
				<textarea name="edit-content" id="editor1"></textarea>
			</div>
			<div class="edit-submit">
				<input class="edit-finish" name="edit-finish" type="submit" value="Hoàn Tất">
				<button type="button" class="cancel-edit">Hủy</button>>
			</div>
		</form>
	</div>
	<div class="box-form_edit-video">
		<form action="" class="form_edit_video">
			<input class="youtubecode" name="youtubecode" type="text">
			<input hidden class="hiddenid" name="hiddenid" type="text">
			<div class="edit_video-submit">
				<input class="edit_video-finish" name="edit-finish" type="submit" value="Hoàn Tất">
				<button type="button" class="cancel_video-edit">Hủy</button>
			</div>
		</form>
	</div>


	<?php include 'template/footer.php' ?>

	<script src="/vendor/js/jquery-3.5.1.min.js"></script>
	
	<?php if ($this->session->userdata('account') && $this->session->userdata('account')['isAdmin'] == 1 ): ?>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Thêm nút sửa lại video
				var editvideo = document.querySelector('.editvideo-pencil');
				editvideo.classList.add("active");
				editvideo.onclick = function () {
					var parentElement = document.querySelector('.box-form_edit-video');
					parentElement.classList.add("active");
					var a = document.querySelector('.container_header iframe').src;
					var b =  a.substr(30);
					var id = document.querySelector('.container_header .idvideo').innerText;
					parentElement.querySelector('.form_edit_video .youtubecode').value = b;
					parentElement.querySelector('.form_edit_video .hiddenid').value = id;
				}
				document.querySelector('.form_edit_video').onsubmit = function (event) {
					event.preventDefault();
					let formData = new FormData(this);
					$.ajax({
						url: '/Index/UpdateHomePageVideo',
						type: 'POST',
						dataType: 'json',
						processData: false,
						contentType: false,
						data: formData,
					})
					.done(function(data) {
						alert("Thành Công");
						location.reload();
					})
					.fail(function() {
						alert("Thất Bại");
						location.reload();
					})
					.always(function() {
						console.log("complete");
					});
					
				}
				document.querySelector('.cancel_video-edit').onclick = function () {
					this.parentElement.parentElement.parentElement.classList.remove("active");
				}
				// Thêm nút sửa lại 4 form và gán sự kiện
				document.querySelectorAll('.edit-pencil').forEach( function(element, index) {
					element.classList.add("active");
					element.onclick = function () {
						var parentElement = document.querySelector('.box-form_edit');
						parentElement.classList.add("active");
						var value_title = this.parentElement.innerText;
						var value_content = this.parentElement.parentElement.querySelector('.contents_content').innerHTML;
						var value_id = this.parentElement.parentElement.querySelector('.contents-id').innerText;
						parentElement.querySelector('.form_edit').querySelector('.edit-title').value = value_title;
						parentElement.querySelector('.form_edit').querySelector('.hidden_id').value = value_id;
						CKEDITOR.instances.editor1.setData(value_content);
					}
				});
				document.querySelector('.cancel-edit').onclick = function () {
					this.parentElement.parentElement.parentElement.classList.remove("active");
				}
				document.querySelector('.form_edit').onsubmit = function (event) {
					event.preventDefault();
					let dataForm = new FormData(this);
					// dataForm.append(name, value, file)
					dataForm.append('edit-content', CKEDITOR.instances.editor1.getData());
					$.ajax({
						url: '/Index/UpdateHomePagePoster',
						type: 'POST',
						dataType: 'json',
						processData: false,
						contentType: false,
						data: dataForm,
					})
					.done(function(data) {
						alert("Update Thành Công");
						location.reload();
					})
					.fail(function() {
						alert("Update Thất Bại");
						location.reload();
					})
					.always(function() {
						console.log("complete");
					});
					
				}
			})
		</script>
	<?php endif ?>


	<script>
		CKEDITOR.replace( 'editor1', {
    			filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    			filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
		} );
	</script>
</body>
</html>

