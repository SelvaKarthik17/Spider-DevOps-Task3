<?php
    require 'dbconfig/config.php';
    error_reporting(0);


    $sender = $_POST['sendername'];
  

    $query = "SELECT message,id,receiver_id,msgtime from updates_table WHERE (id = ? ) OR (receiver_id = ?)";

     $stmt = mysqli_prepare($con,$query);
     mysqli_stmt_bind_param($stmt,'ss',$sender,$sender);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);


    $data = "";

    if(mysqli_num_rows($result)>0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {   
            $data = $data . '<a>';
            $data = $data . $row['id'];
            $data = $data . " to " .$row['receiver_id'];
            $data = $data . " =>  ".$row['message'];
            $data = $data . "  @ " . $row['msgtime'];
            $data = $data . '</a><br><br>';



        }


    }

    echo $data;





?>