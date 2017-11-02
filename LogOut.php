<?php
session_start();
if(isset($_SESSION['logInUser'])){
    unset($_SESSION['logInUser']);
    header('Location:index.php');
}
?>