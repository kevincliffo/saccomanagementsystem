CREATE TABLE financials (
	  FinancialId int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	  MemberNo varchar(50) NOT NULL,
	  FullName varchar(50) NOT NULL,
	  MobileNo varchar(50) NOT NULL,
	  IDNumber varchar(50) NOT NULL,	  
	  Salary double(10,2) NOT NULL,
	  Deduction double(10,2) NOT NULL,
	  Contribution double(10,2) NOT NULL,
	  PendingLoans int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
