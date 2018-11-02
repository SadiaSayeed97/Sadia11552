<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
<div class="container">
<div class="page-header">
	<h1>Create Page</h1>
</div>
      
<?php
$host = "localhost";
$db_name = "SadiaTable";
$username = "sadia";
$password = "sadia";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

if($_POST){
    try{
        $query = "INSERT INTO Customer_11552 SET ShopID=:ShopID,Shop_Name=:Shop_Name, ContactPerson=:ContactPerson, ContactNumber=:ContactNumber, Address=:Address, Area=:Area, GeographicalCoordinates=:GeographicalCoordinates";
 
        $stmt = $con->prepare($query);

	$shopid=htmlspecialchars(strip_tags($_POST['ShopID'])); 
        $shopname=htmlspecialchars(strip_tags($_POST['Shop_Name']));
        $contactperson=htmlspecialchars(strip_tags($_POST['ContactPerson']));
        $contactno=htmlspecialchars(strip_tags($_POST['ContactNumber']));
	$address=htmlspecialchars(strip_tags($_POST['Address']));
	$area=htmlspecialchars(strip_tags($_POST['Area']));
	$coordinates=htmlspecialchars(strip_tags($_POST['GeographicalCoordinates']));
 
        $stmt->bindParam(':ShopID', $shopid);
	$stmt->bindParam(':Shop_Name', $shopname);
        $stmt->bindParam(':ContactPerson', $contactperson);
        $stmt->bindParam(':ContactNumber', $contactno);
	$stmt->bindParam(':Address', $address);
	$stmt->bindParam(':Area', $area);
	$stmt->bindParam(':GeographicalCoordinates', $coordinates);
                  
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Shop ID</td>
            <td><input type='text' name='ShopID' class='form-control' /></td>
        </tr>
        <tr>
            <td>Shop Name</td>
            <td><input type='text' name='Shop_Name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td><input type='text' name='ContactPerson' class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td><input type='text' name='ContactNumber' class='form-control' /></td>
        </tr>
	<tr>
            <td>Address</td>
            <td><input type='text' name='Address' class='form-control' /></td>
        </tr>
	<tr>
            <td>Area</td>
            <td><input type='text' name='Area' class='form-control' /></td>
        </tr>
	<tr>
            <td>Coordinates</td>
            <td><input type='text' name='GeographicalCoordinates' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
		<a href='sadiatable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
          
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
