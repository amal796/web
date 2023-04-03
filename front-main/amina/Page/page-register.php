<?php
    include_once 'C:\xampp\htdocs\amina\Controller\UserC.php';
    include_once 'C:\xampp\htdocs\amina\Controller\EtudiantC.php';
    include_once 'C:\xampp\htdocs\amina\Controller\FormateurC.php';

    $userC = new UserC();
    $formaC = new FormateurC();
    $etudC = new EtudiantC();
    $error= "";
	if(isset($_POST['create']))
	{
		if(isset($_POST['cin']) && isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['date']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['sexe']) && isset($_POST['username']) && isset($_POST['passw']) && isset($_POST['choix']))
		{
			if(!empty($_POST['cin']) && !empty($_POST['name']) && !empty($_POST['lname']) && !empty($_POST['date']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['sexe']) && !empty($_POST['username']) && !empty($_POST['passw']) && !empty($_POST['choix']))
			{
				$password=$_POST['passw'];
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$user = new User($_POST['cin'],$_POST['name'] ,$_POST['lname'] ,$_POST['email'],$_POST['phone'],$_POST['sexe'] ,$_POST['date'] ,$_POST['username'] ,$hash,$_POST['choix']);
				if(($_POST['choix'] == "t") && !empty($_POST['checkbox3']))
				{
					$forma = new Formateur($_POST['cin'],0.0,$_POST['checkbox3'],0.0);
					$formaC->ajouter_formateur($forma);
				}
				else if($_POST['choix'] == "s")
				{
					$etud = new Etudiant($_POST['cin'],0.0,0);
					$etudC->ajouter_etudiant($etud);
				}
				$userC->ajouter_user($user);
				header('Location:account_created.php');
			}
			else 
			{
			$error= "Missing information";
			}
		}
	}
    

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Edukey Register</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<!-- style -->
	<link rel="shortcut icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/select2.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="tuner/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="tuner/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" />
	<link rel="stylesheet" href="css/owl.carousel.css">
	<!--styles -->
	<script src="js/register_formateur.js"></script>
