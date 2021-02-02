<?php 
 include "adminMainPage.php";


 $inputFile        = "";
 $inputUserId      = "";
 $inputPaymentId   = "";
 $currentDate      = date("Y-m-d");


 $inputFileError = "";
 $inputPaymentIdError      = ""; 

 $message = "";
 $message2 = "";

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



function test_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}  


if ($_SERVER["REQUEST_METHOD"] == "POST") {


//**************************** */
if (empty($_POST['ramo'])) {
  $inputPaymentIdError = "Dues Checking is required";
}else {
  $inputPaymentId      = test_input($_POST['ramo']);
}

}
  $sql1 = "SELECT * FROM users, apartments , dues , payments WHERE apartments.aUserID = users.userID 
  AND users.userID = payments.userNo AND payments.duesID = dues.duesID
  AND apartments.apartmentIsFull=1 AND payments.isPaid = 0 ORDER BY apartments.blok , apartments.doorNo";
  $result =$conn->query($sql1);


  $sql2 = "UPDATE payments SET isPaid = 1 , whenPaid = '$currentDate'
   WHERE paymentID = '$inputPaymentId' ";
      
     
       


?>

<DOCTYPE! html>
<html>
    <head>
   

<style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 4px;
  }
  
  tr:nth-child(even) {
    background-color: #dddddd;
  }
  .abc {
    padding-left: 325px;
  }
  .ree {
     padding-left: 335px; 
    padding-top: 40px;
  }
  .error {
    color: crimson;
}
  
</style>    
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
             <th> #   </th>
             <th> ID </th>
             <th> NAME </th>
             <th> BLOK </th> 
             <th> DOOR NO </th>
             <th>E-Mail</th>
             <th>Phone Number</th>
             <th>Dues Name</th>
             <th>Amount</th>
             <th>Starts Date </th>
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
                          
                      }
              
                    
           
                                   
              ?>
              <div id="checkboxGroup">
               <?php   for ($t=0; $t < count($paymentIDs) ; $t++)
                { 
    
               ?>
               <tr class="table-danger">
                
                <td><input type="checkbox" name="ramo" value="<?php echo $paymentIDs[$t]; ?>">  </td>
                <td><?php echo $paymentIDs[$t]; ?></td>
                <td><?php echo $usersName[$t];  ?></td>
                <td><?php echo $usersBlok[$t];?></td>
                <td><?php echo $usersDoorNo[$t] ; ?></td>
                <td><?php echo   $usersEmail[$t] ;?></td>
                <td><?php echo  $usersPhoneNo[$t]; ?></td>
                <td><?php echo  $duesName[$t];?></td>
                <td><?php echo $amount[$t]. " TL"; ?></td>
                <td><?php echo $duesStartDate[$t]; ?></td>
              
               </tr>   
                   
               <?php 
                } 
             }
           
              ?>
              </div>  <br>
             </div>
            </tbody>
          </table>
          <span class="error"><?php echo $inputPaymentIdError;?></span>
        </div>
      </div>

     
     <div class="ree">
     
     <div class="form-group">
                    <label for="leavingDate" class="col-sm-9 control-label"></label>
                    <div class="col-sm-3">  
                        
                         <span class="error"><?php ?></span>
                    </div>

                  
                </div>  
                <?php echo $message2;
                ?>
      <div class ="form-group" style="padding-left:14px">
      <button type="submit" class="btn btn-primary" > Pay it!</button>
     </div>
    
    
      </form>
     
     </div>
      
    

         <script>
         $(document).on('click', 'input[type="checkbox"]', function() {      
    $('input[type="checkbox"]').not(this).prop('checked', false);      
});
         
         
         
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
 if ($conn->query($sql2) == TRUE) {
  $message= "Dues is paid";
  $message2= successMessage($message);

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