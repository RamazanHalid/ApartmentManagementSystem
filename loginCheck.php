<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])){



}
else {
    header("Location: login.php");
    exit();
}

?>