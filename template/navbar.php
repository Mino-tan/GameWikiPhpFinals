<?php
	if(isset($_SESSION['id']) && isset($_SESSION['log'])){
		$client = $_SESSION['client'];
		
		$editprofile= "<a class='dropdown-item' href='edit.php'>Edit Profile</a>";
		$src = $client['upfp'];
		$control = "<a class='dropdown-item' href='logout.php'>Log Out</a>";
		$username = $client['username'];
	}else{
		$editprofile = "";
		$src = "img/default.png";
		$control = "<a class='dropdown-item' href='login.php'>Log In</a>";
		$username = "";
	}
?>

<div class="row row-no-padding">
	<div class="col-12">
		<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
			<a class='navbar-brand'>Navbar</a>
				<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
					<span class='navbar-toggler-icon'></span>
				</button>
			<div class='collapse navbar-collapse' id='navbarSupportedContent'>
				<ul class='navbar-nav'>
					<li class='nav-item'>
						<a class='nav-link' href='index.php'>Home</a>
					</li>
				</ul>
				<ul class="navbar-nav offset-md-9">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src="<?php echo $src;?>"	width="40" height="40" class="rounded-circle">
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php echo $editprofile;?>
							<div class="dropdown-divider"></div>
							<?php echo $control; ?>
						</div>
					</li>
					<a class='navbar-nav'><?php echo $username; ?></a>  
				</ul>  
			</div>
		</nav>
	</div>
</div>