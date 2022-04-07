<?php ob_start("ob_gzhandler"); ?>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
ob_start();

$session = session_id();





if(!empty($_SESSION['user_on'])){
define("SESSION", true);
$IDUSER = $_SESSION["id_user_on"];
define("NAME", $_SESSION['name_user_on']);
define("EMAIL", $_SESSION['email_user_on']);
define("ADMIN", $_SESSION["admin"]);	
}else{
define("SESSION", false);
define("NAME", false);
define("EMAIL", false);	
define("ADMIN", $_SESSION["admin"]);
}

//echo $_SESSION['user_on'];
if($_SESSION['user_on'] == 1){
define("STORE", true);	
}else{
define("STORE", true);
}
define("SHOP", false);

include "_config/connect.php";
include "_config/urlamigavel.php";
include "_config/session.php";
include "_functions/index.php";

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=5, user-scalable=yes">
        <?php /*?><meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=12.0, minimum-scale=.25, user-scalable=yes"/><?php */?>

		
		<title><?php echo TITLE ?></title>
        <link rel="image_src" href="<?php echo IMAGE ?>" />
<meta name="description" content="<?php echo DESC?>" />
<meta name="keywords" content="<?php echo TAG?>"/>


		
        <?php
		include "inc/head.php";
		//include "inc/modal.php";
		?>

	</head>
<script src="https://apis.google.com/js/platform.js"></script>
	<body class="header-collapse">
		
		<div id="site-content">
			<header class="site-header">
				<div class="container">
					<a href="<?php echo PATH ?>" id="branding">
						<img src="<?php echo PATH ?>level_spaces_logo.png" class="logo_header" alt="Level Spaces / Psychedelic Techno Rock band from Berlin">
						
					</a> <!-- #branding -->

					<nav class="main-navigation">
						<button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item <?php if($_GET['a']=="home" or $_GET['a'] == ""){ echo "current-menu-item";}?>"><a href="<?php echo PATH ?>">Home</a></li>
							<li class="menu-item <?php if($_GET['a']=="about") echo "current-menu-item";?>"><a href="<?php echo PATH ?>about">About</a></li>
                            <?php /*?><li class="menu-item <?php if($_GET['a']=="blog") echo "current-menu-item";?>"><a href="<?php echo PATH ?>blog">Blog/News</a></li><?php */?>
							<li class="menu-item <?php if($_GET['a']=="gallery") echo "current-menu-item";?>"><a href="<?php echo PATH ?>gallery">Gallery</a></li>
                            <?php 
							if(SHOP == true){
							?>
							<li class="menu-item <?php if($_GET['a']=="shop") echo "current-menu-item";?>"><a href="<?php echo PATH ?>shop">Shop / Download</a></li>
							<?php } /*?><li class="menu-item <?php if($_GET['a']=="community") echo "current-menu-item";?>"><a href="<?php echo PATH ?>community">Community</a></li><?php */?>
							<li class="menu-item <?php if($_GET['a']=="contact") echo "current-menu-item";?>"><a href="<?php echo PATH ?>contact">Contact</a></li>
						</ul> <!-- .menu -->
					</nav> <!-- .main-navigation -->
					<div class="mobile-menu"></div>
				</div>
			</header> <!-- .site-header -->
            
			<?php include "_functions/notification.php"; ?>
		<?php
        if($_GET['a']){
			
        $path = "pages/";
        if(file_exists($path.$_GET['a'].".php") and $_GET['a'] != ""){
        include($path.$_GET['a'].".php");
        } else {
        include($path."404-error-page.php");
        }
        } else {
        include("$path/home.php");
        }
        ?>
        </div>
			
			
            <?php
			include "inc/footer.php";
			?>
			 <!-- .site-footer -->

		</div> <!-- #site-content -->

				
		<script src="<?php echo PATH ?>js/plugins.js"></script>
		<script src="<?php echo PATH ?>js/app.js"></script>
        <script src="<?php echo PATH ?>js/jquery.mask.min.js"></script>
        
		
	</body>

</html>