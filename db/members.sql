CREATE TABLE members (
	  MemberId int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	  MemberNo varchar(50) NOT NULL,
	  FullName varchar(50) NOT NULL,	  
	  BirthDate varchar(50) NOT NULL,
	  MobileNo varchar(50) NOT NULL,
	  IDNumber varchar(50) NOT NULL,
	  Email varchar(50) NOT NULL,
	  Address varchar(50) NOT NULL,
	  Salary double(10,2) NOT NULL,
	  NextOfKinFullName varchar(50) NOT NULL,
	  NextOfKinMobileNo varchar(50) NOT NULL,	  
	  PasswordHash varchar(256) NOT NULL,
	  Salt varchar(256) NOT NULL,
	  CreatedDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  Confirmed int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
