<?php 

   include "adminMainPage.php";

  
   $outgoingIDs           = array();
   $outgoingName          = array();
   $outgoingDescription   = array();
   $amount                = array();
   $outgoingStartDate     = array();
   $isPaidList            = array();


  $sql1 = "SELECT * FROM outgoing ORDER BY isItPaid, beginDate";

  $result =$conn->query($sql1);

?>

<DOCTYPE! html>
<html>
 <head>


        <link rel="stylesheet" href="../ortak.css">
  </head>
  <body>
    <?php if ($result->num_rows > 0) 
      {
    ?>
      <div class="table-responsive">
        <div class="abc">
         <br> <h2>Outgoing List</h2> <br>
          <form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> " id="myForm" >
           <input class= form-control id="myInput"  type="text" placeholder=Search..>
           <table class=record_table> 
            <tr> 
             <th>ID</th>
             <th>Name</th>
             <th>Description</th>
             <th>Amount</th>
             <th>Starts Date</th>
            </tr>
            <tbody id="myTable">
             <div class="form-check">
              <?php 
                
                for($i=0 ;$row = $result->fetch_assoc(); $i++)
                {   
                    $outgoingIDs[$i]                = $row["outgoingID"];
                    $outgoingName[$i]               = $row["oName"];
                    $amount[$i]                     = $row["oAmount"];
                    $outgoingStartDate[$i]          = $row["beginDate"];
                    $outgoingDescription[$i]        = $row["oDescription"];  
                    $isPaidList[$i]                 = $row["isItPaid"];
                }    
                               
              ?>
              <div id="checkboxGroup">
               <?php   for ($t=0; $t < count($outgoingIDs) ; $t++)
                { 
                  
                      
                    
                 ?>
                 <tr class="<?php   if ($isPaidList[$t] == 0) { echo "table-danger";} else{ echo "table-success";}  ?>" >
               
                  <td><?php echo $outgoingIDs[$t];          ?></td>
                  <td><?php echo $outgoingName[$t];         ?></td>
                  <td><?php echo $outgoingDescription[$t];  ?></td>
                  <td><?php echo $amount[$t]. " TL";        ?></td>
                  <td><?php echo $outgoingStartDate[$t];    ?></td>
                 </tr>   
                     
                 <?php }
                } 
                
      
              ?>
              </div><br>
             </div>
            </tbody>
          </table>
        </div>
       </div>           
     </form>
    </div>
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

<?php 
  
 $conn->close();    
?>  