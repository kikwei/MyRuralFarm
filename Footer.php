<footer>
<div class="row" id="upperFooter">

    <div class="col-md-4 col-lg-4 col-sm-4">
        <h3>&nbsp;<b><u>Quick Links</u></b></span></h3>
       <ul class="nav nav-pills nav-stacked">
           <li><a href="AboutMyRuralFarm.php" style="color: black">About Us</a> </li>
           <li><a href="contactMyRuralFarm.php" style="color: black">Contact Us</a> </li>
           <li><a href="MyRuralFarmNews.php" style="color: black">News</a> </li>
<!--           <li><a href="#" style="color: black">Opportunities</a> </li>-->
       </ul>
    </div>



    <div class="col-md-4 col-lg-4 col-sm-4">
        <h3><b><u>Contact Myruralfarm Investments</u></b></h3>
        <h5><span class="glyphicon glyphicon-phone-alt">&nbsp;<b>Phone:</b> <b>  <?php
        require ('Connect.php');

        $query="SELECT CONCAT(Primary_Phone,'     ',Secondary_Phone) FROM contacts";
        $result=mysqli_query($connection,$query);

        $resultArray=mysqli_fetch_array($result);
        echo $resultArray[0];
                    ?></b></span></h5>
<!--        <h5><span class="glyphicon glyphicon-map-marker">&nbsp;<b>Address</b> P.O BOX 48-20321,Marmanet-Kenya</span></h5>-->
        <h5><span class="glyphicon glyphicon-envelope">&nbsp;<b>Email:  <?php
                $query="SELECT Email FROM contacts";
                $result=mysqli_query($connection,$query);


                $resultArray=mysqli_fetch_array($result);
                echo $resultArray[0];
                    ?></b></span></h5>
    </div>

    <div class="col-md-4 col-lg-4 col-sm-4">
        <h3><u>&nbsp;<b>Follow Us on:</b></u></h3>
        <h5><a href="#" style="color: black"><span class="fa fa-facebook-official">&nbsp; Facebook</span></a></h5>
        <h5><a href="#" style="color: black"> <span class="fa fa-twitter-square">&nbsp; Twitter</span></a></h5>
        <h5><a href="#" style="color: black"><span class="fa fa-instagram">&nbsp; Instagram</span></a></h5>

    </div>

</div>
   <div class="row" id="footer">
       <div class="col-md-12 col-lg-12 col-sm-12">
           <div class="footer" >
                <br/>
                   <p style="color: white">Copyright  &copy; <?php echo date("Y"); ?>  Myruralfarm Investments Limited  - All rights reserved</p>
<!--                  <p style="color: white">Designed by Langat William | 0707156079 | langatwilliamk@gmail.com</p>-->

           </div>
       </div>
<br/>
   </div>


</footer>
