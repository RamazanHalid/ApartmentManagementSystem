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

    $inputName               = "Ramazan";
    $inputEmail              = "raqwemadasdfgdadwzan@gmail.com";
    $inputPassword           = "123123";
    $inputPhone              = "12312312312";
    $inputPhone2             = "12312312312";
    $inputArrivalDate        = "2020-10-10"; 
    $inputBlok               = "B";
    $inputDoorNo             = "3";


    $a="INSERT INTO users ( uname, eMail,
    phoneNo,phoneNo2,pwd)
               VALUES ('$inputName',
                       '$inputEmail',   
                       '$inputPhone',
                       '$inputPhone2',    
                       '$inputPassword'
                      )";

    if(  $conn->query($a) === TRUE ){
        $last_id = $conn->insert_id;    
        echo "New user is  created! * .$last_id";
        
       $b = "INSERT INTO apartments (blok,doorNo,userNo,arrivalDate) VALUES
               ('$inputBlok',
               '$inputDoorNo',
                 '$last_id',
               '$inputArrivalDate')";
        if(  $conn->query($b) === TRUE ){
            echo "apartment created";
        }
    }
    else {
        echo "creating  faild * ";
    }

       
    
            $conn->close();
   ?>