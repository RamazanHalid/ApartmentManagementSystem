<?php 
 include "adminMainPage.php"; 
 //These information for connection my database
 $servername   = "localhost";
 $username     = "root";
 $password     = "";
 $databasename = "apartment";

 function test_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}  

$message = "";
$message2 = "";

$conn = new mysqli($servername, $username, $password, $databasename);
if ($conn->connect_error) 
 {
  die("Connection failed: " . $conn->connect_error);
 }

  $inputText = "";

  $inputTextError = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {

    if (empty($_POST['theText']))
     {
      $inputTextError = "The text is required";
     }
     else 
     {
      $inputText      = test_input($_POST['theText']);
     }
   }
    if (!empty($inputText)) 
     {
      
      $sqlForInsertAnnouncement = "INSERT INTO announcement (theText) VALUES ('$inputText')";
      if ($conn->query($sqlForInsertAnnouncement) === TRUE)
       {
          $message = "Announcement assigned to members";
          $message2= successMessage($message);
          
       }
     }
    else 
     {
         $message = "Please fill the empty places!";
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

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Announcement</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
   .ree {
       padding-left: 325px;
       padding-top: 20px;
   
   }
   .error {
       color: crimson;
   }
  </style>
</head>
<body>

<div class="container ree">
<br><br>
  <h2>Add New Announcement</h2>
  <br>
  <p>This announcement will be seen by everyone!</p>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <div class="form-group">
      <label for="comment">Announcement:</label>
      <textarea class="form-control" rows="10" id="announcement" name="theText"></textarea>
      <br>
      <span><?php echo $message2; ?></span>
      <br>
    </div>
    <button type="submit" class="btn btn-primary">Assign</button>
  </form>
</div>

</body>
</html>