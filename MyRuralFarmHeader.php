<html>

<body>
<div class="container-fluid">
  <div class="row">
          <div class="col-md-3 col-lg-3 col-sm-3" id="header">
              <div class="col-md-7 col-lg-7" id="header">
                  <a href="index.php" title="Home">
                      <img class="img-responsive" id="logo" src="Images/MyRuralFarmLogo.JPG"/>
                  </a>
              </div>
              <div class="col-md-5 col-lg-5 col-sm-5" id="header">
              <h4 id="name">Myruralfarm Investments Ltd.</h4>
              </div>
          </div>


      <div class="col-md-8 com-lg-8 com-sm-8" id="logging">
          <?php
          if(!isset($_SESSION['logInUser']) && !isset($_SESSION['logInStaff'])){?>
<div class="row">
                  <div class="col-md-3 col-lg-3 col-sm-3" id="logIn">
                      <a href="LogIn.php"> <button class="btn btn-default" type="submit">&nbsp;Log In&nbsp;<span class="glyphicon glyphicon-log-in"></span> </button></a>
                  </div>

    <div class="col-md-6 col-lg-6 col-sm-6"></div>

                  <div class="col-md-3 col-lg-3 col-sm-3" id="signUp">
                      <a href="Register.php"> <button class="btn btn-default" type="submit" >&nbsp;Sign Up&nbsp;</button></a>
                  </div>

</div>
         <?php }?>
<!--          elseif(isset($_SESSION['logInStaff']) ){?>-->
<!---->
<!--              <div class="btn-group">-->
<!--                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Welcome --><?php
//                                       echo $_SESSION['logInStaff'];
//                                        ?><!--   <span class="caret"></span>-->
<!--                  </button>-->
<!--                  <ul class="dropdown-menu" role="menu">-->
<!--                      <li><a href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Password</a></li>-->
<!--                      <li><a href="staffLogOut.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a></li>-->
<!--                  </ul>-->
<!--              </div>-->
<!--         --><?php
//          }elseif(isset($_SESSION['logInUser'])){?>
<!--          <div class="btn-group">-->
<!--              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Welcome --><?php
//                  echo $_SESSION['logInUser'];
//                  ?><!--   <span class="caret"></span>-->
<!--              </button>-->
<!--              <ul class="dropdown-menu" role="menu">-->
<!--                  <li><a href="changePassword.php"><span class="fa fa-edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Password</a></li>-->
<!--                  <li><a href="LogOut.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a></li>-->
<!--              </ul>-->
<!--          </div>-->
<!--        --><?php // }
//          ?>
      </div>

  </div>

  <div class="row">
    <div class="navbar navbar-default navbar-static-top"   id="nav-bar" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php" target="_blank" style="color:white" title="Home"><span class="glyphicon glyphicon-home"></span> Myruralfarm</a>
          </div>
          <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1" >
              <ul class="nav navbar-nav">
            <li><a href="index.php" id="links" title="Home">Home</a></li>
            <li><a href="AboutMyRuralFarm.php" id="links" title="About MyRuralFarm Investments Ltd.">About Us</a></li>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown" href="#" role="button" aria-hashpopup="true" aria-expanded="false" id="links">Arable Lands</a>

                <ul class="dropdown-menu" id="dropdown">
                    <li>
                        <a class="dropdown-item" href="SellLand.php" id="dropLinks">Sell Land</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="BuyLand.php" id="dropLinks">Buy Land</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="LeaseLand.php" id="dropLinks">Lease Land As LandLord</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="getLandOnLease.php" id="dropLinks">Lease Land As Tenant</a>
                    </li>

                </ul>

            </li>
<!--            <li><a href="#" id="links">Farm Management</a></li>-->
              <li><a href="MyRuralFarmCareers.php" id="links" title="MyRuralFarm Careers">Careers</a></li>
            <li><a href="MyRuralFarmNews.php" id="links" title="MyRuralFarm News">News</a></li>
			<li><a href="contactMyRuralFarm.php" id="links" title="Contact MyRuralFarm">Contact Us</a></li>
              <li><?php
              if(isset($_SESSION['logInStaff'])) {?>
                  <a href="MyRuralFarmStaffHomePage.php" id="links">Staff Log In</a></li>
              <?php
              }else{?>
                  <a href="staffLogIn.php" id="links">Staff Log In</a></li>
              <?php
              }
              ?>


                  <li><?php
                      if(isset($_SESSION['logInUser'])) {?>
                      <a href="LogOut.php" id="links" title="Log Out"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a>
              <?php
              }else if(isset($_SESSION['logInStaff'])) {?>
                  <a href="staffLogOut.php" id="links" title="Log Out"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a></li>
              <?php }?>
                  <li id="welLogOut">
                      <?php if(isset($_SESSION['logInStaff']) ){?>


                          <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" id="links" style="background-color: #008200;">
                              <span class="glyphicon glyphicon-user"></span> Welcome <?php
                              echo $_SESSION['logInStaff'];
                              ?>   <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="staffChangePassword.php" style="color: blue"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Password</a></li>
                              <li><a href="staffLogOut.php" style="color: blue"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a></li>
                          </ul>

                      <?php
                      }elseif(isset($_SESSION['logInUser'])){?>
<!--                      <div class="btn-group">-->
                          <button type="button" class="dropdown-toggle btn" data-toggle="dropdown" id="links" style="background-color: #008200;">
                              <span class="glyphicon glyphicon-user" ></span> Welcome <?php
                              echo $_SESSION['logInUser'];
                              ?>   <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="changePassword.php" style="color: blue"><span class="fa fa-edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Password</a></li>
                              <li><a href="LogOut.php" style="color: blue"><span class="glyphicon glyphicon-log-out" ></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a></li>
                          </ul>
<!--                      </div>-->
                      <?php  }
                      ?>
                  </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
