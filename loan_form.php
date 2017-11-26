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
        <i class="glyphicon glyphicon-user"></i> &nbsp; Profile
      </h3>
      <br>
    </div>
    <div class='panel-body'>
        <form name="loan_form" class="form-horizontal validetta" id="loan_form" method="post" action="process.php">
                <legend>Loan Informations</legend>
                <input type="hidden" name="device_id" id="device_id">

<form class="container">                
  <div class="row">
    <div class="col-md-6 mb-3">
      <label>* Loan Date</label>
      <input type="text" class="form-control" name="loan_date" id="loan_date" placeholder="Loan Date" required>
    </div>
        
    <div class="col-md-6 mb-3">
      <label>* Device Type</label>
      <select name="device_type" class="form-control" id="device_type" tabindex="5" required>
      <option selected>Select One</option>
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
                        <br />

<div class="row">                        
    <div class="col-md-6 mb-3">
      <label>* Loan Name</label>
      <input type="text" class="form-control" name="loan_name" id="loan_name" placeholder="Full Name" tabindex=1 required>
    </div>

<div class="col-md-6 mb-3">
      <label>Device Code</label>
      <select name="device_code" class="form-control" id="device_code" data-validetta="required" tabindex="6" ></select>
    </div>
    </div>
    <br />                   

<div class="row">
    <div class="col-md-6 mb-3">
      <label>* Department</label>
      <input type="text" class="form-control" name="dept" id="dept" placeholder="Department" tabindex=2 required>

    </div>
    <div class="col-md-6 mb-3">
      <label>Brand</label>
      <input type="text" class="form-control" name="device_brand" id="device_brand" placeholder="Brand" disabled required>
      
    </div>
  </div>
  <br />
  
  <div class="row">
    <div class="col-md-6 mb-3">
      <label>* Necessary</label>
      <input type="text" class="form-control" name="necessary" id="necessary" placeholder="Necessary" tabindex=3 required>

    </div>
    <div class="col-md-6 mb-3">
      <label>Model</label>
      <input type="text" class="form-control" name="device_model" id="device_model" placeholder="Model" required disabled>
    </div>
  </div>
  <br />

  <div class="row">
    <div class="col-md-6 mb-3">
      <label>Return Date</label>
      <input type="text" class="form-control" name="return_date" id="return_date" placeholder="Return Date" tabindex="4">
    </div>
    
    <div class="col-md-6 mb-3">
      <label>Serial</label>
      <input type="text" class="form-control" name="device_serial" id="device_serial" placeholder="Serial" required disabled>
    </div>
    </div>
  <br />
  
<!--  <div class="row">
    <div class="col-md-6 mb-3">
      <label>Loan Date bawah</label>
      <input type="text" class="form-control" name="loan_date" id="loan_date" placeholder="Loan Date" required>
    </div>
    -->
    <div class="row">
    <div class="col-md-6 mb-3">
      <label>Location</label>
      <input type="text" class="form-control" name="location_name" id="location_name" placeholder="Location" required disabled>
    </div>

  <br />
  
 
  </div>
    
    <hr class="dashed" /><p class="pull-left">* Required fields</p><br /><br />
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
echo "<script type='text/javascript' src='./js/loan_form.js'></script>";
?>