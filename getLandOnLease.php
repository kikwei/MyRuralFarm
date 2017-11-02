<?php
session_start();
if(isset($_SESSION['logInUser'])) {

require ('Connect.php');



$select = "SELECT OwnerContact,LandSize,LeasePeriod,LeaseCostPerUnit,LandLocation,LandDescription FROM lands_on_lease WHERE Status='OnLease'";

$result = mysqli_query($connection, $select);

$rows=mysqli_num_rows($result);
?>
<html>
<?php
include ('style.php');
?>
<body>
<?php
include_once('MyRuralFarmHeader.php');
if($rows>0){?>

<div class="row">
    <form action="AcquireLandOnLease.php" method="GET">
        <table border='1' align='center' class='table table-hover text-center'>
            <caption  style='color:#2E4372'><h3 class="text-center"><u >Lands on Lease</u></h3></caption>
            <th class="text-center">Acquire Land</th>
            <th class="text-center">Land Size</th>
            <th class="text-center">Lease Period</th>
            <th class="text-center">Lease Cost Per Unit</th>
            <th class="text-center">Land Location</th>
            <th class="text-center">Land Description</th>

            <?php
            while ($queryResult = mysqli_fetch_array($result)) {

                echo "<tr><td><input type='radio' name='landLordMail' value='".base64_encode($queryResult[0])."'></td><td> $queryResult[1]</td><td> $queryResult[2]</td><td>$queryResult[3]</td><td> $queryResult[4]</td><td> $queryResult[5]</td></tr>";
            }
            }else{
                echo "<p class='alert alert-danger' style='padding-left: 43%; '> No Land is Currently On Lease</p>";
            }
            }
            else{
                header('Location:LogIn.php');
            }

            ?>
        </table>
        <h3 class="text-center"><button type="submit" class=" btn btn-success text-center">Acquire Land</button></h3>
    </form>
</div>
<?php
include ('Footer.php');
?>
</body>
</html>
