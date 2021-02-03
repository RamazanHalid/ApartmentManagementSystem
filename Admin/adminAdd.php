<?php

include "adminMainPage.php";

//This function for user interface inputs validation.
$inputAdminNameError               = "";
$inputAdminEmailError              = "";
$inputAdminPasswordError           = "";
$inputAdminPhoneError              = "";
$inputAdminArrivalDateError        = "";



//this input_veriables hold the informations that coming from user interface
$inputAdminName               = "";
$inputAdminEmail              = "";
$inputAdminPassword           = "";
$inputAdminPhone              = "";
$inputAdminPassword           = "";
$inputAdminArrivalDate        = ""; 


$inputAdminNameForHoldsInfo               = "";
$inputAdminEmailForHoldsInfo              = "";
$inputAdminPasswordForHoldsInfo           = "";
$inputAdminPhoneForHoldsInfo              = "";
$inputAdminPasswordForHoldsInfo           = "";
$inputAdminArrivalDateForHoldsInfo        = ""; 


$servername   = "localhost";
$username     = "root";
$password     = "";
$databasename = "apartment";

$message  = "";
$message2 = "";


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
       $inputAdminNameError = "First name is required";
      }
     else  
      {
       $inputAdminName      = test_input($_POST['fullName']);
       $inputAdminNameForHoldsInfo = $inputAdminName;
       if (!preg_match("/^[a-zA-Z-' ]*$/",$inputAdminName))
        { 
         $inputAdminNameError = "Only letters and white space allowed";
         $inputAdminNameForHoldsInfo = $inputAdminName;
         $inputAdminName = "";
        }
      }
     
     
     //**************************** */
     if (empty($_POST['email'])) {
       $inputAdminEmailError = "Email is required";
     }else {
       $inputAdminEmail      = test_input($_POST['email']);
       $inputAdminEmailForHoldsInfo = $inputAdminEmail;
       if (!filter_var($inputAdminEmail, FILTER_VALIDATE_EMAIL)) {
         $inputAdminEmailError = "Invalid email format";
         $inputAdminEmailForHoldsInfo = $inputAdminEmail;
         $inputAdminEmail = "";
       }
     }
     //**************************** */
     if (empty($_POST['pwd'])) {
      $inputAdminPasswordError = "Password number is required";
    }else {
      $inputAdminPassword      = test_input($_POST['pwd']);
      
    }
     //**************************** */
     if (empty($_POST['phone'])) {
       $inputAdminPhoneError = "Phone number is required";
     }else {
       $inputAdminPhone      = test_input($_POST['phone']);
     }
     
     
     //**************************** */
     if (empty($_POST['arrivalDate'])) {
       $inputAdminArrivalDateError = "Arrival date is required";
     }else {
       $inputAdminArrivalDate      = test_input($_POST['arrivalDate']);
     }
    }
    
   
   
   
   // Create connection for database
   $conn = new mysqli($servername, $username, $password, $databasename);
   // Check connection for database
   if ($conn->connect_error) 
      {
       die("Connection failed: " . $conn->connect_error);
      }
   // Here, I am controlling the input fields do not be empty.
   // If these required inputs are empty, registration do not occur.
   if(!(empty($inputAdminName) ||
   empty($inputAdminPassword) ||
   empty($inputAdminEmail) ||
   empty($inputAdminPhone) ||
   empty($inputAdminArrivalDate)
   )){
       //This query for checking the email address in database.
       //If there are any email address in database registering is failed. 
       $sqlCheckMailIsAvailable2 = "SELECT * FROM admins WHERE '$inputAdminEmail' = eMail";
       $result3 = $conn->query($sqlCheckMailIsAvailable2);
       if($result3->num_rows == 0 )
        {
      
          //If the database do not include same Email,Blok and ApartmentNo, we can add the user.
          //This query for insertion new user.
          $sqlForInsertion = "INSERT INTO admins ( aname, eMail,
          phoneNo,pwd, arrivalDate)
                     VALUES ('$inputAdminName',
                             '$inputAdminEmail',   
                             '$inputAdminPhone',    
                             '$inputAdminPassword',     
                             '$inputAdminArrivalDate'     
                             )";

     
           if ($conn->query($sqlForInsertion) === TRUE) 
             {
               $message = "New admin is  created!";
               $message2 = successMessage($message);
               $inputAdminNameForHoldsInfo             = "";
               $inputAdminEmailForHoldsInfo            = "";
               $inputAdminPassword                     = "";
               $inputAdminPhone                        = "";
               $inputAdminPassword                     = "";
               $inputAdminArrivalDate                  = ""; 
              
              
             }
           else 
              {
                $message = "Please Enter all informations!";
                $message2 = failMessage($message);
              }
        
        }
     
    else 
     {    
       $message = "This E-Mail Address is already used!";
       $message2= failMessage($message);
      //  echo "<h3 style='color:white;'>This E-Mail Address is already used! </h3>";
     }
    
   
   }
   $conn->close();
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
  
?>

<!DOCTYPE html>
<html>
 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../addUser.css">
   <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 </head>
 <body>
 <div class="container-xl">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <h2>Admin Registration Form</h2>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="fullName" placeholder="Full Name" class="form-control" autofocus
                        value="<?php echo $inputAdminNameForHoldsInfo; ?>">
                      	<span class="error"><?php echo $inputAdminNameError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" placeholder="Email" class="form-control"
                        value="<?php echo $inputAdminEmailForHoldsInfo; ?>">
                        <span class="error"><?php echo $inputAdminEmailError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="pwd" placeholder="Password" class="form-control"
                        value="<?php echo $inputAdminPassword; ?>">
                        <span class="error"><?php echo $inputAdminPasswordError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userPhone" class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="tel" name="phone" placeholder="Phone Number" class="form-control" minlength=11 maxlength=11
                        value="<?php echo $inputAdminPhone; ?>" >
                        <span class="error"><?php echo $inputAdminPhoneError;?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="arrivalDate" class="col-sm-3 control-label">Arrival Date</label>
                    <div class="col-sm-9">  
                        <input type="date" name="arrivalDate"  class="form-control"
                        value="<?php echo $inputAdminArrivalDate; ?>" >
                        <span class="error"><?php echo $inputAdminArrivalDateError;?></span>
                    </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3" >
                  <span><?php echo $message2 ?></span>
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