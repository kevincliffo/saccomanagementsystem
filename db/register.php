<?php
	$response = array();
	include 'db_connect.php';
	include 'functions.php';

	//Get the input request parameters

	$inputJSON = file_get_contents('php://input');
	if(get_magic_quotes_gpc()){
		$param = stripslashes($inputJSON);
	}
	else{
		$param = $inputJSON;
	}
	$input = json_decode($param, TRUE); //convert JSON into array

	//Check for Mandatory parameters
	if(isset($input['fullName']) && isset($input['password']) && isset($input['idNumber'])){
 		$idNumber = $input['idNumber'];
		$password = $input['password'];
		$fullName = $input['fullName'];
		$mobileNo = $input['mobileNo'];
		$email = $input['email'];
		$address = $input['address'];
		$salary = $input['salary'];
		$birthDate = $input['birthDate'];
		$nextOfKinName = $input['nextOfKinName'];
		$nextOfKinMobile = $input['nextOfKinMobile'];		
		$confirmed = 0;
		$memberno = '';
		
		//Check if user already exist
		if(!userExists($idNumber)){

			//Get a unique Salt
			$salt         = getSalt();
			
			//Generate a unique password Hash
			$passwordHash = password_hash(concatPasswordWithSalt($password,$salt),PASSWORD_DEFAULT);
			
			//Query to register new user
			$insertQuery  = "INSERT INTO members(MemberNo, FullName, BirthDate, MobileNo, IdNumber, Email, Address, Salary, PasswordHash, Salt, Confirmed, NextOfKinFullName, NextOfKinMobileNo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
			if($stmt = $con->prepare($insertQuery)){
				$stmt->bind_param("sssssssdssiss",$memberno,$fullName,$birthDate,$mobileNo,$idNumber,$email,$address,$salary,$passwordHash,$salt,$confirmed,$nextOfKinName,$nextOfKinMobile);
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
