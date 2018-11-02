<?php  
 $connect = mysqli_connect("localhost", "sadia", "sadia", "SadiaTable");  
 $sql = "DELETE FROM SalesOrder_11552 WHERE OrderNo = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>
