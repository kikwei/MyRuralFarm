<?php
session_start();
if(isset($_POST['LogIn'])) {

    require_once('Connect.php');

    $status = "SELECT STATUS FROM registered_users WHERE Email='" . $_POST['userEmail'] . "'";
    $statusResult = mysqli_query($connection, $status);
    $statusArray = mysqli_fetch_array($statusResult);


    if ($statusArray[0] == 'Inactive') {
        $msg='Your Account is not Activated. Visit Your Email to Activate it.';
        $msgType='alert alert-danger';
    }else{
        $query = "SELECT COUNT(*) FROM registered_users WHERE Email='" . $_POST['userEmail'] . "' AND PASSWORD='" . hash('sha256', $_POST['password']) . "'";
        $result = mysqli_query($connection, $query);

        $resultArray=mysqli_fetch_array($result);

        if ($resultArray[0] == 1) {
            $query= "SELECT  CONCAT(EMAIL,' ',PHONENUMBER) AS CONTACTS FROM registered_users  WHERE Email='" . $_POST['userEmail'] . "'";
            $contactResult=mysqli_query($connection,$query);

            $contact=mysqli_fetch_array($contactResult);

            $sql = "SELECT  CONCAT(SURNAME,' ',LASTNAME) AS FULLNAME FROM registered_users  WHERE Email='" . $_POST['userEmail'] . "'";
            $resultSql = mysqli_query($connection, $sql);

            $nameArray = mysqli_fetch_array($resultSql);

            session_start();

            $_SESSION['logInUser'] = $nameArray[0];
            $_SESSION['contact']=$contact[0];

            header('Location:MyRuralFarmServices.php');

        }else{
            $msg='Wrong Credentials';
            $msgType='alert alert-danger';
        }
    }
}
?>
<html>
<?php
include ('style.php');
?>
<body>
<?php
include './MyRuralFarmHeader.php';
if (@$msg > "") { ?>
<div class="row">
    <div class="col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3 col-sm-4 col-sm-offset-3">
        <div class="<?php echo $msgType?>">
            <button data-dismiss="alert" class="close" type="button">x</button>
            <p class="text-center"><?php echo $msg; ?></p>
        </div>
        <?php  }?>
    </div>
</div>
<div class="row">
<div class="col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3 col-sm-4 col-sm-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><b>User Log In</b></h3>
        </div>
        <div class="panel-body">
            <form action="LogIn.php" method="POST" onsubmit="return validateForm();">

                <label>Email Address:</label>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" style="color: green"><i class="fa fa-user"></i></span>
                        <input type="email" name="userEmail" id="userEmail" class="form-control" placeholder="email@example.com" required>
                    </div>
                </div>


                <label>Password:</label>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" style="color: green"><i class="fa fa-key"></i></span>
                        <input type="password" name="password" id="userPassword" class="form-control" placeholder="Enter Your Password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm pull-right" name="LogIn">Log In</button>

                <br/>
                <br/>

                <div class="form-group">
                    <div class="input-group">

<!--                        <input type="checkbox" name="remberMe" placeholder="">-->
                        Don't have an account?
                        <br/>
                        <br/>
                       &nbsp;&nbsp; <a href="Register.php"><button type="button" class="btn btn-info  pull-right" >Register to have an Account</button></a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
<!--                        <input type="checkbox" name="forgotPassword" placeholder="">-->
                        Forgot password?
                        &nbsp;&nbsp;
                        <a target="_blank" href="PasswordReset.php"><button type="button" class="btn btn-danger sm pull-right" >Reset Password</button></a>

<!--                        <a target="_blank" href="PasswordReset.php"><button type="button" class="btn btn-danger sm pull-right" >Reset Password</button></a>-->
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
<?php
include ('Footer.php');
?>
<script type="text/javascript">
    function validateForm() {
        var userEmail=$.trim($("#userEmail").val());
        var userPassword=$.trim($("#userPassword").val());

        //validate userEmail

        if(userEmail==""){
            alert("Provide Your Email please");
            $("#userEmail").focus();
            return false;
        }


        // validate email
        if (!isValidEmail(userEmail)) {
            alert("Enter a valid email.");
            $("#userEmail").focus();
            return false;
        }


        if(userPassword==""){
            alert("Provide Your Password please");
            $("#userPassword").focus();
            return false;
        }
    }

    function isValidEmail(userEmail) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(userEmail);
    }
</script>
</body>
</html>