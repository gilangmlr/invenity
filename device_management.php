<?php
session_start();

/**
*	Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/class/location.class.php');
$locClass = new LocationClass();
require_once(__DIR__ . '/class/device.class.php');
$devClass = new DeviceClass();

// Location details settings 
$setting_location_details = $invClass->setting_data("location_details");

// Check if user already logged in
include("./include/signin_status.php");

// get header
include("./include/include_header.php");

?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<?php 
	if (isset($_SESSION['save_status']) && $_SESSION['save_status']!=""){
		// show info
		echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[save_status]</div>";
		// clear save_status session value
		$_SESSION["save_status"] = "";
	}

	if (isset($_SESSION['delete_status']) && $_SESSION['delete_status']!=""){
		// show info
		echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[delete_status]</div>";
		// clear save_status session value
		$_SESSION["delete_status"] = "";
	}
	?>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="glyphicon glyphicon-briefcase"></i> &nbsp; <?php echo $current_page_name; ?>
				<span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_add_device_type()"><i class="glyphicon glyphicon-plus"></i> Add Device Type</button></span> 
				<span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_add_device()"><i class="glyphicon glyphicon-plus"></i> Add Device</button></span> 
			</h3>
			<br>
		</div>
		<div class='panel-body'>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#dev_list" id="dev_list_tab" role="tab" data-toggle="tab" aria-controls="dev_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"></i> Device List</a>
				</li>
				<li role="presentation">
					<a href="#dev_type_list" id="dev_type_list_tab" role="tab" data-toggle="tab" aria-controls="dev_type_list" aria-expanded="true"><i class="glyphicon glyphicon-pushpin"></i> Device Type List</a>
				</li>
			</ul>
			<div class="tab-content">
            
				<div role="tabpanel" class="tab-pane fade active in" id="dev_list" aria-labelledby="dev_list_tab">
					<?php 
					// Get device list by type
					if (isset($_GET['type_id']) && $_GET['type_id']!="") {
						$dev_list = $devClass->show_device_by_type($_GET['type_id']);
						if (count($dev_list)>0) {
							$no      = 0;
							$content = "<table class='table table-striped table-bordered datatables'>
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Code</center></th>
									<th><center>Brand</center></th>
									<th><center>Model</center></th>
									<!--<th>SN</th>-->
									<th><center>Status</center></th>
									<th><center>Location Device</center></th>
									<th><center>Actions</center></th>
								</tr>
							</thead>
							<tbody>";

							foreach ($dev_list as $device_data) {
								$no++;
								$device_id              = $device_data["device_id"];
								$device_code            = $device_data["device_code"];
								$type_id                = $device_data["type_id"];
								$type_name              = $device_data["type_name"];
								$device_brand           = stripslashes($device_data["device_brand"]);
								$device_model           = stripslashes($device_data["device_model"]);
								$device_color           = stripslashes($device_data["device_color"]);
								$device_serial          = stripslashes($device_data["device_serial"]);
								$device_description     = $device_data["device_description"];
								$device_photo           = $device_data["device_photo"];
								$device_photo_break     = explode(".", strrev($device_data["device_photo"]), 2);
								$device_photo_thumbnail = strrev($device_photo_break[1])."_thumbnail.".strrev($device_photo_break[0]);
								$device_status          = $device_data["device_status"];
								$location_id            = $device_data["location_id"];
								$location_name          = $device_data["location_name"];
								$device_deployment_date = $device_data["device_deployment_date"];

								// If location details enable
								$dev_details = "";
								if ($setting_location_details=="enable") {
									$place_id      = $device_data["place_id"];
									$building_id   = $device_data["building_id"];
									$floor_id      = $device_data["floor_id"];
									$place_name    = $device_data["place_name"];
									$building_name = $device_data["building_name"];
									$floor_name    = $device_data["floor_name"];

									$dev_details = "<input type='hidden' id='l_place_id_$device_id' value='$place_id'>
									<input type='hidden' id='l_building_id_$device_id' value='$building_id'>
									<input type='hidden' id='l_floor_id_$device_id' value='$floor_id'>
									<input type='hidden' id='l_place_name_$device_id' value='$place_name'>
									<input type='hidden' id='l_building_name_$device_id' value='$building_name'>
									<input type='hidden' id='l_floor_name_$device_id' value='$floor_name'>";
								}

								$content .= "<tr>
									<td>$no</td>
									<td>$device_code</td>
									<td>$device_brand</td>
									<td>$device_model</td>
									<!-- <td>$device_serial</td> -->
									<td>$device_status</td>
									<td>$location_name</td>
									<input type='hidden' id='l_dev_id_$device_id' value='$device_id'>
									<input type='hidden' id='l_dev_code_$device_id' value='$device_code'>
									<input type='hidden' id='l_type_id_$device_id' value='$type_id'>
									<input type='hidden' id='l_dev_brand_$device_id' value='$device_brand'>
									<input type='hidden' id='l_dev_model_$device_id' value='$device_model'>
									<input type='hidden' id='l_dev_color_$device_id' value='$device_color'>
									<input type='hidden' id='l_dev_serial_$device_id' value='$device_serial'>
									<input type='hidden' id='l_dev_description_$device_id' value='$device_description'>
									<input type='hidden' id='l_dev_photo_real_$device_id' value='$device_photo'>
									<input type='hidden' id='l_dev_photo_description_$device_id' value='".strip_tags($device_description)."'>
									<input type='hidden' id='l_dev_photo_$device_id' value='$device_photo_thumbnail'>
									<input type='hidden' id='l_dev_status_$device_id' value='$device_status'>
									<input type='hidden' id='l_dev_type_name_$device_id' value='$type_name'>
									<input type='hidden' id='l_dev_location_id_$device_id' value='$location_id'>
									<input type='hidden' id='l_dev_location_name_$device_id' value='$location_name'>
									<input type='hidden' id='l_dev_deployment_date_$device_id' value='$device_deployment_date'>
									<!-- Device details -->
									$dev_details
									<td>
										<button type='button' class='btn btn-primary' title='Show Detail' onclick=\"show_device_detail('$device_id')\"><i class='glyphicon glyphicon-eye-open'></i></button>
										<button type='button' class='btn btn-default' title='Edit Device' onclick=\"show_edit_device('$device_id')\"><i class='glyphicon glyphicon-pencil'></i></button>
										<button type='button' class='btn btn-danger' title='Delete Device' onclick=\"device_delete('$device_id')\"><i class='glyphicon glyphicon-trash'></i></button>
									</td>
								</tr>";
							}
							$content .= "</tbody></table>";
							$content .= "<p class='text-center'><a href='device_management.php' class='btn btn-primary'>Back to Device Type</a></p>";
							// Legend
							$legend = "<legend>$type_name</legend>";

							echo $legend.$content;
						}
						else {
							echo "<p class='text-center'>No Data Found!</p><p class='text-center'><a href='device_management.php' class='btn btn-primary'>Back to Device Type</a></p>";
						}
					}
					// Show device type
					else {
						?>
						<legend>Device List</legend>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Information :</strong> To view device list, you should choose device type first.
						</div>
						<?php
						$dev_type_list = $devClass->show_device_type("","","yes");
						if (count($dev_type_list)>0) {
							$no      = 0;
							$content = "<table class='table table-striped table-bordered datatables'>
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Type Name</center></th>
									<th><center>Code</center></th>
									<th><center>Device Total</center></th>
									<th><center>Actions</center></th>
								</tr>
							</thead>
							<tbody>";
							foreach ($dev_type_list as $type_data) {
								$no++;
								$type_id      = $type_data["type_id"];
								$type_name    = stripslashes($type_data["type_name"]);
								$type_code    = stripslashes($type_data["type_code"]);
								$device_total = $type_data["device_total"];
								$active       = $type_data["active"];

								$content .= "<tr>
									<td><center>$no</center></td>
									<td>$type_name</td>
									<td><center>$type_code</center></td>
									<td><center>$device_total Devices</center></td>
									<td><center><a href='?type_id=$type_id' class='btn btn-primary btn-sm'>Show Device</a></center></td>
								</tr>";
							}
							$content .= "</tbody></table>";
							echo $content;
						}
						else {
							echo "<p>No Data Found!</p>";
						}
					}
					
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="dev_type_list" aria-labelledby="dev_list_type_tab">
					<legend>Device Type List</legend>
					<?php 
						$dev_type_list = $devClass->show_device_type();
						if (count($dev_type_list)>0) {
							$no      = 0;
							$content = "<table class='table table-striped table-bordered datatables'>
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Type Name</center></th>
									<th><center>Type Code</center></th>
									<th><center>Active</center></th>
									<th><center>Actions</center></th>
								</tr>
							</thead>
							<tbody>";
							foreach ($dev_type_list as $type_data) {
								$no++;
								$type_id   = $type_data["type_id"];
								$type_name = stripslashes($type_data["type_name"]);
								$type_code = stripslashes($type_data["type_code"]);
								$active    = $type_data["active"];

								if ($active=="yes") {
									$active_status = "<span class='label label-success'>Yes</span><input type='hidden' id='dtactive_$type_id' value='yes'>";
									$button_status = "<button type='button' title='Deactive' class='btn btn-danger btn-sm' onclick=\"device_type_change_status('$type_id', '$type_name', 'no')\"><i class='glyphicon glyphicon-remove'></i></button>";
								}
								elseif ($active=="no") {
									$active_status = "<span class='label label-danger'>No</span><input type='hidden' id='dtactive_$type_id' value='no'>";
									$button_status = "<button type='button' title='Activate' class='btn btn-success btn-sm' onclick=\"device_type_change_status('$type_id', '$type_name', 'yes')\"><i class='glyphicon glyphicon-ok'></i></button>";
								}
								$button_delete = "<button type='button' title='Delete' class='btn btn-danger btn-sm' onclick=\"device_type_delete('$type_id', '$type_name')\"><i class='glyphicon glyphicon-trash'></i></button>";
								$content .= "<tr>
									<td><center>$no</center></td>
									<td><center>$type_name</center></td>
									<td><center>$type_code</center></td>
									<td><center>$active_status</center></td>
									<td><center>$button_status $button_delete</center></td>
								</tr>";
							}
							$content .= "</tbody></table>";
							echo $content;
						}
						else {
							echo "<p>No Data Found!</p>";
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

// get footer
include("./include/include_footer.php");
// get plugins
include("./include/init_tinymce.php");
include("./include/init_datatables.php");
include("./include/init_validetta.php");
include("./include/init_chosen.php");
include("./include/init_fancybox.php");
// get page setting
echo "<script type='text/javascript' src='./js/device_management.js'></script>";
include("./include/include_modal_device_detail.php");
include("./include/include_modal_device.php");
include("./include/include_modal_device_type.php");
// include("./include/include_modal_device_edit.php");
?>