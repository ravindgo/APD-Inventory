<?php
session_start();

  include("database/db_conection.php");
if(!$_SESSION['user_type_Store'])
    {
        header("Location: user-login.php");//redirect to login page to secure the welcome page without login access.
    }

      $resultFReq=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Raised' and User_Type='Field Technician'");

    while($rowFR=mysqli_fetch_assoc($resultFReq))
      {
        $_SESSION['field_request'] =$rowFR['total'];
      }
    $resultReqFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalFab from prefab_indent_table WHERE State='Raised' and User_Type='Field Technician'");

    while($rowFab=mysqli_fetch_assoc($resultReqFab))
      {
        $_SESSION['field_request'] =$_SESSION['field_request']+$rowFab['totalFab'];
      }  

       $resultRawCount=mysqli_query($dbcon,"select Count(R_Name) as total from raw_material_details where Quantity=0");
        while($rowRCount=mysqli_fetch_assoc($resultRawCount))
        {
          $_SESSION['rawMatCount'] =$rowRCount['total'];
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
  <title>Store Keeper Details Page</title>

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
                      <li><h4 class="task-card-title" style="padding: 0px 0px 0px 25px; color: white;">APD</h4></li>
                    </ul>
                   
                    <ul class="right hide-on-med-and-down">
                       
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">!</small></i>
                        
                        </a>
                        </li>                        
                     <!--    <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li> -->
                    </ul>
                   
                    <!-- notifications-dropdown -->
                    <<ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class1="new badge"></span></h5>
                      </li>
                      <li class="divider"></li>
                     <li>
                       
                        <?php 
                        if($_SESSION['field_request']!==0)
                        {
                          echo "<a href='#!''><i class='mdi-action-add-shopping-cart'></i>  ";
                          echo "Total ". $_SESSION['field_request']." Field Request(s), Please check.";
                          echo "</a>";                        
                        }

                         if($_SESSION['rawMatCount']!==0)
                        {
                          echo " <a href='#!''><i class='mdi-action-add-shopping-cart'></i>  ";
                          echo $_SESSION['rawMatCount']." Raw Material(s) is/are not in stock, Please check.";
                          echo " </a>";
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
                            <li><a class="modal-trigger" href="#modalProfile" onclick="update_profile('<?php echo $_SESSION['Store_User'];?>');"><i class="mdi-action-face-unlock"></i> Profile</a>
                            </li>
                           <!--  <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                            </li> -->
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                            </li>
                        </ul>
                        <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $_SESSION['Store_User']; ?><i style="margin-left: -10px;" class="mdi-navigation-arrow-drop-down right"></i></a>
                        <!-- <p class="user-roal">Store Keeper</p> -->
                    </div>
                </div>
                </li>
                <li class="bold"><a href="store-index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                </li>
                
                 <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        
                         <li class="bold"><a class="collapsible-header  waves-effect waves-cyan active"><i class="mdi-social-pages"></i> Store Keeper</a>
                            <div class="collapsible-body">
                                <ul>  
                                     <li class="active"><a href="new-raw-materials.php">Raw Materials Form</a></li>
                                    <li><a href="indent-approve-form.php">Product Indent Form</a></li>
                                    <li><a href="new-pre-fab.php">Pre-Fab Indent Form</a></li>
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
                <h5 class="breadcrumbs-title">Store Keeper</h5>
                <ol class="breadcrumbs">
                  <li><a href="store-index.html">Dashboard</a>
                  </li>
                   <li><a href="#">Store Keeper</a>
                  </li>
                  <li class="active">Raw Materials Form</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

           <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" id="tabRawUpdate">Update Raw Material Quantity</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" id="tabRawIndent">Raw Material Indent Form</a>
                      </li>
                    </ul>
                  </div>
                  
                </div>
              </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container" id="rawUpdate">
          
          <div id="jqueryvalidation" class="section">
            <div class="row">
              <div class="col s12 m12 l12">
                  <div class="col s12 m12 l6">
                        <div class="card-panel">
                            <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="">
                                    <div class="row">
                                        <div class="col s12">
                                            <label for="crole">Products *</label>

                                             <?php 
                                              include("database/db_conection.php");

                                              $result=mysqli_query($dbcon,"select R_Id,R_Name from raw_material_details");
                                               $option='';
                                               while($row = mysqli_fetch_array($result)){
                                                  $option.='<option value ="'.$row['R_Id'].'">'.$row['R_Name'].'</option>';
                                              }                              
                                              ?>

                                            <select class="error browser-default" id="prlist" name="prlistName" data-error=".errorTxt6" onchange="fetch_rawMaterial(this.value);">
                                               <option value="0">Please Select</option>
                                                <?php echo $option;?>
                                      </select>
                                      <div class="input-field">
                                          <div class="errorTxt6"></div>
                                      </div>
                                        </div>                                            
                                          <div>
                                            <?php
                                             if(isset($_POST['prlistName'])){
                                          
                                               $myinfo=$_POST['prlistName'];
                                               $_SESSION['selRId']=$myinfo;
                                             }
                                            ?>
                                          </div>

                                          <div class="input-field col s6">
                                            <label class="active" for="quan">Present Quantity</label>
                                            <input id="quan" type="text" readonly name="r_quan" placeholder="Present Quantity" data-error=".errorTxt2">
                                          </div>
                                          <div class="input-field col s6">
                                            <label class="active" for="u_quan">Updated Quantity</label>
                                            <input id="u_quan" type="text" name="r_quan" placeholder="Updated Quantity" data-error=".errorTxt2">
                                          </div>
                                          <div class="input-field col s6">
                                          <input id="amt" type="text" readonly name="r_amt" placeholder="Amount Per Unit">
                                          <label class="active" for="amt">Amount Per Unit</label>
                                        </div>     
                                        <div class="input-field col s6">
                                          <input id="u_amt" type="text" name="r_amt" placeholder="Updated Amount Per Unit">
                                          <label class="active" for="u_amt">Updated Amount Per Unit</label>
                                        </div> 
                                        <div class="input-field col s6">
                                          <input id="tamt" type="text" readonly name="r_tamt" placeholder="Total Amount">
                                          <label class="active" for="tamt">Total Amount</label>
                                        </div>     
                                        <div class="input-field col s6">
                                          <input id="u_tamt" type="text" name="r_tamt" readonly="readonly" placeholder="Updated Total Amount">
                                          <label class="active" for="u_tamt">Updated Total Amount</label>
                                        </div>     
                                  
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right submit" id="actionUpdate">Update
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
            </div>
          </div>
          
            
          </div>
     
        </div>
        <!--end container-->

         <div class="container" id="rawIndent" style="display: none">
          
          <div id="jqueryvalidation" class="section">
            <div class="row">
              <div class="col s12 m12 l12">
              <form class="formValidate" id="formValidate" method="post" action="">
                  <div class="col s12 m12 l6">
                        <div class="card-panel">
                          <div class="row">
                                
                                  <div class="row">                                       
                                          <div class="col s12">
                                            <label for="crole">Raw Materials *</label>
                                            <?php 
                                              include("database/db_conection.php");

                                              $result=mysqli_query($dbcon,"select R_Id,R_Name from raw_material_details");
                                               $option='';
                                              
                                               if(mysqli_num_rows($result) > 0){
                                                   $i=1;

                                                   while($row = mysqli_fetch_array($result)){
                                                  // $option.='<option value ="'.$row['R_Id'].'">'.$row['R_Name'].'</option>';
                                                
                                                   $tid[$i] = $row['R_Id'];
                                                   $tname[$i] = $row['R_Name'];

                                                   $i++;
                                                }  
                                              }
                                           echo" <table class='bordered' id='rawTable'>";
                                              echo"

                                              <thead>
                                                <tr>
                                                 <th>Name</th>  
                                                  <th>Select</th>  
                                                    <th>Quantity</th>     
                                                  
                                                </tr>
                                              </thead>";  

                                              for($i=1;$i<=count($tid);$i++)
                                              {
                                                  echo 

                                                  "<tbody><tr>
                                                 <td id='$tid[$i]' width='15%'>$tname[$i]</td>
                                                   <td width='10%'><input type='checkbox' value='$tid[$i]' class='filled-in' id='$tname[$i]' name='rmaterilas' /><label for='$tname[$i]'></label></td>
                                                 <td  width='10%'><input class='form-control' name='$tid[$i]' type='text'></td>                     
                                               
                                              </tr>                    
                                            </tbody>"; 
                                                  
                                              }

                                              echo"</table>";               
                                            ?>
                                                               <!--  <select class="error browser-default" id="rlist1" name="rlist[]" data-error=".errorTxt6" multiple="multiple" size=30 style='height: 100%;'>
                                                                      <?php echo $option;?>
                                                                  </select> -->

                                            </div>
                                            <div>
                                            
                                            </div>
                                                                 
                                                                                                      
                                      
                                    </div>
                                 
                                  </div>
                        </div>
                  </div>

                  <div class="col s12 m12 l6">
                      <div class="card-panel">
                          <div class="row">
                           <div class="input-field col s12" hidden="true">
                                           <input id="rid" class="form-control" name="rid" type="text">
                                        </div>
                                          <div class="input-field col s12" hidden="true">
                                           <input id="sname" class="form-control" name="sname" type="text" value=<?php echo $_SESSION['Store_User'];?>>
                                        </div>
                          <div class="input-field col s12">
                                            <textarea rows="2" id="rawDetails" name="indentdes" placeholder="Number of selected Raw Materials" readonly class="materialize-textarea" data-error=".errorTxt7"></textarea>
                                            <label class="active" for="rawDetails">Number of selected Raw Materials</label>
                                        </div>
                            <div class="input-field col s6">
                                             <button class="btn waves-effect waves-light left submit" type="submit" value="rsub" id="rawSubmit1" name="rawSubmit">Submit
                                              <i class="mdi-content-send right"></i>
                                            </button>
                              </div>
                          </div>
                        </div>
                  </div>

                <!--   <div class="col s12 m12 l6">
                                 
                        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header"><i class="mdi-communication-live-help"></i> FAQ</div>
                            <div class="collapsible-body" style="">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                          </li>
                          <li class="active">
                            <div class="collapsible-header active"><i class="mdi-communication-email"></i> Need Help?</div>
                            <div class="collapsible-body" style="display: none;">
                              <p>We welcome your inquiries at the email address <a mailto="support@geekslabs.com">support@geekslabs.com</a>.We will get in touch with you soon.</p>
                              <p>As a creative studio we believe no client is too big nor too small to work with us to obtain good advantage.By combining the creativity of artists with the precision of engineers we develop custom solutions that achieve results. <a href="http://themeforest.net/user/geekslabs/portfolio" target="_blank">See our work.</a></p>
                            </div>
                          </li>
                          <li>
                            <div class="collapsible-header"><i class="mdi-editor-insert-emoticon"></i> Testimonial</div>
                            <div class="collapsible-body" style="">
                              <blockquote>Fantastic product, my sites all run super fast and the support is excellent!<br>The website you designed helped a lot! </blockquote>
                            </div>
                          </li>
                        </ul>
                      
                            </div> -->
                            </form>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START RIGHT SIDEBAR NAV-->
      <aside id="right-sidebar-nav">
        <ul id="chat-out" class="side-nav rightside-navigation">
            <li class="li-hover">
            <a href="#" data-activates="chat-out" class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>
            <div id="right-search" class="row">
                <form class="col s12">
                    <div class="input-field">
                        <i class="mdi-action-search prefix"></i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Search</label>
                    </div>
                </form>
            </div>
            </li>
            <li class="li-hover">
                <ul class="chat-collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header teal white-text active"><i class="mdi-social-whatshot"></i>Recent Activity</div>
                    <div class="collapsible-body recent-activity">
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-add-shopping-cart"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">just now</a>
                                <p>Jim Doe Purchased new equipments for zonal office.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-device-airplanemode-on"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Yesterday</a>
                                <p>Your Next flight for USA will be on 15th August 2015.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-store"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Last Week</a>
                                <p>Jessy Jay open a new store at S.G Road.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header light-blue white-text active"><i class="mdi-editor-attach-money"></i>Sales Repoart</div>
                    <div class="collapsible-body sales-repoart">
                        <div class="sales-repoart-list  chat-out-list row">
                            <div class="col s8">Target Salse</div>
                            <div class="col s4"><span id="sales-line-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Payment Due</div>
                            <div class="col s4"><span id="sales-bar-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Delivery</div>
                            <div class="col s4"><span id="sales-line-2"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Progress</div>
                            <div class="col s4"><span id="sales-bar-2"></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header red white-text"><i class="mdi-action-stars"></i>Favorite Associates</div>
                    <div class="collapsible-body favorite-associates">
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Eileen Sideways</p>
                                <p class="place">Los Angeles, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Zaham Sindil</p>
                                <p class="place">San Francisco, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Renov Leongal</p>
                                <p class="place">Cebu City, Philippines</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Weno Carasbong</p>
                                <p>Tokyo, Japan</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Nusja Nawancali</p>
                                <p class="place">Bangkok, Thailand</p>
                            </div>
                        </div>
                    </div>
                </li>
                </ul>
            </li>
        </ul>
      </aside>
      <!-- LEFT RIGHT SIDEBAR NAV-->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

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
    
   <!--  <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            uname: {
                required: true,
                minlength: 5
            },
            cemail: {
                required: true,
                email:true
            },
            password: {
        required: true,
        minlength: 5
      },
      cpassword: {
        required: true,
        minlength: 5,
        equalTo: "#password"
      },
      curl: {
                required: true,
                url:true
            },
            crole:"required",
            ccomment: {
        required: true,
        minlength: 15
            },
            cgender:"required",
      cagree:"required",
        },
        //For custom messages
        messages: {
            uname:{
                required: "Enter a username",
                minlength: "Enter at least 5 characters"
            },
            curl: "Enter your website",
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
    </script> -->

<script type="text/javascript">
function fetch_rawMaterial(val)
{
 $.ajax({
 type: 'post',
 dataType: "json",
 url: 'raw-material-list.php',
 data: {
  get_option1:val
 },
 success: function (response) {     
 $.each(response, function(key, value) {
    //For example
    for(i=0;i<value.length;i++){
      document.getElementById("quan").value=value[0]; 
      document.getElementById("amt").value=value[1]; 
      document.getElementById("tamt").value=value[2]; 
    }
})
 }
 });
}
</script>

<script type="text/javascript">

    $("#u_amt").blur(function(){
    var total_amt=$("#u_quan").val()*$("#u_amt").val();
    document.getElementById("u_tamt").value=total_amt; 
  });  

    $('#actionUpdate').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      r_id:$("#prlist").val(),
      up_quan:$("#u_quan").val(),
      up_amt:$("#u_amt").val(),
       pr_quan:$("#quan").val(),
      pr_amt:$("#amt").val()
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

<script type="text/javascript">
$('#tabRawUpdate').click(function() {
  $('#rawUpdate').show();
  $('#rawIndent').hide();
});

$('#tabRawIndent').click(function() {
   $('#rawUpdate').hide();
  $('#rawIndent').show();
  
});

// $('#rlist1').change(function(){
//   var count=$('#rlist1 option:selected').length;
//  
// });

$('input[name="rmaterilas"]').change(function(){
	var count=$('input[name="rmaterilas"]').filter(':checked').length;
	 document.getElementById("rawDetails").innerHTML="You have selected "+count+" Raw Material(s)"; 
});

$('#rawSubmit1').click(function(e){
 var rIdString="";
 var rValueString="";

 var rawDict=[];

    $('input[name="rmaterilas"]:checked').each(function() {
      var inputId=$('input[name='+this.value+']');
     var quan= $(inputId).val();
     rawDict.push({
      key:   this.value,
      value: quan
     });
   });

     $.each(rawDict , function(i, val) { 
      rIdString=rIdString+val.key+",";
      rValueString=rValueString+val.value+",";
    });

 //insert the data into db
 e.preventDefault();

var rtext=$("#rawDetails").val();
var number = rtext.match(/\d+/)

  $.ajax({
     type: 'post',
     url: 'raw-material-list.php',
     data: {
      rawIdArray:rIdString,
      rawUnitArray:rValueString,
      sName:$("#sname").val(),
      des:number[0]
     },
     success: function (response) {      
      alert(response);
      location.reload();
     }
     });
});



</script>

</body>


<!-- Mirrored from demo.geekslabs.com/materialize/v3.1/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2017 07:38:58 GMT -->
</html>

  
<!-- <?php
    // include("database/db_conection.php");
  
    // if(isset($_POST['actionUpdate']))
    // {
     
    // $raw_quan=$_POST['r_quan'];
    // $raw_amt=$_POST['r_amt'];
    // $raw_id=$_SESSION['selRId'];

    // //echo "<script>alert($raw_id)</script>";

    //   $sqlquery1= "Update raw_material_details set Quantity=$raw_quan, Amount=$raw_amt where R_Id=$raw_id";
    //   $result3=mysqli_query($dbcon,$sqlquery1);

    //   if($result3===true)
    //   {
    //     echo "<script>alert('Record Updated')</script>";
    //   }
    //   else {
    //     echo "<script>alert('failed')</script>";
    //   }
    // }
    ?> -->