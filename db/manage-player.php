<?php
   // Define database connection parameters
	$hn      = 'localhost';
	$un      = 'root';
	$pwd     = '';
	$db      = 'mbastats';
	$cs      = 'utf8';

   // Set up the PDO parameters
	$dsn 	= "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
	$opt 	= array(
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
					PDO::ATTR_EMULATE_PREPARES   => false,
			  );
   // Create a PDO instance (connect to the database)
	$pdo 	= new PDO($dsn, $un, $pwd, $opt);


   // Retrieve the posted data
	$json    =  file_get_contents('php://input');
	$obj     =  json_decode($json);
	$key     =  strip_tags($obj->key);

   // Determine which mode is being requested
	switch($key)
	{
		// Add a new record to the technologies table
		case "create":
			 // Sanitise URL supplied values
			 
			$options = array(
				'options' => array(
					'default' => 0, // value to return if the filter fails
					'min_range' => 0
				),
			);
					 
			$playerName 	  = filter_var($obj->Name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerNickName  = filter_var($obj->NickName, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerImagePath = filter_var($obj->ImagePath, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerTeam	  = filter_var($obj->Team, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerPosition  = filter_var($obj->Position, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerNumber	  = filter_var($obj->Number, FILTER_SANITIZE_NUMBER_INT);
					  
			 // Attempt to run PDO prepared statement
			 try {
				$sql 	= "INSERT INTO players(Name, NickName, ImagePath, Team, Position, Number) VALUES(:Name, :NickName, :ImagePath, :Team, :Position, :Number)";
				echo json_encode($sql);
				$stmt 	= $pdo->prepare($sql);
				$stmt->bindParam(':Name', $playerName, PDO::PARAM_STR);
				$stmt->bindParam(':NickName', $playerNickName, PDO::PARAM_STR);
				$stmt->bindParam(':ImagePath', $playerImagePath, PDO::PARAM_STR);
				$stmt->bindParam(':Team', $playerTeam, PDO::PARAM_STR);
				$stmt->bindParam(':Position', $playerPosition, PDO::PARAM_STR);
				$stmt->bindParam(':Number', $playerNumber, PDO::PARAM_INT);            
							
				$stmt->execute();

				echo json_encode(array('message' => 'Congratulations the record ' . $playerName . ' was added to the database'));
			 }
			 // Catch any errors in running the prepared statement
			 catch(PDOException $e)
			 {
				echo $e->getMessage();
			 }

			break;

      // Update an existing record in the technologies table
		case "update":
			// Sanitise URL supplied values
			$id	  = filter_var($obj->id, FILTER_SANITIZE_NUMBER_INT);
			$playerName 	  = filter_var($obj->Name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerNickName  = filter_var($obj->NickName, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerImagePath = filter_var($obj->ImagePath, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerTeam	  = filter_var($obj->Team, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerPosition  = filter_var($obj->Position, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$playerNumber	  = filter_var($obj->Number, FILTER_SANITIZE_NUMBER_INT);

			// Attempt to run PDO prepared statement
			try {
				$sql 	= "UPDATE players SET Name=:Name,Name=:NickName,ImagePath=:ImagePath,"
				        . "Team=:Team,Position=:Position,Number=:Number WHERE id = :id";
				$stmt 	=	$pdo->prepare($sql);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->bindParam(':playerName', $playerName, PDO::PARAM_STR);
				$stmt->bindParam(':playerNickName', $playerNickName, PDO::PARAM_STR);
				$stmt->bindParam(':playerImagePath', $playerImagePath, PDO::PARAM_STR);
				$stmt->bindParam(':playerTeam', $playerTeam, PDO::PARAM_STR);
				$stmt->bindParam(':playerPosition', $playerPosition, PDO::PARAM_STR);
				$stmt->bindParam(':playerNumber', $playerNumber, PDO::PARAM_INT); 
				$stmt->execute();

				echo json_encode('Congratulations the record ' . $playerName . ' was updated');
			}
			// Catch any errors in running the prepared statement
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}

			break;
      // Remove an existing record in the technologies table
		case "delete":
			// Sanitise supplied record ID for matching to table record
			$id	=	filter_var($obj->id, FILTER_SANITIZE_NUMBER_INT);
			$playerName = filter_var($obj->playerName, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			// Attempt to run PDO prepared statement
			try {
				$pdo 	= new PDO($dsn, $un, $pwd);
				$sql 	= "DELETE FROM players WHERE id = :id";
				$stmt 	= $pdo->prepare($sql);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();

				echo json_encode('Congratulations the record ' . $playerName . ' was removed');
			}
			// Catch any errors in running the prepared statement
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}

			break;
	}

?>
