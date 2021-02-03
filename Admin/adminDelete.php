<?php 

 include "adminMainPage.php";

 $inputLeavingDate  = "";
 $inputAdminId      = "";

 $inputLeavingDateError  = "";
 $inputAdminIdError      = ""; 

 $message  = "";
 $message2 = "";

 $adminIDs            = array();
 $adminNames          = array();
 $adminsEmail         = array();
 $adminPhoneNo        = array();
 $adminArrivalDate    = array();



function test_input($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}  

if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {

    //**************************** */
    if (empty($_POST['leavingDate'])) 
     {
       $inputLeavingDateError = "Leaving date is required";
     }
    else
     {
       $inputLeavingDate      = test_input($_POST['leavingDate']);
     }
   //**************************** */
   if (empty($_POST['ramo'])) {
     $inputAdminIdError = "Admin Checking is required";
   }else {
     $inputAdminId      = test_input($_POST['ramo']);
   }
 }

   
  $sql1 = "SELECT * FROM admins WHERE isActive=1 ";
  $result =$conn->query($sql1);
  
  $sql2 = "UPDATE admins SET isActive = 0 , leavingDate = '$inputLeavingDate'
   WHERE admins.no = '$inputAdminId' ";



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
 

     <link rel="stylesheet" href="../ortak.css">
 
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
             <th>E-Mail</th>
             <th>Phone Number</th>
             <th>Arrival Date</th>
            </tr>
            <tbody id="myTable">
             <div class="form-check">
              <?php  
                      for($i=0 ;$row = $result->fetch_assoc(); $i++){
                          $adminIDs[$i]             = $row["no"];
                          $adminNames[$i]           = $row["aname"];
                          $adminsEmail[$i]          = $row["eMail"];
                          $adminPhoneNo[$i]         = $row["phoneNo"]; 
                          $adminArrivalDate[$i]     = $row["arrivalDate"];
                      }                    
              ?>
              <div id="checkboxGroup">
               <?php   for ($t=0; $t < count($adminIDs) ; $t++)
                { 
    
               ?>
               <tr class="table-success">
                
                <td><input type="checkbox" name="ramo" value="<?php echo $adminIDs[$t] ?>">  </td>
                <td> <?php echo $adminIDs[$t]; ?></td>
                <td><?php echo $adminNames[$t];  ?></td>
                <td><?php echo   $adminsEmail[$t] ;?></td>
                <td><?php echo  $adminPhoneNo[$t]; ?></td>
                <td><?php echo $adminArrivalDate[$t]; ?></td>
              
               </tr>   
                   
               <?php 
                } 
             }
              ?>
              </div>  <br>
             </div>
            </tbody>
          </table>
          <span class="error"><?php echo $inputAdminIdError;?></span>
        </div>
      </div> 
     <div class="ree">
      <div class="form-group">
       <label for="leavingDate" class="col-sm-9 control-label">Leaving Date</label>
        <div class="col-sm-3">  
         <input type="date" name="leavingDate"  class="form-control" value="<?php echo $inputLeavingDate; ?>" >
          <span class="error"><?php echo $inputLeavingDateError;?></span>
           </div>
            </div>  
             <?php echo $message2;?>
            <div class ="form-group" style="padding-left:14px">
             <button type="submit" class="btn btn-primary" name="ramo " > Move Out</button>
            </div>
      </form>
     </div>
      
    

         <script>
               $(document).on('click', 'input[type="checkbox"]', function() {      
          $('input[type="checkbox"]').not(this).prop('checked', false);      
              });
         
         
         
                $(document).ready(function () {
             $('.record_table tr').click(function (event) {
                 if (event.target.type !== 'checkbox') {
                     $(':checkbox', this).trigger('click');
                 }
             });
         
             $("input[type='checkbox']").change(function (e) {
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
   if ($conn->query($sql2) === TRUE) {
    $message= "Admin is deleted!";
    $message2= successMessage($message);
  
   }
 
?>