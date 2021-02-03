<?php
session_start();

if (isset($_SESSION['adminID'])){



}
else {
    header("Location: ../login.php");
    exit();
}

?>