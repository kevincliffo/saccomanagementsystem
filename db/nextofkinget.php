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
	if(isset($input['memberNo'])){
		$memberNo = $input['memberNo'];
		$nextofkinquery = "SELECT MemberNo, FullName, Relationship, BirthDate, MobileNo, IDNumber, Email, Address FROM nextofkin WHERE MemberNo = ?";
		
		if($stmt_nok = $con->prepare($nextofkinquery))
		{
			$stmt_nok->bind_param("s",$memberNo);
			$stmt_nok->execute();
			$stmt_nok->bind_result($memberNo, $nokfullName,$nokrelationship,$nokbirthDate, $nokmobileNo,$nokidNumber,$nokemail,$nokaddress);

			if($stmt_nok->fetch())
			{
				$response["status"] = 0;
				$response["message"] = "Next of Kin Found";
				$response["fullName"] = $nokfullName;
				$response["memberNo"] = $memberNo;
				$response["mobileNo"] = $nokmobileNo;
				$response["relationship"] = $nokrelationship;
				$response["idNumber"] = $nokidNumber;
				$response["birthDate"] = $nokbirthDate;
				$response["email"] = $nokemail;
				$response["address"] = $nokaddress;						
			}
			else
			{
				$response["status"] = 0;
				$response["message"] = "Next of Kin not Found";							
				$response["fullName"] = '';
				$response["memberNo"] = '';
				$response["mobileNo"] = '';
				$response["relationship"] = '';
				$response["idNumber"] = '';
				$response["birthDate"] = '';
				$response["email"] = '';
				$response["address"] = '';									
			}/**/
			$stmt_nok->close();
		}
		else
		{
			$response["status"] = 1;
			$response["message"] = "Next of Kin not Found!";
		}
	}
	else
	{
		$response["status"] = 2;
		$response["message"] = "Missing mandatory parameters";
	}
	//Display the JSON response
	echo json_encode($response);
?>
