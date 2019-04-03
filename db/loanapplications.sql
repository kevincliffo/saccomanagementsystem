CREATE TABLE loanapplications (
	LoanApplicationId int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	MemberNo varchar(50) NOT NULL,
	LoanAmount double(10,2) NOT NULL,
	MonthsPaymentPeriod int(1) NOT NULL,
	IDNumber varchar(50) NOT NULL,
	BasicSalary double(10,2) NOT NULL,
	ApplicationDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	GuarantorMemberNo varchar(50) NOT NULL,
	Confirmed int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
