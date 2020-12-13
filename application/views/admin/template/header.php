<header>
	<div class="header_navbar">
		<div class="logo">
			<a href="/" target="_blank">
				<img src="/vendor/img/absol.png">
				<span class="logo-text">AMG</span>
			</a>
			<span class="material-icons navbar-menu">menu</span>
		</div>

		<div class="user">
			<span class="material-icons user-icon">person</span>
			<span class="material-icons user-arrow">arrow_drop_down</span>
			<span class="user-name"><?php echo $this->session->userdata('account')['userName'] ?></span>
			<a class="logout" href="AccountAuthentic/LogOut">đăng xuất</a>
		</div>
	</div>
</header>
<script>
	document.querySelector('.navbar-menu').onclick = function(event) {
		let flag = false;
		let ob  = document.querySelector('.slidebar').classList;
		for (value of ob) {
			if (value == "active") {
				ob.remove("active");
				document.querySelector('.container_inner').classList.remove("active");
				flag = true;
			}
		}
		if (flag == false) {
			ob.add("active");
			document.querySelector('.container_inner').classList.add("active");
		}
	}
</script>