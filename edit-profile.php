<?php

session_start();

if(!isset($_SESSION['email'])){
	header('Location: index.php');
	exit();
}
else{

	//this pulls the MongoDB driver from vendor folder
	require_once  'vendor/autoload.php';

	//connect to MongoDB Database
	$databaseConnection = new MongoDB\Client;

	//connecting to specific database in mongoDB
	$myDatabase = $databaseConnection->myDB;

	//connecting to our mongoDB Collections
	$userCollection = $myDatabase->users;

	$userEmail = $_SESSION['email'];

	
	$data = array(
		"Email" => $userEmail,
	);

	//fetch user from MongoDB Users Collection
	$fetch = $userCollection->findOne($data);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<form action="actions/edit-profile.php" method="POST">
		
		<input type="text" value="<?php echo $fetch['Firstname']; ?>" name="fname" id="fname" required=""/><br/><br/>

		<input type="text"value="<?php echo $fetch['Lastname']; ?>" name="lname" id="lname" required=""/><br/><br/>

		<input type="email" value="<?php echo $fetch['Email']; ?>" name="email" id="email" required=""/><br/><br/>

		<input type="text" value="<?php echo $fetch['Phone Number']; ?>" name="phoneNo" id="phoneNo" required=""/><br/><br/>

		<input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $fetch['_id']; ?>" />

		<input type="submit" name="update" id="update" value="Update info"/><br/><br/>

	</form>

	<a href="profile.php">Profile Page</a>
</body>
</html>
<?php } ?>