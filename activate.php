<?php

if (isset($_GET['id'])) {
    require_once('Connect.php');
    // $id = base64_decode($_GET['id']);


    $sql = "SELECT COUNT(*) FROM registered_users WHERE `Email` ='" . base64_decode($_GET['id']) . "'";
    try {
    $sqlResult = mysqli_query($connection, $sql);
    $rowCount = mysqli_fetch_array($sqlResult);

    if ($rowCount > 0) {

        $selectStatus = "SELECT Status FROM registered_users WHERE `Email`='" . base64_decode($_GET['id']) . "'";
        $statusResult = mysqli_query($connection, $selectStatus);

        $status = mysqli_fetch_array($statusResult);


        if ($status[0] == "Activated") {
            $msg = "Your account has already been activated.";
            $msgType = "info";
        } else {
            //$query = "UPDATE registered_users SET  `Status` ='Activated' WHERE `Email`='" . base64_decode($_GET['id']) . "'";
            $queryResult = mysqli_query($connection,"UPDATE registered_users SET  `Status` ='Activated' WHERE `Email`='" . base64_decode($_GET['id']) . "'");

//        $statusUpdate=mysqli_affected_rows($connection);
//        if($statusUpdate>0) {
            $selectStatus = "SELECT Status FROM registered_users WHERE `Email`='" . base64_decode($_GET['id']) . "'";
            $statusResult = mysqli_query($connection, $selectStatus);

            $status = mysqli_fetch_array($statusResult);


            if ($status[0] == "Activated") {
                $msg = "Your account has been activated Successfully.Proceed to Log In and enjoy our services.";
                $msgType = "success";
            } else {
                $msg = "Account Activation Failed.Contact Admin for Assistance";
                $msgType = "warning";
            }
        }
    } else {
        $msg = "No account found";
        $msgType = "warning";
    }

  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}
include('style.php');
include './MyRuralFarmHeader.php';
?>
<?php if ($msg != "") { ?>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p style="padding-left: 35%"><?php echo $msg; ?></p>
  </div>
<?php } ?>
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h4 style="padding-left: 50%">Thank you for registering with us.</h4>
    </div>
  </div>
</div>



<?php
include('Footer.php');
?>
