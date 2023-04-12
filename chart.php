<?php
error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "";
$database = "datasensors";


$conn = mysqli_connect("localhost", "root", "", "datasensors");
if (!$conn) {
  die("Connection failed : " . mysqli_connect_error());
}

$sql = "SELECT payload, waktu FROM read_sensor";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $label = $label . "'" . $row["waktu"] . "'" . ",";
    $data = $data . $row["payload"] . ",";
  }
} else {
  echo "0 results";
}

mysqli_close($conn)
?>

<!DOCTYPE html>
<html lang="">

<head>
  <meta charset="utf-8">
  <title>Chart.JS</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<body>
  <div>
    <div style="width: 600px; height: 600px;">
  <canvas id="myChart"></canvas>
</div>
</div>

<button type="button" id="download-pdf" >
  Download PDF
</button>

<button type="button" id="download-pdf2" >
  Download Higher Quality PDF
</button>
  </div>
  <script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?php echo $label ?>],
        datasets: [{
          label: 'My First Dataset',
          data: [<?php echo $data ?>],
          backgroundColor: [
            'rgb(75, 192, 192)'
          ],
          borderColor: [
            'rgb(75, 192, 192)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>


<script>
//original canvas
var canvas = document.querySelector('#myChart');
var context = canvas.getContext('2d');

new Chart(context).Line(chart_data);

//add event listener to button
document.getElementById('download-pdf').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#myChart');
  //creates image
  var canvasImg = canvas.toDataURL("image/jpeg", 1.0);
  
  //creates PDF from img
  var doc = new jsPDF('landscape');
  doc.setFontSize(20);
  doc.text(15, 15, "myChart");
  doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150 );
  doc.save('canvas.pdf');
}

//add event listener to 2nd button
document.getElementById('download-pdf2').addEventListener("click", downloadPDF2);

//download pdf form hidden canvas
function downloadPDF2() {
  var newCanvas = document.querySelector('#myChart');

  //create image from dummy canvas
  var newCanvasImg = newCanvas.toDataURL("image/jpeg", 1.0);
  
    //creates PDF from img
  var doc = new jsPDF('landscape');
  doc.setFontSize(20);
  doc.text(15, 15, "Super Cool Chart");
  doc.addImage(newCanvasImg, 'JPEG', 10, 10, 280, 150 );
  doc.save('new-canvas.pdf');
 }
</script>
</body>
</head>
</html>