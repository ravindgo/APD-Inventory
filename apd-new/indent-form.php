  <?php
   session_start();

    include("database/db_conection.php");

   if(!$_SESSION['user_type_Field'])
    {
        header("Location: user-login.php");//redirect to login page to secure the welcome page without login access.
    }
     $techName=$_SESSION['Field_User'];
     $resultMonth=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE MONTH(Raised_Date)=MONTH(CURRENT_DATE()) and TechName='$techName'");

    while($rowMon=mysqli_fetch_assoc($resultMonth))
      {
        $_SESSION['month_count'] =$rowMon['total'];
      }  
   ?>

<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->


<!-- Mirrored from demo.geekslabs.com/materialize/v3.1/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2017 07:38:56 GMT -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Field technician  Details Page</title>

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

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style>
</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li>
                          <h4 class="task-card-title" style="padding: 0px 0px 0px 25px; color: white;">APD</h4></li>
                    </ul>
                   
                    <ul class="right hide-on-med-and-down">
                        
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">!</small></i>
                        
                        </a>
                        </li>  
                    </ul>
                   
                    <!-- notifications-dropdown -->
                   <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class1="new badge"></span></h5>
                      </li>
                      <li class="divider"></li>
                      <li>
                     <!--    <a href="#!"><i class="mdi-action-add-shopping-cart"></i>   -->
                        <?php 
                        if($_SESSION['month_count']!=="0")
                        {
                          echo "<a href='#!''><i class='mdi-action-add-shopping-cart'></i>  ";
                          echo "Total ". $_SESSION['month_count']." indent raised for the current month."; 
                          echo "</a>";
                        }
                        ?> 
                        
                        <!-- <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time> -->
                      </li>
                     
                     <!--  <li>
                        <a href="#!"><i class="mdi-action-stars"></i> Completed the task</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-settings"></i> Settings updated</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-editor-insert-invitation"></i> Director meeting started</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-trending-up"></i> Generate monthly report</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                      </li> -->
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
     <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="user-details cyan darken-2">
                <div class="row">
                 
                <div class="col col s8 m8 l8">
                        <ul id="profile-dropdown" class="dropdown-content">
                           <li><a class="modal-trigger" href="#modalProfile" onclick="update_profile('<?php echo $_SESSION['Field_User'];?>');"><i class="mdi-action-face-unlock"></i> Profile</a>
                            </li>
                          <!--   <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                            </li> -->
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                            </li>
                        </ul>
                        <a style="margin-left: -20px;" class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $_SESSION['Field_User']; ?><i style="margin-left: -10px;" class="mdi-navigation-arrow-drop-down right"></i></a>
                       <!--  <p class="user-roal">Field Technician</p> -->
                    </div>
                </div>
                </li>
                <li class="bold"><a href="Field-index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                </li>
                
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                       
                        <li class="bold"><a class="collapsible-header  waves-effect waves-cyan active"><i class="mdi-social-pages"></i> Field Technician</a>
                            <div class="collapsible-body">
                                <ul>   
                                   <li class="active"><a href="indent-form.php">Product Indent Form</a>
                                    </li>
                                     <li><a href="preindent-form.php">Pre-Fab Indent Form</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
 
                    </ul>
                </li>
                <li class="li-hover"><div class="divider"></div></li>
                
            </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
            </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <div id="modalProfile" class="modal modal-fixed-footer">
                        <div class="modal-content left">
                           
                      <div class="col s12 m12 l12">
                  <div class="col s12 m12 l6">
                        <div class="card-panel">
                            <form  class="login-form" role="form" method="post" action="user-register.php">
                              
                              <div class="row margin" hidden="true">
                                <div class="input-field col s12">
                                  <i class="mdi-social-person-outline prefix"></i>
                                  <input id="userid" class="form-control" placeholder="Username" name="name" type="text">
                                  <label for="userid" class="center-align">UserId</label>
                                </div>
                              </div>
                              <div class="row margin">
                                <div class="input-field col s12">
                                  <i class="mdi-social-person-outline prefix"></i>
                                  <input id="username" class="form-control" readonly="" placeholder="Username" name="name" type="text">
                                  <label for="username" class="center-align">Username</label>
                                </div>
                              </div>
                              <div class="row margin">
                                <div class="input-field col s12">
                                  <i class="mdi-communication-email prefix"></i>
                                  <input id="email" class="form-control" placeholder="E-mail" readonly="" name="email" type="email">
                                  <label for="email" class="center-align">Email</label>
                                </div>
                              </div>
                              <div class="row margin">
                                <div class="input-field col s12">
                                  <i class="mdi-action-lock-outline prefix"></i>
                                  <input id="newpassword" class="form-control" placeholder="New Password" name="pass" type="password" value="">
                                  <label for="newpassword">New Password</label>
                                </div>
                              </div>
                             <div class="row margin">
                                <div class="input-field col s12">
                                  <i class="mdi-action-lock-outline prefix"></i>
                                  <input id="cnfpassword" class="form-control" placeholder="Confirm Password" name="pass" type="password" value="">
                                  <label for="cnfpassword">Confirm Password</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" name="register" id="actionUpdateProfile">Update Profile</button>
                                </div>
                               <!--  <div class="input-field col s12">
                                  <p class="margin center medium-small sign-up">Already have an account? <a href="user-login.php">Login</a></p>
                                </div> -->
                              </div>
                            </form>
                         </div>
                    </div>
                    
          
        </div>
                        </div>  
                         <div class="modal-footer">
                            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                          </div>                                 
                    </div>
      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Field Technician</h5>
                <ol class="breadcrumbs">
                  <li><a href="Field-index.html">Dashboard</a>
                  </li>
                  <li class="active">Indent Form Details</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

          <!--start container-->
        <div class="container">
          
          <div id="jqueryvalidation" class="section">
            <div class="row">
              <div class="col s12 m12 l12">
                  <div class="col s12 m12 l6">
                        <div class="card-panel">
                          <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="indent-form.php">
                                  <div class="row">                                       
                                          <div class="col s12">
                                            <label for="crole">Product Details *</label>
                                            <?php 
                                              include("database/db_conection.php");

                                              $_SESSION['imagePath']='';

                                              $result=mysqli_query($dbcon,"select Product_Id,Product_Name from product_details");
                                               $option='';
                                               while($row = mysqli_fetch_array($result)){
                                                  $option.='<option value ="'.$row['Product_Id'].'">'.$row['Product_Name'].'</option>';
                                              }                              
                                                                    ?>
                                                                      <select class="error browser-default" id="plist1" name="plist" data-error=".errorTxt6" onchange="fetchImage(this.value);">
                                                                      <option value="0">Please Select</option>
                                                                      <?php echo $option;?>
                                                                  </select>
                                                                  <div>
                                                                 <?php
                                                                 if(isset($_POST['plist'])){
                                                                 $myinfo=$_POST['plist'];
                                                                 //echo "Selected".$myinfo;
                                                                 $_SESSION['selietm']=$myinfo;

                                                                // echo $_SESSION['selietm'];
                                                                }
                                                                 ?>
                                         </div>
                                            </div>

                                        <!--   <div class="input-field col s12">
                                                  <label for="units">No of Units *</label>
                                                  <input id="units" type="text" name="units" data-error=".errorTxt2">
                                                  <div class="errorTxt2"></div>
                                                </div>

                                        <div class="input-field col s12">
                                            <textarea id="comment" name="indentdes" class="materialize-textarea validate" data-error=".errorTxt7"></textarea>
                                            <label for="comment">Your comment *</label>
                                            <div class="errorTxt7"></div>
                                        </div>-->
                                         <div class="input-field col s12" hidden="true">
                                            <input id="tname" name="tname" class="materialize-textarea validate" data-error=".errorTxt7" value=<?php echo $_SESSION['Field_User'];?>>
                                            <label for="tname"></label>
                                            <div class="errorTxt7"></div>
                                        </div>
                                         <div class="input-field col s12">
                                            <textarea id="units" name="indentdes" class="materialize-textarea validate" data-error=".errorTxt7"></textarea>
                                            <label for="units">Measurements</label>
                                            <div class="errorTxt7"></div>
                                        </div>
                                         <div class="input-field col s12">
                                            <input id="camp" name="indentdes" type="text">
                                            <label for="camp">Camp Name (if any)</label>
                                            <div class="errorTxt7"></div>
                                        </div>
                                        <div class="input-field col s12">
                                          <input id="name" type="text" name="p_name">
                                          <label for="name">Name (Product Reciever Name)</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="age" type="number" name="p_age">
                                          <label for="age">Age</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="address" type="text" name="p_add">
                                          <label for="address">Address</label>
                                      </div>                       
                                    
                                      <!--   <div class="input-field col s12">
                                          <textarea id="reason" class="materialize-textarea" name="p_reason"></textarea>
                                          <label for="reason">Reason</label>
                                      </div> -->
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right submit" id="actionIndent">Submit
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>

                                    </div>
                                    </form>

                                  </div>
                        </div>
                  </div>

                  <div class="col s12 m12 l6">
                                 
                        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                          
                          <!-- <li class="active">
                            <div class="collapsible-header active"><i class="mdi-communication-email"></i> Need Help?</div>
                            <div class="collapsible-body" style="display: none;">
                              <p>We welcome your inquiries at the email address <a mailto="support@geekslabs.com">support@geekslabs.com</a>.We will get in touch with you soon.</p>
                              <p>As a creative studio we believe no client is too big nor too small to work with us to obtain good advantage.By combining the creativity of artists with the precision of engineers we develop custom solutions that achieve results. <a href="http://themeforest.net/user/geekslabs/portfolio" target="_blank">See our work.</a></p>
                            </div>
                          </li> -->
                          <li class="active">
                            <div class="collapsible-header active"><i class="mdi-editor-insert-emoticon"></i> Product Image</div>
                            <div class="collapsible-body">
                            <img id="p_image" align="middle" style="margin: 10px 0px 10px 250px;" /> 
                            </div>
                          </li>
                        </ul>
                      
                            </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- END CONTENT -->

     

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->

 <!-- START FOOTER -->
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span class="right"> Powered by <a class="grey-text text-lighten-4" href="http://prysm.com/">PRYSM</a></span>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->




    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--prism -->
    <script type="text/javascript" src="js/plugins/prism/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>
    
    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>

     <!-- google map api -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>

    <!--google map-->
    <script type="text/javascript" src="js/plugins/google-map/google-map-script.js"></script>


