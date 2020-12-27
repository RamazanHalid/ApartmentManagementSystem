<!-- @author Ramazan Halid
     @version 27.12.2020 -->
<?php

$bloks = array("A","B","C","D");
$apartments = array();
for ($t=0 ; $t<16; $t++){
   $apartments[$t] = $t + 1;
}


     
   //That veriables will hold Error Messagges when they are empty!
   $inputNameError               = "";
   $inputEmailError              = "";
   $inputPasswordError           = "";
   $inputPhoneError              = "";
   $inputPhone2Error             = "";
   $inputArrivalDateError        = "";
   $inputBlokError               = "";
   $inputDoorNoError             = "";
   
   

   //this input_veriables hold the informations that coming from user interface
   $inputName               = "";
   $inputEmail              = "";
   $inputPassword           = "";
   $inputPhone              = "";
   $inputPhone2             = "";
   $inputArrivalDate        = ""; 
   $inputBlok               = "";
   $inputDoorNo             = "";

   $inputNameForHoldsInfo               = "";
   $inputEmailForHoldsInfo              = "";
   $inputPasswordForHoldsInfo           = "";
   $inputPhoneForHoldsInfo              = "";
   $inputPhone2ForHoldsInfo             = "";
   $inputpwdForHoldsInfo                = "";
   $inputArrivalDateForHoldsInfo        = ""; 
   $inputBlokForHoldsInfo               = "";
   $inputDoorNoForHoldsInfo        = "";
  
   $message                 = "";
   $message2                = "";

   //These information for connection my database
   $servername   = "localhost";
   $username     = "root";
   $password     = "";
   $databasename = "apartment";

       //This function for user interface inputs validation.
   function test_input($data)
   {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
   }  
  
   //I am getting veriables fron HTML.
   //After that, I am checking the inputs validation.
   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
   
       // Here, I am checking the inputs validation.
     if (empty($_POST['fullName']))
      {
       $inputNameError = "Name is required";
      }
     else  
      {
       $inputName      = test_input($_POST['fullName']);
       $inputNameForHoldsInfo = $inputName;
       if (!preg_match("/^[a-zA-Z-' ]*$/",$inputName))
        { 
         $inputNameError = "Only letters and white space allowed";
         $inputNameForHoldsInfo = $inputName;
         $inputName = "";
        }
      }
     
     
     //**************************** */
     if (empty($_POST['email'])) {
       $inputEmailError = "Email is required";
     }else {
       $inputEmail      = test_input($_POST['email']);
       $inputEmailForHoldsInfo = $inputEmail;
       if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
         $inputEmailError = "Invalid email format";
         $inputEmailForHoldsInfo = $inputEmail;
         $inputEmail = "";
       }
     }
     //**************************** */
     if (empty($_POST['pwd'])) {
      $inputPasswordError = "Password number is required";
    }else {
      $inputPassword      = test_input($_POST['pwd']);
      
    }
     //**************************** */
     if (empty($_POST['userPhone'])) {
       $inputPhoneError = "Phone number is required";
     }else {
       $inputPhone      = test_input($_POST['userPhone']);
     }
     
     //**************************** */
     if (empty($_POST['userPhone2'])) {
       $inputPhone2Error = "";
     }else {
       $inputPhone2       = test_input($_POST['userPhone2']);
     }
     
     //**************************** */
     if (empty($_POST['arrivalDate'])) {
       $inputArrivalDateError = "Arrival date is required";
     }else {
       $inputArrivalDate      = test_input($_POST['arrivalDate']);
     }
     
     //**************************** */
     if (empty($_POST['blok'])) {
       $inputBlokError = "Blok is required";
     }else {
       $inputBlok      = test_input($_POST['blok']);
     }
     //**************************** */
     if (empty($_POST['doorNo'])) {
       $inputDoorNoError = "Door Number is required";
     }else {
       $inputDoorNo      = test_input($_POST['doorNo']);
     }
  

     $conn = new mysqli($servername, $username, $password, $databasename);
     if ($conn->connect_error) 
      {
       die("Connection failed: " . $conn->connect_error);
      }
         
     
      
      if(!(empty($inputName) ||
      empty($inputPassword) ||
      empty($inputEmail) ||
      empty($inputPhone) ||
      empty($inputArrivalDate) ||
      empty($inputBlok) ||
      empty($inputDoorNo))
      ){
          $sqlCheckUserEMail = "SELECT * FROM users WHERE '$inputEmail' = eMail";
          $result = $conn->query($sqlCheckUserEMail);
          //check email avialabity
          if($result->num_rows == 0)
            {
              $sqlCheckBlokAndDoorNo = "SELECT * FROM apartments WHERE '$inputBlok' = blok 
              AND '$inputDoorNo' = doorNo AND isFull = 1";
              $result2 = $conn->query($sqlCheckBlokAndDoorNo);
              if($result2->num_rows == 0)
                {
                  $sqlInsertionForUserTable = "INSERT INTO users ( uname, eMail,
                  phoneNo,phoneNo2,pwd)
                             VALUES ('$inputName',
                                     '$inputEmail',   
                                     '$inputPhone',
                                     '$inputPhone2',    
                                     '$inputPassword'
                                    )";
                  if(  $conn->query($sqlInsertionForUserTable) === TRUE )
                  {
                    $last_id = $conn->insert_id;    
                    $sqlInsertionForApartmentTable = "INSERT INTO apartments (blok,doorNo,userNo,arrivalDate) VALUES
                    ('$inputBlok',
                    '$inputDoorNo',
                      '$last_id',
                    '$inputArrivalDate')";
    
                    if(  $conn->query($sqlInsertionForApartmentTable) === TRUE )
                     {
                      $message = "User creation is success!";
                      $message2 = successMessage($message);
                      
                       
                    
                       //this input_veriables hold the informations that coming from user interface

                       $inputNameForHoldsInfo               = "";
                       $inputEmailForHoldsInfo              = "";
                       $inputName               = "";
                       $inputEmail              = "";
                       $inputPassword           = "";
                       $inputPhone              = "";
                       $inputPhone2             = "";
                       $inputArrivalDate        = ""; 
                       $inputBlok               = "";
                       $inputDoorNo             = "";
                     }
                     else 
                     {
                       $message = "The User creation is failed";
                       $message2 = failMessage($message);
                     }
    
                  }               
                }
              else 
               {
                   $message = "Apartment is full!";
                   $message2= failMessage($message);
               }
            }
          else 
            {
                $message = "This E-Mail also used!";
                $message2= failMessage($message);
            }
       
      }
      else {
        $message = "Fill al of inputs!";
        $message2 = failMessage($message);
      }





    $conn->close();
   
   }
  function successMessage($message){
    $message2 = "<div class='alert alert-success'>
    <strong>Success!</strong> $message
  </div>";
    return $message2;
  }
  function failMessage($message){
    $message2 = "<div class='alert alert-danger'>
    <strong>Error!</strong> $message
     </div>";
    return $message2;
  }
  
  include "adminMainPage.php";
 ?>



