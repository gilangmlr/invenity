<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-16 mx-auto">
            <h1 class="text-uppercase">
              <strong>LOGBOOK MANAGEMENT SYSTEM</strong>
            </h1>
            <hr>
            <!-- login box -->

							<form name="sign_in_form" id="sign_in_form" action="dashboard.php" method="post">
									<label for="username"><i class="glyphicon glyphicon-user"></i>Username : </label>
									<input type="text" name="username" id="username" class="col-sm-4 control-label" placeholder="Enter Username" autofocus required <?php if (isset($_SESSION['sign_in_username'])) { echo " value='".$_SESSION['sign_in_username']."'";} ?>><br>

                                
									<label for="password"><i class="glyphicon glyphicon-lock"></i>Password : </label>
									<input type="password" name="password" id="password" class="col-sm-4 control-label" placeholder="Enter Password" required <?php if (isset($_SESSION['sign_in_password'])) { echo " value='".$_SESSION['sign_in_password']."'";} ?>><br>
								
								<div class="form-group">
									<input type="hidden" name="action" value="sign_in">
									<button type="submit" id="sign_in_initiate" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i> Sign In</button> 
								</div>
							</form>
							
							<?php // Error when signing in - alert and removem session
								if (isset($_SESSION['sign_in_error']) && $_SESSION['sign_in_error']==1) {
								echo "<div class='alert alert-danger alert-dismissable' id='sign_in_alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Sign in failed!<br>Please check your username and password.</div>";
								session_destroy();
								}
							?>
						</div>
					</div>
				</div>
			</div>
	    </div>

<!--            
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Enak nya di isi apaan yak</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="login2.php">login</a>
          </div>
        </div> -->
      </div> 
    </header>

    <section class="bg-primary" id="about">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">IT Support Surabaya</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Untuk memudahkan IT Surabaya dalam melakukan Pemantauan Peminjaman Tools</p>
          </div>
        </div>
      </div>
    </section>
    


    <section id="contact">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading">Contact</h2>
            <hr class="my-8">
            <p class="mb-5">We are grateful for your kind attention and if you have any inquiry<br> 
please do not hesitate to contact us</p>
          </div>
        </div>
        <!-- phone -->
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fa fa-phone fa-3x mb-4 sr-contact"></i>
            <p>(031) 2985 - 100</p>
</div>
          
          <!-- location -->
          <div class="col-lg-4 ml-auto text-center">
            <i class="fa fa-map-marker fa-3x mb-4 sr-contact"></i>
            <p>Jl. Letjen Sutoyo No. 55. Waru, Sidoarjo</p>
            </div>
            
            <!-- Website -->
<!--             <div class="col-lg-4 ml-auto text-center">
            <i class="fa fa-globe fa-3x mb-4 sr-contact"></i>
            <p>www.gudanggaramtk.com</p>
            </div> -->
          
          <!--email -->
          <div class="col-lg-4 mr-auto text-center">
            <i class="fa fa-envelope-o fa-3x mb-4 sr-contact"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">ithelpdesk@gudanggaramtbk.com</a>
            </p>
          </div>
        </div>
      </div>


    </section>

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
