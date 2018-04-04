
<?php
session_start();//session starts here
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Login Page | APD Inventroy Management System</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" method="post" action="user-login.php">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="images/hands.png" style="width: 198px !important; height: 152px !important" alt="" class="circle responsive-img valign profile-image-login">
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" placeholder="User Name" name="uname" type="text" autofocus>
            <label for="username" class="center-align">UserName</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" placeholder="Password" name="pass" type="password" value="">
            <label for="password">Password</label>
          </div>
        </div>
        <!-- <div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
              <input type="checkbox" id="remember-me" />
              <label for="remember-me">Remember me</label>
          </div>
        </div> -->
        <div class="row">
          <div class="input-field col s12">
            <button class="btn cyan waves-effect waves-light right" type="submit" value="login" name="login">Login</button>
          </div>
        </div>
        <div class="row">
             <div class="input-field col s12">
            <p class="margin center medium-small sign-up" style="color: red">
            <?php
            $errorMsg="";
            echo $errorMsg;
            ?></p>
          </div>
        </div>
     <!--    <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="user-register.php">Register Now!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>
          </div>          
        </div> -->

      </form>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!--prism-->
  <script type="text/javascript" src="js/plugins/prism/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>

</body>


</html>

<?php

include("database/db_conection.php");

if(isset($_POST['login']))
{
  $user_name=$_POST['uname'];
  $user_pass=$_POST['pass'];

  $result=mysqli_query($dbcon,"select * from users WHERE User_Name='$user_name' AND Password='$user_pass'");
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      $user_type= $row['User_Type'];
      $user=$row['User_Name'];
      switch ($user_type) {
        case 'Admin':
          $_SESSION['user_type_Admin']=$user_type;
          $_SESSION['Admin_User']=$user;
          echo "<script>window.open('index.php','_self')</script>";
          break;
        case 'Field Technician':
          $_SESSION['user_type_Field']=$user_type;
           $_SESSION['Field_User']=$user;
          echo "<script>window.open('Field-index.php','_self')</script>";
          break;
          case 'Store Keeper':
          $_SESSION['user_type_Store']=$user_type;
           $_SESSION['Store_User']=$user;
          echo "<script>window.open('store-index.php','_self')</script>";
          break;
        default:
           //echo "<script>window.open('user-login.php','_self')</script>";
         echo"<script>alert('Invalid UserName/Password. Please retry')</script>";
          break;
      }
    }
  }
  else{
    echo"<script>alert('Invalid UserName/Password. Please retry.')</script>";
    }
  }
?>