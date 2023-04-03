<?php
	session_start();
	include_once 'config.php';
	$con = config::getConnexion();
	if(isset($_GET['id'])){
        $id = $_GET['id'];
		$stmt = $con->prepare("SELECT * FROM `blog` WHERE `id` = :id");
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		$count=$stmt->rowCount();
		$blog = $stmt->fetch();
	}
	//ajout comment
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$comment    = trim($_POST['comment']);
        $writer     = (int) $_POST['writer'];
        $blog   = (int) $_POST['blog'];
		$idb=$_GET['id'];
		if(!empty($comment) && !empty($blog) && !empty($writer))
		{

			//save to database
			$insert = $con->prepare("insert into comments (text,writer,blog) values ('$comment','$writer','$blog')");
			$insert->execute();
			header("Location:blog-post.php?id=$idb");
			die;
		}else
		{
			echo '<script>alert("Login in order to write comments");</script>';
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Edukey </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<!-- style -->
	<link rel="shortcut icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="fi/flaticon.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="tuner/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="tuner/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" />
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen">
	<link rel="stylesheet" href="css/animate.css">
	<!--styles -->
</head>
<body>
	<!-- page header -->
	<header class="only-color">
		<!-- header top panel -->
		<div class="page-header-top">
			<div class="grid-row clear-fix">
				<address>
					<a href="tel:123456" class="phone-number"><i class="fa fa-phone"></i>123456</a>
					<a href="mailto:edukey@gamil.com" class="email"><i class="fa fa-envelope-o"></i>edukey@gamil.com</a>
					<?php if (isset($_SESSION['loggedin'])) : ?>
						<p>Welcome back, <?=$_SESSION['name']?>!</p>
					<?php endif; ?>
				</address>
				<div class="header-top-panel">
					<?php if (!isset($_SESSION['loggedin'])) : ?>
						<a href="page-login.php" class="fa fa-user login-icon"></a>
					<?php else : ?>
						<a href="logout.php" class="cws-button border-radius alt smaller">Logout</a>
					<?php endif; ?>
					<div id="top_social_links_wrapper">
					    <div class="share-toggle-button"><i class="share-icon fa fa-share-alt"></i></div>
					    <div class="cws_social_links"><a href="https://plus.google.com/" class="cws_social_link" title="Google +"><i class="share-icon fa fa-google-plus" style="transform: matrix(0, 0, 0, 0, 0, 0);"></i></a><a href="http://twitter.com/" class="cws_social_link" title="Twitter"><i class="share-icon fa fa-twitter"></i></a><a href="http://facebook.com" class="cws_social_link" title="Facebook"><i class="share-icon fa fa-facebook"></i></a><a href="http://dribbble.com" class="cws_social_link" title="Dribbble"><i class="share-icon fa fa-dribbble"></i></a></div>
					</div>
					<a href="#" class="search-open"><i class="fa fa-search"></i></a>
					<form action="#" class="clear-fix">
						<input type="text" placeholder="Search" class="clear-fix">
					</form>
					<?php if (isset($_SESSION['loggedin'])) : ?>
					<a href="profil.php" class="cws-button bt-color-2 border-radius alt small">My Profile</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- / header top panel -->
		<!-- main menu -->
		<div class="sticky-wrapper">
			<div class="sticky-menu">
				<div class="grid-row clear-fix">
					<!-- logo -->
					<a href="index.html" class="logo">
						<img src="img/logo.png"  data-at2x="img/logo@2x.png" alt>
						<h1>uniLearn</h1>
					</a>
					<!-- / logo -->
					<nav class="main-nav">
						<ul class="clear-fix">
							<li>
								<a href="index.html">Home</a>
								<!-- sub menu -->
								<ul>
									<li><a href="index.html">Full-Width Slider</a></li>
									<li><a href="index-fullscreen.html">Full-Screen Slider</a></li>
									<li><a href="index-bg-video.html">Video Slider</a></li>
								</ul>
								<!-- / sub menu -->
							</li>
							<li class="megamenu">
								<a href="content-elements.html" class="active">Features</a>
								<!-- sub mega menu -->
								<ul class="clear-fix">
									<li><div class="header-megamenu">Pages</div>
										<ul>
											<li><a href="page-about-us.html">About Us</a></li>
											<li><a href="page-our-staff.html">Our Staff</a></li>
											<li><a href="page-services.html">Services</a></li>
											<li><a href="page-full-width.html">Full-Width Page</a></li>
											<li><a href="page-left-sidebar.html">Page Left Sidebar</a></li>
											<li><a href="page-right-sidebar.html">Page Right Sidebar</a></li>
											<li><a href="page-double-sidebars.html">Double Sidebars</a></li>
											<li><a href="page-faq.html">Faq Page</a></li>
											<li><a href="page-sitemap.html">SiteMap</a></li>
											<li><a href="page-404.html">404 Page</a></li>
										</ul>
									</li>
									<li><div class="header-megamenu">Content</div>
										<ul>
											<li><a href="content-elements.html">Content Elements</a></li>
											<li><a href="page-content-typography.html">Typography</a></li>
											<li><a href="page-pricing-plans.html">Pricing Plans</a></li>
											<li><a href="page-login.html">Login</a></li>

										</ul>
										<img src="http://placehold.it/250x150" alt>
									</li>
									<li><div class="header-megamenu">Portfolio</div>
										<ul>
											<li><a href="portfolio-one-column.html">One Column</a></li>
											<li><a href="portfolio-two-columns.html">Two Columns</a></li>
											<li><a href="portfolio-three-columns.html">Three Columns</a></li>
											<li><a href="portfolio-four-columns.html">Four Columns</a></li>
											<li><a href="portfolio-gallery.html">Gallery</a></li>
											<li><a href="portfolio-filtered.html">Filtered</a></li>
										</ul>
										<img src="http://placehold.it/250x150" alt>
									</li>
									<li><div class="header-megamenu">Blog</div>
										<ul>
											<li><a href="blog-default.php" class="active">All blogs</a></li>
											<?php
											if($stmt = $con->prepare('SELECT * FROM formateurs WHERE id_formateur = :username')) {
											$stmt->bindValue(':username', $_SESSION['id']);
											$stmt->execute();
											$count=$stmt->rowCount();
											if ($count > 0) {
											echo '<li><a href="creat-blog.php">Add a blog</a></li>';
											echo '<li><a href="myblogs.php">My blogs</a></li>';
											}
											}
											?>
										</ul>
										<img src="http://placehold.it/250x150" alt>
									</li>
								</ul>
								<!-- / sub mega menu -->
							</li>
							<li>
								<a href="courses-grid.html">Courses</a>
								<!-- sub menu -->
								<ul>
									<li><a href="courses-grid.html">Courses grid</a></li>
									<li><a href="courses-list.html">Courses list</a></li>
									<li><a href="courses-single-item.html">Courses single item</a></li>
								</ul>
								<!-- / sub menu -->
							</li>
							<li>
								<a href="events-single-item.html">Events</a>
								<!-- sub menu -->
								<ul>
									<li><a href="event-calendar.html">Events Calendar</a></li>
									<li><a href="events-single-item.html">Events Single Item</a></li>
								</ul>
								<!-- / sub menu -->
							</li>
							<li>
								<a href="shop-product-list.html">Shop</a>
								<!-- sub menu -->
								<ul>
									<li><a href="shop-product-list.html">Product List</a></li>
									<li><a href="shop-single-product.html">Single Product</a></li>
									<li><a href="shop-checkout.html">Checkout</a></li>
									<li><a href="shop-cart.html">Shop Cart</a></li>
								</ul>
								<!-- / sub menu -->
							</li>
							<li>
								<a href="contact-us.html">Contact Us</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!-- / main menu -->
		<div class="page-title">
			<div class="grid-row">
				<h1>Blog</h1>
				<!-- bread crumb -->
				<nav class="bread-crumb">
					<a href="index.html">Home</a>
					<i class="fa fa-long-arrow-right"></i>
					<a href="content-elements.html">Features</a>
					<i class="fa fa-long-arrow-right"></i>
					<a href="">Blog</a>
				</nav>
				<!-- / bread crumb -->
			</div>
		</div>
	</header>
	<!-- / page header -->
	<!-- content -->
	<div class="grid-row">
		<div class="page-content grid-col-row clear-fix">
			<div class="grid-col grid-col-9">
				<!-- main content -->
				<main>
					<!-- blog post -->
					<?php
					$date=$blog['date'];
					$day = date('d', strtotime($date));
					$month = date('M', strtotime($date));
					$stmt2 = $con->prepare("SELECT * FROM `comments` WHERE `blog` = :id");
					$stmt2->bindValue(':id', $_GET['id']);
					$stmt2->execute();
								?>
					<div class="blog-post"><article>
						<div class="post-info">
							<div class="date-post"><div class="day"><?=$day?></div><div class="month"><?=$month?></div></div>
							<div class="post-info-main">
								<div class="author-post">by <?=$blog['creator']?></div>
							</div>
						</div>
						<div class="blog-media picture">
							<div class="hover-effect"></div>
							<img src="<?=$blog['photo']?>"  alt>
						</div>
						<h3><?=$blog['name']?></h3>
						<p><?=$blog['description']?></p>
						<div class="quotes clear-fix">
						<?=$blog['text']?>
						</div><br/>
					</article></div>
					<!-- blog post -->
					<hr class="divider-color" />
					<!-- comments for post -->
						<button onclick="window.print()" class="btn btn-success">PRINT</button>
					<div class="comments">
						<div id="comments">
							<div class="comment-title">Comments</div>
							<ol class="commentlist">
							<?php foreach ($stmt2 as $comment) : ?>
							<?php
							try {
								// Create sql statment
								$sql = " select * from users where id_user={$comment['writer']}";
								$resultu = $con->query($sql);
							} catch (Exception $e) {
								echo "Error " . $e->getMessage();
								exit();
							}
							?>
								<li class="comment">
									<div class="comment_container clear">
										<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEXFxcX////CwsLGxsb7+/vT09PJycn19fXq6urb29ve3t7Ozs7w8PDn5+f5+fnt7e25pieFAAAFHUlEQVR4nO2dC5qqMAyFMTwUEdz/bq+VYYrKKJCkOfXmXwHna5uTpA+KwnEcx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3EcA2iO9cdIc5PUdO257y+BU39u66b4HplE3fk6VIcnqmNfl1+gksr6+iIucjl3WYukor7+re6Hoe1y1UhNO3zUd+fUFRmKpOa0Tt6dY5ubRCrOG/QFLk1WGmnt/JxzykcjdZ/jyxJDLlOV2l36AtcsJJb9boG3YcR3DuqODIE3ztYKPkDdmwRmpUToUaSaq++AvRgZMWbOpbQW8hdCAm8ZDugoikzREdCJ2okJPBx6azFLNOwoOgcxojJ98JkaTSJxMpklKrCAKhZGI0drTY/wU5lXoJYibannV9NYy4oozNEAkPHTjop+DTDxVGkIgYJNoyQQJtiIW+EMjGAjm649AjGIaqswcEFQKJ2QPlJbqytki6ZXAAZRJ52J2McaUowzAfs+uFzrYhnzaapphiPWdaJWShqxjqa6kTTQ205TVbsfMa6htL0iYOsXpJrQjHSmCkv1QGPtiHqlYcQ21Gj7fcDU8xOEUuNgSltPzexh+HqFlanCBHZ4OLhCV+gK/3OF6vWvucLv98MUOY2pwu/PS/+D2qJU7pYGbOvDFDW+bbON9p3o3oRxn0bfLgZTgSn6pSfrtr56qLHemtHPTK2319SzGvtjQ9qeb39WgS66Cm073nd0U1PzDdJCO3Gzn6TKpl9Zq7ujGWsQhlA3NwWIMwG9zM08Y/tBrR9VWeczv5CSQuuUNKIUTk23ZJ5RKfVhjnkXotfWIlgX2BSCDYbZR+QTcLhb3dKZDUY2M0d4KWItwhHRah/zsrOgKw4wycwjcgEVcgQDQo23CqSiWEJkFAfod2oE1uIFdA1OsCPqFXYNTjCfb8Ez+iX2x5sKLlVbhtqdDcar9ZevhnbZxoBUD35k23t0d304LYs1ELVbnfFaZ/REJJX9niP8Q19moZGo3m8XR/yBvOnjFfsXcI2c8ZuNo7WMP5HQh6yRGrlmFOJTnyTcT+zRlqPUBI2gTVWNUzUna1ERgecgF4GpNBQ38jGqxVLzQA1A31Rrhk6Yz9QEh/WND0GnuG9huhiTXJkxfAizTHLr6cbJKN6UCU6x/2DTRE1xEeEXi3O0ZUqBN4nJRzHhFB1JPlFTBZlI2kQ8zc3KJ1Le8DIRmFJiknuVS6RK4Ej/JtBfJErDSzOBiY4wJHX6Z1I4v1GUmdCPNirnLLeg3oJLcbX5PcpHNbRvOa1A956QmRPOUXVF+zkaUJynpkYR0bOMJH2nNej1pqyV/aKkz9jr5yj5vrXXz1F5SQLACiMapmierj2ikLyleKdlA/I/2oFxiglxx9B+mHwz0lf34IZQfhDRhlD6bhvgEAoPYooHkTczSIZTLC+cEExsoNKZiGBiY9cCfo/Y/SjIOBMQizWWTe73CMUasJx7jlD+DdKdWUKoY4PRYFtGpO0G1Lx4RaadgTtJhf4fiGqGIwKWCGuGIwKWqP+7IxYCzygjR9IAO5pC7Da9g70TBVpWRNgFBlgT8RV2WxHbKwJMv4BOaEaYaU2K16yZMN/qgV+G7IWIvwyZCxHeDQMsR8wg0DBDDXB5H2EV+hkEGmaoySHQsEJNFoGGFWrAq98JRhUMX1iMMMqLLEIpK5jCbd4vw9nSt/72lewXiN6jmdjfq8Hdknlk92ZwJnbIMMRM7JBhiFlUFoHd1UWaP1QKsPsHA5mkNB+Smn8Wgl3ukB+tygAAAABJRU5ErkJggg==" alt="" class="avatar">
										<div class="comment-text">
											<p class="meta">
												<?php foreach ($resultu as $user) :
												echo "<strong> {$user['username']} </strong>";
												if($user['id_user']==$_SESSION['id_user'])
												{
													echo'<a href="delete_comment.php?id=';echo $comment["id"];echo'&&post=';echo$blog['id'];echo'">Delete</a>';
												}
												endforeach
												?>
												<br>
												<time datetime="2016-06-07T12:14:53+00:00"><?=$comment['date']?></time>
											</p>
											<div class="description">
												<p ><?=$comment['text']?></p>
											</div>
										</div>
									</div>
								</li>
							<?php endforeach ?>
							</ol>
						</div>
					</div>

					<!-- / comments for post -->
					<hr class="divider-color" />
					<div class="leave-reply">
						<div class="title">Leave a comment</div>
						<form class="message-form clear-fix" method="POST">
							<p class="message-form-message">
								<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Comment...."></textarea>
							</p>
							<input type="number" name="blog" value="<?=$blog['id']?>" hidden style="width: 1px;">
							<input type="number" name="writer"  value="<?=$_SESSION['id_user']?>" hidden style="width: 1px;">
							<p class="form-submit rectangle-button green medium">
								<input class="cws-button border-radius alt" name="submit" type="submit" id="submit" value="Submit">
							</p>

						</form>
					</div>
				</main>
				<!-- / main content -->
			</div>

		</div>
	</div>

	<footer>
		<div class="grid-row">
			<div class="grid-col-row clear-fix">
				<section class="grid-col grid-col-4 footer-about">
					<h2 class="corner-radius">About Us</h2>
					<div>
						<h3>Sed aliquet dui auctor blandit ipsum tincidunt</h3>
						<p>Quis rhoncus lorem dolor eu sem. Aenean enim risus, convallis id ultrices eget.</p>
					</div>
					<address>
						<p></p>
						<a href="tel:123-123456789" class="phone-number">123-123456789</a>
						<br />
						<a href="mailto:uni@domain.com" class="email">uni@domain.com</a>
						<br />
						<a href="www.sample.com" class="site">www.sample.com</a>
						<br />
						<a href="www.sample.com" class="address">250 Biscayne Blvd. (North) 11st Floor<br/>New World Tower Miami, 33148</a>
					</address>
					<div class="footer-social">
						<a href="" class="fa fa-twitter"></a>
						<a href="" class="fa fa-skype"></a>
						<a href="" class="fa fa-google-plus"></a>
						<a href="" class="fa fa-rss"></a>
						<a href="" class="fa fa-youtube"></a>
					</div>
				</section>
				<section class="grid-col grid-col-4 footer-latest">
					<h2 class="corner-radius">Latest courses</h2>
					<article>
						<img src="http://placehold.it/83x83" data-at2x="http://placehold.it/83x83" alt>
						<h3>Sed aliquet dui at auctor blandit</h3>
						<div class="course-date">
							<div>10<sup>00</sup></div>
							<div>23.02.15</div>
						</div>
						<p>Sed pharetra lorem ut dolor dignissim,
	sit amet pretium tortor mattis.</p>
					</article>
					<article>
						<img src="http://placehold.it/83x83" data-at2x="http://placehold.it/83x83" alt>
						<h3>Sed aliquet dui at auctor blandit</h3>
						<div class="course-date">
							<div>10<sup>00</sup></div>
							<div>23.02.15</div>
						</div>
						<p>Sed pharetra lorem ut dolor dignissim,
	sit amet pretium tortor mattis.</p>
					</article>
				</section>
				<section class="grid-col grid-col-4 footer-contact-form">
					<h2 class="corner-radius">apply for instructor</h2>
					<div class="email_server_responce"></div>
					<form action="php/contacts-process.php" class="contact-form" method="post" novalidate="novalidate">
						<p><span class="your-name"><input type="text" name="name" value="" size="40" placeholder="Name" aria-invalid="false" required></span>
						</p>
						<p><span class="your-email"><input type="text" name="phone" value="" size="40" placeholder="Phone" aria-invalid="false" required></span> </p>
						<p><span class="your-message"><textarea name="message" placeholder="Comments" cols="40" rows="5" aria-invalid="false" required></textarea></span> </p>
						<button type="submit" class="cws-button bt-color-3 border-radius alt icon-right">Submit <i class="fa fa-angle-right"></i></button>
					</form>
				</section>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="grid-row clear-fix">
				<div class="copyright">uniLearn<span></span> 2015 . All Rights Reserved</div>
				<nav class="footer-nav">
					<ul class="clear-fix">
						<li>
							<a href="index.html">Home</a>
						</li>
						<li>
							<a href="courses-grid.html">Courses</a>
						</li>
						<li>
							<a href="content-elements.html">Plans</a>
						</li>
						<li>
							<a href="blog-default.html">News</a>
						</li>
						<li>
							<a href="page-about-us.html">Pages</a>
						</li>
						<li>
							<a href="contact-us.html">Contact</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</footer>
	<script src="js/jquery.min.js"></script>
	<script type='text/javascript' src='js/jquery.validate.min.js'></script>
	<script src="js/jquery.form.min.js"></script>
	<script src="js/TweenMax.min.js"></script>
	<script src="js/main.js"></script>

	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jflickrfeed.min.js"></script>
	<script src="js/jquery.tweet.js"></script>
	<script type='text/javascript' src='tuner/js/colorpicker.js'></script>
	<script type='text/javascript' src='tuner/js/scripts.js'></script>
	<script src="js/jquery.fancybox.pack.js"></script>
	<script src="js/jquery.fancybox-media.js"></script>
	<script src="js/retina.min.js"></script>
</body>
</html>