</head>
<body >
	<header>
		<div class="page-header-top">
			<div class="grid-row clear-fix">
				<address>
					<a href="tel:123456" class="phone-number"><i class="fa fa-phone"></i>123456</a>
					<a href="mailto:edukey@gmail.com" class="email"><i class="fa fa-envelope-o"></i>edukey@gmail.com</a>
				</address>
				<div class="header-top-panel">
					<a href="page-login.php" class="fa fa-user login-icon"></a>
					<div id="top_social_links_wrapper">
					    <div class="share-toggle-button"><i class="share-icon fa fa-share-alt"></i></div>
					    <div class="cws_social_links"><a href="https://plus.google.com/" class="cws_social_link" title="Google +"><i class="share-icon fa fa-google-plus" style="transform: matrix(0, 0, 0, 0, 0, 0);"></i></a><a href="http://twitter.com/" class="cws_social_link" title="Twitter"><i class="share-icon fa fa-twitter"></i></a><a href="http://facebook.com" class="cws_social_link" title="Facebook"><i class="share-icon fa fa-facebook"></i></a><a href="http://dribbble.com" class="cws_social_link" title="Dribbble"><i class="share-icon fa fa-dribbble"></i></a></div>
					</div>
					<a href="#" class="search-open"><i class="fa fa-search"></i></a>
					<form action="#" class="clear-fix">
						<input type="text" placeholder="Search" class="clear-fix">
					</form>
					
				</div>
			</div>
		</div>

	<main>
		<section class="fullwidth-background bg-2">
			<div class="grid-row">
				<div class="login-block">
					<div class="logo">
						<a href="index.php"><img src="img/logo.png" data-at2x='img/logo@2x.png' alt></a>
						<a href="index.php"><h2>Edukey</h2></a>
					</div>
					<form method="post" class="login-form">
						<div class="form-group">
							<input type="text" class="login-input" placeholder="CIN" id="cin" name="cin" required minlength="8" maxlength="20" size="20">
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Name" id="name" name="name" required minlength="4" maxlength="25" size="20">
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Last-name" id="lname" name="lname" required minlength="4" maxlength="20" >
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>

						<div class="form-group">
							<div > Birth Date :
							</div>
							<input type="date" class="login-block"  name="date" id="date">
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Email" id="email" name="email" required minlength="5" maxlength="30" >
							<span class="input-icon">
								<i class="fa fa-envelope-o"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="tel" class="login-block" placeholder="+216 :" id="phone" name="phone" required >
							<span class="input-icon">
								<i class="fa fa-phone"></i>
							</span>
						</div>
						<div class="form-group">
							<div > You Are A:
							</div>
							<!-- check box -->
							<div class="checkbox" required>
								<input type="checkbox" id="1" value="m" name="sexe" onclick="checking(this.id,1,2)" >
								<label for="1"></label>
							<!-- / check box -->
							Male</div>
								<!-- check box -->
								<div class="checkbox" style="position: relative; left: 20px;">
									<input type="checkbox" id="2" value="f" name="sexe"  onclick="checking(this.id,1,2)" >
									<label for="2" ></label>
								<!-- / check box -->
								Female</div>
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Username" id="username" name="username" required minlength="4" maxlength="25" >
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
						
						<div class="form-group">
							<input type="password" class="login-input" placeholder="Pasword" id="passw" name="passw" required minlength="4" maxlength="20">
							<span class="input-icon">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="password" class="login-input" placeholder="Confirm pasword" id="cpassw" name="cpassw" required minlength="4" maxlength="20">
							<span class="input-icon">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						<div class="form-group">
							<div > Register as a :
							</div>
							<!-- check box -->
							<div class="checkbox" required >
								<input type="checkbox" id="3" value="t" name="choix" onclick="checking(this.id,3,4)" onchange="show_hide()">
								<label for="3"></label>
							<!-- / check box -->
							Teacher</div>
								<!-- check box -->
								<div class="checkbox" style="position: relative; left: 20px;">
									<input type="checkbox" id="4" value="s" name="choix" onclick="checking(this.id,3,4)" onchange="show_hide()" >
									<label for="4"></label>
								<!-- / check box -->
								Student</div>
						</div>
						<div class="form-group" id="choice" style="display: none;">
							<div > Categorie :
							</div>
							<!-- check box -->
							<div class="checkbox" >
								<input type="checkbox" id="5" value="math" name="checkbox3" onclick="checking(this.id,5,7)">
								<label for="5"></label>
							<!-- / check box -->
							Mathematics</div>
								<!-- check box -->
								<div class="checkbox" style="position: relative; left: 30px;">
									<input type="checkbox" id="6" value="prog" name="checkbox3" onclick="checking(this.id,5,7)">
									<label for="6"></label>
								<!-- / check box -->
								Programming</div>
								<!-- check box -->
								<div class="checkbox" >
									<input type="checkbox" id="7" value="web" name="checkbox3" onclick="checking(this.id,5,7)">
									<label for="7"></label>
								<!-- / check box -->
								Web-Development</div>
						</div>	
						<div><p><?php echo $error;?></p></div>
					<button class="button-fullwidth cws-button bt-color-3 border-radius" type="submit" name="create">CREATE AN ACCOUNT</button>
					</form>
				</div>
			</div>
		</section>
	</main>
	<footer>
		<div class="grid-row">
			<div class="grid-col-row clear-fix">
				
			</div>
		</div>
		<div class="footer-bottom">
			<div class="grid-row clear-fix">	
				<nav class="footer-nav">
					<ul class="clear-fix">
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="courses-grid.html">Features</a>
						</li>
						<li>
							<a href="content-elements.html">Categorie</a>
						</li>
						<li>
							<a href="blog-default.html">offers</a>
						</li>
						<li>
							<a href="page-about-us.html">Contact us</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</footer>
	<!-- footer -->
	<!-- scripts -->
	<script src="js/jquery.min.js"></script>
	<script type='text/javascript' src='js/jquery.validate.min.js'></script>
	<script src="js/jquery.form.min.js"></script>
	<script src="js/TweenMax.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/select2.js"></script>
	<script src="js/jquery.isotope.min.js"></script>	
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jflickrfeed.min.js"></script>
	<script src="js/jquery.tweet.js"></script>
	<script type='text/javascript' src='tuner/js/colorpicker.js'></script>
	<script type='text/javascript' src='tuner/js/scripts.js'></script>
	<script src="js/jquery.fancybox.pack.js"></script>
	<script src="js/jquery.fancybox-media.js"></script>
	<script src="js/retina.min.js"></script>
	<!-- scripts -->
</body>
</html>