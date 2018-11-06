<html>  
      <head>  
           <title>SalesOrder</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
	<a href='../Login_11552/welcome.php' class='btn btn-primary m-r-1em'>Home</a>
	<a href = '../Login_11552/logout.php' class='btn btn-danger'>Sign Out</a>
           <div class="container">  
                <div class="table-responsive">
		     <div class="page-header">  
                     <h1 align="center">Salesorder Table</h1><br />
		     </div>  
	<h3>Select Customer ID:</h3>
	<?php
	$host = "localhost";
	$db_name = "SadiaTable";
	$username = "sadia";
	$password = "sadia";
	$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
	$stmt = $con->prepare("select ShopID from Customer_11552");
	$stmt->execute();
    	echo "<select id='CUSTOMER_ID' class='form-control'>";
	echo '<option value="">None</option>';
    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                  echo '<option value="'.$row["ShopID"].'">'.$row["ShopID"].'</option>';                
	}
    	echo "</select>";
	?>
	<br />
                     <div id="live_data"></div>            
                </div>  
           </div>  
      </body>  
</html>  
<script>  
 $(document).ready(function(){  
	var CUSTOMER_ID = $('#CUSTOMER_ID').val();
      $("#CUSTOMER_ID").change(function(){
       CUSTOMER_ID = $('#CUSTOMER_ID').val();
	fetch_data();
      });
      function fetch_data()  
      {  
           $.ajax({  
                url:"retrieve.php",  
                method:"POST",  
		data:{CUSTOMER_ID:CUSTOMER_ID},  
                dataType:"text",
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
      fetch_data();  
      $(document).on('click', '#btn_add', function(){  
           var ORDER_NO = $('#ORDER_NO').text();  
           var CUSTOMER = CUSTOMER_ID;
	   var DATE = $('#DATE').text();
	   var SALESPERSON = $('#SALESPERSON').val();
	   var PRODUCT = $('#PRODUCT').val();
	   var QUANTITY1 = $('#QUANTITY').text(); 
	   var RATE1 = $('#RATE').text();
	   var QUANTITY = parseInt(QUANTITY1);
	   var RATE = parseInt(RATE1);
	   var AMOUNT = 0;
           if(ORDER_NO == '')  
           {  
                alert("Enter ORDER NUMBER");  
                return false;  
           }    
           if(DATE == '')  
           {  
                alert("Enter DATE");  
                return false;  
           }   
           if(QUANTITY == '')  
           {  
                alert("Enter QUANTITY");  
                return false;  
           }  
           $.ajax({  
                url:"create.php",  
                method:"POST",  
                data:{ORDER_NO:ORDER_NO, CUSTOMER:CUSTOMER, DATE:DATE, SALESPERSON:SALESPERSON, PRODUCT:PRODUCT, QUANTITY:QUANTITY, RATE:RATE, AMOUNT:AMOUNT},  
                dataType:"text",  
                success:function(data)  
                {  
                     alert(data); 
                     fetch_data();  
                }  
           })  
      });  
      function edit_data(id, text, column_name)  
      {  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                     alert(data);  
	             fetch_data();
                }  
           });  
      }  
      $(document).on('blur', '.ORDER_NO', function(){  
           var id = $(this).data("id1");  
           var ORDER_NO = $(this).text();  
           edit_data(id, ORDER_NO, "OrderNo");  
      });   
      $(document).on('blur', '.DATE', function(){  
           var id = $(this).data("id3");  
           var DATE = $(this).text();  
           edit_data(id, DATE, "Date");  
      });  
      $(document).on('blur', '.SALESPERSON', function(){  
           var id = $(this).data("id4");  
           var SALESPERSON = $(this).val();  
           edit_data(id, SALESPERSON, "SalespersonID");  
      });
      $(document).on('blur', '.PRODUCT', function(){  
           var id = $(this).data("id5");  
           var PRODUCT = $(this).val();  
           edit_data(id, PRODUCT, "ProductID");  
      });  
      $(document).on('blur', '.QUANTITY', function(){  
           var id = $(this).data("id6");  
           var QUANTITY = $(this).text();  
           edit_data(id, QUANTITY, "Quantity");  
      });
      $(document).on('blur', '.RATE', function(){  
           var id = $(this).data("id7");  
           var RATE = $(this).text();  
           edit_data(id, RATE, "Rate");  
      });   
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id9");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });  
</script>
