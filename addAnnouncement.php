<?php 
 include "adminMainPage.php"; 


 function test_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}  

$message = "";
$message2 = "";


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