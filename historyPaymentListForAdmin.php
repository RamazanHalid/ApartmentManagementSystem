<?php 
 include "adminMainPage.php";
 include "connection.php";


 $users             = array();
 $paymentIDs        = array();
 $usersName         = array();
 $usersBlok         = array();
 $usersDoorNo       = array();
 $usersEmail        = array();
 $usersPhoneNo      = array();
 $duesName          = array();
 $amount            = array();
 $duesStartDate     = array();
 $whenPaid          = array();

$arr=array();

function test_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}  

$counter = 0;




  $sql1 = "SELECT * FROM users, apartments , dues , payments WHERE apartments.aUserID = users.userID 
  AND users.userID = payments.userNo AND payments.duesID = dues.duesID
  AND apartments.apartmentIsFull=1 AND payments.isPaid = 1 ORDER BY  payments.whenPaid DESC";
  $result =$conn->query($sql1);

 
?>

<DOCTYPE! html>
<html>
    <head>
    <?php include "ext.html"; ?> 

     <link rel="stylesheet" href="ortak.css" >    
</head>
    <body>
    <?php if ($result->num_rows > 0) 
      { ?>
      <div class="table-responsive">
        <div class="abc">
         <br>
          <form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> " id="myForm" >
           <input class= form-control id="myInput"  type="text" placeholder=Search..>
           <table class=record_table> 
            <tr> 
             
             <th> ID </th>
             <th> NAME </th>
             <th> BLOK </th> 
             <th> DOOR NO </th>
             <th>E-Mail</th>
             <th>Phone Number</th>
             <th>Dues Name</th>
             <th>Amount</th>
             <th>Starts Date </th>
             <th>Paid Date</th>
            </tr>
            <tbody id="myTable">
             <div class="form-check">
              <?php 
               
                      for($i=0 ;$row = $result->fetch_assoc(); $i++){
                          
                          $users[$i]             = $row["userID"];
                          $usersName[$i]         = $row["uname"];
                          $usersBlok[$i]         = $row["blok"];
                          $usersDoorNo[$i]       = $row["doorNo"];
                          $usersEmail[$i]        = $row["eMail"];
                          $usersPhoneNo[$i]      = $row["phoneNo"];
                          $duesName[$i]          = $row["duesName"];
                          $amount[$i]            = $row["amount"];
                          $duesStartDate[$i]     = $row["startsDate"];
                          $paymentIDs[$i]        = $row["paymentID"];
                          $whenPaid[$i]          = $row["whenPaid"];
                          
                      }
              
                    
           
                                   
              ?>
              <div id="checkboxGroup">
               <?php   for ($t=0; $t < count($paymentIDs) ; $t++)
                { 
    
               ?>
               <tr class="table-success">
                
                
                <td><?php echo $paymentIDs[$t]; ?></td>
                <td><?php echo $usersName[$t];  ?></td>
                <td><?php echo $usersBlok[$t];?></td>
                <td><?php echo $usersDoorNo[$t] ; ?></td>
                <td><?php echo   $usersEmail[$t] ;?></td>
                <td><?php echo  $usersPhoneNo[$t]; ?></td>
                <td><?php echo  $duesName[$t];?></td>
                <td><?php echo $amount[$t]. " TL"; ?></td>
                <td><?php echo $duesStartDate[$t]; ?></td>
                <td><?php echo $whenPaid[$t]; ?>   </td>
              
               </tr>   
                   
               <?php 
                } 
             }
           
              ?>
              </div>  <br>
             </div>
            </tbody>
          </table>
        
        </div>
      </div>
  
      </form>
     
     </div>
      
    

         <script>
                
         
         
                $(document).ready(function () {
             $('.record_table tr').click(function (event) {
                 if (event.target.type !== 'radio') {
                     $(':radio', this).trigger('click');
                 }
             });
         
             $("input[type='radio']").change(function (e) {
                 e.stopPropagation();
                 $('.record_table tr').removeClass("highlight_row");        
                 if ($(this).is(":checked")) {
                     $(this).closest('tr').addClass("highlight_row");
                 }      
             });
            });
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

 
?>  