<?php


// Get all device data
$device_datas_all       = $devClass->show_device();
//$device_datas_new       = $devClass->show_device("", "New");
$device_datas_in_use    = $devClass->show_device("", "In User");
$device_datas_damaged   = $devClass->show_device("", "Damaged");
$device_datas_repaired  = $devClass->show_device("", "Repaired");
$device_datas_keep = $devClass->show_device("", "Keep In IT");

// Loop device data all
$all_total = 0;
foreach ($device_datas_all as $dda) {
	$all_total++;
}

// Loop device data new
/*$new_total = 0;
foreach ($device_datas_new as $ddn) {
	$new_total++;
}*/

// Loop device data in use
$in_use_total = 0;
foreach ($device_datas_in_use as $ddi) {
	$in_use_total++;
}

// Loop device data damaged
$damaged_total = 0;
foreach ($device_datas_damaged as $ddd) {
	$damaged_total++;
}

// Loop device data repaired
$repaired_total = 0;
foreach ($device_datas_repaired as $ddr) {
	$repaired_total++;
}

// Loop device data keep
$keep_total = 0;
foreach ($device_datas_keep as $ddds) {
	$keep_total++;
}

?>

<!-- Chart JS -->


<script type="text/javascript" src="./assets/plugins/chartjs/Chart.bundle.js"></script>


<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
       labels : [ "All Devices", "In User", "Damaged", "Repaired", "Keep In IT" ],
        datasets: [{			  
            label: 'TOTAL ALL DEVICE',
			data : [<?php echo $all_total.",".$in_use_total.",".$damaged_total.",".$repaired_total.",".$keep_total; ?>],
			
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],  			
            borderWidth: 1
        }]
		
    },
   options: { 
        legend: {
            labels: {
                fontColor: "black",
                fontSize: 20,
				fontStyle: "bold",
				fontFamily: "Calibri",
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "black",
                    fontSize: 16,
                    stepSize: 1,
                    beginAtZero: true
                }
            }],
            xAxes: [{
                ticks: {
                    fontColor: "black",
                    fontSize: 16,
                    stepSize: 1,
					fontFamily: "Calibri",
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<!--
<script type="text/javascript">
	var barChartData = {
		labels : [ "All Devices", "In Use", "Damaged", "Repaired", "Keep In" ],
		datasets : [
			{
				fillColor: "rgba(151,187,205,0.5)",
	            strokeColor: "rgba(151,187,205,0.8)",
	            highlightFill: "rgba(151,187,205,0.75)",
	            highlightStroke: "rgba(151,187,205,1)",
				data : [<?php echo $all_total.",".$in_use_total.",".$damaged_total.",".$repaired_total.",".$keep_total; ?>]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}
</script>

-->