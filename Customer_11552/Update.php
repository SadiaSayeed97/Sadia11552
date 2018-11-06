<!DOCTYPE HTML>
<html>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Product</h1>
        </div>
     
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
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
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM Customer_11552 WHERE ShopID = ?";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $shopid = $row['ShopID'];
    $shop_name = $row['Shop_Name'];
    $contactperson = $row['ContactPerson'];
    $contactnumber = $row['ContactNumber'];
    $address = $row['Address'];
    $area = $row['Area'];
    $geographicalcoordinates = $row['GeographicalCoordinates'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<?php	
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE Customer_11552 
                    SET Shop_Name=:Shop_Name, ContactPerson=:ContactPerson, ContactNumber=:ContactNumber, Address=:Address, Area=:Area, GeographicalCoordinates=:GeographicalCoordinates
                    WHERE ShopID = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
         
        $shopname=htmlspecialchars(strip_tags($_POST['Shop_Name']));
        $contactperson=htmlspecialchars(strip_tags($_POST['ContactPerson']));
        $contactno=htmlspecialchars(strip_tags($_POST['ContactNumber']));
	$address=htmlspecialchars(strip_tags($_POST['Address']));
	$area=htmlspecialchars(strip_tags($_POST['Area']));
	$coordinates=htmlspecialchars(strip_tags($_POST['GeographicalCoordinates']));
 
	$stmt->bindParam(':Shop_Name', $shopname);
        $stmt->bindParam(':ContactPerson', $contactperson);
        $stmt->bindParam(':ContactNumber', $contactno);
	$stmt->bindParam(':Address', $address);
	$stmt->bindParam(':Area', $area);
	$stmt->bindParam(':GeographicalCoordinates', $coordinates);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
		header('Location: ../Customer_11552/sadiatable.php');

        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Shop_Name</td>
            <td><input type='text' name='Shop_Name' value="<?php echo htmlspecialchars($shop_name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>ContactPerson</td>
            <td><input type='text' name='ContactPerson' value="<?php echo htmlspecialchars($contactperson, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>ContactNumber</td>	
            <td><input type='text' name='ContactNumber' value="<?php echo htmlspecialchars($contactnumber, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Address</td>
            <td><input type='text' name='Address' value="<?php echo htmlspecialchars($address, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Area</td>
            <td><input type='text' name='Area' value="<?php echo htmlspecialchars($area, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>GeographicalCoordinates</td>
            <td><input type='text' name='GeographicalCoordinates' value="<?php echo htmlspecialchars($geographicalcoordinates, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='sadiatable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
