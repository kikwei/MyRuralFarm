<?php
session_start();
if(!isset($_SESSION['logInUser']))
    header('Location:LogIn.php');

if(isset($_GET['landLordMail'])) {
    require_once ('Connect.php');
    $date=date('Y-m-d H:i:s');
    $contact=base64_decode($_GET['landLordMail']);
    $updateStatus="UPDATE lands_on_lease SET booked_by='".$_SESSION['contact']."',status='BOOKED', date_booked='$date'  WHERE OwnerContact='$contact'";
    $update=mysqli_query($connection,$updateStatus);

    $rows=mysqli_affected_rows($connection);
    if($rows>0){
        echo "<p class='alert alert-success' style='padding-left: 20%'> You have Successfully Acquired the Land.Thank You for using MyRuralFarm Investments Limited. </p>";
    }


}
    else{
        echo "<p class='alert alert-danger' style='padding-left: 50%'> Please choose a Land to Lease!!</p>";



}
?>