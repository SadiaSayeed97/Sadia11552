<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
<a href='../Login_11552/welcome.php' class='btn btn-primary m-r-1em'>Home</a>
<a href = '../Login_11552/logout.php' class='btn btn-danger'>Sign Out</a>
<div class="container">
<div class="page-header">
	<h1>Survey Form</h1>
</div>
      
<?php

	require_once('../vendor/autoload.php');
    
	$client = new MongoDB\Client;
	$database = $client->selectDatabase('Sadia');
	$collection = $database->selectCollection('SURVEY_11552');
	if (isset($_POST['create']))
	{
		$data = [
			'coordinates' => $_POST['coordinates'],
			'shopName' => $_POST['shopName'],
			'available' => $_POST['available'],
			'front' => $_POST['front'],
			'competitor' => $_POST['competitor'],
			'timestamp' => new MongoDB\BSON\UTCDateTime
		];
		if (isset($_FILES['image']))
		{
			if (move_uploaded_file($_FILES['image']['tmp_name'], "upload/".$_FILES['image']['name'])){
				$data['image'] = $_FILES['image']['name'];
				echo 'FILE MOVED!!';
			}
			else
			{
				echo 'FILE NOT MOVED!';
				echo '<br>';
				echo $_FILES['image']['tmp_name'];
				echo '<br>';
			    echo $_FILES['image']['name'];
			}
			
		}
		else
		{
			echo 'FILE NOT FOUND!';
		}
		$result = $collection->insertOne($data);
		if($result->getInsertedCount() > 0)
		{
			$_SESSION['success_msg'] = "Form submitted";
			header('location: survey.php');
		}
		else {
			$_SESSION['error_msg'] = "Failed to submit";
			header('location: survey.php');
		}
	}
	if (isset($_SESSION['success_msg']))
    {
        echo '<br><br><div class="bg bg-success">';
        echo '<b>'; echo $_SESSION['success_msg']; echo '</b>';
        unset($_SESSION['success_msg']);
        echo '
        </div>';
    }
	if (isset($_SESSION['error_msg']))
	{
        echo '<br><br><div class="bg bg-danger">';
        echo '<b>'; echo $_SESSION['error_msg']; echo '</b>';
        unset($_SESSION['error_msg']);
        echo '
        </div>';
	}
	$forms = $collection->find();
	foreach($forms as $key => $form){
		$UTCDateTime = new MongoDB\BSON\UTCDateTime((string)$form['timestamp']);
		$DateTime = $UTCDateTime->toDateTime();
		echo '
		<div class = "row">
				<div class = "col-sm-4">
				<p>Time: '.$DateTime->format('d/m/Y H:i:s').'</p>
				<p>Coordinates: '.$form['coordinates'].'</p>
				<p>Are competitor products more prominent? : '.$form['competitor'].'</p>
				</div>
					<div class ="col-sm-4">
						<p>Shop Name: '.$form['shopName'].'</p>
						<p>Are my products available in shop? : '.$form['available'].'</p>
						<p>Are my products positioned in front? : '.$form['front'].'</p>
					</div>
					<div class = "col-sm-4"><img src="upload/'.$form['image'].'" width="180">
					</div>
		</div>
			<br>	<br>';
	}
?>
 
<form action = "survey.php" method="post" enctype="multipart/form-data">
 	
<hr>
	<h3>Create Form</h3>

	<p><b>Geographical Coordinates</b>: 
	<input type="text" name="coordinates" />
	</p>

	<p><b>Shop Name</b>: 
	<input type="text" name="shopName" />
	</p>

	<p><b>Products Available?</b>: 
	<input type="radio" name="available" value="Yes"> Yes   
	<input type="radio" name="available" value="No">  No
	</p>

	<p><b>Products positioned in front?</b>:
	<input type="radio" name="front" value="Yes"> Yes
	<input type="radio" name="front" value="No"> No
	</p>

	<p><b>Competitor products more prominent?</b>:
	<input type="radio" name="competitor" value="Yes"> Yes
	<input type="radio" name="competitor" value="No"> No
	</p>

	<p><b>Picture</b>: 
	<input type="file" name="image">
	</p>

<input type="submit" name="create" value="Insert" />
          
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
