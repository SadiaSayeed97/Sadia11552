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
    $query = "SELECT * FROM SalesPerson_11552 WHERE PersonID = ?";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $PersonID = $row['PersonID'];
    $Name = $row['Name'];
    $ContactNo = $row['ContactNo'];
    $ShopID = $row['ShopID'];
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
        $query = "UPDATE SalesPerson_11552 
                    SET PersonID=:PersonID, Name=:Name, ContactNo=:ContactNo, ShopID=:ShopID
                    WHERE PersonID = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
         
        $PersonID=htmlspecialchars(strip_tags($_POST['PersonID']));
        $Name=htmlspecialchars(strip_tags($_POST['Name']));
        $ContactNo=htmlspecialchars(strip_tags($_POST['ContactNo']));
	$ShopID=htmlspecialchars(strip_tags($_POST['ShopID']));
 
	$stmt->bindParam(':PersonID', $PersonID);
        $stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':ContactNo', $ContactNo);
	$stmt->bindParam(':ShopID', $ShopID);
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
            <td>Person ID</td>
            <td><input type='text' name='PersonID' value="<?php echo htmlspecialchars($PersonID, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type='text' name='Name' value="<?php echo htmlspecialchars($Name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact No</td>	
            <td><input type='text' name='ContactNo' value="<?php echo htmlspecialchars($ContactNo, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
	<td>Shop ID</td>
	<td>
	<?php
	$stmt = $con->prepare("select ShopID from Customer_11552");
	$stmt->execute();
    	echo "<select name='ShopID' class='form-control'>";
	echo '<option value="">None</option>';
    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                  echo '<option value="'.$row["ShopID"].'">'.$row["ShopID"].'</option>';                
	}
    	echo "</select>";
	?>
	</td>
	</tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='SalesPerson_11552.php' class='btn btn-danger'>Back</a>
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
