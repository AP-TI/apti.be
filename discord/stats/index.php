<?php
include '../../../conn.php';
$sql = "SELECT * FROM AantalOnline";
$result = mysqli_query($apti, $sql);
$row = mysqli_fetch_assoc($result);
$limit = 10080;
if($_GET['bekijk'] == "vandaag"){
  $limit = 1440;
}
 ?>
 <html>
 <head>
   <title>APTI - Statistieken</title>
   <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="60">
   <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico'>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
       var data = google.visualization.arrayToDataTable([
         ['Datum en tijd', 'Aantal online',],
         <?php
         $sql = "SELECT * FROM (SELECT * FROM AantalOnline order by CheckID desc limit $limit) sub order by CheckID asc";
         $result = mysqli_query($apti, $sql);
         while ($row = mysqli_fetch_assoc($result)) {
          $datum = new DateTime($row['Datum']);
          $datum = $datum->format('Y-m-d H:i');
           echo "['".$datum."', ".$row['Aantal']."],";
         }
         ?>
       ]);


       var options = {
         title: 'APTI Server Statistieken',
         titleTextStyle:{color: '#FFF'},
         curveType: 'function',
         legend: { position: 'bottom' },
         legendTextStyle:{color: '#FFF'},
         animation: {
           duration: 1000,
           easing: 'out',
           "startup": true
         },
         backgroundColor: '#111111',
         hAxis:{
           textStyle: {color: '#FFF'}
         },
         vAxis:{
           textStyle: {color: '#FFF'}
         }
       };

       var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

       chart.draw(data, options);
     }
     setInterval(drawChart, (60 * 1000));
   </script>
 </head>
 <body>
 <?php
 if($_GET['bekijk'] == "vandaag"){
 ?>
 <a href="./" class="veranderDag">Afgelopen week</a>
 <?php
 }else{
 ?>
<a href="?bekijk=vandaag" class="veranderDag">Vandaag</a>
<?php
 }
 ?>
   <div id="curve_chart" style="min-width: 900px; max-width: auto; min-height: 500px; height: 78%;"></div>
 </body>
</html>
