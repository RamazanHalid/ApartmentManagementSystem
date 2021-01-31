<?php   include "adminMainPage.php";

include "connection.php";

 $sqlForVaultCash = "SELECT SUM(dues.amount) as moneySum FROM payments , dues WHERE dues.duesID = payments.duesID AND  payments.isPaid = 1";
 $result = $conn->query($sqlForVaultCash);
 $totalMoney = 0;
 $totalPayable = 0;
 if ($result->num_rows > 0 )
  {
     $row = $result->fetch_assoc();
    $totalMoney = $row["moneySum"];
  }
 $sqlForTotalOutgoing = "SELECT SUM(oAmount) as payableSum FROM outgoing WHERE isItPaid = 0";
 $result2 = $conn->query($sqlForTotalOutgoing);
 if ($result2->num_rows > 0) 
  {
     $row2 = $result2->fetch_assoc();
     $totalPayable = $row2["payableSum"];
  }
 $caseMoney = $totalMoney - $totalPayable;

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
      padding-left: 335px;
      padding-top : 50px;
  }
  </style>
  
 </head>
 <body>
   <div class="reee">
    <div class="row">
     <div class="table-responsive col-md-6">
      <h2>Vault Cash</h2>
      <table class="table" style="width 40%">
       <tr class="table-primary">
        <th>Total Incoming:</th>
        <td><?php echo $totalMoney." TL"; ?></td>
       </tr>
       <tr class="table-danger">
        <th>Total Outgoing:</th>
        <td><?php echo $totalPayable. " TL"; ?></td>
       </tr>
       <tr class="table-success">
        <th>Money in the case:</th>
        <td><?php echo $caseMoney. " TL"; ?></td>
       </tr>      
     </div>
   </div>
   </div>
 </body>
</html>