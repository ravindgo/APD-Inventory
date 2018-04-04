<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->


<!-- Mirrored from demo.geekslabs.com/materialize/v3.1/user-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2017 07:39:34 GMT -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Register Page | APD Inventroy Management System</title>

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
  

  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form  class="login-form" role="form" method="post" action="user-register.php">
        <div class="row">
          <div class="input-field col s12 center">
            <!-- <img src="images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login"> -->
            <h4 class="task-card-title" style="padding: 0px 0px 0px 25px"><span style="color: #607D8B">A</span><span style="color: #EC407A">P</span><span style="color: #9C27B0">D</span></h4>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" class="form-control" placeholder="Username" name="name" type="text">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="email" class="form-control" placeholder="E-mail" name="email" type="email">
            <label for="email" class="center-align">Email</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" class="form-control" placeholder="Password" name="pass" type="password" value="">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <label for="genter_select">Type *</label><br>
              <p>
                <input name="cgender" type="radio" id="gender_male" data-error=".errorTxt8"/>
                <label for="gender_male">Field Technician</label>
              </p>
              <p>
                <input name="cgender" type="radio" id="gender_female" value="f"/>
                <label for="gender_female">Store Keeper</label>
              </p>
              <div class="input-field">
                  <div class="errorTxt8"></div>
              </div>
          </div> 
        </div>
        <div class="row">
          <div class="input-field col s12">
          <button class="btn cyan waves-effect waves-light right" type="submit" value="register" name="register">Register</button>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="user-login.php">Login</a></p>
          </div>
        </div>
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


<!-- Mirrored from demo.geekslabs.com/materialize/v3.1/user-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2017 07:39:35 GMT -->
</html>

<?php

include("database/db_conection.php");//make connection here
if(isset($_POST['register']))
{
    $user_name=$_POST['name'];//here getting result from the post array after submitting the form.
    $user_pass=$_POST['pass'];//same
    $user_email=$_POST['email'];//same


    if($user_name=='')
    {
        //javascript use for input checking
        echo"<script>alert('Please enter the name')</script>";
exit();//this use if first is not work then other will not show
    }

    if($user_pass=='')
    {
        echo"<script>alert('Please enter the password')</script>";
exit();
    }

    if($user_email=='')
    {
        echo"<script>alert('Please enter the email')</script>";
    exit();
    }
//here query check weather if user already registered so can't register again.
    $check_email_query="select * from users WHERE user_email='$user_email'";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
exit();
    }
//insert the user into the database.
    $insert_user="insert into users (user_name,user_pass,user_email) VALUE ('$user_name','$user_pass','$user_email')";
    if(mysqli_query($dbcon,$insert_user))
    {
        echo"<script>window.open('index.php','_self')</script>";
    }

}

?>