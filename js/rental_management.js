/**
* Rental Management js
* 
* @author   Gilang Gumilar
*   @version  0.1
*/
jQuery(document).ready(function($) {



});

  /**
  * Show rental detail
  * 
  * @param    device_id
  * 
  */
  function show_rental_detail (device_id) {
    $("#dl_rental_date").html($("#rental_date_"+device_id).val());
    $("#dl_renter_name").html($("#renter_name_"+device_id).val());
    $("#dl_dev_code").html($("#device_code_"+device_id).val());
    $("#dl_dev_type").html($("#device_type_"+device_id).val());
    $("#dl_dev_brand").html($("#device_brand_"+device_id).val());
    $("#dl_dev_model").html($("#device_model_"+device_id).val());
    $("#dl_dev_color").html($("#device_color_"+device_id).val());
    $("#dl_dev_serial").html($("#device_serial_"+device_id).val());

    $("#dl_dev_photo_real").prop('href', $("#device_photo_real_"+device_id).val());
    $("#dl_dev_photo_real").prop('title', $("#device_photo_description_"+device_id).val());
    $("#dl_dev_photo").prop('src', $("#device_photo_"+device_id).val());
    
    $("#dl_dev_description").html($("#device_description_"+device_id).val());
    $("#dl_dev_status").html($("#device_status_"+device_id).val());
    $("#dl_dev_location").html($("#location_name_"+device_id).val());
    $("#dl_dev_place").html($("#place_name_"+device_id).val());
    $("#dl_dev_building").html($("#building_name_"+device_id).val());
    $("#dl_dev_floor").html($("#floor_name_"+device_id).val());
    $("#modal_dialog_rental_detail").modal("show");
  }

  /**
  * Return device
  * 
  * @param    device_id
  * 
  */
  function return_device (device_id) {
    // Set modal value and show it!
    $("#modal_form").attr('action', './process.php');
    $("#modal_title").html("Confirmation");
    $("#modal_content").html("<p class='text-center'>Device Code: "+$("#device_code_"+device_id).val()+", Device Type: "+$("#device_type_"+device_id).val()+", Device Brand: "+$("#device_brand_"+device_id).val()+"<br>Sure want to <strong>return</strong> this device?</p><input type='hidden' name='device_id' value='"+device_id+"'><input type='hidden' name='action' value='return_device'>");
    $("#modal_footer").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button> <button type='submit' class='btn btn-primary'>Yes</button>");
    $("#modal_dialog").modal("show");
  }