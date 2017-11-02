<?php
session_start();

if(!isset($_SESSION['logInUser']))
    header('Location:LogIn.php');

if (count($_POST) > 0) {

    /* Form Required Field Validation */
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $msg = ucwords($key) . " field is required";
            $msgType="alert alert-danger";
            break;
        }
    }

//Validation to check if Land Size is provided
    if (!isset($msg)) {
        if (!isset($_POST["landSize"])) {
            $msg = " Land Size field is required";
            $msgType = 'alert alert-danger';
        }
    }

//Validation to check if Leasing Period is provided
    if (!isset($msg)) {
        if (!isset($_POST["leasePeriod"])) {
            $msg = " Lease Period field is required";
            $msgType = 'alert alert-danger';
        }
    }

//Validation to check if Leasing Cost is provided
    if (!isset($msg)) {
        if (!isset($_POST["leaseCost"])) {
            $msg = " Lease Cost field is required";
            $msgType = 'alert alert-danger';
        }
    }

//Validation to check if Location of The Land is provided
    if (!isset($msg)) {
        if (!isset($_POST["landLocation"])) {
            $msg = " Land Location field is required";
            $msgType = 'alert alert-danger';
        }
    }


    if (!isset($msg)) {
        if (!isset($_POST["landDescription"])) {
            $msg = " Land Description field is required";
            $msgType = 'alert alert-danger';
        }
    }


    /* Email Validation */
//    if (!isset($msg)) {
//        if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
//            $msg = "Invalid UserEmail";
//            $msgType = 'alert alert-danger';
//        }
//    }


    if (!isset($msg)) {

        require('Connect.php');

        $query = "INSERT INTO lands_on_lease(LandSize,LeasePeriod,LeaseCostPerUnit,LandLocation,LandDescription,OwnerContact) 
                      VALUES('" . trim($_POST["landSize"]) . "', '" . trim($_POST["leasePeriod"]) . "', '" . trim($_POST["leaseCost"]) . "', '" . trim($_POST['landLocation']) . "','" . trim($_POST["landDescription"]) . "','" . $_SESSION['contact'] . "')";

        try {
            $result = mysqli_query($connection, $query);

            $rowCount = mysqli_affected_rows($connection);

            if ($rowCount > 0) {
                $msg = 'Land Details Successfully Submitted';
                $msgType = 'alert alert-success';
            } else {
                $msg = 'Land Details Submission Failed.Please try Again.';
                $msgType = 'alert alert-danger';
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
include_once('MyRuralFarmHeader.php');
?>

<?php if (@$msg!="") { ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="<?php echo $msgType?>">
            <button data-dismiss="alert" class="close" type="button">x</button>
            <p class="text-centre"><?php echo $msg; ?></p>
        </div>
        <?php }?>
    </div>
</div>


<div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><b>Enter Details of The Farm to Lease</b></h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="LeaseLand.php" method="post"  onsubmit="return validateForm();">


                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="LandSize">Land Size:
                                <input type="text" placeholder="Enter Land Size in units e.g 100 Acres, 10 Hectares" id="landSize" class="form-control" name="landSize">
                            </label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="LeasePeriod">Lease Period:
                                <input type="text" placeholder="Enter duration that you want to Lease out your Land e.g 2 Years" id="leasePeriod" class="form-control" name="leasePeriod">
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="LeaseCost">Leasing Cost:
                                <input type="text" placeholder=" e.g Ksh. 100,000 per Acre in 2 Years" id="leaseCost" class="form-control" name="leaseCost">
                             </label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="LandLocation">Location of The Land:
                                <input type="text" placeholder="Enter where the Land is Located e.g Marmanet-Kenya" id="landLocation" class="form-control" name="landLocation">
                            </label>
                        </div>



                        <div class="form-group">
                            <label class="col-md-12 col-lg-12 col-sm-12" for="landDescription">Description of The Land:
                                <textarea  placeholder="e.g 50 Metres from Nyahururu-Rumuruti Road, 100 Metres from a stream" id="landDescription" class="form-control" name="landDescription"></textarea>
                            </label>
                        </div>




                        <div style="height: 10px;clear: both"></div>

                        <div class="form-group">
                            <div class="col-md-10 col-lg-10 col-sm-10">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                    </fieldset>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function validateForm() {

        var landSize = $.trim($("#landSize").val());
        var leasePeriod = $.trim($("#leasePeriod").val());
        var leaseCost = $.trim($("#leaseCost").val());
        var landLocation = $.trim($("#landLocation").val());



        // validate LandSize
        if (landSize == "") {
            alert("Specify the Size of the Land.");
            $("#landSize").focus();
            return false;
        }

        // validate LeasePeriod
        if (leasePeriod == "") {
            alert("Specify the Period you want to Lease Out Your Land.");
            $("#leasePeriod").focus();
            return false;
        }

        //validate landCost
        if (leaseCost == "") {
            alert("Specify the cost of leasing the Land per unit.");
            $("#landCost").focus();
            return false;
        }

        //validate landLocation
        if (landLocation == "") {
            alert("Specify where the Land is Located.");
            $("#landLocation").focus();
            return false;
        }



        return true;
    }




</script>

<?php
include ('Footer.php');
?>
</body>
</html>