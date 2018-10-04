  <?php
echo "<a href='CreateTable.php' class='btn btn-primary m-r-1em'>Create</a>";
echo "<a href='/Login_11552/welcome.php' class='btn btn-primary m-r-1em'>Home</a>";
echo "<a href = '/Login_11552/logout.php' class='btn btn-danger'>Sign Out</a>";
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SadiaTable";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Customer_11552";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
	 <tr>
	 <th>ShopID</th>
	 <th>Shop_Name</th>
	 <th>ContactPerson</th>
	 <th>ContactNumber</th>
	 <th>Address</th>
	 <th>Area</th>
	 <th>GeographicalCoordinates</th>
	 </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["ShopID"]."</td>
	     <td>".$row["Shop_Name"]."</td>
	     <td>".$row["ContactPerson"]."</td>
	     <td>".$row["ContactNumber"]."</td>
	     <td>".$row["Address"]."</td>
	     <td>".$row["Area"]."</td>
	     <td>".$row["GeographicalCoordinates"]."</td>";  
	echo "<td>";
            // we will use this links on next part of this post
            echo "<a href='Update.php?id={$row["ShopID"]}' class='btn btn-primary m-r-1em'>Edit</a>";
 	echo " ";
            // we will use this links on next part of this post
            echo "<a href='#' onclick='delete_user({$row["ShopID"]});'  class='btn btn-danger'>Delete</a>";
        echo "</td>";
	 echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?> 
<html>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<table style="width:100%">
</table>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
		
    padding: 15px;
    text-align: left;
}
td{
background-color: c3f1ff;
}
table#t01 {
    width: 100%;    
    background-color: #f1f1c1;
}	

</style>
<script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
</body>
</html>