<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="addUser.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>
   <div class="container-xl">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <h2>User Registration Form</h2>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="fullName" placeholder="Full Name" class="form-control" autofocus
                        value="<?php echo $inputNameForHoldsInfo; ?>">
                      	<span class="error"><?php echo $inputNameError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" placeholder="Email" class="form-control"
                        value="<?php echo $inputEmailForHoldsInfo; ?>">
                        <span class="error"><?php echo $inputEmailError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="pwd" placeholder="Password" class="form-control"
                        value="<?php echo $inputPassword; ?>">
                        <span class="error"><?php echo $inputPasswordError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userPhone" class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="tel" name="userPhone" placeholder="Phone Number" class="form-control"
                        value="<?php echo $inputPhone; ?>" >
                        <span class="error"><?php echo $inputPhoneError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userPhone2" class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="tel" name="userPhone2"  placeholder="2.Phone Number" class="form-control" 
                        value="<?php echo $inputPhone2; ?>"  >
                     
                    </div>
                </div>
                <div class="form-group">
                    <label for="arrivalDate" class="col-sm-3 control-label">Arrival Date</label>
                    <div class="col-sm-9">  
                        <input type="date" name="arrivalDate"  class="form-control"
                        value="<?php echo $inputArrivalDate; ?>" >
                        <span class="error"><?php echo $inputArrivalDateError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="blok" class="col-sm-3 control-label">Blok</label>
                    <div class="col-sm-9">
                        <select name="blok" class="form-control">
                            <option value="" disable>Select...</option>
                           <?php
                              for ($w=0; $w < count($bloks); $w++) { 
                                echo "<option value=$bloks[$w]>$bloks[$w]</option>";
                              }
                             
                              
                          ?>
                         
                        </select>
                        <span class="error"><?php echo $inputBlokError;?></span>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="doorNo" class="col-sm-3 control-label">Door No</label>
                    <div class="col-sm-9">
                        <select  name="doorNo" class="form-control">
                            <option value="" disable>Select...</option>
                            <?php for ($i=0; $i < count($apartments) ; $i++) { 
                             echo "<option value=$apartments[$i]>$apartments[$i]</option>";
                            } ?>
                            
                        </select>
                        <span class="error"><?php echo $inputDoorNoError;?></span>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3" >
                  <span><?php echo $message2?></span>
                  </div>
                
                </div>
               
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
    </div> 

</body>
</html>
