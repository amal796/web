<?php
	session_start();
	include_once 'config.php';
	$con = config::getConnexion();
	try {
        // Create sql statment
        $sql = " select * from blog where creator = '{$_SESSION['name']}' ";
        $resultp = $con->query($sql);
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
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
											<li><a href="blog-default.php">All blogs</a></li>
											<?php
											if($stmt = $con->prepare('SELECT * FROM formateurs WHERE id_formateur = :username')) {
											$stmt->bindValue(':username', $_SESSION['id']);
											$stmt->execute();
											$count=$stmt->rowCount();
											if ($count > 0) {
											echo '<li><a href="creat-blog.php">Add a blog</a></li>';
											echo '<li><a href="myblogs.php" class="active">My blogs</a></li>';
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
				<h1>My Blogs</h1>
				<!-- bread crumb -->
				<nav class="bread-crumb">
					<a href="index.html">Home</a>
					<i class="fa fa-long-arrow-right"></i>
					<a href="content-elements.html">Features</a>
					<i class="fa fa-long-arrow-right"></i>
					<a href="">My Blogs</a>
				</nav>
				<!-- / bread crumb -->
			</div>
		</div>
	</header>
	<!-- / page header -->
	<!-- content -->
	<div class="page-content grid-row">
		<!-- main content -->
		<main>
			<div class=" grid-col-row clear-fix">
				<div class="grid-col grid-col-10">
					<!-- blog post -->
					<?php foreach ($resultp as $blog) : 
					$date=$blog['date'];
					$day = date('d', strtotime($date));
					$month = date('M', strtotime($date));
					?>
					<div class="blog-post">
						<article>
							<div class="post-info">
								<div class="date-post"><div class="day"><?=$day?></div><div class="month"><?=$month?></div></div>
								<div class="post-info-main">
									<div class="author-post">by <?=$blog['creator']?></div>
								</div>
							</div>
							<div class="blog-media picture">
								<div class="hover-effect"></div>
								<div class="link-cont">
								</div>
								<img src="<?=$blog['photo']?>" class="columns-col-12" alt>
							</div>
							<h3><?=$blog['name']?></h3>
							<p><?=$blog['description']?><a href="blog-post?id=<?=$blog['id']?>.php"></a></p>
							<div class="tags-post">
								<a href="delete-blog.php?id=<?=$blog['id']?>" rel="tag">Delete</a><!-- 
							 --><a href="update-blog.php?id=<?=$blog['id']?>" rel="tag">Update</a>
							</div>
						</article>
					</div>
					<hr class="divider-big" />
					<?php endforeach ?>
					<!-- / blog post -->
				</div>
		</main>
		<!-- / main content -->
	</div>
	<!-- / content -->
	<!-- footer begin -->
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
	<!-- footer end -->
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