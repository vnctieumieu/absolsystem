<header>
	<div class="header_navbar grid wide ">
		<a href="/" class="navbar_logo">
			<img src="/vendor/img/absol.png">
		</a>
		<div class="navbar_menu">
			<a href="" class="menu_items support_pokemonrevolution">
				<img src="/vendor/img/pokemonball.png">
				<span>HỖ TRỢ POKEMON REVOLUTION</span>
			</a>
			<a href="/pokemart" class="menu_items">
				<img src="/vendor/img/pokemart.png">
				<span>CỬA HÀNG POKEMON</span>
			</a>
		</div>
		<div class="navbar_icons-link">
			<!-- Facebook -->
			<a target="_blank" class="link_socioal" href="https://www.facebook.com/groups/pichueastersilver">
				<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" class="svg-inline--fa fa-facebook fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
			</a>
			<!-- Discord -->
			<a target="_blank" class="link_socioal" href="https://discord.gg/gT2P2BCxQv">
				<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="discord" class="svg-inline--fa fa-discord fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M297.216 243.2c0 15.616-11.52 28.416-26.112 28.416-14.336 0-26.112-12.8-26.112-28.416s11.52-28.416 26.112-28.416c14.592 0 26.112 12.8 26.112 28.416zm-119.552-28.416c-14.592 0-26.112 12.8-26.112 28.416s11.776 28.416 26.112 28.416c14.592 0 26.112-12.8 26.112-28.416.256-15.616-11.52-28.416-26.112-28.416zM448 52.736V512c-64.494-56.994-43.868-38.128-118.784-107.776l13.568 47.36H52.48C23.552 451.584 0 428.032 0 398.848V52.736C0 23.552 23.552 0 52.48 0h343.04C424.448 0 448 23.552 448 52.736zm-72.96 242.688c0-82.432-36.864-149.248-36.864-149.248-36.864-27.648-71.936-26.88-71.936-26.88l-3.584 4.096c43.52 13.312 63.744 32.512 63.744 32.512-60.811-33.329-132.244-33.335-191.232-7.424-9.472 4.352-15.104 7.424-15.104 7.424s21.248-20.224 67.328-33.536l-2.56-3.072s-35.072-.768-71.936 26.88c0 0-36.864 66.816-36.864 149.248 0 0 21.504 37.12 78.08 38.912 0 0 9.472-11.52 17.152-21.248-32.512-9.728-44.8-30.208-44.8-30.208 3.766 2.636 9.976 6.053 10.496 6.4 43.21 24.198 104.588 32.126 159.744 8.96 8.96-3.328 18.944-8.192 29.44-15.104 0 0-12.8 20.992-46.336 30.464 7.68 9.728 16.896 20.736 16.896 20.736 56.576-1.792 78.336-38.912 78.336-38.912z"/></svg>
			</a>
			<!-- Youtube -->
			<a target="_blank" class="link_socioal" href="https://www.youtube.com/channel/UCSjMT2aYpe6zmgASAhV8Zxw?guided_help_flow=5">
				<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
			</a>
			<!-- User -->
			<div href="" class="link_user">
				<?php if ($this->session->userdata('account')): ?>
					<h4 class="welcome_user active"> <?php echo $this->session->userdata('account')['userName'];?></h4>
					<a class="user-logout" href="/AccountAuthentic/LogOut">Đăng Xuất</a>
				<?php endif ?>
				<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
				<span></span>
			</div>
		</div>
		<?php if (!$this->session->userdata('account')): ?>
			<div class="navbar_login hidden">
				<form id="Login" action="" class="form_login user_form">
					<div class="form_login-inputs">
						<input name="userName" required type="text">
						<span>Tài khoản</span>
					</div>
					<div class="form_login-inputs">
						<input name="password" required type="password">
						<span>Mật khẩu</span>
					</div>
					<input class="submit-login" name="submit-login" type="submit" value="Đăng Nhập">
					<span href="" class="register">Tạo tài khoản của bạn</span>
				</form>
				<form action="" id="Register" class="form_register user_form" method="post"enctype="multipart/form-data">
					<div class="form_register-inputs">
						<input required name="username" type="text">
						<span>Tài khoản</span>
					</div>
					<div class="form_register-inputs">
						<input required name="password" type="password">
						<span>Mật khẩu</span>
					</div>
					<div class="form_register-inputs">
						<input required name="repassword" type="password">
						<span>Nhập lại mật khẩu</span>
					</div>
					<div class="form_register-inputs">
						<input required name="email" type="email">
						<span>Nhập email</span>
					</div>
					<div class="form_register-inputs">
						<input required name="address" type="text">
						<span>Nhập địa chỉ</span>
					</div>
					<input class="submit-register" name="submit-register" type="submit" value="Đăng Ký">
					<span href="" class="login">Đăng nhập với tài khoản của bạn</span>
				</form>
			</div>
		<?php endif ?>
		<?php if ($this->session->userdata('account')): ?>
			<div class="navbar_login hidden">
				<div class="info_login-box">
					<span class="info_login">Tài Khoản: <?php echo $this->session->userdata('account')['userName']?></span>
					<span class="info_login">Email: <?php echo $this->session->userdata('account')['email']?></span>
					<span class="info_login">Địa chỉ: <?php echo $this->session->userdata('account')['address']?></span>
					<?php if ($this->session->userdata('account')['isAdmin'] == 0): ?>
						<span class="info_login">Thành Viên</span>
					<?php endif ?>
					<?php if ($this->session->userdata('account')['isAdmin'] == 1): ?>
						<span class="info_login">Quản Trị Viên</span>
					<?php endif ?>
					<a href="/Index/LoadChangeAddress" class="change_address">+ Đổi địa chỉ</a>
					<a href="/AccountAuthentic/LoadChangePassword" class="change_password">+ Đổi mật khẩu</a>
					<a href="/Index/LoadHistoryOrder" class="history_order">+ Lịch sử mua hàng</a>
				</div>
			<div>
		<?php endif ?>
	</div>
