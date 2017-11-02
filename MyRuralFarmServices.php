<?php
session_start();
require_once ('Connect.php');

if(!isset($_SESSION['logInUser']))
    header('Location:LogIn.php');
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
    <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-sm-8 col-sm-offset-2">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-md-6 col-lg-6 col-sm-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b><?php

                            require_once ('Connect.php');
                            $query="SELECT COUNT(*) FROM lands_on_sale WHERE status='Onsale'";
                            $result=mysqli_query($connection,$query);

                            $resultArray=mysqli_fetch_array($result);

                            echo $resultArray[0].' Lands On Sale';
                                    ?>
                                </b></h3>
                        </div>
                            <div class="panel-body">
                             <div class="panel-footer">
                                <h3 class="text-center"><a href="BuyLand.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">Buy Land</button></a></h3>
                            </div>
                            </div>
                        </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b>Sell Land</b></h3>
                        </div>
                            <div class="panel-body">
                                <div class="panel-footer">
                                <h3 class="text-center"><a href="SellLand.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">Sell Land</button></a></h3>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b>Lease Land As LandLord</b></h3>
                        </div>
                            <div class="panel-body">
                                <div class="panel-footer">
                                <h3 class="text-center"><a href="LeaseLand.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">Lease Land</button></a></h3>
                            </div>
                            </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><b>
                                    <?php

                                    require_once ('Connect.php');
                                    $query="SELECT COUNT(*) FROM lands_on_lease WHERE status='Onlease'";
                                    $result=mysqli_query($connection,$query);

                                    $resultArray=mysqli_fetch_array($result);

                                    echo $resultArray[0].' Lands On Lease';
                                    ?>
                                </b></h3>
                        </div>
                            <div class="panel-body">
                                <div class="panel-footer">
                                <h3 class="text-center"><a href="getLandOnLease.php" style="color: whitesmoke"><button type="submit" class="btn btn-success">Lease Land</button></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <?php
        include_once ('Footer.php');
        ?>
</body>
</html>