<script type="text/javascript">
function fetchImage(val)
{
 $.ajax({
 type: 'post',
 url: 'indent-selection.php',
 data: {
  get_image:val
 },
 success: function (response) {      
$('#p_image').attr('src',response);
 }
 });
}
</script>

<script type="text/javascript">

    $('#actionIndent').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
       indent_type:'Product',
      p_id:$("#plist1").val(),
      unit:$("#units").val(),
      comm:"",//$("#comment").val(),
      cmp:$("#camp").val(),
      pi_name:$("#name").val(),
      age:$("#age").val(),
      add:$("#address").val(),
      reason:"",//$("#reason").val()
      techName:$("#tname").val()
     },
     success: function (response) {      
      alert(response);
      location.reload();
      //$('#ides,#unit,#rdate,#pname,#age,#dis,#plist1').val('');
     }
     });
    });

</script>

 <script type="text/javascript">
function update_profile(utype)
{
 $.ajax({
 type: 'post',
 dataType: "json",
 url: 'user-profile.php',
 data: {
  userType:utype
 },
 success: function (response) {      

  document.getElementById("username").value=response[1]; 
  document.getElementById("email").value=response[2]; 
   document.getElementById("userid").value=response[0]; 
 }
 });
}
</script>

<script type="text/javascript">

    $('#actionUpdateProfile').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'user-profile.php',
     data: {
      uId:$("#userid").val(),
      uName:$("#username").val(),
      uEmail:$("#email").val(),
      uNewPass:$("#newpassword").val(),
      uCnfPass:$("#cnfpassword").val()
     },
     success: function (response) {      
      alert(response);
      location.reload();
     }
     });
    });

