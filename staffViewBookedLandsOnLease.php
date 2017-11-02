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
?>

<?php
require ('Connect.php');
if(isset($_SESSION['logInStaff'])) {


$select = "SELECT LandSize,LeasePeriod,LeaseCostPerUnit,LandLocation,LandDescription,OwnerContact,booked_by,date_booked FROM lands_on_lease WHERE Status='Booked' ORDER BY date_booked ASC ";

$result = mysqli_query($connection, $select);

$rows=mysqli_num_rows($result);
if($rows>0){?>

<div class="row">
    <form action="staffApproveLease.php" method="GET">
        <table border='1' align='center' class='table table-hover text-center'>
            <caption  style='color:#2E4372'><h3 class="text-center"><u >Booked Lands OnLease</u></h3></caption>

            <th class="text-center">Approve Lease</th>
            <th class="text-center">Land Size</th>
            <th class="text-center">Lease Period</th>
            <th class="text-center">Lease Cost Per Unit</th>
            <th class="text-center">Land Location</th>
            <th class="text-center">Land Description</th>
            <th class="text-center">Land Owner</th>
            <th class="text-center">Booked By</th>
            <th class="text-center">Date Booked</th>

            <?php
            while ($queryResult = mysqli_fetch_array($result)) {

                echo "<tr><td><input type='radio' name='landLordMail' value='$queryResult[5]'></td><td> $queryResult[0]</td><td> $queryResult[1]</td><td>$queryResult[2]</td><td> $queryResult[3]</td><td> $queryResult[4]</td><td> $queryResult[5]</td><td> $queryResult[6]</td><td> $queryResult[7]</td></tr>";
            }
            }else{
                echo "<p class='alert alert-danger' style='padding-left: 43%; '> No Land On Lease is Currently Booked</p>";
            }
            }
            else{
                header('Location:MyRuralStaffLogIn.php');
            }

            ?>
        </table>
        <h3 class="text-center"><button type="submit" class=" btn btn-success text-center" name="approveLease">Approve Lease</button></h3>
        <h3 class="text-center"><button type="submit" class=" btn btn-danger text-center" name="disapproveLease">DisApprove Lease</button></h3>
    </form>
</div>
<?php
include ('Footer.php');
?>
</body>
</html>
