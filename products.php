<?php
ob_start();
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>HELPingos</title>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<script src="js/jquery.min.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/component.css" rel='stylesheet' type='text/css' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="application/x-javascript"> 
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
		function hideURLbar(){ window.scrollTo(0,1); } 
	</script>
	<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,300,700' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css' />
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
</head>
<body>
	<!-- header-section-starts -->
	<div class="user-desc">
		<div class="user-desc">
			<div class=".col-md-6">
				<div class="bs-example"> 
					<div class="container">
						<form action='search.php' method='get'>
							<ul>
								<li>
									<input type="text" name="search" placeholder="Type product name">
									<input class="cbp-vm-icon cbp-vm-add" type="submit" name="submit" value="GO!">
								</li>
								<?php 
									if(isset($_SESSION['user'])){
										$user= $_SESSION['user'];
										if($user == ''){
											echo "<li><i class='user'></i><a href='account.php'>Register/Log In</a></li>";
										} else {
											echo "<li><i class='user'></i><a href='logout.php'>Log Out</a></li>";
											echo "<li><i class='cog'></i><a href='changepass.php'>Change Password</a></li>";
										}
									} else {
										echo "<li><i class='user'></i><a href='account.php'>Register/Log In</a></li>";
									}
								?>
								<li><i class="cart"></i><a href="cart.php">Cart
									<span>
									<?php
										try {
											$stmt = $pdo->query("SELECT COUNT(*) FROM helpingos_cart");
											$count = $stmt->fetchColumn();
											echo "<span style='color:cream'>&nbsp;&nbsp;(" . $count . ")</span>";
										} catch (PDOException $e) {
											echo "<span style='color:red'>Error</span>";
										}
									?>
									</span></a>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="header">
		<div class="header-top">
			<div class="container">
				<div class="logo">
					<a href="index.php"><img src="images/logo1.png" alt="" /></a>
				</div>
				<div class="top-menu">
					<span class="menu"> </span>
					<ul class="cl-effect-15">
						<li><a class="active" href="index.php" data-hover="HOME">HOME</a></li>
						<li><a href="news.php" data-hover="NEWS">NEWS</a></li>
						<li><a href="products.php?cat_id=2">PRODUCTS</a></li>
						<li><a href="gallery.php" data-hover="GALLERY">GALLERY</a></li>
						<li><a href="contact.php" data-hover="CONTACT">CONTACT</a></li>
					</ul>
				</div>
				<script>
					$("span.menu").click(function(){
						$(".top-menu ul").slideToggle("slow");
					});
				</script>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

<!-- header-section-ends -->
<!-- content-section-starts -->
	<div class="container">
		<div class="products-page">
			<div class="product">
				<div class="product-listy">
					<h3>Products Categories</h3>
					<ul class="product-list">
						<?php 
							try {
								$stmt = $pdo->query("SELECT * FROM helpingos_product_category");
								while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
									echo "<li class='active'><a href='products.php?cat_id=" . $category['category_id'] . "'>" . $category['category_name'] . "</a></li>";
								}
							} catch (PDOException $e) {
								echo "<li>Error loading categories</li>";
							}
						?>
					</ul>
				</div>
				<div class="latest-bis">
					<img src="images/top_long.jpg" class="img-responsive">
					<div class="offer">
						<p>40%</p>
						<small>Top Offer</small>
					</div>
				</div>
			</div>

			<div class="new-product">
				<div class="new-product-top">
					<ul class="product-top-list">
						<li><a href="index.php">Home</a>&nbsp;<span>&gt;</span></li>
						<li><span class="act">Products</span>&nbsp;</li>
					</ul>
					<p class="back"><a href="index.php">Back to Previous</a></p>
					<div class="clearfix"></div>
				</div>

				<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
						<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid" title="grid">Grid View</a>
						<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list" title="list">List View</a>
					</div>
					<div class="clearfix"></div>
					<ul>
						<?php
							$cat_id = $_GET['cat_id'] ?? 0;

							try {
								$stmt = $pdo->prepare("SELECT * FROM helpingos_product WHERE pro_category_id = ?");
								$stmt->execute([$cat_id]);
								$productCount = $stmt->rowCount();

								if ($productCount > 0) {
									while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
										echo "<li>";
										echo "<a class='cbp-vm-image' href='single.php?product_id=" . $product['Pro_id'] . "' >";
										echo "<div class='view view-first'>";
										echo "<div class='inner_content clearfix'>";
										echo "<div class='product_image'>";
										echo "<img src='images/" . $product['pro_image'] . "' class='img-responsive' alt=''/>";
										echo "<div class='mask'><div class='info'>Quick View</div></div>";
										echo "<div class='product_container'>";
										echo "<div class='cart-left'><p class='title'>" . $product['pro_name'] . "</p></div>";
										echo "<div class='pricey'>" . $product['pro_price'] . "</div>";
										echo "<div class='clearfix'></div>";
										echo "</div></div></div></div></a>";
										echo "<div class='cbp-vm-details'>For -" . $product['pro_gender'] . "<br/>" . $product['pro_offer'] . "</div>";
										echo "</li>";
									}
								} else {
									echo "<p>Sorry, there are no products in this category at present.</p>";
								}
							} catch (PDOException $e) {
								echo "<p>Error loading products</p>";
							}
						?>
					</ul>
				</div>

				<script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
                <script src="js/classie.js" type="text/javascript"></script>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>

<?php include('footer.php'); ?>