</script>

</body>

</html>

  <!-- <?php
    // include("database/db_conection.php");
  
    // if(isset($_POST['action']))
    // {
     
    // $var1=$_SESSION["selietm"];

    // $p_total=0;
    // $p_name=$_POST['p_name'];
    // $p_age=$_POST['p_age'];
    // $p_disease=$_POST['p_reason'];
    // $indent_des=$_POST['indentdes'];
    // $indent_units=$_POST['units'];
    //  $curr_date=date('Y/m/d');
    // $p_id=0;

    //   $result=mysqli_query($dbcon,"select Count(Patient_Id) as total from patient_details");
    //   while($row=mysqli_fetch_assoc($result))
    //   {
    //     $p_total=$row['total'];
    //   }                                          

    //   $sqlquery="insert into patient_details (Patient_Id, Patient_Name, Age, Disease) 
    //     values ($p_total+1,'$p_name',$p_age,'$p_disease')";

    //   $result1=mysqli_query($dbcon,$sqlquery);

    //   $result2= mysqli_query($dbcon,"select Patient_Id from patient_details where Patient_Name='$p_name'");
    //     while($row1 = mysqli_fetch_array($result2)){
    //       $p_id=$row1['Patient_Id'];
    //     }

    //     echo "<script>alert($p_id)</script>";

    //   $sqlquery1= "insert into indent_table (Description, Units, State, User_Type, Product_Id, Raised_Date, Patient_Id) 
    //     values ('$indent_des',$indent_units,'Raised','Field Technician','$var1','$curr_date',$p_id)";
    //   $result3=mysqli_query($dbcon,$sqlquery1);

    //   if($result3===true)
    //   {
    //     echo "<script>alert('New record created successfully')</script>";
    //   }
    //   else {
    //     echo "<script>alert('failed')</script>";
    //   }
    // }
    ?> -->