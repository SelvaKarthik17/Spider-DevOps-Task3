
		<?php

		    require 'dbconfig/config.php';
		    error_reporting(0);


			$username = $_POST['sendername'];

			$fid = $_POST['recvname'];


			$send = $_POST['msg'];



			$query = "INSERT into updates_table (id,receiver_id,message) values (?,?,?)";

            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,'sss',$username,$fid,$send);
            mysqli_stmt_execute($stmt);
            $query_run = mysqli_stmt_get_result($stmt);


		     

		?>