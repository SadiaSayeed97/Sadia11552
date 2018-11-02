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
        $query = "INSERT INTO Product_11552 SET ProductCode=:ProductCode,Brand=:Brand, Type=:Type, Shade=:Shade, Size=:Size, SalesPrice=:SalesPrice";
 
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
            <td>Product Code</td>
            <td><input type='text' name='ProductCode' class='form-control' /></td>
        </tr>
        <tr>
            <td>Brand</td>
            <td><input type='text' name='Brand' class='form-control' /></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><input type='text' name='Type' class='form-control' /></td>
        </tr>
        <tr>
            <td>Shade</td>
            <td><input type='text' name='Shade' class='form-control' /></td>
        </tr>
	<tr>
            <td>Size</td>
            <td><input type='text' name='Size' class='form-control' /></td>
        </tr>
	<tr>
            <td>Sales Price</td>
            <td><input type='text' name='SalesPrice' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
		<a href='Product_11552.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
          
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
