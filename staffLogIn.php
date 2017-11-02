<?php
ob_start();

if(isset($_POST['staffLogIn'])){
    require_once ('Connect.php');
    $query="SELECT COUNT(*) FROM staff WHERE `Email`='".$_POST['staffEmail']."' AND password='".hash('sha256',$_POST['password'])."'";
    $count=mysqli_query($connection,$query);
    $resultArray=mysqli_fetch_array($count);
    if($resultArray[0]==1){
        $sql="SELECT user_name FROM staff WHERE `Email`='".$_POST['staffEmail']."'";
        $result=mysqli_query($connection,$sql);
        $userName=mysqli_fetch_array($result);
        
        session_start();
        $_SESSION['logInStaff']=$userName[0];
echo $userName[0];
        header("Location:MyRuralFarmStaffHomePage.php");
    }else{
        $msg="Wrong Credentials";
        $msgType="warning";
    }
}
?>
<html>
<?php
include ('style.php');
?>
<body>
<?php
include_once ('MyRuralFarmHeader.php');
if (@$msg != "") { ?>
<div class="row">
    <div class="col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3 col-sm-4 col-sm-offset-3">
        <div class="alert alert-danger alert-<?php echo $msgType; ?>">
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
                <h3 class="panel-title text-center"><b>Staff Log In</b></h3>
            </div>
            <div class="panel-body">
                <form action="staffLogIn.php" method="POST" onsubmit="return validateForm()">

                    <label>Email Address:</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" style="color: green"><i class="fa fa-user"></i></span>
                            <input type="email" name="staffEmail" id="staffEmail" class="form-control" placeholder="email@example.com" required>
                        </div>
                    </div>


                    <label>Password:</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" style="color: green"><i class="fa fa-key"></i></span>
                            <input type="password" name="password" id="staffPassword" class="form-control" placeholder="Enter Your Password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm pull-right" name="staffLogIn">Log In</button>

                    <br/>
                    <br/>

                    <div class="form-group">
                        <div class="input-group">
                            <!--                            <input type="checkbox" name="forgotPassword" placeholder="">-->
                            Forgot password?
                            &nbsp;&nbsp;
                            <a target="_blank" href="MyRuralFarmStaffPasswordReset.php"><button type="button" class="btn btn-danger sm pull-right" >Reset Password</button></a>
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
        var staffEmail=$.trim($("#staffEmail").val());
        var staffPassword=$.trim($("#staffPassword").val());

        //validate userEmail

        if(staffEmail==""){
            alert("Provide Your Email please");
            $("#staffEmail").focus();
            return false;
        }

        // validate email
        if (!isValidEmail(staffEmail)) {
            alert("Enter a valid email.");
            $("#staffEmail").focus();
            return false;
        }


        if(staffPassword==""){
            alert("Provide Your Password please");
            $("#staffPassword").focus();
            return false;
        }
    }

    function isValidEmail(staffEmail) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(staffEmail);
    }
</script>
</body>
</html>
