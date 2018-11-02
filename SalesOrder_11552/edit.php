<?php  
 $connect = mysqli_connect("localhost", "sadia", "sadia", "SadiaTable");  
 $id = $_POST["id"];  
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE SalesOrder_11552 SET ".$column_name."='".$text."' WHERE OrderNo='".$id."'"; 
 if($column_name=='ProductID'){
	$res = mysqli_query($connect, "SELECT SalesPrice FROM Product_11552 WHERE ProductCode='".$text."'");
	$row = mysqli_fetch_array($res);
	mysqli_query($connect, "UPDATE SalesOrder_11552 SET Rate='".$row['SalesPrice']."' WHERE OrderNo='".$id."'");
 } 
 if(mysqli_query($connect, $sql))  
 {  
      mysqli_query($connect, "UPDATE SalesOrder_11552 SET Amount=Rate*Quantity WHERE OrderNo='".$id."'");
      echo 'Data Updated';  
 }  
 ?>
