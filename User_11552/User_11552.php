  <?php
echo "<a href='CreateTable.php' class='btn btn-primary m-r-1em'>Create</a>";
echo "<a href='../Login_11552/welcome.php' class='btn btn-primary m-r-1em'>Home</a>";
echo "<a href = '../Login_11552/logout.php' class='btn btn-danger'>Sign Out</a>";
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
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

$sql = "SELECT * FROM User_11552";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
	 <tr>
	 <th>UserName</th>
	 <th>Password</th>
	 <th>Active</th>
	 <th>PersonID</th>
	 </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["UserName"]."</td>
	     <td>".$row["Password"]."</td>
	     <td>".$row["Active"]."</td>
	     <td>".$row["PersonID"]."</td>";  
	echo "<td>";
            // we will use this links on next part of this post
            echo "<a href='Update.php?id={$row["UserName"]}' class='btn btn-primary m-r-1em'>Edit</a>";
 	echo " ";
            // we will use this links on next part of this post
            echo "<a href='delete.php?id={$row['UserName']}' class='btn btn-danger'>Delete</a>";
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
</body>
</html>

