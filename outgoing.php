<?php 
include "adminMainPage.php";
 session_start();

 $servername   = "localhost";
 $username     = "root";
 $password     = "";
 $databasename = "apartment";

 $conn = new mysqli($servername, $username, $password, $databasename);
   if ($conn->connect_error) 
    {
     die("Connection failed: " . $conn->connect_error);
    }
 

    $inputOutgoingName                   = "";
    $inputAmount                         = 1;
    $inputOutgoingDescription            = "";
    $inputOutgoingDate                   = "";

   
    $inputOutgoingNameError                   = "";
    $inputAmountError                         = "";
    $inputOutGoingDescriptionError            = "";
    $inputOutgoingDateError                   = "";

    $inputOutgoingNameForHoldInfo                   = "";
    $inputOutgoingDescriptionForHoldInfo            = "";

    $message   = "";
    $message2  = "";

     //This function for user interface inputs validation.
    function test_input($data)
   {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
   }  
   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
   
       // Here, I am checking the inputs validation.
     if (empty($_POST['outgoingName']))
      {
       $inputOutgoingNameError = "Outgoing name is required";
      }
     else  
      {
       $inputOutgoingName      = test_input($_POST['outgoingName']);
       $inputOutgoingNameForHoldInfo = $inputOutgoingName;
       if (!preg_match("/^[a-zA-Z-' ]*$/",$inputOutgoingName))
        { 
         $inputOutgoingNameError = "Only letters and white space allowed";
         $inputOutgoingNameForHoldInfo = $inputOutgoingName;
         $inputOutgoingName = "";
        }
      }
  
      //**************************** */
     if (empty($_POST['startsDate'])) {
        $inputOutgoingDateError = "Starts date is required";
      }else {
        $inputOutgoingDate      = $_POST['startsDate'];
      }
       //**************************** */
      if (empty($_POST['description']))
      {
       $inputOutGoingDescriptionError = "Description is required";
      }
     else  
      {
       $inputOutgoingDescription      = test_input($_POST['description']);
       $inputOutgoingDescriptionForHoldInfo = $inputOutgoingDescription;
       if (!preg_match("/^[a-zA-Z-' ]*$/",$inputOutgoingDescription))
        { 
         
         $inputNameError = "Only letters and white space allowed";
         $inputOutgoingDescriptionForHoldInfo = $inputOutgoingDescription;
         $inputOutgoingDescription = "";
        }
      }
      //**************************** */
     if (empty($_POST['amount'])) 
     {
      $inputAmountError = "Amountis required";
       }
    else {
      $inputAmount      = $_POST['amount'];
    }
    }
  

    $adminId = $_SESSION["adminID"];
    
    if (!(empty($inputOutgoingName) ||
          empty($inputOutgoingDescription) ||
          empty($inputAmount) ||
          empty($inputOutgoingDate)
           ) ) {
       
    
        $sqlForCheckAdminID = "SELECT * FROM admins WHERE admins.no = '$adminId' ";
        $result = $conn->query($sqlForCheckAdminID);
        
        if ($result->num_rows > 0 )
         {
       
             while($row = $result->fetch_assoc()){
           
             $sqlInsertOutgoing = "INSERT INTO outgoing (oName, oAmount, oDescription, 
             adminID , beginDate) VALUES (
                    '$inputOutgoingName',
                    '$inputAmount',
                    '$inputOutgoingDescription',
                    '$adminId',
                    '$inputOutgoingDate'
                                          )";
            $result2 = $conn->query($sqlInsertOutgoing);
            if ($result2 === TRUE) {
                $message = "Outgoing is created!";
                $message2= successMessage($message);
            }
                                 
             }
               
             }
    
         
        else
         {   
             $message = "There is a problem about admin!";
             $message2= failMessage($message);
         }

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
      





      $conn->close();
 

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
                <h2>Outgoing Add Form</h2>
                <div class="form-group">
                    <label for="outgoingName" class="col-sm-3 control-label"> Name:</label>
                    <div class="col-sm-9">
                        <input type="text" name="outgoingName" placeholder="Outgoing Name" class="form-control" autofocus
                        value="<?php echo $inputOutgoingNameForHoldInfo; ?>">
                      	<span class="error"><?php echo $inputOutgoingNameError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Amount:</label>
                    <div class="col-sm-9">
                        <input type="number" name="amount" placeholder="amount" class="form-control" min="1"
                        value="<?php echo $inputAmount; ?>" >
                        <span class="error"><?php echo $inputAmountError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description:</label>
                    <div class="col-sm-9">
                        <input type="tel" name="description"  placeholder="Description" class="form-control" 
                        value="<?php echo $inputOutgoingDescription; ?>"  >
                        <span class="error"><?php echo $inputOutGoingDescriptionError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="startsDate" class="col-sm-3 control-label">Starts Date:</label>
                    <div class="col-sm-9">  
                        <input type="date" name="startsDate"  class="form-control"
                        value="<?php echo $inputOutgoingDate; ?>" >
                        <span class="error"><?php echo $inputOutgoingDateError;?></span>
                    </div>
                </div> 
                  <?php echo $message2; ?>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Assign</button>
                    </div>
                </div>
            </form>
    </div> 

</body>
</html>
