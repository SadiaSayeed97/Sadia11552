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
        $query = "INSERT INTO SalesPerson_11552 SET PersonID=:PersonID,Name=:Name, ContactNo=:ContactNo, ShopID=:ShopID";
 
        $stmt = $con->prepare($query);

	$PersonID=htmlspecialchars(strip_tags($_POST['PersonID'])); 
        $Name=htmlspecialchars(strip_tags($_POST['Name']));
        $ContactNo=htmlspecialchars(strip_tags($_POST['ContactNo']));
        $ShopID=htmlspecialchars(strip_tags($_POST['ShopID']));
 
        $stmt->bindParam(':PersonID', $PersonID);
	$stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':ContactNo', $ContactNo);
        $stmt->bindParam(':ShopID', $ShopID);
                  
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
            <td>Person ID</td>
            <td><input type='text' name='PersonID' class='form-control' /></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type='text' name='Name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td><input type='text' name='ContactNo' class='form-control' /></td>
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
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
		<a href='SalesPerson_11552.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
          
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
