<?php 

   include "adminMainPage.php";
   include "connection.php";

   $inputFile        = "";
  
   $currentDate      = date("Y-m-d");
   $inputOutgoingID  = "";
  
  
   $inputFileError = "";
   $inputOutgoingIDError = ""; 
  
   $message = "";
   $message2 = "";
  
   $outgoingIDs           = array();
   $outgoingName          = array();
   $outgoingDescription   = array();
   $amount                = array();
   $outgoingStartDate     = array();
  
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
    $inputOutgoingIDError = "Dues Checking is required";
  }else {
    $inputOutgoingID      = test_input($_POST['ramo']);
  }
   
   
   
  }


  $sql1 = "SELECT * FROM outgoing WHERE isItPaid = 0
    ORDER BY beginDate";
  $result =$conn->query($sql1);


  $sql2 = "UPDATE outgoing SET isItPaid = 1 , oWhenPaid = '$currentDate'
   WHERE outgoingID = '$inputOutgoingID' ";
   if ($conn->query($sql2) === TRUE)
   {
     $message= "The Outgoing paid!";
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
   
?>

<DOCTYPE! html>
<html>
 <head>
 <?php include "ext.html"; ?> 

  <style>
      table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1.5px solid #dddddd;
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
      {
    ?>
      <div class="table-responsive">
        <div class="abc">
         <br>
          <form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> " id="myForm" >
           <input class= form-control id="myInput"  type="text" placeholder=Search..>
           <table class=record_table> 
            <tr> 
             <th>#</th>
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
                }    
                               
              ?>
              <div id="checkboxGroup">
               <?php   for ($t=0; $t < count($outgoingIDs) ; $t++)
                { 
                 ?>
                 <tr class="table-danger">
                  <td><input type="checkbox" name="ramo" value="<?php echo $outgoingIDs[$t]; ?>">  </td>
                  <td><?php echo $outgoingIDs[$t];          ?></td>
                  <td><?php echo $outgoingName[$t];         ?></td>
                  <td><?php echo $outgoingDescription[$t];  ?></td>
                  <td><?php echo $amount[$t]. " TL";        ?></td>
                  <td><?php echo $outgoingStartDate[$t];    ?></td>
                 </tr>   
                     
                 <?php 
                } 
                
      }
              ?>
              </div><br>
             </div>
            </tbody>
          </table>
       
        </div>
      </div>     
     <div class="ree">
     <div class="form-group">
      <label for="leavingDate" class="col-sm-9 control-label"></label>
       <div class="col-sm-3">  
         <span class="error"><?php ?></span>
        </div>
       </div>  
       <?php echo $message2; ?>
       <div class ="form-group" style="padding-left:14px">
        <button type="submit" class="btn btn-primary" > Pay it!</button>
       </div>
    </form>
   </div>
   <script>
      $(document).on('click', 'input[type="checkbox"]', function() {      
       $('input[type="checkbox"]').not(this).prop('checked', false);      
    });
    //********************************************** */ 
        $(document).ready(function(){
           $("#myInput").on("keyup", function() {
             var value = $(this).val().toLowerCase();
             $("#myTable tr").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
             });
           });
         });
         /******************************************** */
         $(document).ready(function () {
             $('.record_table tr').click(function (event) {
                 if (event.target.type !== 'checkbox') {
                     $(':checkbox', this).trigger('click');
                 }
             });
           /******************************************** */
             $("input[type='checkbox']").change(function (e) {
                 e.stopPropagation();
                 $('.record_table tr').removeClass("highlight_row");        
                 if ($(this).is(":checked")) {
                     $(this).closest('tr').addClass("highlight_row");
                 }      
             });
            });
   </script>
  </body>
</html>

<?php 
  
 $conn->close();    
?>  