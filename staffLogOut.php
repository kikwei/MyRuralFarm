<?php
session_start();
if(isset($_SESSION['logInStaff'])){
    unset($_SESSION['logInStaff']);
    header('Location:index.php');
}
?>