<?php 
	// Show main menu based on user privileges
	$current_page      = basename($_SERVER['PHP_SELF']);
	$current_page_name = "";
	$main_menu_array   = $invClass->main_menu($_SESSION['privileges']);
	$display_menu      = "";
	foreach ($main_menu_array as $main_menu) {
		$component_id   = $main_menu['component_id'];
		$component_name = $main_menu['component_name'];
		$component_page = $main_menu['component_page'];
		// Set Display Menu
		if ($current_page==$component_page) {
			$display_menu .= "<a href='$component_page' class='list-group-item active' title='$component_name'><i class='glyphicon glyphicon-chevron-right'></i> &nbsp; $component_name</a>";
			$current_page_name = " ".$component_name;
		} else {
			$display_menu .= "<a href='$component_page' class='list-group-item' title='$component_name'><i class='glyphicon glyphicon-chevron-right'></i> &nbsp; $component_name</a>";
		}
		// If dashboard, set dashboard active
		if ($current_page=="dashboard.php") {
			$home_link = "active";
		} else {
			$home_link = "";
		}
	}
?>
	<!DOCTYPE html>
		<html>
		<head>
			<title>
				<?php 
				if ($invClass->setting_data("inventory_name")!="") {
					echo $invClass->setting_data("inventory_name").$current_page_name;
				} else {
					echo "Inventory System";
				} ?>
			</title>
			<!-- Styling -->
 
		<link rel="icon" href="./assets/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap-new.min.css"> 
        <link rel="stylesheet" href="./datepicker/css/bootstrap-datepicker3.css">
		<link rel="stylesheet" type="text/css" href="./assets/css/jquery-ui-1.12.1.min.css">
                    <style>
body {
	background:url(./img/header.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

</style>
<!--		<link rel="stylesheet" type="text/css" href="./assets/plugins/pace/pace.css">-->
	</head>
<!--	<body background="./assets/images/backgrounds/<?php if ($invClass->setting_data("body_background")!="") { echo $invClass->setting_data("body_background"); } else {echo "symphony.png";} ?>"> -->
<div class="docs-header">
			<!--nav-->
<!--			<nav class="navbar navbar-inverse navbar-custom" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button> -->
                        <!-- Navigation --> 
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="dashboard.php" ><img src="assets/images/sclogo.png" width="285" height="76" class="img-responsive img-icons">
        
        </a>
        </button>
      </div>
    </nav>
</div>
			</nav>
			</div>
			<p>&nbsp;</p>
            
            <header class="masthead text-left text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h3 class="text-uppercase">
            
            <!-- Font Color -->
            <style type="text/css">
   h3 {
   color: white;
   }
   
</style>
              <strong><?php 
							if ($invClass->setting_data("inventory_name")!="") { 
								echo $invClass->setting_data("inventory_name"); 
							} else {
								echo "Inventory System";
							} ?></strong>
            </h3>

    
</header>
			<div class="container document">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="list-group">
							<li class="list-group-item">
								<div class="text-center">
									<a href='my_profile.php' class='list-group-item text-center' title='My Profile'>
										<img src="<?php echo $_SESSION['user_photo'] ?>" class="img-thumbnail" height="90px" /><br>
										<?php echo $_SESSION['first_name']. " " .$_SESSION['last_name'] ?>
									</a>
								</div>
							</li>
							<a href="dashboard.php" class="list-group-item <?php echo $home_link; ?>" title="Dashboard"><i class="glyphicon glyphicon-home"></i> &nbsp; Home</a>
							<?php
								// Show Display Menu Result
								echo $display_menu;
							?>
							<a href="#" class="list-group-item" id="sign_out" title="Sign Out"><i class="glyphicon glyphicon-log-out"></i> &nbsp; Sign Out</a>
						</div>
					</div>
                    