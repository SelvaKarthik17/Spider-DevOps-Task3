
            
		<?php

   			error_reporting(0);
   			require 'dbconfig/config.php';

   			$msg = array();
   			$ok = 0;

		 
		 	$username=trim(htmlspecialchars($_POST['username']));		 	
		 	$password=trim(htmlspecialchars($_POST['password']));
		 	
		 	

		 	$query="select * from user_table WHERE username= ? ";

            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,'s',$username);
            mysqli_stmt_execute($stmt);
            $query_run = mysqli_stmt_get_result($stmt);


		 	if(mysqli_num_rows($query_run)>0)
		 	{	 
		 		while ($row = mysqli_fetch_assoc($query_run)) {

		 			$hashedpwd = $row["password"]; //from database

		 			if(password_verify($password,$hashedpwd))
		 			{
		 				$ok = 1;
		 				$msg[] = "Welcome!";
		 			}

		 			else
		 			{
		 				$msg[] = "Invalid Credentials !";
		 			}

		 			
		 		}
		 	 


		 	}
		 	else
		 	{

		 		$msg[] = "Invalid Credentials !";
		 	}

		 			$output = new stdClass();
		 			
		 			$output->msg = $msg;
		 			$output->ok = $ok; 


                    echo json_encode($output);



		?>

