<?php   
include "userMainPage.php";
include "../connection.php";

$userName = "";
$userEmail = "";
$userBlok =  "";
$userDoorNo = "";
$userPhone  = "";
$userArrivalDate = "";

$loginUserID  =  $_SESSION["id"];
$totalMoney   = 0;
$totalPayable = 0;


 $sqlForVaultCash = "SELECT SUM(dues.amount) as moneySum FROM payments , dues WHERE dues.duesID = payments.duesID 
 AND  payments.isPaid = 1";
 $result = $conn->query($sqlForVaultCash);

 if ($result->num_rows > 0 ) {
     $row = $result->fetch_assoc();
    $totalMoney = $row["moneySum"];
 }
 $sqlForTotalOutgoing = "SELECT SUM(oAmount) as payableSum FROM outgoing WHERE isItPaid = 0";
 $result2 = $conn->query($sqlForTotalOutgoing);
 if ($result2->num_rows > 0) {
     $row2 = $result2->fetch_assoc();
     $totalPayable = $row2["payableSum"];
 }
 $caseMoney = $totalMoney - $totalPayable;

 $sqlForUserInformations = "SELECT * FROM users, apartments WHERE users.userID = apartments.aUserID
 AND users.userID = '$loginUserID' 
 AND apartments.apartmentIsFull = 1";
 $result3 = $conn->query($sqlForUserInformations);
 if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc() ){
      $userName = $row["uname"];
      $userBlok = $row["blok"];
      $userDoorNo = $row["doorNo"];
      $userEmail = $row["eMail"];
      $userPhone = $row["phoneNo"];
      $userArrivalDate = $row["aArrivalDate"];
    }
 }
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Home Page </title>

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
              </table>
        </div>
        <div  class="table-responsive col-md-6">
         <h2>Your Informations:</h2>
          <table style="border: 1px solid;" class="table-warning" style="width 40%">
           <tr>
            <th>Name:</th>
            <td><?php echo $userName; ?></td>
           </tr>
           <tr>
            <th>Telephone:</th>
            <td><?php echo $userPhone; ?></td>
           </tr>
           <tr>
            <th>E-mail:</th>
            <td><?php echo $userEmail; ?></td>
           </tr>
           <tr>
            <th>Blok:</th>
            <td><?php echo $userBlok; ?></td>
           </tr>
           <tr>
            <th>Door No:</th>
            <td><?php echo $userDoorNo; ?></td>
           </tr>
           <tr>
            <th>Arrival Date:</th>
            <td><?php echo $userArrivalDate; ?></td>
           </tr>
          </table>
      </div>
    </div>
   </div>
  </body>
</html>