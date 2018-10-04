<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
 
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
$username = "root";
$password = "";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM Product_11552 WHERE ProductCode = ?";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $ProductCode = $row['ProductCode'];
    $Brand = $row['Brand'];
    $Type = $row['Type'];
    $Shade = $row['Shade'];
    $Size = $row['Size'];
    $SalesPrice = $row['SalesPrice'];
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
        $query = "UPDATE Product_11552 
                    SET ProductCode=:ProductCode, Brand=:Brand, Type=:Type, Shade=:Shade, Size=:Size, SalesPrice=:SalesPrice
                    WHERE ProductCode = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
         
        $ProductCode=htmlspecialchars(strip_tags($_POST['ProductCode']));
        $Brand=htmlspecialchars(strip_tags($_POST['Brand']));
        $Type=htmlspecialchars(strip_tags($_POST['Type']));
	$Shade=htmlspecialchars(strip_tags($_POST['Shade']));
	$Size=htmlspecialchars(strip_tags($_POST['Size']));
	$SalesPrice=htmlspecialchars(strip_tags($_POST['SalesPrice']));
 
	$stmt->bindParam(':ProductCode', $ProductCode);
        $stmt->bindParam(':Brand', $Brand);
        $stmt->bindParam(':Type', $Type);
	$stmt->bindParam(':Shade', $Shade);
	$stmt->bindParam(':Size', $Size);
	$stmt->bindParam(':SalesPrice', $SalesPrice);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
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
            <td>ProductCode</td>
            <td><input type='text' name='ProductCode' value="<?php echo htmlspecialchars($ProductCode, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Brand</td>
            <td><input type='text' name='Brand' value="<?php echo htmlspecialchars($Brand, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Type</td>	
            <td><input type='text' name='Type' value="<?php echo htmlspecialchars($Type, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Shade</td>
            <td><input type='text' name='Shade' value="<?php echo htmlspecialchars($Shade, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Size</td>
            <td><input type='text' name='Size' value="<?php echo htmlspecialchars($Size, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>SalesPrice</td>
            <td><input type='text' name='SalesPrice' value="<?php echo htmlspecialchars($SalesPrice, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='Product_11552.php' class='btn btn-danger'>Back</a>
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
