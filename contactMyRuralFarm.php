<?php
session_start();

    if (count($_POST) > 0) {

        /* Form Required Field Validation */
        foreach ($_POST as $key => $value) {
            if (empty($_POST[$key])) {
                $msg = ucwords($key) . " field is required";
                $msgType = 'alert alert-danger';
                break;
            }
        }

        //Validation to check if Email is provided
        if (!isset($msg)) {
            if (!isset($_POST["userEmail"])) {
                $msg = " Your Email is required";
                $msgType = 'alert alert-danger';
            }
        }


        //Validation to check if Name is provided
        if (!isset($msg)) {
            if (!isset($_POST["Name"])) {
                $msg = " Please Provide Your Name";
                $msgType = 'alert alert-danger';
            }
        }


        //Validation to check if Message is provided
        if (!isset($msg)) {
            if (!isset($_POST["message"])) {
                $msg = " Please Provide your Feedback";
                $msgType = 'alert alert-danger';
            }
        }

        if (!isset($msg)) {
            if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
                $msg = "Invalid UserEmail";
                $msgType = 'alert alert-danger';
            }
        }

        if (!isset($msg)) {

            require_once('Connect.php');

            $date = date('Y-m-d H:i:s');

            $query = "INSERT INTO customer_feedback (Customer,Customer_Email,Message,date_posted)
                      VALUES ('".$_POST['Name']."','".$_POST['userEmail']."','".$_POST['message']."','$date')";

            $insert=mysqli_query($connection,$query);

            if(mysqli_affected_rows($connection)>0){
                $msg="Your Message Successfully Delivered";
                $msgType="alert alert-success";
            }else{
                $msg="Message Delivery Failed.Try Again Later";
                $msgType = 'alert alert-danger';
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
include_once('MyRuralFarmHeader.php');
?>
<div class="row" id="contact">
    <div class="col-md-4 col-lg-4 col-sm-4 col-md-offset-3  col-lg-offset-3  col-sm-offset-3">
    <h4>Contact Us at Myruralfarm Investments through:</h4>
        <p><b>Email: <span  style="color: blue">info@myruralfarm.co.ke</span></b></p>
        <p><b>Telephone:  <span  style="color: blue">+254791430244 , +254703430213 OR +254721463795 </span></b> </p>
        <br/>
        <br/>
        <h4>You can also use the Form Below to contact Us:</h4>
    </div>
</div>

<?php

if (@$msg !="") { ?>
<div class="row">
    <div class="col-md-8 col-lg-8  col-sm-8  col-md-offset-2  col-sm-offset-2 col-lg-offset-2">
        <div class="<?php echo $msgType?>">
            <button data-dismiss="alert" class="close" type="button">x</button>
            <p><?php echo $msg; ?></p>
        </div>
        <?php  }?>
    </div>
</div>


<div class="row">
    <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 ">
        <div class="panel panel-footer">
        <br/><br/>
        <form class="form-horizontal" action="" method="POST">

            <div class="form-group">

                <label class="col-md-12 col-lg-12 col-sm-12">Your Name:
                    <input type="text" placeholder="Provide Your Name" id="customerName" class="form-control" name="Name">
            </div>

            <div class="form-group">
                <label class="col-md-12 col-lg-12 col-sm-12">Email:
                    <input type="text" placeholder="Your Email" id="userEmail" class="form-control" name="userEmail">
                </label>
            </div>




            <div class="form-group">
                <label class="col-md-12 col-lg-12 col-sm-12">Your Message:
                    <input type="text" placeholder="Leave your Message here"  id="customerMessage" class="form-control" name="message">
                </label>
            </div>


            <div class="form-group">
                <div class="col-md-10 col-lg-10 col-sm-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
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
</body>
</html>