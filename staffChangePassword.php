<?php
require_once('Connect.php');
session_start();
if(!isset($_SESSION['logInStaff']))
    header('Location:staffLogIn.php');
if(isset($_SESSION['logInStaff']) && isset($_POST['changePassword'])) {

    $oldPassword = $_POST['oldPassword'];
    $hashOld = hash('sha256', $oldPassword);
    $newPassword = $_POST['newPassword'];
    $hashNew = hash('sha256', $newPassword);
    $confirmPassword = $_POST['confirmPassword'];
    $hashConfirm = hash('sha256', $confirmPassword);


    $oldPasswordQuery = "SELECT PASSWORD FROM staff WHERE user_name='" . $_SESSION['logInStaff'] . "'";
    $result = mysqli_query($connection, $oldPasswordQuery);
    $passArray = array();
    while ($oldPass = mysqli_fetch_assoc($result)) {
        $passArray[] = $oldPass;
        $oldPassArray=$oldPass['PASSWORD'];


        if ($hashOld ==$oldPassArray)
        {
            if($hashNew == $hashConfirm)
            {
                $insertNewPassword = "UPDATE  staff SET PASSWORD='$hashNew' WHERE  user_name='" . $_SESSION['logInStaff'] . "'";
                mysqli_query($connection, $insertNewPassword);
                if (mysqli_affected_rows($connection) > 0)
                {
                    $msg= "Password change successful";
                    $msgType="alert alert-success";
                } else{
                    $msg= "No change was done";
                    $msgType="alert alert-danger";
                }

            }
            else{
                $msg= "Your new Passwords doesn't match!";
                $msgType="alert alert-danger";
            }
        }
        else
        {
            $msg="Your old Password doesn't match the one provided!";
            $msgType="alert alert-danger";
        }

    }
}
//    include_once ('MyRuralFarmHeader.php');
?>


<html>
<?php
include ('style.php');
?>
<body>
<?php
include_once('MyRuralFarmHeader.php');
if(@$msg !=""){ ?>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-sm-6 col-sm-offset-3">
            <div>
                <div class="<?php echo $msgType?>">
                    <button data-dismiss="alert" class="close" type="button">x</button>
                    <p class="text-center"><?php echo $msg; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php }?>


<div class="row">
    <div class="col-md-6 col-lg-6  col-md-offset-3 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Change Your Password</h3>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" action="staffChangePassword.php" method="POST">
                    <div class="form-group">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <label  class="control-label">Old Password:</label>
                        </div>
                        <div class="col-md-9 col-lg-9 col-sm-9">
                            <input class="form-control" type="password" name="oldPassword" placeholder="Enter your old password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <label  class="control-label">New Password:</label>
                        </div>
                        <div class="col-md-9 col-lg-9 col-sm-9">
                            <input class="form-control" type="password" name="newPassword" placeholder="Enter your new password" required>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <label  class="control-label">Confirm Password:</label>
                        </div>
                        <div class="col-md-9 col-lg-9 col-sm-9">
                            <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm your new password" required>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-lg-6  col-md-offset-6 col-lg-offset-6 col-sm-6  col-sm-offset-6">
                            <button type="submit" class="btn btn-success pull-right" name="changePassword">Change password</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</body>
</html>