</header>
<script>	
	window.onscroll = function (event) {
		var data =  document.querySelector('header');
		if (window.pageYOffset > 0) {
			data.style.height = "50px";
			data.style.fontSize = "7px";
		}
		else {
			data.style.height = "83px";
			data.style.fontSize = "10px";
		}
	}
	document.querySelector('.support_pokemonrevolution').onclick = function(event) {
		event.preventDefault();
		alert("tính năng đang được bảo trì để phát triển");
	}
	document.querySelector('.link_user').onclick = function (event) {
		var flag = false;
		for (value of this.classList) {
			if (value == "active") {
				flag = true;
				this.classList.remove("active");
				document.querySelector('.navbar_login').classList.add("hidden");
			}
		}
		if (flag == false) {
			this.classList.add("active");
			document.querySelector('.navbar_login').classList.remove("hidden");
		}
	}
	if (document.querySelector('.register')) {
		document.querySelector('.register').onclick = function (event) {
			document.querySelector('.form_login').style.display = "none";
			document.querySelector('.form_register').style.display = "flex";
		}
	}
	if (document.querySelector('.login')) {
		document.querySelector('.login').onclick = function (event) {
			document.querySelector('.form_register').style.display = "none";
			document.querySelector('.form_login').style.display = "flex";
		}
	}
	document.querySelectorAll('.user_form').forEach( function(element, index) {
		element.onsubmit = function (event) {
			event.preventDefault();
			var formData = new FormData(this);
			var idForm = this.getAttribute('id');
			$.ajax({
				url: '/AccountAuthentic/'+idForm,
				type: 'POST',
				dataType: 'json',
				processData: false,
				contentType: false,
				data: formData,
			})
			.done(function(data) {
				if (data.status) {
					alert(data.msg);
					location.reload();
				}
				else {
					alert(data.msg);
					location.reload();
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
</script>