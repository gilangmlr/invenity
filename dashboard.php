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
require_once(__DIR__ . '/class/loan.class.php');
$rentClass  = new LoanClass();

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
        if (isset($_SESSION['loan_status']) && $_SESSION['loan_status']!=""){
          // show info
          echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[loan_status]</div>";
          // clear save_status session value
          $_SESSION["loan_status"] = "";
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
            <!-- Table Loan Status -->
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-dashboard"></i> &nbsp; Loan Status</h3>
            <br>
          </div>
          <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
              $rentclass = new LoanClass();

              $data     = $rentclass->show_loans(false);
              $data_num = count($data);

              // Show if exists
              if ($data_num!=0) {
                $data_table = "<table class='table table-bordered table-striped' id='datatable'>
				<thead>
					<tr>
						<th><center>Date</center></th>
						<th><center>Name</center></th>
						<th><center>Department</center></th>
						<th><center>Device Type</center></th>
						<th><center>Necessary</center></th>
						<th><center>Return Loan</center></th>
						<th><center>Details</center></th>
					</tr>
						</thead>
						<tbody>";
                foreach ($data as $loan_data) {
                  $device_id              = $loan_data["device_id"];
                  $loan_date            = $loan_data["loan_date_formatted"];
                  $loan_name            = $loan_data["loan_name"];
				  $dept					= $loan_data["dept"];
				  $necessary			= $loan_data["necessary"];
				  $return_date			= $loan_data["return_date"];
                  $device_code            = $loan_data["device_code"];
                  $device_type            = $loan_data["type_name"];
                  $device_brand           = $loan_data["device_brand"];
                  $device_model           = $loan_data["device_model"];
                  $device_serial          = stripslashes($loan_data["device_serial"]);
                  $device_color           = stripslashes($loan_data["device_color"]);
                  $location_name          = $loan_data["location_name"];
                  $device_description     = $loan_data["device_description"];
                  $device_photo           = $loan_data["device_photo"];
                  $device_photo_break     = explode(".", strrev($loan_data["device_photo"]), 2);
                  $device_photo_thumbnail = strrev($device_photo_break[1])."_thumbnail.".strrev($device_photo_break[0]);
                  $device_status          = $loan_data["device_status"];

                  // If location details enable
                  $dev_details = "";
                  if ($setting_location_details=="enable") {
                    $place_name    = $loan_data["place_name"];
                    $building_name = $loan_data["building_name"];
                    $floor_name    = $loan_data["floor_name"];

                    $dev_details = "<input type='hidden' id='place_name_$device_id' value='$place_name'>
                    <input type='hidden' id='building_name_$device_id' value='$building_name'>
                    <input type='hidden' id='floor_name_$device_id' value='$floor_name'>";
                  }
                
                  $data_table   .= "<tr>
                    <td>$loan_date</td>
                    <td>$loan_name</td>
                    <td><center>$dept</center></td>
                    <td>$device_type</td>
                    <td>$necessary</td>
                    <td>$return_date</td>
                    <td>
                      <button type='button' class='btn btn-primary' title='Show Detail' onclick=\"show_loan_detail('$device_id')\"><i class='glyphicon glyphicon-eye-open'></i></button>
                      <button type='button' class='btn btn-primary' title='Return Device' onclick=\"return_device('$device_id')\"><i class='glyphicon glyphicon-ok'></i></button>
                    </td>
                    <input type=\"hidden\" id=\"loan_date_$device_id\" value=\"$loan_date\">
                    <input type=\"hidden\" id=\"loan_name_$device_id\" value=\"$loan_name\">
					<input type=\"hidden\" id=\"dept_$device_id\" value=\"$dept\">
					<input type=\"hidden\" id=\"necessary_$device_id\" value=\"$necessary\">
					<input type=\"hidden\" id=\"return_date_$device_id\" value=\"$return_date\">
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

    echo "<script type='text/javascript' src='./js/loan_management.js'></script>";
    include("./include/include_modal_loan_detail.php");

	}
}

?>