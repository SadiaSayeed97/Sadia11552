<?php
   include('session.php');
   $servername = "localhost";
$username = "sadia";
$password = "sadia";
$dbname = "SadiaTable";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$q1 = mysqli_query($conn, "select count(*) from Customer_11552");
$q2 = mysqli_query($conn, "select count(*) from SalesPerson_11552");
$q3 = mysqli_query($conn, "select count(*) from Product_11552");
$q4 = mysqli_query($conn, "select count(*) from User_11552");
$q5 = mysqli_query($conn, "select count(*) from SalesOrder_11552");

$row1 = mysqli_fetch_array($q1);
$row2 = mysqli_fetch_array($q2);
$row3 = mysqli_fetch_array($q3);
$row4 = mysqli_fetch_array($q4);
$row5 = mysqli_fetch_array($q5);
?>
<html>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   <head>
      <title>Home Page</title>
   </head>
   <style>
body{
background-repeat: repeat;
  background-position: left bottom;
  background-size: 430px;
  background-image: url("splash.jpg");
}
h1{
font-size:50px;
}
</style>

   <body>
      <h1 align="center">W E L C O M E , <?php echo $login_session; ?>!</h1>

      <div id="chartContainer" style="height: 300px; width: 100%;"></div>

	<table>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='../Customer_11552/sadiatable.php' class='btn btn-primary'>Customer</a>
	<a href='../SalesPerson_11552/SalesPerson_11552.php' class='btn btn-primary'>Salesperson</a>
	<a href='../Product_11552/Product_11552.php' class='btn btn-primary'>Product</a>
	<a href='../User_11552/User_11552.php' class='btn btn-primary'>User</a>
	<a href='../SalesOrder_11552/table.php' class='btn btn-primary'>Salesorder</a>
	<a href='../Survey_11552/survey.php' class='btn btn-primary'>Field Survey</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href = "logout.php" class="btn btn-danger">Sign Out</a>
	</div>
	</tr>
	</table> 
   </body>
<script>
window.onload = function () {
	
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Dashboard"
	},
	axisX: {
		interval: 1
	},
	axisY: {
		interval: 1,
		title: "Number of entries",
	},
	data: [{
		type: "bar",
		dataPoints: [
			{ label: "Customers", y: <?php echo $row1[0]; ?> },
			{ label: "Salespersons", y: <?php echo $row2[0]; ?> },
			{ label: "Products", y: <?php echo $row3[0]; ?> },
			{ label: "Users", y: <?php echo $row4[0]; ?> },
			{ label: "Invoices", y: <?php echo $row5[0]; ?> }
		]
	}]
});
chart.render();

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</html>
