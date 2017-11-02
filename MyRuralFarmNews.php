<?php
session_start();
include ('style.php');
include_once('MyRuralFarmHeader.php');
?>
<body>
<div class="row" id="news">
<div class="col-md-8 col-md-offset-2">
    <h2 style="color: #00CC00;;">Latest News</h2>
    <?php
    require('Connect.php');



        $ids = "SELECT id FROM news";
        $idResult = mysqli_query($connection, $ids);


    while($idArray=mysqli_fetch_array($idResult)) {

        $maxId = "SELECT MAX(id) FROM news";
        $maxIdResult = mysqli_query($connection, $maxId);

        $maxIdArray = mysqli_fetch_array($maxIdResult);


        $difference = $maxIdArray[0] - $idArray[0];

        if($difference < 8) {
            $news = "SELECT  `news` FROM `news` WHERE `id`='$idArray[0]' ORDER BY `date_posted` DESC ";
            $result = mysqli_query($connection, $news);

            while ($resultArray = mysqli_fetch_array($result)) {
                ?>
                <p style="padding-left: 12%" ><?php echo $resultArray[0]; ?></p>

                <?php
                echo "<br/>";
            }
        }
    }

    ?>

</div>
</div>
</body>
