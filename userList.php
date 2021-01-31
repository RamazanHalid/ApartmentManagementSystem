<!--
  @author Ramazan Halid
  @version 29.12.2020
-->
<!-- user list -->

<?php
 include "adminMainPage.php";
 include "connection.php";

 
 $sqlListAllUsers = "SELECT * FROM users , apartments WHERE users.userID = apartments.aUserID
 ORDER BY   apartments.apartmentIsFull desc, apartments.blok , apartments.doorNo";
 $result = $conn->query($sqlListAllUsers);

 if($result->num_rows > 0)
  { 
    
    echo "<div class=table-responsive> <div class=abc>";
    echo "<input class= form-control id=myInput type=text placeholder=Search..> <br>";
    echo "<table> 
            <tr> 
             <th> ID </th>
             <th> NAME </th>
             <th> BLOK </th> 
             <th> DOOR NO </th>
             <th>E-Mail</th>
             <th>Phone Number</th>
             <th>Second Phone Number</th>
             <th>Arrival Date</th>
             <th>Leaving Date</th>
            </tr>";
    echo  "<tbody id=myTable>";
    while($row = $result->fetch_assoc())
     { 
       if($row["apartmentIsFull"] == 1)
       {
        echo "<tr class=table-success><td>" 
        .$row["userID"]. "</td><td>" 
        .$row["uname"]."</td><td>". $row["blok"]."</td><td>".$row["doorNo"]."</td><td>".
        $row["eMail"]."</td><td>" 
        .$row["phoneNo"]."</td><td>". $row["phoneNo2"]."</td><td>".$row["aArrivalDate"]."</td>
        <td>".$row["aLeavingDate"]."</tr>" ;
 
       }
       else {
        echo "<tr class=table-danger><td>" .$row["userID"]. "</td><td>" 
        .$row["uname"]."</td><td>". $row["blok"]."</td><td>".$row["doorNo"]."</td><td>".
        $row["eMail"]."</td><td>" 
        .$row["phoneNo"]."</td><td>". $row["phoneNo2"]."</td><td>".$row["aArrivalDate"]."</td>
        <td>".$row["aLeavingDate"]."</tr>" ;

       }
     }
     echo "</tbody></table></div></div>";
  }

  $conn->close();


 ?>
<DOCTYPE html>
<html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  
  tr:nth-child(even) {
    background-color: #dddddd;
  }
  .abc {
    padding-left: 325px;
  }
</style>
 </head>
 <body>
 

  <script>
     $(document).ready(function(){
       $("#myInput").on("keyup", function() {
         var value = $(this).val().toLowerCase();
         $("#myTable tr").filter(function() {
           $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
         });
       });
     });
  </script>
 </body>
</html>

