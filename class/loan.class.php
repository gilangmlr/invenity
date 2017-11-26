<?php
/**
* Component Class
* Manage component system
*
* @author Gilang Gumilar
* @version 0.1
*/

require_once(__DIR__ . '/../lib/db.class.php');
require_once(__DIR__ . '/system.class.php');

class LoanClass
{
  /**
  * Construct
  * 
  */
  public function __construct() {
    $this->db       = new DB();
    $this->sysClass = new SystemClass();
  }


  /**
  * Show all Loan records
  *
  * @return   array   $result
  *
  */
  public function show_loans($all = true, $returned = false)
  {
    $wh = '';
    if (!$all) {
      $wh = $returned? ' AND returned = 1 ' : ' AND returned = 0 ';
    }
    $query = "SELECT DATE_FORMAT(r.`loan_date`, '%Y-%m-%d') as `loan_date_formatted`, r.*, a.*, 
          b.`type_name`, 
          c.`location_name`,
          lp.`place_name`, 
          lb.`building_name`, 
          lf.`floor_name` 
          FROM loan r 
          INNER JOIN device_list a  ON r.`device_id` =  a.`device_id`
          LEFT JOIN device_type b ON a.`type_id` = b.`type_id` 
          LEFT JOIN location c ON a.`location_id` = c.`location_id` 
          LEFT JOIN location_details d ON a.`location_id` = d.`location_id` 
          LEFT JOIN location_place lp ON d.`place_id` = lp.`place_id` 
          LEFT JOIN location_building lb ON d.`building_id` = lb.`building_id`  
          LEFT JOIN location_floor lf ON d.`floor_id` = lf.`floor_id`
          WHERE true" . $wh;
/*    if ($_SESSION['privileges'] !== '*') {
      $username = $_SESSION['username'];
      $query .= " AND r.`username` = '$username'";
    } */
    $result = $this->db->query($query);
    return $result; 
  } 

  /**
  * Rent a device
  *
  * @param  array   $dt_loan
  * @return   string  $process
  *
  */
  public function rent_device($dt_loan)
  {
    // assign variable
    $device_id   = intval($dt_loan["device_id"]);
    $loan_name = $dt_loan["loan_name"];
    $loan_date = $dt_loan["loan_date"];
	$dept = $dt_loan["dept"];
	$necessary = $dt_loan["necessary"];
	$return_date = $dt_loan["return_date"];

    // create query
    $query   = "INSERT INTO loan (username, loan_date, device_id, loan_name, created_date, updated_date, dept, necessary, return_date) VALUES ('$_SESSION[username]', '$loan_date', $device_id, '$loan_name', NOW(), NOW(), '$dept', '$necessary', NOW())";

    // add to database
    $process = $this->db->query($query);

    // create system log
    if ($process>0) {
      $this->sysClass->save_system_log($_SESSION['username'], $query);
    }

    // create query
    $queryUpd   = "UPDATE device_list SET device_status = 'In Use' WHERE device_id = $device_id";

    // update database
    $processUpd = $this->db->query($queryUpd);

    // create system log
    if ($processUpd>0) {
      $this->sysClass->save_system_log($_SESSION['username'], $queryUpd);
    }

    return $process;
  }

  /**
  * Return device
  *
  * @param  array   $dt_loan
  * @return   string  $process
  *
  */
  public function return_device($dt_loan)
  {
    // assign variable
    $device_id   = intval($dt_loan["device_id"]);

    // create query
    $query   = "UPDATE loan SET returned = 1 WHERE device_id = $device_id";

    // add to database
    $process = $this->db->query($query);

    // create system log
    if ($process>0) {
      $this->sysClass->save_system_log($_SESSION['username'], $query);
    }

    // create query
    $queryUpd   = "UPDATE device_list SET device_status = 'Keep In IT' WHERE device_id = $device_id";

    // update database
    $processUpd = $this->db->query($queryUpd);

    // create system log
    if ($processUpd>0) {
      $this->sysClass->save_system_log($_SESSION['username'], $queryUpd);
    }

    return $process;
  }
}

?>