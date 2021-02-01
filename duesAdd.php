<?php 
include "adminMainPage.php";
 include "connection.php";

    $inputDuesName               = "";
    $inputAmount                 = 1;
    $inputDescription            = "";
    $inputDate                   = "";

   
    $inputDuesNameError               = "";
    $inputAmountError                 = "";
    $inputDescriptionError            = "";
    $inputDateError                   = "";

    $inputDuesNameForHoldInfo               = "";
    $inputDescriptionForHoldInfo            = "";
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
     if (empty($_POST['duesName']))
      {
       $inputDuesNameError = "Dues name is required";
      }
     else  
      {
       $inputDuesName      = test_input($_POST['duesName']);
       $inputDuesNameForHoldInfo = $inputDuesName;
       if (!preg_match("/^[a-zA-Z-' ]*$/",$inputDuesName))
        { 
         $inputDuesNameError = "Only letters and white space allowed";
         $inputDuesNameForHoldInfo = $inputDuesName;
         $inputDuesName = "";
        }
      }
  
      //**************************** */
     if (empty($_POST['startsDate'])) {
        $inputDateError = "Starts date is required";
      }else {
        $inputDate      = $_POST['startsDate'];
      }
       //**************************** */
      if (empty($_POST['description']))
      {
       $inputDescriptionError = "Description is required";
      }
     else  
      {
       $inputDescription      = test_input($_POST['description']);
       $inputDescriptionForHoldInfo = $inputDescription;
       if (!preg_match("/^[a-zA-Z-' ]*$/",$inputDescription))
        { 
         
         $inputNameError = "Only letters and white space allowed";
         $inputDescriptionForHoldInfo = $inputDescription;
         $inputDescription = "";
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
  
    $sqlForCheckAdminID = "SELECT * FROM admins WHERE admins.no = '$adminId'";
    $result = $conn->query($sqlForCheckAdminID);
    if ($result->num_rows > 0 )
     {
         while($row = $result->fetch_assoc()){
         $sqlInsertDues = "INSERT INTO dues (duesName, amount, duesDescription, 
         adminNo , startsDate) VALUES (
                '$inputDuesName',
                '$inputAmount',
                '$inputDescription',
                '$adminId',
                '$inputDate'
                                      )";
                             
         }
            if($conn->query($sqlInsertDues) === TRUE){
           
                $last_id = $conn->insert_id;
                $sqlForAllUsers = "SELECT * FROM users, apartments 
                WHERE users.userID = apartments.aUserID AND apartments.apartmentIsFull = 1 ";
                $result2 = $conn->query($sqlForAllUsers);
                if($result2->num_rows > 0){
                
                  while ($row2 = $result2->fetch_assoc()){
                  
                    $userIDs = $row2["userID"];
                  
                    $sqlForPaymentTable = "INSERT INTO payments (userNo,duesID) VALUES
                    ( '$userIDs',
                      '$last_id')";
                      if($conn->query($sqlForPaymentTable ) === TRUE){
                        
                        $message = "Dues assigned";
                        $message2 = successMessage($message);
                      }
                      else {
                        $message = "Dues did not assign";
                        $message2 = failMessage($message);
                      }
                  }

                
            }
            else {
              
                $message = "Some thing is wrong";
                $message2= failMessage($message);
            }
         }

     }
    else
     {   
         $message = "nothing";
         $message2= failMessage($message);
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
                <h2>Dues Add Form</h2>
                <div class="form-group">
                    <label for="duesName" class="col-sm-3 control-label">Dues Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="duesName" placeholder="Dues Name" class="form-control" autofocus
                        value="<?php echo $inputDuesNameForHoldInfo; ?>">
                      	<span class="error"><?php echo $inputDuesNameError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-9">
                        <input type="number" name="amount" placeholder="amount" class="form-control" min="1"
                        value="<?php echo $inputAmount; ?>" >
                        <span class="error"><?php echo $inputAmountError;?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <input type="tel" name="description"  placeholder="Description" class="form-control" 
                        value="<?php echo $inputDescription; ?>"  >
                        <span class="error"><?php echo $inputDescriptionError;?></span> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="startsDate" class="col-sm-3 control-label">Starts Date</label>
                    <div class="col-sm-9">  
                        <input type="date" name="startsDate"  class="form-control"
                        value="<?php echo $inputDate; ?>" >
                        <span class="error"><?php echo $inputDateError;?></span>
                    </div>
                </div>
                <?php echo $message2; ?>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
    </div> 

</body>
</html>
