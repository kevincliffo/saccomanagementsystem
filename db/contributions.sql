CREATE TABLE contributions (
	  ContributionId int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	  PaymentDate DATE NOT NULL,
	  MemberNo varchar(50) NOT NULL,
	  FullName varchar(50) NOT NULL,	  
	  Salary double(10,2) NOT NULL,
	  Contribution double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
