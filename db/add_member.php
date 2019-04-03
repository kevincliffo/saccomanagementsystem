<?php
$response = array();
include 'db_connect.php';
include 'functions.php';

//Get the input request parameters
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

//Check for Mandatory parameters
if(isset($input['IDNumber']) && isset($input['Password']) && isset($input['FullName'])){
	$IDNumber = $input['IDNumber'];
	$Password = $input['Password'];
	$FullName = $input['FullName'];
	
	//Check if user already exist
	if(!userExists($username)){

		//Get a unique Salt
		$salt         = getSalt();
		
		//Generate a unique password Hash
		$passwordHash = password_hash(concatPasswordWithSalt($password,$salt),PASSWORD_DEFAULT);
		
		//Query to register new user
		//$insertQuery  = "INSERT INTO member(username, full_name, password_hash, salt) VALUES (?,?,?,?)";
		$insertQuery  = "INSERT INTO members(MemberNo, FullName, BirthDate, MobileNo, IDNumber, Email, Address, PasswordHash, Salt) VALUES (?,?,?,?,?,?,?,?,?)";
		
		if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("ssss",$username,$fullName,$passwordHash,$salt);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "User created";
			$stmt->close();
		}
	}
	else{
		$response["status"] = 1;
		$response["message"] = "User exists";
	}
}
else{
	$response["status"] = 2;
	$response["message"] = "Missing mandatory parameters";
}
echo json_encode($response);
?>
