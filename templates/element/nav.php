<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Navbar</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo $this->Url->build(['controller'=>'blogs', 'action'=>'index']); ?>">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $this->Url->build(['controller'=>'blogs', 'action'=>'about']); ?>">About</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $this->Url->build(['controller'=>'blogs', 'action'=>'contact']); ?>">Contact</a>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a class="nav-link mr-sm-2" href="#"><span class="fas fa-user mr-1"></span>Sign up</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mr-sm-2" href="#"><span class="fas fa-sign-in-alt mr-1"></span>Login</a>
				</li>

			</ul>
		</form>
	</div>
</nav>

<!-- Script para el nav activo dependiendo de la pagina donde estemos -->
<script type="text/javascript">
	$(document).ready(function(){
		var _urlpath = $(location).attr('pathname');

		$('.nav-item').each(function(){
			var _this = $(this);
			var _str = _this.find('a').attr('href');
			_str !== _urlpath ? _this.removeClass('active') : _this.addClass('active');
		});
	});
</script>