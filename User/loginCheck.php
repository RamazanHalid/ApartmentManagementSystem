<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email_'])){



}
else {
    header("Location: ../login.php");
    exit();
}

?>