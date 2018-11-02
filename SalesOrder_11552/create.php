<?php  
 $connect = mysqli_connect("localhost", "sadia", "sadia", "SadiaTable");  
 $res = mysqli_query($connect, "SELECT SalesPrice FROM Product_11552 WHERE ProductCode='".$_POST["PRODUCT"]."'");
 $row = mysqli_fetch_array($res);
 $sql = "INSERT INTO SalesOrder_11552 VALUES('".$_POST["ORDER_NO"]."', '".$_POST["CUSTOMER"]."', '".$_POST["DATE"]."', '".$_POST["SALESPERSON"]."', '".$_POST["PRODUCT"]."', '".$_POST["QUANTITY"]."', '".$row["SalesPrice"]."', '".$_POST["AMOUNT"]."')";  
 if(mysqli_query($connect, $sql))  
 {  
      mysqli_query($connect, "UPDATE SalesOrder_11552 SET Amount=Rate*Quantity WHERE OrderNo='".$_POST["ORDER_NO"]."'");
      echo 'Data Inserted';  
 }  
 ?> 
