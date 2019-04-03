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
	//if(isset($input['fullName']) && isset($input['password']) && isset($input['idNumber'])){
	$MemberNo = $input['MemberNo'];
	$LoanAmount = floatval($input['LoanAmount']);
	$MonthsPaymentPeriod = $input['MonthsPaymentPeriod'];
	$IDNumber = $input['IDNumber'];
	$BasicSalary = floatval($input['BasicSalary']);
	$GuarantorMemberNo = $input['GuarantorMemberNo'];

	
	$insertQuery = "INSERT INTO loanapplications(MemberNo, LoanAmount, MonthsPaymentPeriod, IDNumber, BasicSalary, GuarantorMemberNo) VALUES(?,?,?,?,?,?)";
		/*$response["status"] = 0;
		$response["message"] = $insertQuery;
		$myfile = fopen("testfile.txt", "w");
		fwrite($myfile, $insertQuery);
		fclose($myfile);*/
	try
	{
	if($stmt = $con->prepare($insertQuery)){
		$stmt->bind_param("sdisds",$MemberNo,$LoanAmount,$MonthsPaymentPeriod,$IDNumber,$BasicSalary,$GuarantorMemberNo);
		$stmt->execute();
		$response["status"] = 0;
		$response["message"] = "Loan Application Successful created";
		$stmt->close();
	}
	else{
		$response["status"] = 0;
		$response["message"] = "Loan Application failed";
	}
	}
	catch(Exception $e)
	{
		$response["status"] = 1;
		$response["message"] = $e->getMessage();		
	}
	echo json_encode($response);
?>
