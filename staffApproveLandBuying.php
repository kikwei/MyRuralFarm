<?php
session_start();
if(!isset($_SESSION['logInStaff']))
    header('Location:MyRuralStaffLogIn.php');
if(isset($_GET['approveBuying'])){
    require_once ('Connect.php');

    $update="UPDATE `lands_on_sale` SET `Status`='SOLD' WHERE `OwnerContact`='".$_GET['sellerMail']."'";
    $updateQuery=mysqli_query($connection,$update);

    $rows=mysqli_affected_rows($connection);
    if($rows>0){
        header('Location:staffViewBookedLandsOnSale.php');
    }
}else if(isset($_GET['disapproveBuying'])){
    require_once ('Connect.php');

    $update="UPDATE `lands_on_sale` SET `Status`='OnSale',`Booked_by`='Null',`Date_booked`='Null' WHERE `OwnerContact`='".$_GET['sellerMail']."'";
    $updateQuery=mysqli_query($connection,$update);

    $rows=mysqli_affected_rows($connection);
    if($rows>0){
        header('Location:staffViewBookedLandsOnSale.php');
    }
}
?>