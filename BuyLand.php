<?php
session_start();

if(isset($_SESSION['logInUser'])) {


        require ('Connect.php');



$select = "SELECT OwnerContact,LandSize,LandCostPerUnit,LandLocation,LandDescription FROM lands_on_sale WHERE Status='OnSale'";

$result = mysqli_query($connection, $select);

$rows = mysqli_num_rows($result);
?>
<html>
<?php
include('style.php');
?>
<body>

<?php
include_once('MyRuralFarmHeader.php');
if ($rows > 0){
?>


<div class="row">
    <form action="BookLandToBuy.php" method="GET">
        <table border='1' align='center' class='table table-hover text-center'>
            <caption style='color:#2E4372'><h3 class="text-center"><u>Lands on Sale</u></h3></caption>
            <th class="text-center">Buy Land</th>
            <th class="text-center">Land Size</th>
            <th class="text-center">Cost Per Unit</th>
            <th class="text-center">Land Location</th>
            <th class="text-center">Land Description</th>

            <?php
            while ($queryResult = mysqli_fetch_array($result)) {

                echo "<tr><td><input type='radio' name='sellerMail' value='".base64_encode($queryResult[0])."'></td><td> $queryResult[1]</td><td> $queryResult[2]</td><td>$queryResult[3]</td><td> $queryResult[4]</td></tr>";
            }
            } else {
                echo "<p class='alert alert-danger' style='padding-left: 43%; '> No Land is Currently On Sale</p>";
            }
            ?>
        </table>
        <h3 class="text-center"><button type="submit" class=" btn btn-success text-center">Buy Land</button></h3>
    </form>
</div>
<?php
 }else{
    header("Location:LogIn.php");
           }?>
<?php
include ('Footer.php');
?>
</body>
</html>
