/**
* Rental Form js
* 
* @author   Gilang Gumilar
*   @version  0.1
*/
jQuery(document).ready(function($) {
  $("#rental_date").datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date());

  for (var idx in devList) {
    var dev = devList[idx];
    $("#device_code").append($('<option value="'+dev["device_id"]+'">'+dev["device_code"]+'</option>'));
  }

  var dev = devList[0];
  $("#device_id").val(dev['device_id']);
  $("#type_name").val(dev['type_name']);
  $("#device_brand").val(dev['device_brand']);
  $("#device_model").val(dev['device_model']);
  $("#device_serial").val(dev['device_serial']);
  $("#location_name").val(dev['location_name']);

  function getDevice(id) {
    for (var i = 0; i < devList.length; i++) {
      if (devList[i]['device_id'] == id) {
        return devList[i];
      }
    }
  }

  $("#device_code").change(function() {
    var dev = getDevice($(this).val());
    $("#device_id").val(dev['device_id']);
    $("#type_name").val(dev['type_name']);
    $("#device_brand").val(dev['device_brand']);
    $("#device_model").val(dev['device_model']);
    $("#device_serial").val(dev['device_serial']);
    $("#location_name").val(dev['location_name']);
  });

});

  