<?php

session_start();

//this pulls the MongoDB driver from vendor folder
require_once  '../vendor/autoload.php';

//connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->myDB;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;


if(isset($_POST['update'])){

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phoneNo = $_POST['phoneNo'];
    $hidden_id = $_POST['hidden_id'];
}

// $data = array(
// 	"Firstname" => $fname,
// 	"Lastname" => $lname,
// 	"Email" => $email,
// 	"Phone Number" => $phoneNo,
// );


$data = array('$set' => array(

	"Firstname" => $fname,
	"Lastname" => $lname,
	"Email" => $email,
	"Phone Number" => $phoneNo,

));

//insert into MongoDB Users Collection
$update = $userCollection->updateOne(['_id' => new \MongoDB\BSON\ObjectID($hidden_id)], $data);

if($update){
	header('Location: ../profile.php');
}
else{
	?>
		<center><h4 style="color: red;">Update Failed</h4></center>
		<center><a href="../edit-profile.php?id=<?php echo $hidden_id;?>">Try Again</a></center>
	<?php
}

?>
