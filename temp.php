<table id="tabel" class="table table-striped table-hover">
<thead class="thead-dark">
<tr>
<th>TEMP</th>
</tr>
</thead>
<tbody>
<?php
$.get("data.php",function(data){
print("<tr>"+"<td>"+JSON.parse(data)[0])+"</td>"+"</tr>");
});
?>
</tbody>
<div id="linechart_material" style="width: 900px; height: 500px"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).on("load", function(){
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
window.onload = timedRefresh(60000);

var Row = document.getElementById("row");
var Cells = Row.getElementsByTagName("td");
var oTable = document.getElementById("tabel");
var arr = [];
for(var i = 1; i < tabel.rows.length;i++){
	var oCells = oTable.rows.item(i).cells;
	var arr2 = [i,parseInt(oCells[0].firstChild.data)];
	arr.push(arr2);
}
google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = new google.visualization.DataTable();
data.addColumn('number', 'Time');
data.addColumn('number', 'temperature');
data.addRows(arr);
var options = {
chart: {
title: 'temperatuur in de kamer',
subtitle: 'in graden celsius'
},
width: 900,
height: 500
};
var chart = new google.charts.Line(document.getElementById('linechart_material'));
chart.draw(data, google.charts.Line.convertOptions(options));
}
});
function getData(){
var arrJSON = [];
var Row = document.getElementById("row");
var Cells = Row.getElementsByTagName("td");
var oTable = document.getElementById("tabel");
        for(var i = 1; i < tabel.rows.length;i++){
                var oCells = oTable.rows.item(i).cells;
                 var arr2 ={log: i,temperature: parseInt(oCells[0].firstChild.data)};
                arrJSON.push(arr2);
        }
       	var url = 'https://raspberrypi/data.php';
	var data = arrJSON;

fetch(url, {
  method: 'POST', // or 'PUT'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{
    'Content-Type': 'application/json'
  }
}).then(res => res.json())
.then(response => console.log('Success:', JSON.stringify(response)))
.catch(error => console.error('Error:', error));
}
</script>
</body>
</html>
