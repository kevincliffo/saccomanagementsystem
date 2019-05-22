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
	if(isset($input['memberno']) && isset($input['password'])){
		$memberno = $input['memberno'];
		$password = $input['password'];
		$query    = "SELECT FullName,PasswordHash, Salt,MobileNo,IDNumber,MemberId,BirthDate,Email,Address,Salary,CreatedDate,Confirmed FROM members WHERE MemberNo = ?";

		if($stmt = $con->prepare($query)){
			$stmt->bind_param("s",$memberno);
			$stmt->execute();
			$stmt->bind_result($fullName,$passwordHashDB,$salt, $mobileno,$idnumber,$memberid,$birthdate,$email,$address,$salary,$createddate,$confirmed);
			
			if($stmt->fetch()){
				//Validate the password
				if(password_verify(concatPasswordWithSalt($password,$salt),$passwordHashDB)){
					$response["status"] = 0;
					$response["message"] = "Login successful";
					$response["FullName"] = $fullName;
					$response["MobileNo"] = $mobileno;
					$response["IDNumber"] = $idnumber;
					$response["MemberId"] = $memberid;
					$response["BirthDate"] = $birthdate;
					$response["Email"] = $email;
					$response["Address"] = $address;
					$response["Salary"] = $salary;
					$response["CreatedDate"] = $createddate;
					$response["Confirmed"] = $confirmed;
				}
				else{
					$response["status"] = 1;
					$response["message"] = "Invalid Login combination";
				}
			}
			else{
				$response["status"] = 1;
				$response["message"] = "Login Details not Found!";
			}
			
			$stmt->close();
		}
	}
	else{
		$response["status"] = 2;
		$response["message"] = "Missing mandatory parameters".$input['password'];
	}
	//Display the JSON response
	echo json_encode($response);
?>
