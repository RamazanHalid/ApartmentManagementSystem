<?php   include "userMainPage.php";

//declaration of database informations.
$servername   = "localhost";
$username     = "root";
$password     = "";
$databasename = "apartment";


$conn = new mysqli($servername, $username, $password, $databasename);

 // Check database connection
 if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
    }
 $sqlForVaultCash = "SELECT * FROM announcement
  ORDER BY announcement.cTime DESC";
 $result = $conn->query($sqlForVaultCash);

 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Home Page </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="//code.jquery.com/jquery.min.js"></script>
  <style>
  .reee {
      padding-left: 350px;
      padding-right: 100px;
      padding-top : 50px;
  }
  </style>
  
 </head>
 <body>


  <div class="reee">
   <div class="row" >
    <div class="table-responsive" >
     <h2>Announcements:</h2>
     <table class="table" >
      <tr class="table-secondary">
       <th>  Announcement Date:    </th>
       <td> Description:      </td>
      </tr>

      <?php if ($result->num_rows > 0 ) {
            while($row=$result->fetch_assoc()){

      ?> 
    <tr class="table-info">
     <th><?php echo $row["date"]; ?></th>
     <td><?php echo $row["theText"]; ?></td>
    </tr>
    <?php }} ?>
   </table>
  </div>
</div>
</div>
</body>
</html>