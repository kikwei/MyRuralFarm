<?php
session_start();
?>
<html>
<?php
include ('style.php');
?>
<body>
<?php
include_once('MyRuralFarmHeader.php');
if(!isset($_SESSION['logInStaff'])) {
    header('Location:staffLogIn.php');
}else{
require ('Connect.php');


$select = "SELECT OwnerContact,LandSize,LandCostPerUnit,LandLocation,LandDescription FROM lands_on_sale WHERE Status!='Sold'";

$result = mysqli_query($connection, $select);

$rows=mysqli_num_rows($result);
if($rows>0){?>

<div class="row">
    <form action="BookLandToBuy.php" method="GET">
        <table border='1' align='center' class='table table-hover text-center'>
            <caption  style='color:#2E4372'><h3 class="text-center"><u >Lands on Sale</u></h3></caption>

            <th class="text-center">Land Size</th>
            <th class="text-center">Cost Per Unit</th>
            <th class="text-center">Land Location</th>
            <th class="text-center">Land Description</th>
            <th class="text-center">Land Owner</th>

            <?php
            while ($queryResult = mysqli_fetch_array($result)) {

                echo "<tr><td> $queryResult[1]</td><td> $queryResult[2]</td><td>$queryResult[3]</td><td> $queryResult[4]</td><td> $queryResult[0]</td></tr>";
            }
            }else{
                echo "<p class='alert alert-danger' style='padding-left: 50%; '> No Land is Currently On Sale</p>";
            }
            }


            ?>
        </table>

    </form>
</div>

<?php
if(isset($_POST['SaleNews'])){
    require_once ('Connect.php');

    $date=date('Y-m-d H:i:s');

    $query="INSERT INTO `news`(`news`,`date_posted`)
            VALUES ('".trim($_POST['news'])."','$date')";

    $insert=mysqli_query($connection,$query);

    $rows=mysqli_affected_rows($connection);
    if($rows>0){
        $msg="News Posted successfully";
        $msgType='alert alert-success';
    }else{
        $msg="No News Posted";
        $msgType='alert alert-danger';
    }
}
?>
<?php

if (@$msg >"") { ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="<?php echo $msgType?>">
            <button data-dismiss="alert" class="close" type="button">x</button>
            <p class="text-center"><?php echo $msg; ?></p>
        </div>
        <?php  }?>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Post Latest Lands On Sale</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="">
                    <div class="form-group">
                        <div class="col-md-4 col-lg-4 col-sm-4">
                            <label class="control-label" style="padding-left: 85%">News:</label>
                        </div>
                        <div class="col-md-8 col-lg-8 col-sm-8">
                            <input type="text" class="form-control" placeholder="Post The Latest News on Lands On Sale" name="news" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-10 col-lg-4 col-lg-offset-10 col-sm-4 col-sm-offset-10">
                            <button type="submit" class="btn btn-success" name="SaleNews">Post News</button>
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
