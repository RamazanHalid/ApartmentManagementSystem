<?php
 //declaration of database informations.
 $servername   = "localhost";
 $username     = "root";
 $password     = "";
 $databasename = "apartment";
 
 $inputUserEMailError    = "";
 $inputUserPasswordError = "";
 $inputUserPositionError = "";
 
 $IncorrectInfo          = "";
 
 $inputUserEMail         = "";
 $inputPosition          = "";
 $inputUserPassword      = "";

 $inputEmailForHolds     = "";

 // Create database connection
 $conn = new mysqli($servername, $username, $password, $databasename);

 // Check database connection
 if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
    }
    //This fuction will check each _POST variable.
      //This function for security.
      function test_input($data)
       {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
       }
 // Check the user informations from database if true, goes to new php file . If not write a error message
 if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        if (empty($_POST['email'])) {
            $inputUserEMailError = "Email is required";
          }else {
            $inputUserEMail      = test_input($_POST['email']);
            $inputEmailForHolds  = $inputUserEMail;
            if (!filter_var($inputUserEMail, FILTER_VALIDATE_EMAIL)) {
              $inputUserEMailError = "Invalid email format";
               $inputUserEMail = "";
            }
          }
        if (empty($_POST['pwd']))
          {
           $inputUserPasswordError = "Password is required";
          }
        else  
          {
           $inputUserPassword      = test_input($_POST['pwd']);
           
          }
       
      
      $inputPosition     = test_input($_REQUEST['userPosition']);

     
      //This query created to check the user login information from the database.
      $sql1 = "SELECT * FROM admins WHERE '$inputUserEMail' = eMail AND 
      '$inputUserPassword' = pwd";
      $result = $conn->query($sql1);
      $sql2 = "SELECT * FROM users WHERE '$inputUserEMail' = eMail AND 
      '$inputUserPassword' = pwd";
      $result2 = $conn->query($sql2);
      // This if statment controled position of user(Admin,User)
      // Host and Tenant have same user interface.
      if ($inputPosition == "admin")
       {     
        if ($result->num_rows > 0) 
         {
           header("Location: adminMainPage.php");
           exit();
         } 
        else 
         {
             $IncorrectInfo = "<br>Login informations are incorrect!";
         }
       }
      elseif($inputPosition == "user")
        {
           if ($result2->num_rows > 0) 
            {
              header("Location: userMainPage.php");
              exit();
            } 
           else 
            {
                $IncorrectInfo = "<br>Login informations are incorrect!";
            }
        }
      $conn->close();   
    }   

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="userRegistration.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="logo.jpg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="<?php echo $_SERVER['PHP_SELF'];?>">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="<?php echo $inputEmailForHolds; ?>" required autofocus>
									<p><span class="error"><?php echo $inputUserEMailError; ?></span></p>
                                    
								</div>

								<div class="form-group">
									<label for="pwd">Password
										<a href="forgot.html" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="pwd" value="<?php echo $inputUserPassword; ?>" required data-eye>
                                    <p><span class="error"><?php echo $inputUserPasswordError; ?></span></p>
								    
								</div>

								<div class="form-group" >
                                 <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="userPosition" id="inlineRadio1" value="admin"
                                  <?php if (isset($inputPosition) && $inputPosition=="admin") echo "checked"; ?> checked >
                                  <label class="form-check-label" for="admin">Admin</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="userPosition" id="inlineRadio2" value="user"
                                  <?php if (isset($inputPosition) && $inputPosition=="user") echo "checked"; ?>>
                                  <label class="form-check-label" for="user">User</label>
                                 </div>
								</div>

								<div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
									</button>
								</div>
                                <p style="color:red"><strong><?php echo $IncorrectInfo; ?></p></strong>
								
							</form>
						</div>
					</div>
					<div class="footer">
						 &copy; 2020 &mdash; Ramazan Halid
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>