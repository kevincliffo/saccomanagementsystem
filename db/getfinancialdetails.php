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
		
		
		$response["TotalContribution"] = 0;
		
		$query  = "SELECT MemberNo, Salary, Deduction, Contribution, PendingLoans FROM financials WHERE MemberNo='$memberNo'";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$response["Salary"] = $row["Salary"];
				$response["MonthlyDeduction"] = $row["Deduction"];
				$response["MonthlyContribution"] = $row["Contribution"];
				$response["PendingLoans"] = $row["PendingLoans"];
			}
		}
		else
		{
			$response["Salary"] = 0;
			$response["MonthlyDeduction"] = 0;
			$response["MonthlyContribution"] = 0;
			$response["PendingLoans"] = 0;			
		}
		
		$query2 = "SELECT SUM(Deduction) AS TotalDeduction FROM deductions WHERE MemberNo = '$memberNo'";
		$result2 = mysqli_query($con, $query2);
		if (mysqli_num_rows($result2) > 0) {
			while($row2 = mysqli_fetch_assoc($result2)) {
				$response["TotalDeduction"] = $row2["TotalDeduction"];
			}
		}
		else
		{
			$response["TotalDeduction"] = 0;
		}
		

		$query3 = "SELECT SUM(Contribution) AS TotalContribution FROM contributions WHERE MemberNo = '$memberNo'";
		$result3 = mysqli_query($con, $query3);
		if (mysqli_num_rows($result3) > 0) {
			while($row3 = mysqli_fetch_assoc($result3)) {
				$response["TotalContribution"] = $row3["TotalContribution"];
			}
		}
		else
		{
			$response["TotalContribution"] = 0;
		}
		$response["status"] = 0;
		$response["message"] = "Record Found";		
	}
	else{
		$response["status"] = 2;
		$response["message"] = "Missing mandatory parameters";
	}
	echo json_encode($response);
?>
