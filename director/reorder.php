<?php
include('index.php');
require('dbconnect.php');
$sql = "SELECT name,availableamt FROM `medicine reorder`";
$result = $conn->query($sql);
$data = array();
while($row = $result->fetch_assoc()) {
  $name = $row["name"];
  $sales = (int)$row["availableamt"];
  $data[] = array($name, $sales);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        #update{
            border-bottom: 10px solid #111d13;
        }
        #updatre{
            background-color: #e63946;
        }
    </style>
    
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Medicine name');
      data.addColumn('number', 'Available amount');
      data.addRows(<?php echo json_encode($data); ?>);

      var options = {
        title: 'Total medicine available in stock',
        width: 900,
        height: 800,
        legend: { position: 'none' },
        bars: 'horizontal'
      };

      var chart = new google.visualization.BarChart(document.getElementById('bar-graph'));
      chart.draw(data, options);

    }
    </script>
    
</head>
<body>
<div id="central">
        <h7> Add/Update Medicine.</h7>
    <div id="all">
        <a href="reports.php" style="text-decoration: none; color:white;"><div class="allmenu" id="create">New Medicine</div></a>
        <a href="updmed.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updat">Update medicine</div></a>
        <a href="reorder.php" style="text-decoration: none; color:white;"><div class="allmenu" id="updatre">Check reorder</div></a>

    </div>
     <div id="bar-graph"></div>
<!-- //end of content -->
</div>

</body>

</html>