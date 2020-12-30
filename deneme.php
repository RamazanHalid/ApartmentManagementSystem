<?php 
   $servername   = "localhost";
   $username     = "root";
   $password     = "";
   $databasename = "apartment";

   $conn = new mysqli($servername, $username, $password, $databasename);
   if ($conn->connect_error) 
    {
     die("Connection failed: " . $conn->connect_error);
    }
    echo "connection successfuly * ";

    $inputName               = "Ramazanwe";
    $inputAmount             = 1000;
    $inputDescription        = "Standart Dues wqe";
    $inputAdminNo            = 2; 
    $inputDate               = "2020-12-12";
    


    $a="INSERT INTO dues ( duesName, amount,
    duesDescription,adminNo, startsDate)
               VALUES ('$inputName',
                       '$inputAmount',   
                       '$inputDescription',
                       '$inputAdminNo',
                       '$inputDate'
                      )";

    if($conn->query($a) === TRUE ){
        $last_id = $conn->insert_id;    
        echo "New user is  created! ";
        $sqlForAllUsers ="SELECT users.userID FROM users, apartments 
        WHERE users.userID = apartments.aUserID AND apartments.apartmentIsFull = 1 ";
        $result = $conn->query($sqlForAllUsers);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $c = $row["userID"];
                $b = "INSERT INTO payments (userNo,duesID) VALUES
                      ( '$c',
                        '$last_id')";
               if(  $conn->query($b) === TRUE ){
                   echo "apartment created";
                }
        }
    }
    }
    else {
        echo "creating  faild * ";
    }

       
    
            $conn->close();
   ?>