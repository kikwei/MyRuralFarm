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

//Validation to check if Surname is provided
if (!isset($msg)) {
    if (!isset($_POST["surName"])) {
        $msg = " Please Provide Your SurName";
        $msgType="alert alert-danger";
    }
}


//Validation to check if First Name is provided
if (!isset($msg)) {
    if (!isset($_POST["firstName"])) {
        $msg = "Please Provide Your First Name";
        $msgType="alert alert-danger";
    }
}


//Validation to check if Last Name is provided
if (!isset($msg)) {
    if (!isset($_POST["lastName"])) {
        $msg = " Please Provide Your Last Name";
        $msgType="alert alert-danger";
    }
}


if (!isset($msg)) {
    if (!isset($_POST["userEmail"])) {
        $msg = " Please Provide Your Email";
        $msgType="alert alert-danger";
    }
}


if (!isset($msg)) {
    if (!isset($_POST["phoneNumber"])) {
        $msg = " Please Provide Your Phone Number";
        $msgType="alert alert-danger";
    }
}

if (!isset($msg)) {
    if (!isset($_POST["password"])) {
        $msg = " Please Provide Your Password";
        $msgType="alert alert-danger";
    }
}



    if (!isset($msg)) {
        if ($_POST["password"]!=$_POST["confirmPassword"]) {
            $msg = "Your Passwords does not Match";
            $msgType="alert alert-danger";
        }
    }


/* Email Validation */
if (!isset($msg)) {
    if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid UserEmail";
        $msgType="alert alert-danger";
    }
}


if (!isset($msg)) {
    require('Connect.php');
    require_once "phpmailer/class.phpmailer.php";

    $name=$_POST['firstName'];
    $email=$_POST['userEmail'];
    $password=hash('sha256',$_POST['password']);


    try{
    $dupEmail="SELECT COUNT(*) FROM `registered_users` WHERE `Email`='".$_POST['userEmail']."'";
    $dupResult=mysqli_query($connection,$dupEmail);

    $count=mysqli_fetch_array($dupResult);

    if($count[0]>0){
    $msg="The Email is already in use.Please use another Email";
    $msgType="alert alert-danger";
    }else{
        $sql="INSERT INTO `registered_users`(Surname,FirstName,LastName,County,Ward,PhoneNumber,Email,Password)
              VALUES ('".$_POST['surName']."','".$_POST['firstName']."','".$_POST['lastName']."','".$_POST['county']."','".$_POST['ward']."','".$_POST['phoneNumber']."','".$_POST['userEmail']."','$password')";

        $insert=mysqli_query($connection,$sql);

        $rows=mysqli_affected_rows($connection);

        if($rows>0){

    $url='www.myruralfarm.co.ke';
            $message = '<html><head>
                <title>Email Verification</title>
                </head>
                <body>';
            $message .= '<h1>Hi ' . $name . '!</h1>';
            $message .= '<p><a href="'.$url.'/'.'activate.php?id=' . base64_encode($email) .'">Click Here to Activate Your Account</a>';
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

            $mail->Subject = trim("Email Verifcation -MyRuralFarm Investments Ltd.");
            $mail->MsgHTML($message);

            try {
                $mail->send();
                $msg = "Log In to Your Email to Activate your Account.";
                $msgType = "alert alert-success";
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msgType = "alert alert-danger";
            }
        } else {
            $msg = "Registration Failed.Please try again.";
            $msgType = "alert alert-danger";
        }
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
                            <label class="col-md-12 col-lg-12 col-sm-12" for="surName">Surname:
                                <input type="text" placeholder="Surname" id="surName" class="form-control" name="surName">
                            </label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="firstName">First Name:
                                <input type="text" placeholder="First Name" id="firstName" class="form-control" name="firstName">
                            </label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12 " for="lastName">Last Name:
                                <input type="text" placeholder="Last Name" id="lastName" class="form-control" name="lastName">
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="address">County:
                                <input type="text" placeholder="County" id="address" class="form-control" name="county">
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="residential">Ward:
                                <input type="text" placeholder="Ward of Residence" id="residential" class="form-control" name="ward">
                            </label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="phoneNumber">Phone Number:
                                <input type="tel" placeholder="Phone Number" id="phoneNumber" class="form-control" name="phoneNumber">
                            </label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="userEmail">Email Address:
                                <input type="email" placeholder="Email" id="userEmail" class="form-control" name="userEmail">
                            </label>
                        </div>



                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="password">Password:
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password">
                            </label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="confirmPassword">Confirm Password:
                                <input type="password" placeholder="Confirm Password" id="confirmPassword" class="form-control" name="confirmPassword">
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

        var surName = $.trim($("#surName").val());
        var firstName = $.trim($("#firstName").val());
        var lastName = $.trim($("#lastName").val());
        var phoneNumber = $.trim($("#phoneNumber").val());
        var userEmail = $.trim($("#userEmail").val());
        var password = $.trim($("#password").val());
        var confirmPassword = $.trim($("#confirmPassword").val());


        // validate SurName
        if (surName == "") {
            alert("Please provide your Surname.");
            $("#surName").focus();
            return false;
        }

        //validate FirstName
        if (firstName == "") {
            alert("Please provide your First Name.");
            $("#firstName").focus();
            return false;
        }
        //validate LastName
        if (lastName == "") {
            alert("Please provide your Last Name.");
            $("#lastName").focus();
            return false;
        }
        //validate phone number
        if (phoneNumber == "") {
            alert("Provide your Phone Number.");
            $("#phoneNumber").focus();
            return false;
        }

        //validate password
        if (password == "") {
            alert("Provide Password.");
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
        //validate email
        if (userEmail == "") {
            alert("Provide Your Email Address.");
            $("#userEmail").focus();
            return false;
        }

        // validate email
        if (!isValidEmail(userEmail)) {
            alert("Enter a valid email.");
            $("#userEmail").focus();
            return false;
        }


        return true;
    }

    function isValidEmail(userEmail) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(userEmail);
    }


</script>

<?php
include ('Footer.php');
?>
</body>
</html>