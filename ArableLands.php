<?php
session_start();

if(isset($_SESSION['logInUser']) || isset($_SESSION['logInStaff'])){
    header('Location:MyRuralFarmServices.php');
}else{
    header('Location:LogIn.php');
}
?>