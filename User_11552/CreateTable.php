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
        $query = "INSERT INTO User_11552 SET UserName=:UserName,Password=:Password, Active=:Active, PersonID=:PersonID";
 
        $stmt = $con->prepare($query);

	$UserName=htmlspecialchars(strip_tags($_POST['UserName'])); 
        $Password=htmlspecialchars(strip_tags($_POST['Password']));
        $Active=htmlspecialchars(strip_tags($_POST['Active']));
        $PersonID=htmlspecialchars(strip_tags($_POST['PersonID']));
 
        $stmt->bindParam(':UserName', $UserName);
	$stmt->bindParam(':Password', $Password);
        $stmt->bindParam(':Active', $Active);
        $stmt->bindParam(':PersonID', $PersonID);
                  
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
		header('Location: ../User_11552/User_11552.php');
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
            <td>User Name</td>
            <td><input type='text' name='UserName' class='form-control' /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='text' name='Password' class='form-control' /></td>
        </tr>
        <tr>
            <td>Active</td>
            <td><input type='text' name='Active' class='form-control' /></td>
        </tr>
        <tr>
	<td>Person ID</td>
	<td>
	<?php
	$stmt = $con->prepare("select PersonID from SalesPerson_11552");
	$stmt->execute();
    	echo "<select name='PersonID' class='form-control'>";
	echo '<option value="">None</option>';
    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                  echo '<option value="'.$row["PersonID"].'">'.$row["PersonID"].'</option>';                
	}
    	echo "</select>";
	?>
	</td>
	</tr>	
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
		<a href='User_11552.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
          
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
