



<!DOCTYPE html>
<html>
<head>
	<title>Insert Logo </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
		<div class="container bg-danger">
			<h1 align="center">Logo Insert Page</h1><br>

			<form method="POST" enctype="multipart/form-data">
				<fieldset>Logo Insert</fieldset>
				
				<input type="text" name="title" class="form-control" placeholder="Enter your Title">
				
				<input type="file" name="logo_file" class="form-control">
				<input type="file" name="banner" class="form-control">
				<input type="submit" name="save" value="Save" class="btn-primary form-control">
			</form>
		</div>

		<table border="2" style="border-collapse:collapse;">
			<tr>
				<td>Logo</td>
				<td>title</td>
				<td>banner</td>
			</tr>
			<?php 

			$con = mysqli_connect("localhost","root","","project");

			$sql = "SELECT * FROM info";

			$query = mysqli_query($con,$sql);

			while ($rows =mysqli_fetch_assoc($query)) {

				?>
				<tr>
					<td><img src="<?php echo $rows['logo']; ?>" height="50" width="50"></td>
					<td><?php echo $rows['Title'];?></td>
					<td><img src="<?php echo $rows['banner'];?>" height="50" width="50"></td>
				</tr>			
			<?php
			}

			 ?>

		</table>
</body>
</html>
<?php

$con = mysqli_connect("localhost","root","","project");// To connect Database i use mysqli_connect function.

if ($con) {

	if (isset($_POST['save'])) {


		$title = $_POST['title'];

		$target_dirr ="photo/";
		$target_file = $target_dirr.basename($_FILES["logo_file"]["name"]);
		move_uploaded_file($_FILES["logo_file"]["tmp_name"], $target_file);

		$target_dirr ="photo/";
		$target_file2 = $target_dirr.basename($_FILES["banner"]["name"]);
		move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file2);

		$sql = "INSERT INTO info(title,logo,banner) VALUES ('$title','$target_file','$target_file2')";

		$query = mysqli_query($con,$sql);

		if ($query) {
			 echo "Data Inserted Successfull";
		}
		else{
			echo "Failed to insert data";
		}

	}
	else{
		die("Please Click save button for save data");
	}
	
	
}
else{
	die("Database Connection Failed");
}


?>


