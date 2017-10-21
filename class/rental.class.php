<?php
/**
* Component Class
* Manage component system
*
* @author Noerman Agustiyan
* @version 0.1
*/

require_once(__DIR__ . '/../lib/db.class.php');
require_once(__DIR__ . '/system.class.php');

class RentalClass
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
  * Show all rental records
  *
  * @return   array   $result
  *
  */
  public function show_rentals()
  {
    $query = "SELECT DATE_FORMAT(r.`rental_date`, '%Y-%m-%d') as `rental_date_formatted`, r.*, a.*, 
          b.`type_name`, 
          c.`location_name`,
          lp.`place_name`, 
          lb.`building_name`, 
          lf.`floor_name` 
          FROM rental r 
          INNER JOIN device_list a  ON r.`device_id` =  a.`device_id`
          LEFT JOIN device_type b ON a.`type_id` = b.`type_id` 
          LEFT JOIN location c ON a.`location_id` = c.`location_id` 
          LEFT JOIN location_details d ON a.`location_id` = d.`location_id` 
          LEFT JOIN location_place lp ON d.`place_id` = lp.`place_id` 
          LEFT JOIN location_building lb ON d.`building_id` = lb.`building_id`  
          LEFT JOIN location_floor lf ON d.`floor_id` = lf.`floor_id`
          WHERE true";
    if ($_SESSION['privileges'] !== '*') {
      $username = $_SESSION['username'];
      $query .= " AND r.`username` = '$username'";
    }
    $result = $this->db->query($query);
    return $result;
  }

  /**
  * Rent a device
  *
  * @param  array   $dt_rental
  * @return   string  $process
  *
  */
  public function rent_device($dt_rental)
  {
    // assign variable
    $device_id   = intval($dt_rental["device_id"]);
    $renter_name = $dt_rental["renter_name"];
    $rental_date = $dt_rental["rental_date"];

    // create query
    $query   = "INSERT INTO rental (username, rental_date, device_id, renter_name, created_date, updated_date) VALUES ('$_SESSION[username]', '$rental_date', $device_id, '$renter_name', NOW(), NOW())";

    // add to database
    $process = $this->db->query($query);

    // create system log
    if ($process>0) {
      $this->sysClass->save_system_log($_SESSION['username'], $query);
    }

    // create query
    $queryUpd   = "UPDATE device_list SET device_status = 'in use' WHERE device_id = $device_id";

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
  * @param  array   $dt_rental
  * @return   string  $process
  *
  */
  public function return_device($dt_rental)
  {
    // assign variable
    $device_id   = intval($dt_rental["device_id"]);

    // create query
    $query   = "DELETE FROM rental WHERE device_id = $device_id";

    // add to database
    $process = $this->db->query($query);

    // create system log
    if ($process>0) {
      $this->sysClass->save_system_log($_SESSION['username'], $query);
    }

    // create query
    $queryUpd   = "UPDATE device_list SET device_status = 'keep' WHERE device_id = $device_id";

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