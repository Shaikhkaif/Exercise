



<!DOCTYPE html>
<html>
<head>
	<title>Insert Logo </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
		<div class="container bg-danger">
			<h1 align="center">Insert logo Page</h1><br>

			<form method="POST" enctype="multipart/form-data">
				<fieldset >Insert logo</fieldset>
				
				<input type="file" name="Logo" class="form-control">
				<input type="text" name="Title" class="form-control" placeholder="Enter your title">
				<input type="file" name="Symbol" class="form-control">
				<input type="submit" name="insert" value="Submit" class="btn-primary form-control">
			</form>
		</div>

		<table border="2" style="border-collapse:collapse;">
			<tr>
				<td>Logo</td>
				<td>Title</td>
				<td>Symbol</td>
			</tr>
			<?php 

			$con = mysqli_connect("localhost","root","","practice");

			$sql = "SELECT * FROM db";

			$query = mysqli_query($con,$sql);

			while ($rows =mysqli_fetch_assoc($query)) {

				?>
				<tr>
					<td><img src="<?php echo $rows['logo']; ?>" height="30" width="30"></td>
					<td><?php echo $rows['title'];?></td>
					<td><img src="<?php echo $rows['symbol'];?>" height="30" width="30"></td>
				</tr>			
			<?php
			}

			 ?>

		</table>
</body>
</html>
<?php

$con = mysqli_connect("localhost","root","","practice");// To connect Database i use mysqli_connect function.

if ($con) {

	if (isset($_POST['save'])) {


		$title = $_POST['title'];

		$target_dirr ="photo/";
		$target_file = $target_dirr.basename($_FILES["logo"]["name"]);
		move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);

		$target_dirr ="photo/";
		$target_file2 = $target_dirr.basename($_FILES["symbol"]["name"]);
		move_uploaded_file($_FILES["symbol"]["tmp_name"], $target_file2);

		$sql = "INSERT INTO db(logo,title,symbol) VALUES ('$$target_file','$title','$target_file2')";

		$query = mysqli_query($con,$sql);

		if ($query) {
			 echo "Data Inserted Successful";
		}
		else{
			echo "Failed to insert data";
		}

	}
	else{
		die("Please Click Submit button for save data");
	}
	
	
}
else{
	die("Database Connection Failed");
}


?>


