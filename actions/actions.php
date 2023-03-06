<?php

//this pulls the MongoDB driver from vendor folder
require_once  '../vendor/autoload.php';

//connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->myDB;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;

// if($userCollection){
// 	echo "Collection ".$userCollection." Connected";
// }
// else{
// 	echo "Failed to connect to Database/Collection";
// }

if(isset($_POST['signup'])){

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phoneNo = $_POST['phoneNo'];
    $password = sha1($_POST['password']);
}

$data = array(
	"Firstname" => $fname,
	"Lastname" => $lname,
	"Email" => $email,
	"Phone Number" => $phoneNo,
	"Password" => $password
);

//insert into MongoDB Users Collection
$insert = $userCollection->insertOne($data);

if($insert){
	?>
		<center><h4 style="color: green;">Successfully Registered</h4></center>
		<center><a href="../index.php">Login</a></center>
	<?php
}
else{
	?>
		<center><h4 style="color: red;">Registration Failed</h4></center>
		<center><a href="../signup.php">Try Again</a></center>
	<?php
}

