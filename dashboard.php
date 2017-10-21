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

// Location details settings 
$setting_location_details = $invClass->setting_data("location_details");

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
        <?php 
        if (isset($_SESSION['rental_status']) && $_SESSION['rental_status']!=""){
          // show info
          echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[rental_status]</div>";
          // clear save_status session value
          $_SESSION["rental_status"] = "";
        }

        if (isset($_SESSION['return_status']) && $_SESSION['return_status']!=""){
          // show info
          echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[return_status]</div>";
          // clear save_status session value
          $_SESSION["return_status"] = "";
        }
        ?>
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
                $data_table = "<table class='table table-bordered table-striped' id='datatable'><thead><tr><th>Date</th><th>Name</th><th>Device Code</th><th>Device Type</th><th>Brand</th><th>Location</th><th>Actions</th></tr></thead><tbody>";
                foreach ($data as $rental_data) {
                  $device_id              = $rental_data["device_id"];
                  $rental_date            = $rental_data["rental_date_formatted"];
                  $renter_name            = $rental_data["renter_name"];
                  $device_code            = $rental_data["device_code"];
                  $device_type            = $rental_data["type_name"];
                  $device_brand           = $rental_data["device_brand"];
                  $device_model           = $rental_data["device_model"];
                  $device_serial          = stripslashes($rental_data["device_serial"]);
                  $device_color           = stripslashes($rental_data["device_color"]);
                  $location_name          = $rental_data["location_name"];
                  $device_description     = $rental_data["device_description"];
                  $device_photo           = $rental_data["device_photo"];
                  $device_photo_break     = explode(".", strrev($rental_data["device_photo"]), 2);
                  $device_photo_thumbnail = strrev($device_photo_break[1])."_thumbnail.".strrev($device_photo_break[0]);
                  $device_status          = $rental_data["device_status"];

                  // If location details enable
                  $dev_details = "";
                  if ($setting_location_details=="enable") {
                    $place_name    = $rental_data["place_name"];
                    $building_name = $rental_data["building_name"];
                    $floor_name    = $rental_data["floor_name"];

                    $dev_details = "<input type='hidden' id='place_name_$device_id' value='$place_name'>
                    <input type='hidden' id='building_name_$device_id' value='$building_name'>
                    <input type='hidden' id='floor_name_$device_id' value='$floor_name'>";
                  }
                
                  $data_table   .= "<tr>
                    <td>$rental_date</td>
                    <td>$renter_name</td>
                    <td>$device_code</td>
                    <td>$device_type</td>
                    <td>$device_brand</td>
                    <td>$location_name</td>
                    <td>
                      <button type='button' class='btn btn-primary' title='Show Detail' onclick=\"show_rental_detail('$device_id')\"><i class='glyphicon glyphicon-eye-open'></i></button>
                      <button type='button' class='btn btn-primary' title='Return Device' onclick=\"return_device('$device_id')\"><i class='glyphicon glyphicon-ok'></i></button>
                    </td>
                    <input type=\"hidden\" id=\"rental_date_$device_id\" value=\"$rental_date\">
                    <input type=\"hidden\" id=\"renter_name_$device_id\" value=\"$renter_name\">
                    <input type=\"hidden\" id=\"device_code_$device_id\" value=\"$device_code\">
                    <input type=\"hidden\" id=\"device_type_$device_id\" value=\"$device_type\">
                    <input type=\"hidden\" id=\"device_brand_$device_id\" value=\"$device_brand\">
                    <input type=\"hidden\" id=\"device_model_$device_id\" value=\"$device_model\">
                    <input type=\"hidden\" id=\"device_color_$device_id\" value=\"$device_color\">
                    <input type=\"hidden\" id=\"device_serial_$device_id\" value=\"$device_serial\">
                    <input type=\"hidden\" id=\"device_photo_real_$device_id\" value=\"$device_photo\">
                    <input type=\"hidden\" id=\"device_photo_description_$device_id\" value=\"".strip_tags($device_description)."\">
                    <input type=\"hidden\" id=\"device_photo_$device_id\" value=\"$device_photo_thumbnail\">
                    <input type=\"hidden\" id=\"device_description_$device_id\" value=\"$device_description\">
                    <input type=\"hidden\" id=\"device_status_$device_id\" value=\"$device_status\">
                    <input type=\"hidden\" id=\"location_name_$device_id\" value=\"$location_name\">
                    $dev_details
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

    include("./include/init_fancybox.php");

    echo "<script type='text/javascript' src='./js/rental_management.js'></script>";
    include("./include/include_modal_rental_detail.php");

	}
}

?>