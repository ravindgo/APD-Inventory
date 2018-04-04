<?php
session_start();

    include("database/db_conection.php");
    if(!$_SESSION['user_type_Field'])
    {
        header("Location: user-login.php");//redirect to login page to secure the welcome page without login access.
    }
    $techName=$_SESSION['Field_User'];
    $result=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Raised' and TechName='$techName'");

    while($row=mysqli_fetch_assoc($result))
      {
        $_SESSION['raised_count'] =$row['total'];
      }  

    $resultFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalFab from prefab_indent_table WHERE State='Raised' and TechName='$techName'");

    while($rowFab=mysqli_fetch_assoc($resultFab))
      {
        $_SESSION['raised_count'] =$_SESSION['raised_count']+$rowFab['totalFab'];
      }  

    $resultApp=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Approved' and TechName='$techName'");

    while($rowApp=mysqli_fetch_assoc($resultApp))
      {
        $_SESSION['approved_count'] =$rowApp['total'];
      }  

    $resultAppFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalFab from prefab_indent_table WHERE State='Approved' and TechName='$techName'");

    while($rowAppFab=mysqli_fetch_assoc($resultAppFab))
      {
        $_SESSION['approved_count'] =$_SESSION['approved_count']+$rowAppFab['totalFab'];
      }  

    $resultRej=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Rejected' and TechName='$techName'");

    while($rowRej=mysqli_fetch_assoc($resultRej))
      {
        $_SESSION['rejected_count'] =$rowRej['total'];
      } 

    $resultRejFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalFab from prefab_indent_table WHERE State='Rejected' and TechName='$techName'");

    while($rowRejFab=mysqli_fetch_assoc($resultRejFab))
      {
        $_SESSION['rejected_count'] =$_SESSION['rejected_count']+$rowAppFab['rowRejFab'];
      }   

    $resultMonth=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE MONTH(Raised_Date)=MONTH(CURRENT_DATE()) and TechName='$techName'");

    while($rowMon=mysqli_fetch_assoc($resultMonth))
      {
        $_SESSION['month_count'] =$rowMon['total'];
      }  

     $resultMonFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalFab from prefab_indent_table WHERE MONTH(Raised_Date)=MONTH(CURRENT_DATE()) and TechName='$techName'");

    while($rowMonFab=mysqli_fetch_assoc($resultMonFab))
      {
        $_SESSION['month_count'] =$_SESSION['month_count']+$rowMonFab['totalFab'];
      }   

      mysqli_close($dbcon);
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
    <title>Field Technician - APD Inventroy Management System</title>

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
    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
     <style type="text/css">
      .pagination{
        background-color:#fff !important;
        padding: 5px;/*
        border: 1px solid #ccc;
        border-radius: 10px;*/
       }

       #productDetails{
        margin-bottom: 10px;
       }

       .pagination li{
        cursor: pointer;
        font-size: 1rem !important;
        padding: 0 5px !important;
       }

       .pgactive{
        color:#00bcd4 !important;
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
                    <!-- <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize"/>
                    </div> -->
                    <ul class="right hide-on-med-and-down">
                       <!--  <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown"><img src="images/flag-icons/United-States.png" alt="USA" /></a>
                        </li> -->
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">!</small></i>
                        
                        </a>
                        </li>                        
                        <!-- <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li> -->
                    </ul>
                    <!-- translation-button -->
                   <!--  <ul id="translation-dropdown" class="dropdown-content">
                      <li>
                        <a href="#!"><img src="images/flag-icons/United-States.png" alt="English" />  <span class="language-select">English</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images/flag-icons/France.png" alt="French" />  <span class="language-select">French</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images/flag-icons/China.png" alt="Chinese" />  <span class="language-select">Chinese</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images/flag-icons/Germany.png" alt="German" />  <span class="language-select">German</span></a>
                      </li>
                      
                    </ul> -->
                    <!-- notifications-dropdown -->
                    <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class1="new badge"></span></h5>
                      </li>
                      <li class="divider"></li>
                      <li>
                         <?php 
                        if($_SESSION['month_count']!==0)
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
                         <!--    <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
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
                <li class="bold active"><a href="Field-index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                </li>
               
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        
                        <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-social-pages"></i> Field Technician</a>
                            <div class="collapsible-body">
                                <ul>                                        
                                   
                                   <li><a href="indent-form.php">Product Indent Form</a>
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

                <!--start container-->
                <div class="container">

                    <!--card stats start-->
                    <div id="card-stats">
                        <div class="row">
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content  green white-text">
                                        <p class="card-stats-title"><i class="mdi-social-group-add"></i> Monthly Indents</p>
                                        <h4 class="card-stats-number"><?php echo $_SESSION['month_count'];?></h4>
                                        <!-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 15% <span class="green-text text-lighten-5">from yesterday</span>
                                        </p> -->
                                    </div>
                                   <!--  <div class="card-action  green darken-2">
                                        <div id="clients-bar" class="center-align"></div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content pink lighten-1 white-text">
                                        <p class="card-stats-title"><i class="mdi-editor-insert-drive-file"></i> Total Raised</p>
                                        <h4 class="card-stats-number"> <?php echo $_SESSION['raised_count'];?></h4>
                                       <!--  <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-down"></i> 3% <span class="deep-purple-text text-lighten-5">from last month</span>
                                        </p> -->
                                    </div>
                                   <!--  <div class="card-action  pink darken-2">
                                        <div id="invoice-line" class="center-align"></div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content blue-grey white-text">
                                        <p class="card-stats-title" ><i class="mdi-action-trending-up"></i> Total Approved</p>
                                        <h4 class="card-stats-number"><?php echo $_SESSION['approved_count'];?></h4>
                                        <!-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 80% <span class="blue-grey-text text-lighten-5">from yesterday</span>
                                        </p> -->
                                    </div>
                                    <!-- <div class="card-action blue-grey darken-2">
                                        <div id="profit-tristate" class="center-align"></div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content purple white-text">
                                        <p class="card-stats-title" ><i class="mdi-action-trending-up"></i> Total Rejected</p>
                                        <h4 class="card-stats-number"><?php echo $_SESSION['rejected_count'];?></h4>
                                       <!--  <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 70% <span class="purple-text text-lighten-5">last month</span>
                                        </p> -->
                                    </div>
                                   <!--  <div class="card-action purple darken-2">
                                        <div id="sales-compositebar" class="center-align"></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--card stats end-->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

             
                        

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

                     <!--Multicolor with icon tabs-->
         <!--  <div id="multi-color-tab" class="section">
             <div class="col s12 m12 l12">
                                <ul id="task-card" class="collection with-header">
                                    <li class="collection-header cyan">
                                        <h4 class="task-card-title" style="font-size: 1.5rem">Indent Information</h4>
                                       
                                    </li>
                                </ul> 
                            </div>

            </div> -->

        <div id="multi-color-tab" class="section">
          <!--   <h4 class="header">Stock Information</h4> -->
            <div class="row">
              <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <!--<ul class="tabs tab-demo-active z-depth-1">
                       <li class="tab col s3"><a class="white-text red darken-1 waves-effect waves-light" active href="#sapien1"><i class="mdi-notification-event-available"></i> Raw materials</a>
                      </li>
                      <li class="tab col s3"><a class="white-text purple darken-1 waves-effect waves-light " href="#activeone1"><i class="mdi-notification-event-available"></i> pre-fabricated</a>
                      </li>
                      <li class="tab col s3"><a class="white-text light-blue darken-1 waves-effect waves-light" href="#vestibulum1"><i class="mdi-notification-event-available"></i> products</a>
                      </li>


                    </ul> -->
                <!-- <form  class="login-form" id="queryid" role="form" method="post" action=""> -->
                    <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light modal-trigger" href="#modal1">Indent Details</a>
                      </li>
                      <li id="queryIndent" class="tab col s3"><a class="white-text waves-effect waves-light">Query Indent</a>
                        
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light modal-trigger" href="#modal2">Patient Details</a>
                      </li>
                    </ul>
                  </div> 
                </div>
              </div>


              <div class="col s12 m8 l12">
                <div class="row">
                <div class="col l4">&nbsp;</div>
                <div class="col l4" id="showRadio" style="margin-left: 60px; display: none;">
                     <form  class="login-form" id="queryid" role="form" method="post" action="">
                        <div class="row margin">
                                <div class="col s12 m12 l12">
                                 <div class="col s4 m4 l4">
                                    <p class="modal-trigger" href="#modal3">
                                      <input name="state" type="radio" id="rai" value="Raised"/>
                                      <label for="rai">Raised</label>
                                    </p>
                                  </div>
                                  <div class="col s5 m5 l5">
                                    <p class="modal-trigger" href="#modal4">
                                      <input name="state" type="radio" id="app" value="Approved"/>
                                      <label for="app">Approved</label>
                                    </p>
                                  </div>
                                  <div class="col s3 m3 l3">
                                    <p class="modal-trigger" href="#modal5">
                                      <input name="state" type="radio" id="rej" value="Rejected"/>
                                      <label for="rej">Rejected</label>
                                    </p>
                                  </div>
                                </div>

                              </div>
                            </form>
                  </div>
                  <div class="col l4">&nbsp;</div>
                </div>
            </div>


                <div id="modal3" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">

             <div id="preselecting-tab" class="section">
           
            <div class="row">
              
              <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#productRaised">Products</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#prefabRaised">Pre Fabricated Item</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">                  
                    <div id="productRaised" class="col s12  cyan lighten-4">

                    <div class="col s11 cyan lighten-4">
                      <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                      $fname=$_SESSION['Field_User'];

                      $limitRaised=10;

                      $pageRaised=1;
                     $start_fromRaised = ($pageRaised-1) * $limitRaised;  

                       $result5=mysqli_query($dbcon,"SELECT i.Description,i.Indent_Id, i.Units,i.Product_Id,i.Name,i.Raised_Date, i.Patient_Id,i.User_Type,i.TechName,i.Camp_Name,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.User_Type='$u_type' and i.State='Raised' and i.TechName='$fname' LIMIT $start_fromRaised,$limitRaised");
                       
                       if(mysqli_num_rows($result5) > 0){
                        $i=1;
                       while($row5 = mysqli_fetch_array($result5)){

                        $Pr_Name="";

                        if($row5['Product_Id']!==null){
                          $selPId=$row5['Product_Id'];
                          $resultPrName=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId'");
                          
                            while($rowPrName = mysqli_fetch_array($resultPrName)){
                              $Pr_Name=$rowPrName['Product_Name'];
                            }
                          
                        }

                        $prIndent[$i]=$row5['Indent_Id'];
                           // $des1[$i]=$row5['Description'];
                         $pid1[$i]=$Pr_Name;   
                         $unit1[$i]=$row5['Units'];      
                           $utype1[$i]=$row5['TechName']; 
                           $rdate1[$i]=$row5['Raised_Date']; 
                           $camp3[$i]=$row5['Camp_Name'];                                                 
                             $pname1[$i]=$row5['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='ftqiraisProducts' class='bordered'>";
                    echo"

                  <thead>
                    <tr>          
                    <th>Product Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th>      
                          <th>Camp Name</th>       
                        <th>Patient Name</th>
                       
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pid1);$i++)
                    {
                        echo 

                        "<tbody id='modal3Pr'><tr>
                        <td>$pid1[$i]</td>  
                        <td >$unit1[$i]</td>  
                      <td>$utype1[$i]</td>   
                      <td >$rdate1[$i]</td>
                      <td >$camp3[$i]</td>
                       <td>$pname1[$i]</td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     mysqli_close($dbcon);

                    }

                    else
                    {
                          echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                       <th>Product Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th> 
                         <th>Camp Name</th>          
                        <th>Patient Name</th>
                         
                    </tr>
                  </thead>";
                   echo"</table>";
                    }
                     ?>
                    </div>
                    <div class="col s1 cyan lighten-4">
                      <?php

                      if(mysqli_num_rows($result5) > 0){
                     echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                     
                          <th>Edit</th>
                    </tr>
                  </thead>";
                  for($i=1;$i<=count($pid1);$i++)
                    {
                        echo 

                        "<tbody><tr>
                    
                       <td name='modalEdit' id='$prIndent[$i]'><a class='modal-trigger' href='#editModal'>Edit</a></td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }
                   echo"</table>";
                 }
                 else
                 {
                   echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                       <th>Edit</th>
                         
                    </tr>
                  </thead>";
                   echo"</table>";
                 }
                    ?>
                    </div>


                     

                      <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Indent_Id) FROM indent_table WHERE State='Raised'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='techRaisedPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
<div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftqiraisProducts')">Download as excel</div>
                    </div>

                    </div>
 

                    <div id="prefabRaised" class="col s12  cyan lighten-4">

                    <div class="col s11 cyan lighten-4">
                      <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                      $fname=$_SESSION['Field_User'];

                       $limitRaisedFab=10;

                      $pageRaisedFab=1;
                     $start_fromRaisedFab = ($pageRaisedFab-1) * $limitRaisedFab;   

                       $resultPreRaised=mysqli_query($dbcon,"SELECT i.Description,i.Pre_Id, i.Units,i.Name,i.Raised_Date, i.Patient_Id,i.User_Type,i.TechName,i.Camp_Name,p.Patient_Name FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.User_Type='$u_type' and i.State='Raised' and i.TechName='$fname' LIMIT $start_fromRaisedFab,$limitRaisedFab");
                       
                       if(mysqli_num_rows($resultPreRaised) > 0){
                        $i=1;
                       while($rowPreRaised = mysqli_fetch_array($resultPreRaised)){
                       
                       $pfabId[$i]=$rowPreRaised['Pre_Id'];  
                         $pidPreRaised[$i]=$rowPreRaised['Name'];   
                         $unitPreRaised[$i]=$rowPreRaised['Units'];      
                           $utypePreRaised[$i]=$rowPreRaised['TechName']; 
                           $rdatePreRaised[$i]=$rowPreRaised['Raised_Date'];     
                            $camp4[$i]=$rowPreRaised['Camp_Name'];                                                
                             $pnamePreRaised[$i]=$rowPreRaised['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='ftqiraisPreFab' class='bordered'>";
                    echo"

                  <thead>
                    <tr>          
                    <th>Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th>    
                          <th>Camp Name</th>       
                        <th>Patient Name</th>
                        
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pidPreRaised);$i++)
                    {
                        echo 

                        "<tbody id='modal3Fab'><tr>
                        <td>$pidPreRaised[$i]</td>  
                        <td>$unitPreRaised[$i]</td>  
                      <td>$utypePreRaised[$i]</td>   
                      <td>$rdatePreRaised[$i]</td>
                       <td>$camp4[$i]</td>
                       <td>$pnamePreRaised[$i]</td>                     
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     mysqli_close($dbcon);

                    }

                    else
                    {
                          echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                       <th>Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th>    
                          <th>Camp Name</th>          
                        <th>Patient Name</th>
                    </tr>
                  </thead>";
                   echo"</table>";
                    }
                     ?>
                    </div>
                    <div class="col s1 cyan lighten-4">
                      

                      <?php
                      if(mysqli_num_rows($resultPreRaised) > 0){
                     echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                     
                          <th>Edit</th>
                    </tr>
                  </thead>";
                  for($i=1;$i<=count($pidPreRaised);$i++)
                    {
                        echo 

                        "<tbody><tr>
                    
                       <td name='modalEditPreFab' id='$pfabId[$i]'><a class='modal-trigger' href='#editModalPreFab'>Edit</a></td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }
                   echo"</table>";
                 }
                 else

                 {
                     echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                       <th>Edit</th>
                    </tr>
                  </thead>";
                   echo"</table>";
                 }
                    ?>
                    </div>

                       

                      <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Pre_Id) FROM prefab_indent_table WHERE State='Raised'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='techRaisedFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                     <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftqiraisPreFab')">Download as excel</div>
                   </div>

                    
                    </div>

                 
                   
                  </div>


                </div>
              </div>
            </div>
          </div>
                </div>        

                <div class="modal-footer">
                <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
              </div>                        
            </div>

                                            <div id="editModal" class="modal modal-fixed-footer">
                                <div class="modal-content left" style="color: black">
                                    <div class="col s12 m12 l8">
                                <div class="card-panel">
                                  <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="">
                                  <div class="row">     

                                            <div class="input-field col s12" hidden="true">
                                          <input id="indentPr" placeholder="Product Name" readonly type="text" name="prname">
                                          <label class="active" for="indentPr">Indent Id</label>
                                      </div>     
                                       <div class="input-field col s12" hidden="true">
                                          <input id="patientIdPr" placeholder="Product Name" readonly type="text" name="prname">
                                          <label class="active" for="patientIdPr">Patient Id</label>
                                      </div>                                                                 
                                      <!--   <div class="input-field col s12">
                                            <textarea rows="2" id="ides" placeholder="Indent Description" name="indentdes" readonly class="materialize-textarea" data-error=".errorTxt7"></textarea>
                                            <label class="active" for="ides">Indent Description</label>
                                        </div> -->
                                        <div class="input-field col s12">
                                          <input id="prname" placeholder="Product Name" readonly type="text" name="prname">
                                          <label class="active" for="pname">Product</label>
                                      </div>       
                                         <div class="input-field col s12">
                                          <textarea id="unitpr" class="materialize-textarea" placeholder="Measurements" name="unit"></textarea>
                                          <label class="active" for="unitpr">Measurements</label>
                                      </div>  
                                       <div class="input-field col s12">
                                            <input id="camp" name="indentdes" type="text" placeholder="Camp Name (if any)">
                                            <label for="camp">Camp Name (if any)</label>
                                            <div class="errorTxt7"></div>
                                        </div>
                                        <div class="input-field col s12">
                                          <input id="namepr" type="text" name="p_name" placeholder="Name (Product Reciever Name)">
                                          <label for="namepr">Name (Product Reciever Name)</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="agepr" type="number" name="p_age" placeholder="Age">
                                          <label for="agepr">Age</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="addresspr" type="text" name="p_add" placeholder="Address">
                                          <label for="addresspr">Address</label>
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
                         <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                      </div>                                     
                    </div>

                     <div id="editModalPreFab" class="modal modal-fixed-footer">
                                <div class="modal-content left" style="color: black">
                                    <div class="col s12 m12 l8">
                                <div class="card-panel">
                                  <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="">
                                  <div class="row">                                                                              
                                      <!--   <div class="input-field col s12">
                                            <textarea rows="2" id="ides" placeholder="Indent Description" name="indentdes" readonly class="materialize-textarea" data-error=".errorTxt7"></textarea>
                                            <label class="active" for="ides">Indent Description</label>
                                        </div> -->
                                        <div class="input-field col s12" hidden="true">
                                          <input id="indentfab" placeholder="Product Name" readonly type="text" name="prname">
                                          <label class="active" for="indentfab">Indent Id</label>
                                      </div>     
                                       <div class="input-field col s12" hidden="true">
                                          <input id="patientIdfab" placeholder="Product Name" readonly type="text" name="prname">
                                          <label class="active" for="patientIdfab">Patient Id</label>
                                      </div>          
                                        <div class="input-field col s12">
                                          <input id="namePrfab" placeholder="Pre Fabricated Entity" readonly type="text" name="fabname">
                                          <label class="active" for="namePrfab">Pre Fabricated Entity</label>
                                      </div>       
                                         <div class="input-field col s12">
                                          <textarea id="unitfab" class="materialize-textarea" placeholder="Measurements" name="unitfab"></textarea>
                                          <label class="active" for="unitfab">Measurements</label>
                                      </div>  
                                       <div class="input-field col s12">
                                            <input id="campfab" name="indentdes" type="text" placeholder="Camp Name (if any)">
                                            <label for="campfab">Camp Name (if any)</label>
                                            <div class="errorTxt7"></div>
                                        </div>
                                        <div class="input-field col s12">
                                          <input id="namePtfab" type="text" name="p_name" placeholder="Name (Product Reciever Name)">
                                          <label for="namePtfab">Name (Product Reciever Name)</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="agefab" type="number" name="p_age" placeholder="Age">
                                          <label for="agefab">Age</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="addressfab" type="text" name="p_add" placeholder="Address">
                                          <label for="addressfab">Address</label>
                                      </div>           
                                                                                           
                                    
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right submit" id="actionUpdatePre">Update
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                           
                                        </div>
                                         
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


                <div id="modal4" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">

                        <div id="preselecting-tab" class="section">
           
            <div class="row">
              
              <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#productApproved">Products</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#prefabApproved">Pre Fabricated Item</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">
                    <div id="productApproved" class="col s12  cyan lighten-4">

                    <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                       $fname=$_SESSION['Field_User'];

                       $limitApproved=10;

                      $pageApproved=1;
                        $start_fromApproved = ($pageApproved-1) * $limitApproved;  

                       $result6=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name, i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Approved' and i.TechName='$fname' LIMIT $start_fromApproved,$limitApproved");
                       
                       if(mysqli_num_rows($result6) > 0){
                        $i=1;
                       while($row6 = mysqli_fetch_array($result6)){

                        $Pr_NameApp="";

                        if($row6['Product_Id']!==null){
                          $selPId=$row6['Product_Id'];
                          $resultPrNameApp=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId'");
                          
                            while($rowPrNameApp = mysqli_fetch_array($resultPrNameApp)){
                              $Pr_NameApp=$rowPrNameApp['Product_Name'];
                            }
                          
                        }
                         $pid2[$i]=$Pr_NameApp;   
                         $unit2[$i]=$row6['Units'];    
                           $utype2[$i]=$row6['User_Type'];  
                           $rdate2[$i]=$row6['Raised_Date'];                      
                            $adate2[$i]=$row6['Approved_Date'];
                            $camp5[$i]=$row6['Camp_Name'];
                             $pname2[$i]=$row6['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='ftqiappProducts' class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                     <th>Product Name</th> 
                      <th>Measurements</th> 
                        <th>Approved By</th>    
                         <th>Raised Date</th>                    
                        <th>Approved Date</th>
                        <th>Camp Name</th>
                        <th>Patient Name</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pid2);$i++)
                    {
                        echo 

                        "<tbody id='modal4Pr'><tr>
                         <td>$pid2[$i]</td>
                          <td>$unit2[$i]</td>
                      <td>$utype2[$i]</td>   
                      <td>$rdate2[$i]</td>
                      <td>$adate2[$i]</td>
                        <td>$camp5[$i]</td>
                       <td>$pname2[$i]</td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     mysqli_close($dbcon);
                    }

                    else
                    {
                       echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                    <th>Product Name</th> 
                      <th>Measurements</th> 
                        <th>Approved By</th>    
                         <th>Raised Date</th>                    
                        <th>Approved Date</th>
                        <th>Camp Name</th>
                        <th>Patient Name</th>
                    </tr>
                  </thead>";
                  echo"</table>";
                    }
                
                   
                     ?>
                      <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Indent_Id) FROM indent_table WHERE State='Approved'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='techAppPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                     <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftqiappProducts')">Download as excel</div>
                  </div>
                    </div>
                    <div id="prefabApproved" class="col s12  cyan lighten-4">
                       <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                      $fname=$_SESSION['Field_User'];

                        $limitApprovedFab=10;

                      $pageApprovedFab=1;
                        $start_fromApprovedFab = ($pageApprovedFab-1) * $limitApprovedFab;  

                       $resultPreRaised=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Raised_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.User_Type='$u_type' and i.State='Approved' and i.TechName='$fname' LIMIT $start_fromApprovedFab,$limitApprovedFab");
                       
                       if(mysqli_num_rows($resultPreRaised) > 0){
                        $i=1;
                       while($rowPreRaised = mysqli_fetch_array($resultPreRaised)){
                       
                         $pidPreRaised[$i]=$rowPreRaised['Name'];   
                         $unitPreRaised[$i]=$rowPreRaised['Units'];      
                           $utypePreRaised[$i]=$rowPreRaised['User_Type']; 
                           $rdatePreRaised[$i]=$rowPreRaised['Raised_Date'];     
                           $adatePreRaised[$i]=$rowPreRaised['Approved_Date'];  
                           $camp6[$i]=$rowPreRaised['Approved_Date'];                                                   
                             $pnamePreRaised[$i]=$Camp_Name['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='ftqiappPreFab' class='bordered'>";
                    echo"

                  <thead>
                    <tr>          
                    <th>Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th>     
                          <th>Approved Date</th> 
                          <th>Camp Name</th>      
                        <th>Patient Name</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pidPreRaised);$i++)
                    {
                        echo 

                        "<tbody id='modal4Fab'><tr>
                        <td>$pidPreRaised[$i]</td>  
                        <td>$unitPreRaised[$i]</td>  
                      <td>$utypePreRaised[$i]</td>   
                      <td>$rdatePreRaised[$i]</td>
                      <td>$adatePreRaised[$i]</td>
                        <td>$camp6[$i]</td>
                       <td>$pnamePreRaised[$i]</td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     mysqli_close($dbcon);

                    }

                    else
                    {
                          echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                       <th>Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th>  
                          <th>Approved Date</th>  
                          <th>Camp Name</th>          
                        <th>Patient Name</th>
                    </tr>
                  </thead>";
                   echo"</table>";
                    }
                     ?>

                      <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Pre_Id) FROM prefab_indent_table WHERE State='Approved'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='techAppFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                     <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftqiappPreFab')">Download as excel</div>
                  </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
                            
                        </div>        
                        <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                      </div>                          
                    </div>

                <div id="modal5" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">
                            <div id="preselecting-tab" class="section">
           
            <div class="row">
              
              <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#productRejected">Products</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#prefabRejected">Pre Fabricated Item</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">
                    <div id="productRejected" class="col s12  cyan lighten-4">

                    <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                       $fname=$_SESSION['Field_User'];

                       $limitRejected=10;

                      $pageRejected=1;
                      $start_fromRejected = ($pageRejected-1) * $limitRejected;  

                       $result6=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name, i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Rejected' and i.TechName='$fname' LIMIT $start_fromRejected,$limitRejected");
                       
                       if(mysqli_num_rows($result6) > 0){
                        $i=1;
                       while($row6 = mysqli_fetch_array($result6)){

                        $Pr_NameApp="";

                        if($row6['Product_Id']!==null){
                          $selPId=$row6['Product_Id'];
                          $resultPrNameApp=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId'");
                          
                            while($rowPrNameApp = mysqli_fetch_array($resultPrNameApp)){
                              $Pr_NameApp=$rowPrNameApp['Product_Name'];
                            }
                          
                        }
                         $pid2[$i]=$Pr_NameApp;   
                         $unit2[$i]=$row6['Units'];    
                           $utype2[$i]=$row6['User_Type'];  
                           $rdate2[$i]=$row6['Raised_Date'];                      
                            $adate2[$i]=$row6['Approved_Date'];
                             $camp7[$i]=$row6['Camp_Name'];
                             $pname2[$i]=$row6['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='ftqirejProducts' class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                     <th>Product Name</th> 
                      <th>Measurements</th> 
                        <th>Approved By</th>    
                         <th>Raised Date</th>                    
                        <th>Rejected Date</th>
                         <th>Camp Name</th>      
                        <th>Patient Name</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pid2);$i++)
                    {
                        echo 

                        "<tbody id='modal5Pr'><tr>
                         <td>$pid2[$i]</td>
                          <td>$unit2[$i]</td>
                      <td>$utype2[$i]</td>   
                      <td>$rdate2[$i]</td>
                      <td>$adate2[$i]</td>
                       <td>$camp7[$i]</td>
                       <td>$pname2[$i]</td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     mysqli_close($dbcon);
                    }

                    else
                    {
                       echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                    <th>Product Name</th> 
                      <th>Measurements</th> 
                        <th>Approved By</th>    
                         <th>Raised Date</th>                    
                        <th>Rejected Date</th>
                         <th>Camp Name</th>      
                        <th>Patient Name</th>
                    </tr>
                  </thead>";
                  echo"</table>";
                    }
                
                   
                     ?>
                      <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Indent_Id) FROM indent_table WHERE State='Rejected'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='techRejectedPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                     <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftqirejProducts')">Download as excel</div>
                   </div>
                    </div>

                    <div id="prefabRejected" class="col s12  cyan lighten-4">
                       <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                      $fname=$_SESSION['Field_User'];

                      $limitRejectedFab=10;

                      $pageRejectdFab=1;
                        $start_fromRejectdFab = ($pageRejectdFab-1) * $limitRejectedFab;  

                       $resultPreRaised=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Raised_Date, i.Patient_Id,i.User_Type,I.Camp_Name,p.Patient_Name FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.User_Type='$u_type' and i.State='Rejected' and i.TechName='$fname' LIMIT $start_fromRejectdFab,$limitRejectedFab");
                       
                       if(mysqli_num_rows($resultPreRaised) > 0){
                        $i=1;
                       while($rowPreRaised = mysqli_fetch_array($resultPreRaised)){
                       
                         $pidPreRaised[$i]=$rowPreRaised['Name'];   
                         $unitPreRaised[$i]=$rowPreRaised['Units'];      
                           $utypePreRaised[$i]=$rowPreRaised['User_Type']; 
                           $rdatePreRaised[$i]=$rowPreRaised['Raised_Date'];     
                            $adatePreRaised[$i]=$rowPreRaised['Approved_Date'];  
                             $camp8[$i]=$rowPreRaised['Camp_Name'];                                                 
                             $pnamePreRaised[$i]=$rowPreRaised['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='ftqirejPreFab' class='bordered'>";
                    echo"

                  <thead>
                    <tr>          
                    <th>Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th>       
                          <th>Rejected Date</th>       
                           <th>Camp Name</th>       
                        <th>Patient Name</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pidPreRaised);$i++)
                    {
                        echo 

                        "<tbody id='modal5Fab'><tr>
                        <td>$pidPreRaised[$i]</td>  
                        <td>$unitPreRaised[$i]</td>  
                      <td>$utypePreRaised[$i]</td>   
                      <td>$rdatePreRaised[$i]</td>
                       <td>$adatePreRaised[$i]</td>
                       <td>$camp8[$i]</td>
                       <td>$pnamePreRaised[$i]</td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     mysqli_close($dbcon);

                    }

                    else
                    {
                          echo" <table class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                       <th>Name</th>  
                    <th>Measurements</th>              
                        <th>Raised By</th>     
                         <th>Raised Date</th>       
                          <th>Rejected Date</th>
                           <th>Camp Name</th>              
                        <th>Patient Name</th>
                    </tr>
                  </thead>";
                   echo"</table>";
                    }
                     ?>
                     <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Pre_Id) FROM prefab_indent_table WHERE State='Rejected'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='techRejectedFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                     <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftqirejPreFab')">Download as excel</div>
                   </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
                        </div>      
                        <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                      </div>                            
                    </div>
              
             <!--  </form> -->

                 
                 <!-- Indent details modal info -->

               <div id="modal1" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">

          <div id="preselecting-tab" class="section">
           
            <div class="row">
              
              <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#productDetails">Products</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#prefabDetails">Pre Fabricated Item</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">
                    <div id="productDetails" class="col s12  cyan lighten-4">
                  

                     <?php

                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                     $fname=$_SESSION['Field_User'];
                     $limit=10;

                      $page=1;
                        $start_from = ($page-1) * $limit;  

                      $result2=mysqli_query($dbcon,"SELECT i.Description, i.Units, i.State, i.Product_Id, i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i,
                        patient_details p WHERE i.Patient_Id=p.Patient_Id LIMIT $start_from,$limit");
                       if(mysqli_num_rows($result2) > 0){
                        $i=1;
                       while($row2 = mysqli_fetch_array($result2)){

                         $Pr_Name2="";

                        if($row2['Product_Id']!==null){
                          $selPId2=$row2['Product_Id'];
                          $resultPrName2=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId2'");
                          
                            while($rowPrName2 = mysqli_fetch_assoc($resultPrName2)){
                              $Pr_Name2=$rowPrName2['Product_Name'];
                            }
                          
                        }
                         $pid[$i]=$Pr_Name2;
                         $unit[$i]=$row2['Units'];
                         $state[$i]=$row2['State'];
                           $rdate[$i]=$row2['Raised_Date'];
                            $adate[$i]=$row2['Approved_Date'];
                            $camp1[$i]=$row2['Camp_Name'];
                             $pname[$i]=$row2['Patient_Name'];
                         $i++;
                        }

                        echo" <table id='ftid' class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                    <th data-field='id'>Product Name</th>
                    <th data-field='id'>Measurements</th>
                        <th data-field='price'>State</th>
                        <th data-field='name'>Raised Date</th>
                        <th data-field='price'>Approved Date</th>
                        <th data-field='price'>Camp Name</th>
                        <th data-field='price'>Patient Name</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pid);$i++)
                    {
                        echo 

                        "<tbody id='modal1Table'><tr>
                         <td>$pid[$i]</td>
                          <td>$unit[$i]</td>
                      <td>$state[$i]</td>
                      <td>$rdate[$i]</td>
                      <td>$adate[$i]</td>
                      <td>$camp1[$i]</td>
                       <td>$pname[$i]</td>
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                    mysqli_close($dbcon);
                    }
                    else
                    {
                       echo" <table class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                       <th data-field='id'>Product Name</th>
                    <th data-field='id'>Measurements</th>
                        <th data-field='price'>State</th>
                        <th data-field='name'>Raised Date</th>
                        <th data-field='price'>Approved Date</th>
                        <th data-field='price'>Camp Name</th>
                        <th data-field='price'>Patient Name</th>
                    </tr>
                  </thead>";
                  echo"</table>";
                    }
                    
                     ?>
                     <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Indent_Id) FROM indent_table";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='product' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                      <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftid')">Download as excel</div>
                    </div>
                     </div>
                     
                    <div id="prefabDetails" class="col s12  cyan lighten-4">
                      <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];
                     $fname=$_SESSION['Field_User'];

                      $limitPreFab=10;
                      $pagePreFab=1;
                      $start_fromPreFab = ($pagePreFab-1) * $limitPreFab;  

                      $resultPreFab=mysqli_query($dbcon,"SELECT i.Description, i.Units, i.State, i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM prefab_indent_table i,
                        patient_details p WHERE i.Patient_Id=p.Patient_Id LIMIT $start_fromPreFab,$limitPreFab");
                       if(mysqli_num_rows($resultPreFab) > 0){
                        $i=1;
                       while($rowFab = mysqli_fetch_array($resultPreFab)){
                 
                         $pidFab[$i]=$rowFab['Name'];
                         $unitFab[$i]=$rowFab['Units'];
                         $stateFab[$i]=$rowFab['State'];
                           $rdateFab[$i]=$rowFab['Raised_Date'];
                            $adateFab[$i]=$rowFab['Approved_Date'];
                            $camp2[$i]=$rowFab['Camp_Name'];
                             $pnameFab[$i]=$rowFab['Patient_Name'];
                         $i++;
                        }

                        echo" <table id='ftidPreFab' class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                    <th data-field='id'>Name</th>
                    <th data-field='id'>Measurements</th>
                        <th data-field='price'>State</th>
                        <th data-field='name'>Raised Date</th>
                        <th data-field='price'>Approved Date</th>
                        <th data-field='price'>Camp Name</th>
                        <th data-field='price'>Patient Name</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pidFab);$i++)
                    {
                        echo 

                        "<tbody id='modal1TablePreFab'><tr>
                         <td>$pidFab[$i]</td>
                          <td>$unitFab[$i]</td>
                      <td>$stateFab[$i]</td>
                      <td>$rdateFab[$i]</td>
                      <td>$adateFab[$i]</td>
                       <td>$camp2[$i]</td>
                       <td>$pnameFab[$i]</td>
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                    mysqli_close($dbcon);
                    }
                    else
                    {
                       echo" <table class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                       <th data-field='id'>Name</th>
                    <th data-field='id'>Measurements</th>
                        <th data-field='price'>State</th>
                        <th data-field='name'>Raised Date</th>
                        <th data-field='price'>Approved Date</th>
                        <th data-field='price'>Camp Name</th>
                        <th data-field='price'>Patient Name</th>
                    </tr>
                  </thead>";
                  echo"</table>";
                    }
                    
                     ?>
                      <?php  
                 include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Pre_Id) FROM prefab_indent_table";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='prefab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                     <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('ftidPreFab')">Download as excel</div>
                    </div>

                  </div>
                </div>
                
              </div>
            </div>
          </div>

                            
                        </div>  
                        <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                      </div>                                
                    </div>

                                     <!-- Product modal info -->

                     <div id="modal2" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">
                            <?php
                     include("database/db_conection.php");
                     $u_type=$_SESSION['user_type_Field'];

                      $result3=mysqli_query($dbcon,"SELECT * FROM patient_details ORDER BY Patient_Name asc");
                       
                       if(mysqli_num_rows($result3) > 0){
                        $i=1;
                       while($row3 = mysqli_fetch_array($result3)){
                         $pname[$i]=$row3['Patient_Name'];
                         $ptage[$i]=$row3['Age'];
                       
                         $i++;
                        }
                    
                    echo" <table id='ftpatientDetails' class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                        <th data-field='id'>Name</th>
                        <th data-field='name'>Age</th>
                        
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pname);$i++)
                    {
                        echo 

                        "<tbody><tr>
                      <td width='10%'>$pname[$i]</td>
                      <td width='10%'>$ptage[$i]</td>
                     
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     mysqli_close($dbcon);
                   }
                   else
                   {
                     echo" <table class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                        <th data-field='id'>Name</th>
                        <th data-field='name'>Age</th>
                        
                    </tr>
                  </thead>";

                    echo"</table>";
                   }
                     ?>
                        </div>         
                        <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                        <a href="#" onclick="downloadAsExcel('ftpatientDetails');" style="float: left;" class="waves-effect waves-red btn-flat">Download as excel</a>
                      </div>                         
                    </div>

                                     <!-- Pre fabricated modal info -->

                    <div id="modal6" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">
                            <?php
                     include("database/db_conection.php");

                      $resultPre=mysqli_query($dbcon,"select Name,Quantity,Amount from pre_fabricated_entity");
                       if(mysqli_num_rows($resultPre) > 0){
                        $i=1;
                       while($rowPre = mysqli_fetch_array($resultPre)){
                         $prname[$i]=$rowPre['Name'];
                         $prqua[$i]=$rowPre['Quantity'];
                         $pramt[$i]=$rowPre['Amount'];

                         $i++;
                        }
                    }
                    echo" <table class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                        <th data-field='prid'>Name</th>
                        <th data-field='prname'>Quantity</th>
                        <th data-field='prprice'>Rate</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($prname);$i++)
                    {
                        echo 

                        "<tbody><tr>
                      <td width='10%'>$prname[$i]</td>
                      <td width='10%'>$prqua[$i]</td>
                      <td width='10%'>$pramt[$i]</td>
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     ?>
                        </div>    
                         <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                      </div>                              
                    </div>

                  </div>
                
                </div>
              </div>
            </div>
          </div>

          </div>
                  
                </div>
                <!--end container-->
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
    <footer class="page-footer" style="margin-top: 400px">
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
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- table to excel -->
  <script type="text/javascript" src="js/plugins/jquery.table2excel.min.js"></script>  
    

    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   

    <!-- chartjs -->
    <script type="text/javascript" src="js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="js/plugins/chartjs/chart-script.js"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/plugins/sparkline/sparkline-script.js"></script>
    
    <!-- google map api -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>

    <!--jvectormap-->
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/vectormap-script.js"></script>
    
    <!--google map-->
    <!-- <script type="text/javascript" src="js/plugins/google-map/google-map-script.js"></script> -->

    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">

    $(document).ready(function(){
    $("#queryIndent").click(function(){
        $("#showRadio").toggle();
    });
});
        
      
    </script>

    <script type="text/javascript">

 function downloadAsExcel(tableid){    
       //e.preventDefault();
       var tableId="#"+tableid;
       var utc = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
         $(tableId).table2excel({
            exclude: ".noExl",
            name: "tableid",
            filename: tableid + "/" + utc
        });
    }


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


    $('td[name="modalEdit"]').click(function(){
      var prId=$(this).attr('id');

       $.ajax({
     type: 'post',
     dataType: "json",
     url: 'indent-selection.php',
     data: {
       prdIndentId:prId,
       indent_type:'product'
     },
     success: function (response) {      
    document.getElementById("prname").value=response[0]; 
  document.getElementById("unitpr").innerHTML=response[1]; 
   document.getElementById("camp").value=response[2]; 
    document.getElementById("namepr").value=response[3]; 
    document.getElementById("agepr").value=response[4]; 
    document.getElementById("addresspr").value=response[5]; 
    document.getElementById("patientIdPr").value=response[6]; 
     document.getElementById("indentPr").value=response[7]; 
     }
     });
    });

     $('#actionUpdate').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      prInId:$("#indentPr").val(),
       ptId:$("#patientIdPr").val(),
      prInUnit:$("#unitpr").val(),
      prInCamp:$("#camp").val(),
      prInName:$("#namepr").val(),
      prInAge:$("#agepr").val(),
      prInAddress:$("#addresspr").val(),
      indent_type:'product'
     },
     success: function (response) {      
      alert(response);
      location.reload();
      //$('#ides,#unit,#rdate,#pname,#age,#dis,#plist1').val('');
     }
     });
    });

      $('td[name="modalEditPreFab"]').click(function(){
      var preFabId=$(this).attr('id');

       $.ajax({
     type: 'post',
     dataType: "json",
     url: 'indent-selection.php',
     data: {
       prdIndentId:preFabId,
       indent_type:'prefabricated'
     },
     success: function (response) {      
    document.getElementById("namePrfab").value=response[0]; 
  document.getElementById("unitfab").innerHTML=response[1]; 
   document.getElementById("campfab").value=response[2]; 
    document.getElementById("namePtfab").value=response[3]; 
    document.getElementById("agefab").value=response[4]; 
    document.getElementById("addressfab").value=response[5]; 
    document.getElementById("patientIdfab").value=response[6]; 
     document.getElementById("indentfab").value=response[7]; 
     }
     });
    });

     $('#actionUpdatePre').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      prInId:$("#indentfab").val(),
       ptId:$("#patientIdfab").val(),
      prInUnit:$("#unitfab").val(),
      prInCamp:$("#campfab").val(),
      prInName:$("#namePtfab").val(),
      prInAge:$("#agefab").val(),
      prInAddress:$("#addressfab").val(),
       indent_type:'prefabricated'
     },
     success: function (response) {      
      alert(response);
      location.reload();
      //$('#ides,#unit,#rdate,#pname,#age,#dis,#plist1').val('');
     }
     });
    });

     $(".pagination li").click(function(){
      var pageNum = this.id;
      var ulId=$(this).parent().attr('id');
      var entity="";

     if(ulId==='product'){
      entity='productIndent';
     }
     if(ulId==='prefab'){
      entity='prefabricatedIndent';
     }

      if(ulId==='techRaisedPr'){
      entity='techRaisedPrIndent';
     }
     if(ulId==='techRaisedFab'){
      entity='techRaisedFabIndent';
     }
      if(ulId==='techAppPr'){
      entity='techAppPrIndent';
     }
      if(ulId==='techAppFab'){
      entity='techAppFabIndent';
     }
      if(ulId==='techRejectedPr'){
      entity='techRejectedPrIndent';
     }
      if(ulId==='techRejectedFab'){
      entity='techRejectedFabIndent';
     }


      $(".pagination li").removeClass('pgactive');
     $(this).addClass('pgactive');
       //$('#modal1').modal('show');

        $.ajax({
     type: 'post',
     dataType:'json',
     url: 'pagination.php',
     data: {
     fIndentPage:pageNum,
     indent_type:entity
     },
     success: function (response) {   

     if(entity==='productIndent') 
     {
       $('#modal1Table tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modal1Table').append(trHTML);
     }

     if(entity==='prefabricatedIndent') 
     {
       $('#modal1TablePreFab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modal1TablePreFab').append(trHTML);
     }

     if(entity==='techRaisedPrIndent') 
     {
       $('#modal3Pr tr').remove();  
       var trHTML = '';   
       
      for(res=1;res<=Object.keys(response).length;res++)
      {        
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      $("#editModalPr").addClass("modal-trigger");
      }
    
       $('#modal3Pr').append(trHTML);
     }

     if(entity==='techRaisedFabIndent') 
     {
       $('#modal3Fab tr').remove();  
       var trHTML = '';   

      for(res=1;res<=Object.keys(response).length;res++)
      {
         var fabId=response[res][5];
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modal3Fab').append(trHTML);
     }

     if(entity==='techAppPrIndent') 
     {
       $('#modal4Pr tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modal4Pr').append(trHTML);
     }

     if(entity==='techAppFabIndent') 
     {
       $('#modal4Fab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modal4Fab').append(trHTML);
     }

     if(entity==='techRejectedPrIndent') 
     {
       $('#modal5Pr tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modal5Pr').append(trHTML);
     }

     if(entity==='techRejectedFabIndent') 
     {
       $('#modal5Fab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modal5Fab').append(trHTML);
     }
    
  }
  });

  });

</script>
    
</body>
</html>
