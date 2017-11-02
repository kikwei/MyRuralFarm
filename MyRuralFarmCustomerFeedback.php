<?php
session_start();
if(!isset($_SESSION['logInStaff'])) {
    header('Location:MyRuralStaffLogIn.php');
}else {
    require('Connect.php');


    $query="SELECT Customer,Customer_Email,Message FROM Customer_Feedback ORDER BY date_posted";


    $result=mysqli_query($connection,$query);

    $rowsAff=mysqli_affected_rows($connection);

    if($rowsAff>0) {
        ?>
        <html>
        <?php
        include ('style.php');
        ?>
        <body>
        <?php
        include ('MyRuralFarmHeader.php');
        ?>
        <div class="container">
        <table class="table table-hover text-center" border="1">
            <th class="text-center">Customer</th>
            <th class="text-center">Customer' Email</th>
            <th class="text-center">Message</th>

            <?php
            while ($rows = mysqli_fetch_array($result)) {
                echo "<tr><td>$rows[0]</td><td>$rows[1]</td><td>$rows[2]</td></tr>";
            }
            ?>
        </table>
        </div>
        <?php
    }else{
        echo"<p class='alert alert-danger text-center'>No Current Customer Feedback!</p>";
    }
}?>
        </body>
        </html>