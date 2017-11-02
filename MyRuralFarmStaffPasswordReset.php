<?php
if (count($_POST) > 0) {

    /* Form Required Field Validation */
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $msg = ucwords($key) . " field is required";
            $msgType="alert alert-danger";
            break;
        }
    }


    if (!isset($msg)) {
        if (!isset($_POST["staffEmail"])) {
            $msg = " Please Provide Your Staff Email";
            $msgType="alert alert-danger";
        }
    }


    /* Email Validation */
    if (!isset($msg)) {
        if (!filter_var($_POST["staffEmail"], FILTER_VALIDATE_EMAIL)) {
            $msg = "Invalid Email";
            $msgType="alert alert-danger";
        }
    }


    if (!isset($msg)) {
        require('Connect.php');
        require_once "phpmailer/class.phpmailer.php";

        $email=$_POST['staffEmail'];



        try{
            $Email="SELECT COUNT(*) FROM `staff` WHERE `Email`='".$_POST['staffEmail']."'";
            $Result=mysqli_query($connection,$Email);

            $count=mysqli_fetch_array($Result);

            if($count[0]>0){

                $url='www.myruralfarm.co.ke';
                $message = '<html><head>
                <title>Password Reset</title>
                </head>
                <body>';
                $message .= '<h1>Hello ' . $email . '!</h1>';
                $message .= '<p><a href="'.$url.'/'.'staffResetPassword.php?id=' . base64_encode($email) .'">Click Here to Reset Your Password</a>';
                $message .= "</body></html>";



                // php mailer code starts
                $mail = new PHPMailer(true);
                $mail->IsSMTP(); // telling the class to use SMTP

                $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
                $mail->SMTPAuth = true;                  // enable SMTP authentication
                $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
                $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
                $mail->Port = 587;                   // set the SMTP port for the GMAIL server

                $mail->Username = 'laravelrenato@gmail.com';
                $mail->Password = 'com_08_15';

                $mail->SetFrom('laravelrenato@gmail.com', 'Myruralfarm Investments Ltd.');
                $mail->AddAddress($email);

                $mail->Subject = trim("Password Reset - MyRuralFarm Investments Ltd.");
                $mail->MsgHTML($message);

                try {
                    $mail->send();
                    $msg = "An email has been sent for password reset.";
                    $msgType = "alert alert-success";
                } catch (Exception $ex) {
                    $msg = $ex->getMessage();
                    $msgType = "alert alert-danger";
                }
            } else {
                $msg = "Password Reset Failed.Please try again.";
                $msgType = "alert alert-danger";
            }

        } catch (Exception $ex) {
            echo $ex->getMessage();
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
include('MyRuralFarmHeader.php');
if (@$msg!="") { ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="<?php echo @$msgType;?>">
            <button data-dismiss="alert" class="close" type="button">x</button>
            <p class="text-center"><?php echo $msg; ?></p>
        </div>
        <?php }?>
    </div>
</div>


<div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">


            <div class=" panel panel-footer">

                <form class="form-horizontal" action="" method="POST" onsubmit="return validateForm();">


                    <fieldset>


                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="surName">Email Address:
                                <input type="email" placeholder="Provide Your Email Address" id="staffEmail" class="form-control" name="staffEmail">
                            </label>
                        </div>



                        <div style="height: 10px;clear: both"></div>

                        <div class="form-group">
                            <div class="col-md-10 col-lg-10 col-sm-10">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                    </fieldset>

                </form>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    function validateForm() {

        var staffEmail = $.trim($("#staffEmail").val());


        //validate email
        if (userEmail == "") {
            alert("Provide Your Staff Email Address.");
            $("#staffEmail").focus();
            return false;
        }

        // validate email
        if (!isValidEmail(staffEmail)) {
            alert("Enter a valid email.");
            $("#staffEmail").focus();
            return false;
        }


        return true;
    }

    function isValidEmail(staffEmail) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(staffEmail);
    }


</script>

<?php
include ('Footer.php');
?>
</body>
</html>