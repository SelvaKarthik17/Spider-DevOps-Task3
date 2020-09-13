		
            <?php

              require 'dbconfig/config.php';
              error_reporting(0);


              $msg = array();
            

            	$username = trim(htmlspecialchars($_POST['username']));
            	$password = trim(htmlspecialchars($_POST['password']));
            	$cpassword = trim(htmlspecialchars($_POST['cpassword']));
            	

            	if($password==$cpassword)
            	{
            		$query= "select * from user_table WHERE username=?";

                        $stmt = mysqli_prepare($con,$query);
                        mysqli_stmt_bind_param($stmt,'s',$username);
                        mysqli_stmt_execute($stmt);
                        $query_run = mysqli_stmt_get_result($stmt);

            		

            		if(mysqli_num_rows($query_run) > 0){

            			
                              $msg[] = 'Username already exists....try another username';


            		}



            		else
            		{
            			$password = password_hash($password, PASSWORD_DEFAULT);

            			$query= "insert into user_table (username,password) values(?,?)";

                              $stmt = mysqli_prepare($con,$query);
                              mysqli_stmt_bind_param($stmt,'ss',$username,$password);
                              $exe = mysqli_stmt_execute($stmt);
                              $query_run = mysqli_stmt_get_result($stmt);
                              

            			if($exe)
            			{	

            				
                                    $msg[] = 'registration successful....';
            			}
            			else
            			{
            				
                                    $msg[] = 'Error';
            			}
            		}
 

            	}
            	else 
            	{

                        $msg[] = 'Password and confirm password do not match';
            	}

                  echo json_encode(

                        array(

                              'msg' => $msg

                        )



                  );



		?>