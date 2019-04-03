CREATE TABLE nextofkin (
	  NextOfKinId int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	  MemberNo varchar(50) NOT NULL,
	  FullName varchar(50) NOT NULL,
	  Relationship varchar(50) NOT NULL,	  
	  BirthDate varchar(50) NOT NULL,
	  MobileNo varchar(50) NOT NULL,
	  IDNumber varchar(50) NOT NULL,
	  Email varchar(50) NOT NULL,
	  Address varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
