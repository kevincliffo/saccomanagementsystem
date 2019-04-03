CREATE TABLE errorneousdeductions (
	  ErrorneousDeductionId int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	  MemberNo varchar(50) NOT NULL,
	  FullName varchar(50) NOT NULL,
	  Amount double(10,2) NOT NULL,
	  DeductionDate varchar(50) NOT NULL,
	  CreatedDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  Reason varchar(255) NOT NULL,
	  Corrected int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
