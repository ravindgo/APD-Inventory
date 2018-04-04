<?php
session_start();

    include("database/db_conection.php");
    if(!$_SESSION['user_type_Store'])
    {
        header("Location: user-login.php");//redirect to login page to secure the welcome page without login access.
    }
      $techName=$_SESSION['Store_User'];
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

   $resultApp=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Approved'");

    while($rowApp=mysqli_fetch_assoc($resultApp))
      {
        $_SESSION['app_count'] =$rowApp['total'];
      }  
    $resultAppFab=mysqli_query($dbcon,"select Count(Pre_Id) as total from prefab_indent_table WHERE State='Approved'");

    while($rowAppFab=mysqli_fetch_assoc($resultAppFab))
      {
        $_SESSION['app_count'] =$_SESSION['app_count']+$rowAppFab['total'];
      }  

   $resultRej=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Rejected'");

    while($rowRjej=mysqli_fetch_assoc($resultRej))
      {
        $_SESSION['rej_count'] =$rowRjej['total'];
      } 

     $resultRejFab=mysqli_query($dbcon,"select Count(Pre_Id) as total from prefab_indent_table WHERE State='Rejected'");

    while($rowRjejFab=mysqli_fetch_assoc($resultRejFab))
      {
        $_SESSION['rej_count'] =$_SESSION['rej_count']+$rowRjejFab['total'];
      }  

     $resultRawM=mysqli_query($dbcon,"select Count(R_Indent_Id) as total from raw_indent_table");

    while($rowRM=mysqli_fetch_assoc($resultRawM))
      {
        $_SESSION['r_count'] =$rowRM['total'];
      }  

      
       $resultRawCount=mysqli_query($dbcon,"select Count(R_Name) as total from raw_material_details where Quantity=0");
        while($rowRCount=mysqli_fetch_assoc($resultRawCount))
        {
          $_SESSION['rawMatCount'] =$rowRCount['total'];
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
    <title>Store Keeper - APD Inventroy Management System</title>

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
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 10px;
        text-align: left !important;
       }

       /*#productDetails{
        margin-bottom: 10px;
       }*/

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
                    <ul id="notifications-dropdown" class="dropdown-content">
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
                <li class="bold active"><a href="store-index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                </li>
               
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        
                         <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-social-pages"></i> Store Keeper</a>
                            <div class="collapsible-body">
                                <ul>                                     
                                   <!--  <li><a href="new-product.html">Products Form</a></li> -->
                                    <li><a href="new-raw-materials.php">Raw Materials Form</a></li>
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

                <!--start container-->
                <div class="container">

                    <!--card stats start-->
                    <div id="card-stats">
                        <div class="row">
                            <div class="col s12 m6 l3">
                               
                               <div class="card">
                                    <div class="card-content  green white-text">
                                    <a class="modal-trigger" href="#modal1"> 
                                        <p class="card-stats-title"> <span style="color: white;"><i class="mdi-social-group-add"></i>Field Requests</span></p>                                        
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['field_request'];?></h4></a>
                                        <div id="modal1" class="modal modal-fixed-footer">
                                            <div class="modal-content left" style="color: black">
                                                <!-- <p>Field Request content</p> -->

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
                
                     $limitFieldReq=10;

                      $pageFieldReq=1;
                     $start_fromFieldReq = ($pageFieldReq-1) * $limitFieldReq;  
                       $result1=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name,i.Raised_Date, i.Patient_Id,i.User_Type,i.Camp_Name,i.TechName,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.User_Type='Field Technician' and i.State='Raised' LIMIT $start_fromFieldReq,$limitFieldReq");
                       
                       if(mysqli_num_rows($result1) > 0){
                        $i=1;
                       while($row1 = mysqli_fetch_array($result1)){

                        $Pr_Name1="";

                        if($row1['Product_Id']!==null){
                          $selPId1=$row1['Product_Id'];
                          $resultPrName1=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId1'");
                          
                            while($rowPrName1 = mysqli_fetch_assoc($resultPrName1)){
                              $Pr_Name1=$rowPrName1['Product_Name'];
                            }
                          
                        }
                         
                          $pid1[$i]=$Pr_Name1;  
                          $unit1[$i]=$row1['Units'];   
                         $utype1[$i]=$row1['TechName'];     
                           $rdate1[$i]=$row1['Raised_Date'];   
                           $camp1[$i]=$row1['Camp_Name'];                                              
                             $pname1[$i]=$row1['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='skfrProducts' class='bordered'>";
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

                        "<tbody id='modalFReqPr'><tr>
                       <td>$pid1[$i]</td>
                         <td>$unit1[$i]</td>
                       <td>$utype1[$i]</td>                     
                      <td>$rdate1[$i]</td>
                     <td>$camp1[$i]</td>
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
                     <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Indent_Id),User_Type FROM indent_table WHERE User_Type='Field Technician' and State='Raised'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='fReqPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                     <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('skfrProducts')">Download as excel</div>
                    </div>
                    
                    </div>
                    <div id="prefabDetails" class="col s12  cyan lighten-4">
                      
                      <?php
                     include("database/db_conection.php");
                
                     $limitFReqFab=10;

                      $pageFReqFab=1;
                     $start_fromFReqFab = ($pageFReqFab-1) * $limitFReqFab;
                       $resultPreRaised=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Raised_Date, i.Patient_Id,i.User_Type,i.Camp_Name,i.TechName,p.Patient_Name FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.User_Type='Field Technician' and i.State='Raised' LIMIT $start_fromFReqFab,$limitFReqFab");
                       
                       if(mysqli_num_rows($resultPreRaised) > 0){
                        $i=1;
                       while($rowPreRaised = mysqli_fetch_array($resultPreRaised)){

                          $pidPreRaised[$i]=$rowPreRaised['Name'];   
                          $unitPreRaised[$i]=$rowPreRaised['Units'];   
                         $utypePreRaised[$i]=$rowPreRaised['TechName'];     
                           $rdatePreRaised[$i]=$rowPreRaised['Raised_Date'];   
                           $campPreRaised[$i]=$rowPreRaised['Camp_Name'];                                              
                             $pnamePreRaised[$i]=$rowPreRaised['Patient_Name'];
                
                         $i++;
                        }
                         echo" <table id='skfrPreFab' class='bordered'>";
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

                        "<tbody id='modalFReqFab'><tr>
                       <td>$pidPreRaised[$i]</td>
                         <td>$unitPreRaised[$i]</td>
                       <td>$utypePreRaised[$i]</td>                     
                      <td>$rdatePreRaised[$i]</td>
                     <td>$campPreRaised[$i]</td>
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
                      <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(Pre_Id),User_Type FROM prefab_indent_table WHERE User_Type='Field Technician' and State='Raised'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='fReqFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                      <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('skfrPreFab')">Download as excel</div>
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
                  </div>
                  
              </div>
          </div>
                            <!-- <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content pink lighten-1 white-text">
                                       <a class="modal-trigger" href="#modal2"> <p class="card-stats-title"><span style="color: white;"><i class="mdi-editor-insert-drive-file"></i> Pending Approvals</span></p></a>
                                        <h4 class="card-stats-number">1806</h4>
                                      <div id="modal2" class="modal">
                                            <div class="modal-content left" style="color: black">
                                                <p>Pending Approvals content</p>
                                            </div>                                
                                        </div>
                                    </div> 
                                </div>
                            </div> -->
                            <div class="col s12 m6 l3">
                               <div class="card">
                                    <div class="card-content blue-grey white-text">
                                    <a class="modal-trigger" href="#modal3"> 
                                        <p class="card-stats-title" ><span style="color: white;"><i class="mdi-action-trending-up"></i> Total Approved</span></p>
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['app_count'];?></h4></a>
                                        <div id="modal3" class="modal">
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
                
                $u_type=$_SESSION['user_type_Store'];
                $limitFAppPr=10;

                      $pageFAppPr=1;
                     $start_fromFAppPr = ($pageFAppPr-1) * $limitFAppPr;  
                       $result2=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name,i.Raised_Date,i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Approved' LIMIT $start_fromFAppPr,$limitFAppPr");
                       
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
                          $pid2[$i]=$Pr_Name2;   
                         $unit2[$i]=$row2['Units'];   
                         $utype2[$i]=$row2['User_Type']; 
                         $rdate2[$i]=$row2['Raised_Date'];   
                           $adate2[$i]=$row2['Approved_Date'];   
                           $camp2[$i]=$row2['Camp_Name'];                                             
                             $pname2[$i]=$row2['Patient_Name'];
                
                         $i++;
                        }
                        echo" <table id='sktaProducts' class='bordered'>";
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

                        "<tbody id='modalFAppPr'><tr>
                    <td>$pid2[$i]</td>
                     <td>$unit2[$i]</td>
                      <td>$utype2[$i]</td>  
                        <td>$rdate2[$i]</td>
                      <td>$adate2[$i]</td>
                      <td>$camp2[$i]</td>
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
                        $pagLink = "<ul id='fAppPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                      <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('sktaProducts')">Download as excel</div>
                    </div>
                    
                    </div>
                    <div id="prefabApproved" class="col s12  cyan lighten-4">

                     <?php
                     include("database/db_conection.php");
                
                $u_type=$_SESSION['user_type_Store'];
                $limitFAppFab=10;

                      $pageFAppFab=1;
                     $start_fromFAppFab = ($pageFAppFab-1) * $limitFAppFab;  
                       $resultApproved=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Raised_Date,i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Approved' LIMIT $start_fromFAppFab,$limitFAppFab");
                       
                       if(mysqli_num_rows($resultApproved) > 0){
                        $i=1;
                       while($rowApproved = mysqli_fetch_array($resultApproved)){

                          $pidApproved[$i]=$rowApproved['Name'];  
                         $unitApproved[$i]=$rowApproved['Units'];   
                         $utypeApproved[$i]=$rowApproved['User_Type']; 
                         $rdateApproved[$i]=$rowApproved['Raised_Date'];   
                           $adateApproved[$i]=$rowApproved['Approved_Date'];   
                           $campApproved[$i]=$rowApproved['Camp_Name'];                                             
                             $pnameApproved[$i]=$rowApproved['Patient_Name'];
                
                         $i++;
                        }
                        echo" <table id='sktaPreFab' class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                      <th>Name</th> 
                        <th>Measurements</th> 
                        <th>Approved By</th>    
                          <th>Raised Date</th>  
                         <th>Approved Date</th>  
                         <th>Camp Name</th>                                         
                        <th>Patient Name</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pidApproved);$i++)
                    {
                        echo 

                        "<tbody id='modalFAppFab'><tr>
                    <td>$pidApproved[$i]</td>
                     <td>$unitApproved[$i]</td>
                      <td>$utypeApproved[$i]</td>  
                        <td>$rdateApproved[$i]</td>
                      <td>$adateApproved[$i]</td>
                      <td>$campApproved[$i]</td>
                       <td>$pnameApproved[$i]</td>
                     
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
                        $sql = "SELECT COUNT(Pre_Id) FROM prefab_indent_table WHERE State='Approved'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='fAppFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                      <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('sktaPreFab')">Download as excel</div>
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
                                    </div> 
                                </div>
                            </div>


                            <div class="col s12 m6 l3">
                               <div class="card">
                                    <div class="card-content purple white-text">
                                     <a class="modal-trigger" href="#modal4">
                                        <p class="card-stats-title" ><span style="color: white;"><i class="mdi-action-trending-up"></i> Total Rejected</span></p>
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['rej_count'];?></h4></a>
                                       <div id="modal4" class="modal">
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
                                      $u_type=$_SESSION['user_type_Store'];
                                      $limitFRejPr=10;

                                        $pageFRejPr=1;
                                       $start_fromFRejPr = ($pageFRejPr-1) * $limitFRejPr;
                                             $result3=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name,i.Patient_Id,i.User_Type,i.Camp_Name,i.Raised_Date,i.Approved_Date,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Rejected' LIMIT $start_fromFRejPr,$limitFRejPr");
                                             
                                             if(mysqli_num_rows($result3) > 0){
                                              $i=1;
                                             while($row3 = mysqli_fetch_array($result3)){

                                              $Pr_Name="";

                                              if($row3['Product_Id']!==null){
                                                $selPId=$row3['Product_Id'];
                                                $resultPrName=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId'");
                                                
                                                  while($rowPrName = mysqli_fetch_array($resultPrName)){
                                                    $Pr_Name=$rowPrName['Product_Name'];
                                                  }
                                                
                                              }
                                              $pid3[$i]=$Pr_Name;
                                               $unit3[$i]=$row3['Units'];  
                                                $utype3[$i]=$row3['User_Type'];  
                                                 $rdate3[$i]=$row3['Raised_Date'];     
                                                $adate3[$i]=$row3['Approved_Date'];   
                                                $camp3[$i]=$row3['Camp_Name'];                                                       
                                                   $pname3[$i]=$row3['Patient_Name'];
                                      
                                               $i++;
                                              }
                                              echo" <table id='sktrProducts' class='bordered'>";
                                          echo"

                                        <thead>
                                          <tr>
                                             <th>Product Name</th>  
                                              <th>Measurements</th>  
                                              <th>Rejecetd By</th>     
                                               <th>Raised Date</th>   
                                               <th>Rejected Date</th>    
                                               <th>Camp Name</th>                                  
                                              <th>Patient Name</th>
                                          </tr>
                                        </thead>";

                                          for($i=1;$i<=count($pid3);$i++)
                                          {
                                              echo 

                                              "<tbody id='modalFRejPr'><tr>
                                              <td>$pid3[$i]</td>
                                               <td>$unit3[$i]</td>
                                            <td>$utype3[$i]</td>   
                                             <td>$rdate3[$i]</td>
                                              <td>$adate3[$i]</td>
                                              <td>$camp3[$i]</td>
                                             <td>$pname3[$i]</td>
                                           
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
                                              <th>Rejecetd By</th>     
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
                                              $pagLink = "<ul id='fRejPr' class='pagination'>";  
                                              for ($i=1; $i<=$total_pages; $i++) {  
                                                           $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                                              };  
                                              echo $pagLink . "</ul>";  
                                               mysqli_close($dbcon);
                                           ?> 
                                            <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('sktrProducts')">Download as excel</div>
                                          </div>

                                            </div>
                                            <div id="prefabRejected" class="col s12  cyan lighten-4">
                                              
                                                <?php
                                           include("database/db_conection.php");
                                      $u_type=$_SESSION['user_type_Store'];
                                      $limitFRejFab=10;

                                    $pageFRejFab=1;
                                   $start_fromFRejFab = ($pageFRejFab-1) * $limitFRejFab;  

                                             $resultRejected=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Patient_Id,i.User_Type,i.Camp_Name,i.Raised_Date,i.Approved_Date,p.Patient_Name FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Rejected' LIMIT $start_fromFRejFab,$limitFRejFab");
                                             
                                             if(mysqli_num_rows($resultRejected) > 0){
                                              $i=1;
                                             while($rowRejected = mysqli_fetch_array($resultRejected)){

                                              $pidRejected[$i]=$rowRejected['Name'];  
                                               $unitRejected[$i]=$rowRejected['Units'];  
                                                $utypeRejected[$i]=$rowRejected['User_Type'];  
                                                 $rdateRejected[$i]=$rowRejected['Raised_Date'];     
                                                $adateRejected[$i]=$rowRejected['Approved_Date'];   
                                                $campRejected[$i]=$rowRejected['Camp_Name'];                                                       
                                                   $pnameRejected[$i]=$rowRejected['Patient_Name'];
                                      
                                               $i++;
                                              }
                                              echo" <table id='sktrPreFab' class='bordered'>";
                                          echo"

                                        <thead>
                                          <tr>
                                             <th>Name</th>  
                                              <th>Measurements</th>  
                                              <th>Rejecetd By</th>     
                                               <th>Raised Date</th>   
                                               <th>Rejected Date</th>    
                                               <th>Camp Name</th>                                  
                                              <th>Patient Name</th>
                                          </tr>
                                        </thead>";

                                          for($i=1;$i<=count($pidRejected);$i++)
                                          {
                                              echo 

                                              "<tbody id='modalFRejFab'><tr>
                                              <td>$pidRejected[$i]</td>
                                               <td>$unitRejected[$i]</td>
                                            <td>$utypeRejected[$i]</td>   
                                             <td>$rdateRejected[$i]</td>
                                              <td>$adateRejected[$i]</td>
                                              <td>$campRejected[$i]</td>
                                             <td>$pnameRejected[$i]</td>
                                           
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
                                              <th>Rejecetd By</th>     
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
                                            $pagLink = "<ul id='fRejFab' class='pagination'>";  
                                            for ($i=1; $i<=$total_pages; $i++) {  
                                                         $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                                            };  
                                            echo $pagLink . "</ul>";  
                                             mysqli_close($dbcon);
                                         ?> 
                                          <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('sktrPreFab')">Download as excel</div>
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
                                    </div> 
                                </div>
                            </div>

                            <div class="col s12 m6 l3">
                               
                               <div class="card">
                                    <div class="card-content  green white-text">
                                    <a class="modal-trigger" href="#modalRaw"> 
                                        <p class="card-stats-title"> <span style="color: white;"><i class="mdi-action-trending-up"></i>Raw Material Indent Details</span></p>                                        
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['r_count'];?></h4></a>
                                        <div id="modalRaw" class="modal modal-fixed-footer">
                                            <div class="modal-content left" style="color: black">
                                            <div class="col s12  cyan lighten-4">
                                                <!-- <p>Field Request content</p> -->
                                                <div class="col s3 cyan lighten-4">

                                                   <?php
                                                         include("database/db_conection.php");

                                                         $limitRaw=10;

                                                      $pageRaw=1;
                                                     $start_fromRaw = ($pageRaw-1) * $limitRaw;
                                                    
                                                           $resultRaw=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Description,i.Raised_Date,i.State,i.Approved_Date,i.User_Type 
                                                            FROM raw_indent_table i LIMIT $start_fromRaw,$limitRaw");
                                                           
                                                           if(mysqli_num_rows($resultRaw) > 0){
                                                            $i=1;
                                                           while($rowRaw = mysqli_fetch_array($resultRaw)){

                                                             $desR[$i]=$rowRaw['Description']; 
                                                             $rIndId[$i]=$rowRaw['R_Indent_Id']  ;
                                                              $userR[$i]=$rowRaw['User_Type'];   
                                                               $stateR[$i]=$rowRaw['State'];   
                                                               $rdateR[$i]=$rowRaw['Raised_Date'];   
                                                                $adateR[$i]=$rowRaw['Approved_Date'];   
                                                    
                                                             $i++;
                                                            }

                                                             echo" <table id='skrmid' class='bordered'>";
                                                        echo"

                                                      <thead>
                                                        <tr>
                                                            <th>Raw Material(s)</th>
                                                          
                                                        </tr>
                                                      </thead>";

                                                        for($i=1;$i<=count($userR);$i++)
                                                        {
                                                          $tnameId="n".$i;
                                                          $rawMatId="r".$rIndId[$i];
                                                            echo 

                                                            "<tbody>

                                                            <tr name='rnameShow' id='$rawMatId'>
                                                          <td  width='10%'> <a href='#'>Raised for $desR[$i] items</a></td>                                         
                                                         </tr>
                                                         
                                                        <tr style='display:none' id='$tnameId'>
                                                        
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
                                                           
                                                              <th>Raw Material(s)</th>
                                                          
                                                        </tr>
                                                      </thead>";
                                                      echo"</table>";
                                                    }
                                                       
                                                         ?>
                                                  
                                                </div>
                                                 <div class="col s9 cyan lighten-4">
                                               <?php
                                             include("database/db_conection.php");

                                             $limitRaw=10;

                                          $pageRaw=1;
                                         $start_fromRaw = ($pageRaw-1) * $limitRaw;
                                        
                                               $resultRaw=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Description,i.Raised_Date,i.State,i.Approved_Date,i.User_Type 
                                                FROM raw_indent_table i LIMIT $start_fromRaw,$limitRaw");
                                               
                                               if(mysqli_num_rows($resultRaw) > 0){
                                                $i=1;
                                               while($rowRaw = mysqli_fetch_array($resultRaw)){

                                                 $desR[$i]=$rowRaw['Description']; 
                                                 $rIndId[$i]=$rowRaw['R_Indent_Id']  ;
                                                  $userR[$i]=$rowRaw['User_Type'];   
                                                   $stateR[$i]=$rowRaw['State'];   
                                                   $rdateR[$i]=$rowRaw['Raised_Date'];   
                                                    $adateR[$i]=$rowRaw['Approved_Date'];   
                                        
                                                 $i++;
                                                }

                                                 echo" <table class='bordered'>";
                                            echo"

                                          <thead>
                                            <tr>                                         
                                                 <th>Raised/Approved By</th> 
                                                  <th>State</th> 
                                                   <th>Raised Date</th>  
                                                <th>Approved/Rejected Date</th>    
                                            </tr>
                                          </thead>";

                                            for($i=1;$i<=count($userR);$i++)
                                            {
                                              $tnameId="n".$i;
                                              $rawMatId="r".$rIndId[$i];
                                                echo 

                                                "<tbody id='modalStoreRaw'>

                                                <tr>
                                             
                                             <td  width='10%'>$userR[$i]</td>
                                              <td width='10%'>$stateR[$i]</td>
                                            <td width='10%'>$rdateR[$i]</td>
                                             <td width='10%'>$adateR[$i]</td>
                                             </tr>
                                             
                                            <tr style='display:none' id='$tnameId'>
                                            
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
                                              
                                                 <th>Raised/Approved By</th> 
                                                  <th>State</th> 
                                                   <th>Approved Date</th>  
                                                <th>Approved/Rejected Date</th>    
                                            </tr>
                                          </thead>";
                                          echo"</table>";
                                        }
                                           
                                             ?>
                                                </div>

                                             </div>

                                              <div>
                                             <?php  
                                            include("database/db_conection.php");
                                            $limit=10;
                                              $sql = "SELECT COUNT(R_Indent_Id) FROM raw_indent_table";  
                                              $rs_result =  mysqli_query($dbcon,$sql);  
                                              $row =  mysqli_fetch_row($rs_result);  
                                              $total_records = $row[0];  
                                              $total_pages = ceil($total_records / $limit);  
                                              $pagLink = "<ul id='storeRaw' class='pagination'>";  
                                              for ($i=1; $i<=$total_pages; $i++) {  
                                                           $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                                              };  
                                              echo $pagLink . "</ul>";  
                                               mysqli_close($dbcon);
                                           ?> 
                                          </div>
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
                    <!--card stats end-->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

             
                        

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

                     <!--Multicolor with icon tabs-->
                  <div id="multi-color-tab" class="section">
            <h4 class="header">Stock Information</h4>
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

                    <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light modal-trigger" href="#modal5">Product Details</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light modal-trigger" href="#modal6">Pre Fabricated Materials</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light modal-trigger" href="#modal7">Raw materials</a>
                      </li>
                    </ul>
                  </div>
                  
                </div>
              </div>

                 
                 <!-- Raw materials modal info -->

                    <div id="modal7" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">
                            <?php
                     include("database/db_conection.php");

                     $total_amt=array();
                      $result2=mysqli_query($dbcon,"select R_Name,Quantity,Amount from raw_material_details");
                       if(mysqli_num_rows($result2) > 0){
                        $i=1;
                       while($row2 = mysqli_fetch_array($result2)){                        
                         $name[$i]=$row2['R_Name'];
                         $qua[$i]=$row2['Quantity'];
                         $amt[$i]=$row2['Amount'];
                         $total_amt[$i]=$qua[$i]*$amt[$i];
                         $i++;
                        }
                    }
                    echo" <table id='skrawMaterials' class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                        <th data-field='id'>Name</th>
                        <th data-field='name'>Quantity</th>
                        <th data-field='price'>Rate (per unit)</th>
                        <th data-field='tamt'>Total Amount</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($name);$i++)
                    {
                        echo 

                        "<tbody><tr>
                      <td width='10%'>$name[$i]</td>
                      <td width='10%'>$qua[$i]</td>
                      <td width='10%'>$amt[$i]</td>
                      <td width='10%'>$total_amt[$i]</td>
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     ?>
                        </div>    
                         <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
                         <a href="#" onclick="downloadAsExcel('skrawMaterials');" style="float: left;" class="waves-effect waves-red btn-flat">Download as excel</a>
                      </div>                              
                    </div>

                                     <!-- Product modal info -->

                    <div id="modal5" class="modal modal-fixed-footer">
                                                  <div class="modal-content left" style="color: black">
                                    <div class="col s12 m12 l8">
                                <div class="card-panel">
                                  <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="">
                                  <div class="row">                                       
                                          <div class="col s12">
                                            <label for="crole">Product Details *</label>
                                            <?php 
                                              include("database/db_conection.php");

                                              $resultPro=mysqli_query($dbcon,"select Product_Id, Product_Name from product_details");
                                               $option='';
                                               while($rowPro = mysqli_fetch_array($resultPro)){
                                                  $option.='<option value ="'.$rowPro['Product_Id'].'">'.$rowPro['Product_Name'].'</option>';
                                              }                              
                                            ?>
                                              <select class="error browser-default" id="plist1" name="plist" data-error=".errorTxt6" onchange="fetch_select(this.value);">
                                              <option value="0">Please Select</option>
                                              <?php echo $option;?> 
                                          </select>
                                          </div>
                                          <div>
                                            <?php
                                             if(isset($_POST['plist'])){
                                          
                                               $myinfo=$_POST['plist'];
                                               $_SESSION['selId']=$myinfo;
                                             }
                                             ?>
                                              
                                          </div>    
                                          <div id="divtable">
                                            <table id="ptable">
                                              <thead>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                              </thead>
                                              <tbody id="ptablebody">
                                                
                                              </tbody>
                                            </table>
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

                    <!-- Floating Action Button -->

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
    <footer class="page-footer" style="margin-top: 500px">
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
    

    <!--jvectormap-->
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/vectormap-script.js"></script>
    
       
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>

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

function fetch_select(val)
//$('#plist').on('change',function()
{
 $.ajax({
 type: 'post',
 dataType: "json",
 url: 'raw-material-list.php',
 data: {
  selctedPId:val
 },
 success: function (response) {   
   $('#ptablebody').empty();
  $.each(response, function(i, item) {
    //for(var r=0;r<item.length;r++){
      var trHTML = '';    
      trHTML += '<tr><td>' + item[0] + '</td><td>' + item[1] + '</td><td>' + item[2] + '</td></tr>';
     
      $('#ptablebody').append(trHTML);
   // }   
  });
 }
 });
}
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

     $('tr[name="rnameShow"]').on("click",function(){
      var rawId=$(this).attr('id');
      var nextId=$(this).next();
      var nextTR= nextId[0].id;
      $('tbody').css({'border-top':'1px solid #ccc'});
      var rawString="";
       document.getElementById(nextTR).innerHTML="";
       var rawMaterialId=rawId.substr(1);

       $.ajax({
     type: 'post',
     dataType: "json",
     url: 'raw-material-list.php',
     data: {
      rIndentId:rawMaterialId
     },
     success: function (response) {      
     $.each(response, function(key, value) {
   

    for(i=0;i<value.length-1;i++){
     rawString=value[0]+"->"+value[1];
     document.getElementById(nextTR).innerHTML=document.getElementById(nextTR).innerHTML+rawString+'</br>';
    }
    })
  }
});
   $(this).next().toggle();
});


     $(".pagination li").click(function(){
      var pageNum = this.id;
      var ulId=$(this).parent().attr('id');
      var entity="";

     if(ulId==='fReqPr'){
      entity='fieldRequestPr';
     }
     if(ulId==='fReqFab'){
      entity='fieldRequestFab';
     }

      if(ulId==='fAppPr'){
      entity='fieldAppPr';
     }
     if(ulId==='fAppFab'){
      entity='fieldAppFab';
     }
      if(ulId==='fRejPr'){
      entity='fieldRejPr';
     }
      if(ulId==='fRejFab'){
      entity='fieldRejFab';
     }
       if(ulId==='storeRaw'){
      entity='rawMat';
     }
    
      $(".pagination li").removeClass('pgactive');
     $(this).addClass('pgactive');
       //$('#modal1').modal('show');

        $.ajax({
     type: 'post',
     dataType:'json',
     url: 'pagination_storekeeper.php',
     data: {
     fIndentPage:pageNum,
     indent_type:entity
     },
     success: function (response) {   

     if(entity==='fieldRequestPr') 
     {
       $('#modalFReqPr tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalFReqPr').append(trHTML);
     }

     if(entity==='fieldRequestFab') 
     {
       $('#modalFReqFab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalFReqFab').append(trHTML);
     }

     if(entity==='fieldAppPr') 
     {
       $('#modalFAppPr tr').remove();  
       var trHTML = '';   
       
      for(res=1;res<=Object.keys(response).length;res++)
      {        
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
    
       $('#modalFAppPr').append(trHTML);
     }

     if(entity==='fieldAppFab') 
     {
       $('#modalFAppFab tr').remove();  
       var trHTML = '';   

      for(res=1;res<=Object.keys(response).length;res++)
      {
         var fabId=response[res][5];
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalFAppFab').append(trHTML);
     }

     if(entity==='fieldRejPr') 
     {
       $('#modalFRejPr tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalFRejPr').append(trHTML);
     }

     if(entity==='fieldRejFab') 
     {
       $('#modalFRejFab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalFRejFab').append(trHTML);
     }

     if(entity==='rawMat') 
     {
       $('#modalStoreRaw tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        var trId="r"+response[res][1];
        var tnId="n"+res;
        trHTML += '<tr name="rnameShow" id='+trId+'>';
        trHTML += '<td>' + response[res][2] + '</td><td>' + response[res][3] + '</td>'+ '<td>' 
        + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
        trHTML+='<tr style="display:none" id='+tnId+'></tr>'
      }
       $('#modalStoreRaw').append(trHTML);
     }
  }
  });

  });

</script>
    
</body>



</html>