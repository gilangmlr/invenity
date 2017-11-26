<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Log Book System</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top" ><img src="assets/images/sclogo.png" width="285" height="76"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          </ul>
        </div>
      </div>
    </nav>
    
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
<header class="masthead text-center text-white d-flex">
	<!-- Styling -->
 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">
    
		<link rel="icon" href="./assets/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="./assets/css/jquery-ui-1.12.1.min.css">

      <div class="container">
        <div class="row">
          <div class="col-lg-16">
  <h3 class="text-uppercase">
            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><strong>IMPROVEMENT LOGBOOK</strong>
            </h3>
<form class="form-inline">
			<div class="container my-auto">
				<div class="row">
					<div class="col-lg-4 mx-auto text-left">
<div class="container">
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
    

    <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>
  </body>
<center><strong>PT Gudang Garam tbk</strong></center>
</html>