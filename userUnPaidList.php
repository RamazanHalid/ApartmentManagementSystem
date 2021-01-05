<?php 
session_start();
 include "userMainPage.php";
 //These information for connection my database
 $servername       = "localhost";
 $username         = "root";
 $password         = "";
 $databasename     = "apartment";

 $loginUserID      =  $_SESSION["forUserID"];
 $inputFile        = "";
 $inputUserId      = "";
 $inputPaymentId   = "";
 $currentDate      = date("Y-m-d");


 $inputFileError           = "";
 $inputPaymentIdError      = ""; 

 $message  = "";
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

$arr=array();

function test_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}  

$counter = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


//**************************** */
if (empty($_POST['ramo'])) {
  $inputPaymentIdError = "Dues Checking is required";
}else {
  $inputPaymentId      = test_input($_POST['ramo']);
}
 
 
 
}


 

 $conn = new mysqli($servername, $username, $password, $databasename);
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  }


  $sql1 = "SELECT * FROM users, apartments , dues , payments WHERE apartments.aUserID = users.userID 
  AND '$loginUserID' = users.userID
  AND users.userID = payments.userNo AND payments.duesID = dues.duesID
  AND apartments.apartmentIsFull=1 AND payments.isPaid = 0 ORDER BY dues.startsDate";
  $result =$conn->query($sql1);

  


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

<DOCTYPE! html>
<html>
    <head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <link rel="stylesheet"  href="ortak.css">  
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