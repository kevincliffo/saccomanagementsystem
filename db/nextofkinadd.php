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
	if(isset($input['memberNo']) && isset($input['relationship']) && isset($input['fullName'])){
		$relationship = $input['relationship'];
		$birthDate = $input['birthDate'];
		$mobileNo = $input['mobileNo'];
		$idNumber = $input['idNumber'];
		$email = $input['email'];
		$address = $input['address'];
        $memberNo = $input['memberNo'];
		$fullName = $input['fullName'];
		$taskValue = $input['taskValue'];
		
		switch($taskValue)
		{
			case "1":
				$insertQuery  = "INSERT INTO nextofkin(MemberNo, FullName, Relationship, BirthDate, MobileNo, IDNumber, Email, Address) VALUES (?,?,?,?,?,?,?,?)";
				if($stmt = $con->prepare($insertQuery)){
					$stmt->bind_param("ssssssss",$memberNo,$fullName,$relationship,$birthDate,$mobileNo,$idNumber,$email,$address);
					$stmt->execute();
					$response["status"] = 0;
					$response["message"] = "Add Sucessful";
					$stmt->close();
				}
				else
				{
					$response["status"] = 0;
					$response["message"] = "Entry not added to database";					
				}			
				break;
			case "2":
				$updateQuery  = " UPDATE nextofkin SET FullName='$fullName', Relationship='$relationship', "
							  . " BirthDate='$birthDate', MobileNo='$mobileNo', IDNumber='$idNumber', Email='$email', "
							  . " Address='$address' WHERE MemberNo='$memberNo'";
															  
				if (mysqli_query($con, $updateQuery))
				{
					$response["status"] = 0;
					$response["message"] = "Record updated successfully";				
				} 
				else 
				{
					$response["status"] = 0;
					$response["message"] = "Update Failed ". mysqli_error($con);
				}							  
			  							  					
				break;
		}

	}
	else{
		$response["status"] = 2;
		$response["message"] = "Missing mandatory parameters";
	}
	echo json_encode($response);
?>
