<?php
include "adminMainPage.php";
include "connection.php";

 $sqlListAllAdmins = "SELECT * FROM admins 
 ORDER BY  isActive DESC";
 $result = $conn->query($sqlListAllAdmins);

 if($result->num_rows > 0)
  { 
    
    echo "<div class=table-responsive> <div class=abc>";
    echo "<input class= form-control id=myInput type=text placeholder=Search..> <br>";
    echo "<table> 
            <tr> 
             <th> ID </th>
             <th> NAME </th>    
             <th>E-Mail</th>
             <th>Phone Number</th>
             <th>Arrival Date</th>
             <th>Leaving Date</th>
            </tr>";
    echo  "<tbody id=myTable>";
    while($row = $result->fetch_assoc())
     { 
       if($row["isActive"] == 1)
       {
        echo "<tr class=table-success><td>" .$row["no"]. "</td><td>" 
        .$row["aname"]."</td><td>". $row["eMail"]."</td><td>".$row["phoneNo"]."</td><td>".
        $row["arrivalDate"]."</td><td>" 
        .$row["leavingDate"]."</td></tr>" ;
 
       }
       else {
        echo "<tr class=table-danger><td>" .$row["no"]. "</td><td>" 
        .$row["aname"]."</td><td>". $row["eMail"]."</td><td>".$row["phoneNo"]."</td><td>".
        $row["arrivalDate"]."</td><td>" 
        .$row["leavingDate"]."</td></tr>" ;

       }
     }
     echo "</tbody></table></div></div>";
  }




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
 
 
 </body>
</html>
