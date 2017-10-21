<?php
session_start();

/**
*	Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/user.class.php');
$userclass = new UserClass();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/class/device.class.php');
$devClass  = new DeviceClass();
require_once(__DIR__ . '/class/rental.class.php');
$rentClass  = new RentalClass();

/**
* 	Check if user already logged in
*/
if (!isset($_SESSION['username']) && !isset($_SESSION['level'])) {
	// form filled -> process sign in and refresh if success
	if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['action']) && $_POST['action']=="sign_in") {
		$userclass->sign_in($_POST['username'], $_POST['password']);
	}
	// form didn't fill / illegal request -> redirect to login page
	else {
		header("Location: ./index.php");
		die();
	}
}
else if (isset($_SESSION['username']) && isset($_SESSION['level']) && $_SESSION['username']!="" && $_SESSION['level']!="") {
	// already logged in 
	// sign out
	if (isset($_POST['action']) && $_POST['action']=="sign_out") {
		$userclass->sign_out();
	}
	else {
		// get header
		include("./include/include_header.php");

		?>
    	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">
    				<h3 class="panel-title"><i class="glyphicon glyphicon-dashboard"></i> &nbsp; Status Monitor</h3>
    				<br>
    			</div>
    			<div class="panel-body">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<canvas id="canvas" class="img-thumbnail"></canvas>
					</div>
    			</div>
    		</div>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-dashboard"></i> &nbsp; Rental Status</h3>
            <br>
          </div>
          <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
              $rentclass = new RentalClass();

              $data     = $rentclass->show_rentals();
              $data_num = count($data);

              // Show if exists
              if ($data_num!=0) {
                $data_table = "<table class='table table-bordered table-striped' id='datatable'><thead><tr><th>Date</th><th>Name</th><th>Device Code</th><th>Device Type</th><th>Brand</th><th>Model</th><th>Serial</th><th>Location</th></tr></thead><tbody>";
                foreach ($data as $rental_data) {
                  $rental_date = $rental_data["rental_date_formatted"];
                  $renter_name = $rental_data["renter_name"];
                  $device_code  = $rental_data["device_code"];
                  $device_type      = $rental_data["type_name"];
                  $device_brand      = $rental_data["device_brand"];
                  $device_model     = $rental_data["device_model"];
                  $device_serial     = $rental_data["device_serial"];
                  $location_name     = $rental_data["location_name"];
                
                  $data_table    .= "<tr>
                    <td>$rental_date</td>
                    <td>$renter_name</td>
                    <td>$device_code</td>
                    <td>$device_type</td>
                    <td>$device_brand</td>
                    <td>$device_model</td>
                    <td>$device_serial</td>
                    <td>$location_name</td>
                  </tr>";
                }
                $data_table .= "</tbody></table>";
                echo $data_table;
              }
              // No data found?
              else {
                echo "<p>No Data Found!</p>";
              }
            ?>
          </div>
          </div>
        </div>
    	</div>
		<?php

		// get footer
		include("./include/include_footer.php");

		// get dashboard chart
		include("./include/include_dashboard_chart.php");

    require_once(__DIR__ . '/class/rental.class.php');

	}
}

?>