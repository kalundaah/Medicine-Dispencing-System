<?php
include('index.php');
require('dbconnect.php');
// $sql = "SELECT name,revenue FROM `medicine` ORDER BY `revenue` DESC";
// $result = mysqli_query($conn, $sql);
// $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
$sql = "SELECT name,totalsold,revenue FROM medicine ORDER BY `revenue` DESC";
$result = $conn->query($sql);
$data = array();
while($row = $result->fetch_assoc()) {
  $name = $row["name"];
  $sales = (int)$row["revenue"];
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
        #allocate{
            border-bottom: 10px solid #111d13;
        }
    </style>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Medicine name');
      data.addColumn('number', 'Revenue in Kshs');
      data.addRows(<?php echo json_encode($data); ?>);

      var options = {
        title: '',
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
        <div id="bar-graph"></div>
    </div>
<!-- //end of content -->
</div>
    
    
</body>
</html>
