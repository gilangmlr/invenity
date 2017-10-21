<?php
session_start();

/**
* Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/user.class.php');
$userclass = new UserClass();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/class/device.class.php');
$deviceclass = new DeviceClass();

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
  // Get user detail
  $username = $_SESSION["username"];
  $data     = $userclass->show_all_user($username);
  $data_num = count($data);

  if ($data_num!=0) {
    foreach ($data as $user_data) {
      $username   = $user_data["username"];
      $first_name = $user_data["first_name"];
      $last_name  = $user_data["last_name"];
      $photo      = $user_data["photo"];
      $level      = $user_data["level"];
      $active     = $user_data["active"];
    }
  }

  // Get all devices
  $dev_list     = $deviceclass->show_all_available_devices();
  $data_num = count($dev_list);

  $dev_list_json = json_encode([]);

  if ($data_num!=0) {
    $dev_list_json = json_encode($dev_list, JSON_UNESCAPED_SLASHES);
  }
  ?>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        <i class="glyphicon glyphicon-user"></i> &nbsp; My Profile
      </h3>
      <br>
    </div>
    <div class='panel-body'>
        <form name="rental_form" class="form-horizontal validetta" id="rental_form" method="post" action="process.php">
                <legend>Rental Informations</legend>
                <input type="hidden" name="device_id" id="device_id">
                <div class="form-group">
                    <label class="control-label col-sm-3">Hari / Tanggal</label>
                    <div class="col-sm-9">
                        <input type="text" name="rental_date" id="rental_date">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Nama Peminjam</label>
                    <div class="col-sm-9">
                        <input type="text" name="renter_name" id="renter_name" data-validetta="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Device Type</label>
                    <div class="col-sm-9">
                        <select name="device_type" id="device_type">
                        <?php
                            // Get all device types
                            $dev_types     = $deviceclass->show_all_device_types();
                            $data_num = count($dev_types);

                            if ($data_num!=0) {
                              foreach ($dev_types as $type_data) {
                                echo '<option value="'.$type_data["type_id"].'">'.$type_data["type_name"].'</option>';
                              }
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Device Code</label>
                    <div class="col-sm-9">
                        <select name="device_code" id="device_code" data-validetta="required"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Brand</label>
                    <div class="col-sm-9">
                        <input type="text" id="device_brand" disabled data-validetta="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Model</label>
                    <div class="col-sm-9">
                        <input type="text" id="device_model" disabled data-validetta="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Serial</label>
                    <div class="col-sm-9">
                        <input type="text" id="device_serial" disabled data-validetta="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Location</label>
                    <div class="col-sm-9">
                        <input type="text" id="location_name" disabled data-validetta="required">
                    </div>
                </div>
              <hr class="dashed" />
                <input type="hidden" name="privileges" value="<?php echo $_SESSION['privileges'] ?>">
                <input type="hidden" name="level" id="level" value="user">
                <input type="hidden" name="action" id="action" value="rent">
                <input type="hidden" name="action2" id="action2" value="dashboard">
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </div>
</div>
<?php

// get footer
include("./include/include_footer.php");
// get plugins
include("./include/init_validetta.php");
// get page setting
echo "<script type='text/javascript'>var devList = $dev_list_json;</script>";
echo "<script type='text/javascript' src='./js/rental_form.js'></script>";
?>