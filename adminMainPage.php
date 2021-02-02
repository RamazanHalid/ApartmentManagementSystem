
<?php 
include "connection.php";
include "loginCheckAdmin.php";
 ?>
<!DOCTYPE html>
<html lang="en">
 <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Admin Page </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="//code.jquery.com/jquery.min.js"></script>
  <link rel="stylesheet" href="adminMainPage.css">
  
 </head>
 <body>



  <div class="sidebar-container" id="asdasd">
   <div class="sidebar-logo">
    Apartment Management
   </div>
   <ul class="sidebar-navigation">
    <li class="header">HOME</li>
    <li>
      <a href="adminHomePage.php" >
        <i class="fa fa-home" aria-hidden="true"></i> Home page
      </a>
    </li>
    <li>
      <a href="historyPaymentListForAdmin.php" >
        <i class="fa fa-home" aria-hidden="true"></i>History of Paid Dues
      </a>
    </li>
    <li>
      <a href="unPaidList.php" >
        <i class="fa fa-home" aria-hidden="true"></i>Unpaid Dues
      </a>
    </li>
    <li>
      <a href="addAnnouncement.php" >
        <i class="fa fa-home" aria-hidden="true"></i>Add Announcement
      </a>
    </li>
    <li class="header">Members</li>
    <li>
      <a href="userList.php">
        <i class="fa fa-users" aria-hidden="true"></i>List
      </a>
    </li>
    <li>
      <a href="userAdd.php" >
        <i class="fa fa-cog" aria-hidden="true"></i>Registration 
      </a>
    </li>
    <li>
      <a href="userUpdate.php">
        <i class="fa fa-info-circle" aria-hidden="true"></i>Moving Out
      </a>
    </li>
    <li class="header">Admins</li>
    <li>
      <a href="adminList.php" >
        <i class="fa fa-home" aria-hidden="true"></i> Admins List 
      </a>
    </li>
    <li>
      <a href="adminAdd.php" >
        <i class="fa fa-home" aria-hidden="true"></i> Add New Admin
      </a>
    </li>
    <li>
      <a href="adminDelete.php" >
        <i class="fa fa-home" aria-hidden="true"></i> Deletion
      </a>
    </li>
    <li class="header">DUES</li>
    <li>
      <a href="duesAdd.php" >
        <i class="fa fa-home" aria-hidden="true"></i> Assign Dues
      </a>
    </li>
    <li>
      <a href="outgoing.php" >
        <i class="fa fa-home" aria-hidden="true"></i> Add Outgoing
      </a>
    </li>
    <li>
      <a href="adminOutgoingUnpaidList.php" >
        <i class="fa fa-home" aria-hidden="true"></i>Unpaid Outgoing List
      </a>
    </li>
    <li>
      <a href="adminOutgoingPage.php" >
        <i class="fa fa-home" aria-hidden="true"></i>Outgoing List
      </a>
    </li> 
    <li class="header">Other</li>
    <li>
      <a href="logout.php" id="logout">
        <i class="fa fa-home" aria-hidden="true" ></i> Log out
      </a>
     </li>
   </ul>
  </div>
 </div>
 </body>
</html>