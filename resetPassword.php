<?php

if (isset($_GET['id'])) {
    if (isset($_POST['resetPassword'])) {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password != $confirmPassword) {
            $msg = "Your Passwords does not Match!";
            $msgType = "alert alert-danger";
        } else {
            require_once('Connect.php');

            $sql = "UPDATE registered_users SET `Password`='" . hash('sha256', $password) . "' WHERE `Email`='" . base64_decode($_GET['id']) . "'";
            $passwordReset = mysqli_query($connection, $sql);

            $rowsAffected = mysqli_affected_rows($connection);

            if ($rowsAffected > 0) {
                $msg = "Password reset Successful.Log In with Your New Password now.";
                $msgType = "alert alert-success";
            }else{
				$msg = "Password reset Failed!Please try agin Later";
                $msgType = "alert alert-danger";
			}
        }
    }
}
include('style.php');
include './MyRuralFarmHeader.php';
?>
<?php if ($msg != "") { ?>
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
<?php } ?>

<div class="row">
    <div class="col-md-6 col-lg-6  col-md-offset-3 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Reset Your Password</h3>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" action="" method="POST" onsubmit="return validateForm()">
                    <div class="form-group">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <label  class="control-label">Password:</label>
                        </div>
                        <div class="col-md-9 col-lg-9 col-sm-9">
                            <input class="form-control" type="password" name="password" placeholder="Enter your new password" required>
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
                            <button type="submit" class="btn btn-success pull-right" name="resetPassword">Reset password</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function validateForm() {
        var password = $.trim($("#password").val());
        var confirmPassword = $.trim($("#confirmPassword").val());


        //validate password
        if (password == "") {
            alert("Provide Your Password.");
            $("#password").focus();
            return false;
        }

        //validate password confirmation
        if (confirmPassword == "") {
            alert("Please Confirm Your Password.");
            $("#confirmPassword").focus();
            return false;
        }

        if (password != confirmPassword) {
            alert("Your Passwords does not Match");
            $("#password").focus();
            return false;
        }
    }

<?php
include('Footer.php');
?>
