<?php
   include("Config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['UserName']);
      $mypassword = mysqli_real_escape_string($db,$_POST['Password']); 
      
      $sql = "SELECT UserName FROM User_11552 WHERE UserName = '$myusername' and Password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>

   
   <head>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Courier New, Courier, monospace;
            font-size:20px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:22px;
         }
         .box {
            border:#666666 solid 2px;
         }
body{
background-repeat: repeat;
  background-position: left bottom;
  background-size: 430px;
  background-image: url("splash.jpg");
}

      </style>
      
   </head>
   
   <body bgcolor = "#dbd7cb">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#343434; color:#FFFFFF; padding:3px;" align = "center"><b>Login</b></div>	
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "UserName" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "Password" class = "box" /><br/><br />
		  <div align= "center">
                  <input type = "submit" value = " Submit "/><br />
		  </div>
               </form>
               
               
					
            </div>
				
         </div>
			
      </div>

   </body>

</html>