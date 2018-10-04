<?php
   include('session.php');
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
</style>

   <body>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
      <h1 align="center">W E L C O M E , <?php echo $login_session; ?>!</h1>



	<table>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='/Customer_11552/sadiatable.php' class='btn btn-primary'>Customer</a>
	<a href='/SalesPerson_11552/SalesPerson_11552.php' class='btn btn-primary'>Salesperson</a>
	<a href='/Product_11552/Product_11552.php' class='btn btn-primary'>Product</a>
	<a href='/User_11552/User_11552.php' class='btn btn-primary'>User</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href = "logout.php" class="btn btn-danger">Sign Out</a>
	</div>
	</tr>
	</table> 
   </body>
</html>
