<?php
session_start();
if(!isset($_SESSION['logInStaff']))
    header('Location:MyRuralStaffLogIn.php');
if(isset($_GET['approveLease'])){
    require_once ('Connect.php');

    $update="UPDATE `lands_on_lease` SET `Status`='LEASED' WHERE `OwnerContact`='".$_GET['landLordMail']."'";
    $updateQuery=mysqli_query($connection,$update);

    $rows=mysqli_affected_rows($connection);
    if($rows>0){
        header('Location:staffViewBookedLandsOnLease.php');
    }
}else if(isset($_GET['disapproveLease'])){
    require_once ('Connect.php');

    $update="UPDATE `lands_on_lease` SET `Status`='OnLease',`Booked_by`='Null',`Date_booked`='Null' WHERE `OwnerContact`='".$_GET['landLordMail']."'";
    $updateQuery=mysqli_query($connection,$update);

    $rows=mysqli_affected_rows($connection);
    if($rows>0){
        header('Location:staffViewBookedLandsOnLease.php');
    }
}else{
	echo"Choose Land to Approve Please";
}
?>