<?php
session_start();
require_once ('Connect.php');

if(!isset($_SESSION['logInStaff']))
    header('Location:MyRuralStaffLogIn.php');
?>
<html>
<?php
include ('style.php');
?>
<body>
<?php
include('MyRuralFarmHeader.php');
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b><?php

                                    require_once ('Connect.php');
                                    $query="SELECT COUNT(*) FROM lands_on_sale WHERE status!='Sold'";
                                    $result=mysqli_query($connection,$query);

                                    $resultArray=mysqli_fetch_array($result);

                                    echo $resultArray[0].' Lands On Sale';
                                    ?>
                                </b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-footer">
                                <h3 class="text-center"><a href="staffViewLandsOnSale.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">View Lands OnSale</button></a></h3>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b>
                                    <?php

                                    require_once ('Connect.php');
                                    $query="SELECT COUNT(*) FROM lands_on_lease WHERE status!='Leased'";
                                    $result=mysqli_query($connection,$query);

                                    $resultArray=mysqli_fetch_array($result);

                                    echo $resultArray[0].' Lands On Lease';
                                    ?>
                                </b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-footer">
                                <h3 class="text-center"><a href="staffViewLandsOnLease.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">View Lands OnLease</button></a></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b><?php

                                    require_once ('Connect.php');
                                    $query="SELECT COUNT(*) FROM lands_on_sale WHERE status='Booked'";
                                    $result=mysqli_query($connection,$query);

                                    $resultArray=mysqli_fetch_array($result);

                                    echo $resultArray[0].' Lands On Sale Booked';
                                    ?></b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-footer">
                                <h3 class="text-center"><a href="staffViewBookedLandsOnSale.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">View Booked Lands</button></a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b>
                                    <?php

                                    require_once ('Connect.php');
                                    $query="SELECT COUNT(*) FROM lands_on_lease WHERE status='Booked'";
                                    $result=mysqli_query($connection,$query);

                                    $resultArray=mysqli_fetch_array($result);

                                    echo $resultArray[0].' Lands On Lease Booked';
                                    ?>
                                </b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-footer">
                                <h3 class="text-center"><a href="staffViewBookedLandsOnLease.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">View Booked Lands</button></a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-md-offset-5">
        <a href="MyRuralFarmCustomerFeedback.php" target="_blank"><button class="btn btn-success">View Customers' Feedback</button> </a>
        </div>
    </div>
</div>
<br/>
<?php
include_once ('Footer.php');
?>
</body>
</html>
