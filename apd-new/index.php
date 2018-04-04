	
<?php
session_start();

include("database/db_conection.php");

if(!$_SESSION['user_type_Admin'])
{

    header("Location: user-login.php");//redirect to login page to secure the welcome page without login access.
}


$result=mysqli_query($dbcon,"select Count(Vendor_Id) as total from vendor_details");

 while($row=mysqli_fetch_assoc($result))
  {
        $_SESSION['v_count'] =$row['total'];
  } 


$result1=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Approved'");

 while($row1=mysqli_fetch_assoc($result1))
  {
        $_SESSION['app_count'] =$row1['total'];
  } 

$resultAppFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalFab from prefab_indent_table WHERE State='Approved'");

while($rowAppFab=mysqli_fetch_assoc($resultAppFab))
  {
    $_SESSION['app_count'] =$_SESSION['app_count']+$rowAppFab['totalFab'];
  }  

    $resultAppRaw=mysqli_query($dbcon,"select Count(R_Indent_Id) as totalRaw from raw_indent_table WHERE State='Approved'");

while($rowAppRaw=mysqli_fetch_assoc($resultAppRaw))
  {
    $_SESSION['app_count'] =$_SESSION['app_count']+$rowAppRaw['totalRaw'];
  }  

   $resultRai=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Raised'");

    while($rowRai=mysqli_fetch_assoc($resultRai))
      {
        $_SESSION['raised_count'] =$rowRai['total'];
      }  

$resultRaiFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalRaiFab from prefab_indent_table WHERE State='Raised'");

while($rowRaiFab=mysqli_fetch_assoc($resultRaiFab))
  {
    $_SESSION['raised_count'] =$_SESSION['raised_count']+$rowRaiFab['totalRaiFab'];
  }  

    $resultRaiRaw=mysqli_query($dbcon,"select Count(R_Indent_Id) as totalRaiRaw from raw_indent_table WHERE State='Raised'");

while($rowRaiRaw=mysqli_fetch_assoc($resultRaiRaw))
  {
    $_SESSION['raised_count'] =$_SESSION['raised_count']+$rowRaiRaw['totalRaiRaw'];
  }  


      $resultRej=mysqli_query($dbcon,"select Count(Indent_Id) as total from indent_table WHERE State='Rejected'");

    while($rowRej=mysqli_fetch_assoc($resultRej))
      {
        $_SESSION['rejected_count'] =$rowRej['total'];
      } 
      $resultRejFab=mysqli_query($dbcon,"select Count(Pre_Id) as totalRejFab from prefab_indent_table WHERE State='Rejected'");

while($rowRejFab=mysqli_fetch_assoc($resultRejFab))
  {
    $_SESSION['rejected_count'] =$_SESSION['rejected_count']+$rowRejFab['totalRejFab'];
  }  

    $resultRejRaw=mysqli_query($dbcon,"select Count(R_Indent_Id) as totaRejlRaw from raw_indent_table WHERE State='Rejected'");

while($rowRejRaw=mysqli_fetch_assoc($resultRejRaw))
  {
    $_SESSION['rejected_count'] =$_SESSION['rejected_count']+$rowRejRaw['totaRejlRaw'];
  }   
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
    <title>APD Inventroy Management System</title>

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

     /*  #productDetails{
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
                      <!-- <li><h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1"><img src="images/apdind_logo.jpg" alt="materialize logo"></a> <span class="logo-text">APD Inventroy</span></h1></li> -->
                      <li>
                          <h4 class="task-card-title" style="padding: 0px 0px 0px 25px; color: white;">APD</h4>
                      </li>
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
                        <li><a href="#" id="notiId" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">!</small></i>
                        
                        </a>
                        </li>                        
                       
                    </ul>
                 
                    <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class1="new badge"></span></h5>
                      </li>
                      <li class="divider"></li>
                      <li>
                        
                        <?php 
                        if($_SESSION['raised_count']!==0)
                        {
                          echo "<a href='#!'><i class='mdi-action-add-shopping-cart'></i>";
                          echo "Total ".$_SESSION['raised_count']. " indent are Raised, Please check."; 
                          echo " </a>";
                        } 
                        elseif ($_SESSION['raised_count']===0) {
                                               	echo "Nothing for now!!!";
                                               }                       
                        ?> 
                       
                        <!-- <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time> -->
                      </li>
                      <!-- <li>
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
                            <li><a class="modal-trigger" href="#modalProfile" onclick="update_profile('<?php echo $_SESSION['Admin_User'];?>');"><i class="mdi-action-face-unlock"></i> Profile</a>
                            </li>
                           <!--  <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                            </li> -->
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                            </li>
                        </ul>
                        <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $_SESSION['Admin_User']; ?><i style="margin-left: -10px;" class="mdi-navigation-arrow-drop-down right"></i></a>
                        <!-- <p class="user-roal">Store Keeper</p> -->
                    </div>

                </div>
                </li>
                <li class="bold active"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                </li>
                
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                       
                        <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-circle"></i> User Management</a>
                            <div class="collapsible-body">
                                <ul>               
                                    <li><a href="user-register.php">New User</a>
                                    </li>
                                    <li><a href="user-list.php">All Users</a>
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
                                   <a class="modal-trigger" href="#modalVendor">
                                   <p class="card-stats-title"><span style="color: white;"><i class="mdi-social-group-add"></i> Vendors</p>
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['v_count']; ?></h4></a>
                                       <div id="modalVendor" class="modal modal-fixed-footer">
                                            <div class="modal-content left" style="color: black">
                                                <!-- <p>Field Request content</p> -->

                                                <?php
                     include("database/db_conection.php");
                
                       $resultVen=mysqli_query($dbcon,"SELECT * from vendor_details");
                       
                       if(mysqli_num_rows($resultVen) > 0){
                        $i=1;
                       while($rowVen = mysqli_fetch_array($resultVen)){
                    
                           $vname[$i]=$rowVen['Vendor_Name'];
                         $vemail[$i]=$rowVen['Email'];                        
                                                  
                          $vconNo[$i]=$rowVen['Contact_No'];
                           $vadd[$i]=$rowVen['Address'];   
                           $vmType[$i]=$rowVen['Manufacture_Type'];                                              
                      
                         $i++;
                        }
                         echo" <table id='vendorTable' class='bordered'>";
                    echo"

                  <thead>
                    <tr>
                        <th>Name</th>
                      
                        <th>Email</th>                    
                        <th>Contact No</th>  
                         <th>Address</th>
                         <th>Manufacture Type</th>    
                       
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($vname);$i++)
                    {
                        echo 

                        "<tbody><tr>
                      <td width='10%'>$vname[$i]</td>
                    
                       <td width='13%'>$vemail[$i]</td>                  
                        <td width='10%'>$vconNo[$i]</td>
                        <td width='10%'>$vadd[$i]</td>                        
                      <td width='10%'>$vmType[$i]</td>
                 
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
                      
                        <th>Email</th>                    
                        <th>Contact No</th>  
                         <th>Address</th>
                         <th>Manufacture Type</th>                           
                    </tr>
                  </thead>";
                  echo"</table>";
                }
                   
                     ?>

                                            </div>  
                                             <div class="modal-footer">
                                                <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>

                                                 <a id="vendorList" class="waves-effect waves-red btn-flat" style="float: left" 
                                                 onclick="downloadAsExcel('vendorTable');">Download as Excel</a>
                                              </div>                                 
                                        </div>
                                    </div>
                                   <!--  <div class="card-action  green darken-2">
                                        <div id="clients-bar" class="center-align"></div>
                                    </div> -->
                                </div>
                              
                            </div>
                            <div class="col s12 m6 l3">
                           
                                <div class="card">
                                    <div class="card-content pink lighten-1 white-text">
                                        <a class="modal-trigger" href="#modalApp"> <p class="card-stats-title"><span style="color: white;"><i class="mdi-editor-insert-drive-file"></i> Total Approvals</p>
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['app_count']; ?></h4></a>
                                      <div id="modalApp" class="modal modal-fixed-footer">
                                            <div class="modal-content left" style="color: black">




                                              <!--Preselecting a tab-->
          <div id="preselecting-tab" class="section">
           
            <div class="row">
              
              <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#productApproval">Products</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#prefabApproval">Pre Fabricated Item</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#rawApproval">Raw Materials</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">
                    <div id="productApproval" class="col s12  cyan lighten-4">
                      <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];

                     $limitAppPr=10;

                      $pageAppPr=1;
                     $start_fromAppPr = ($pageAppPr-1) * $limitAppPr;  

                           $result2=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name,i.Approved_Date, i.Raised_Date,i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Approved' LIMIT $start_fromAppPr,$limitAppPr");
                           
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
                            echo" <table id='adprApp' class='bordered'>";
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

                            "<tbody id='modalAppPr'><tr>
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
                      </thead> ";

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
                        $pagLink = "<ul id='adAppPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                       <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('adprApp')">Download as excel</div>
                      </div>
                    </div>
                    <div id="prefabApproval" class="col s12  cyan lighten-4">
                     <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];

                    $limitAppFab=10;

                      $pageAppFab=1;
                     $start_fromAppFab = ($pageAppFab-1) * $limitAppFab;  

                           $resultPreFabApp=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Approved_Date, i.Raised_Date,i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM  prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Approved' LIMIT $start_fromAppFab,$limitAppFab");
                           
                           if(mysqli_num_rows($resultPreFabApp) > 0){
                            $i=1;
                           while($rowPreApp = mysqli_fetch_array($resultPreFabApp)){

                               $des2[$i]=$rowPreApp['Description'];
                             $unit2[$i]=$rowPreApp['Units'];   
                             $utype2[$i]=$rowPreApp['User_Type'];                        
                              //$pid2[$i]=$Pr_Name2;   
                              $name2[$i]=$rowPreApp['Name'];
                              $rdate2[$i]=$rowPreApp['Raised_Date'];   
                               $adate2[$i]=$rowPreApp['Approved_Date'];   
                               $camp2[$i]=$rowPreApp['Camp_Name'];                                             
                                 $pname2[$i]=$rowPreApp['Patient_Name'];
                    
                             $i++;
                            }
                            echo" <table id='adFabApp' class='bordered'>";
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

                        for($i=1;$i<=count($name2);$i++)
                        {
                            echo 

                            "<tbody id='modalAppFab'><tr>
                        <td>$name2[$i]</td> 
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
                         <th>Name</th>  
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
                        $pagLink = "<ul id='adAppFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                       <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('adFabApp')">Download as excel</div>
                      </div>
                    </div>
                    <div id="rawApproval" class="col s12  cyan lighten-4">
                     <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];

                    $limitAppRw=10;

                    $pageAppRw=1;
                    $start_fromAppRw = ($pageAppRw-1) * $limitAppRw;  
                           $resultAppRaw=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Description,i.Raised_Date,i.State,i.Approved_Date,i.User_Type FROM raw_indent_table i WHERE i.State='Approved' 
                            LIMIT $start_fromAppRw,$limitAppRw");
                           
                           if(mysqli_num_rows($resultAppRaw) > 0){
                            $i=1;
                           while($rowRawApp = mysqli_fetch_array($resultAppRaw)){

                               $desApRw[$i]=$rowRawApp['Description'];
                              $ridApRw[$i]=$rowRawApp['R_Indent_Id'];   
                              $utypeApRw[$i]=$rowRawApp['User_Type'];                        
                              $rdateApRw[$i]=$rowRawApp['Raised_Date'];   
                               $adate2ApRw[$i]=$rowRawApp['Approved_Date'];                                
                             $i++;
                            }
                            echo" <table class='bordered'>";
                        echo"

                      <thead>
                        <tr>
                          
                           <th>Raw Material(s)</th>                       
                           <th>Raised Date</th>  
                        <th>Approved</th>  
                        </tr>
                      </thead>";

                        for($i=1;$i<=count($ridApRw);$i++)
                        {
                          $tnameId="n".$i;
                        echo 

                        "<tbody id='modalAppRw'>

                              <tr name='rnameShow' id='$ridApRw[$i]'>
                            <td> <a href='#'>Raised for $desApRw[$i] items</a></td>
                        
                          <td>$rdateApRw[$i]</td>
                           <td>$adate2ApRw[$i]</td>
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
                           <th>Raised Date</th>  
                        <th>Approved</th>  
                     
                        </tr>
                      </thead>";
                       echo"</table>";
                        }
                        
                         ?>
                        <!--  <div>
                         <?php  
                        include("database/db_conection.php");
                        $limit=10;
                        $sql = "SELECT COUNT(R_Indent_Id) FROM raw_indent_table WHERE State='Approved'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='adAppRw' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                      </div> -->
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
                                   <!--  <div class="card-action  pink darken-2">
                                        <div id="invoice-line" class="center-align"></div>
                                    </div> -->
                                </div>
                             
                            </div>
                            <div class="col s12 m6 l3">
                            
                                <div class="card">
                                    <div class="card-content blue-grey white-text">
                                    <a class="modal-trigger" href="#modalRai"> 
                                        <p class="card-stats-title" <span style="color: white;"><i class="mdi-action-trending-up"></i> Total Raised</p>
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['raised_count']; ?></h4></a>
                                        <div id="modalRai" class="modal modal-fixed-footer">
                                            <div class="modal-content left" style="color: black">
                                                <!-- <p>Field Request content</p> -->

            <div id="preselecting-tab" class="section">
           
            <div class="row">
              
              <div class="col s12 m8 l12">
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo-active z-depth-1 cyan">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#productRiased">Products</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#prefabRiased">Pre Fabricated Item</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#rawRiased">Raw Materials</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">
                    <div id="productRiased" class="col s12  cyan lighten-4">
                      <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];
                    $limitRaiPr=10;

                    $pageRaiPr=1;
                    $start_fromRaiPr = ($pageRaiPr-1) * $limitRaiPr;  
                           $result2=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name,i.Approved_Date,i.TechName,i.Raised_Date,i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Raised' LIMIT $start_fromRaiPr,$limitRaiPr");
                           
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
                             $utype2[$i]=$row2['TechName'];                        
                              $rdate2[$i]=$row2['Raised_Date'];   
                               $camp2[$i]=$row2['Camp_Name'];                                             
                                 $pname2[$i]=$row2['Patient_Name'];
                    
                             $i++;
                            }
                            echo" <table id='adRaised' class='bordered'>";
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

                        for($i=1;$i<=count($pid2);$i++)
                        {
                            echo 

                            "<tbody id='modalRaiPr'><tr>
                           <td>$pid2[$i]</td> 
                             <td>$unit2[$i]</td> 
                          <td>$utype2[$i]</td>    
                            <td>$rdate2[$i]</td>                        
                        
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
                        $sql = "SELECT COUNT(Indent_Id) FROM indent_table WHERE State='Raised'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='adRaiPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                        <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('adRaised')">Download as excel</div>
                      </div>

                    </div>
                    <div id="prefabRiased" class="col s12  cyan lighten-4">
                     <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];
                    $limitRaiFab=10;

                    $pageRaiFab=1;
                    $start_fromRaiFab = ($pageRaiFab-1) * $limitRaiFab;  
                           $resultPreFab=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Approved_Date,i.TechName, i.Raised_Date,i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM  prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Raised' LIMIT $start_fromRaiFab,$limitRaiFab");
                           
                           if(mysqli_num_rows($resultPreFab) > 0){
                            $i=1;
                           while($row2 = mysqli_fetch_array($resultPreFab)){

                                $name2[$i]=$row2['Name'];
                             $unit2[$i]=$row2['Units'];   
                             $utype2[$i]=$row2['User_Type'];     
                              $rdate2[$i]=$row2['Raised_Date'];   
                               $camp2[$i]=$row2['Camp_Name'];                                             
                                 $pname2[$i]=$row2['Patient_Name'];
                    
                             $i++;
                            }
                            echo" <table id='adFabRaised' class='bordered'>";
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

                        for($i=1;$i<=count($name2);$i++)
                        {
                            echo 

                            "<tbody id='modalRaiFab'><tr>                                                   
                            <td>$name2[$i]</td> 
                              <td>$unit2[$i]</td> 
                             <td>$utype2[$i]</td>  
                            <td>$rdate2[$i]</td>                        
                       
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
                        $sql = "SELECT COUNT(Pre_Id) FROM prefab_indent_table WHERE State='Raised'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='adRaiFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                       <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('adFabRaised')">Download as excel</div>
                      </div>
                    </div>
                    <div id="rawRiased" class="col s12  cyan lighten-4">
                     <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];
                    $limitRaiRw=10;

                    $pageRaiRw=1;
                    $start_fromRaiRw = ($pageRaiRw-1) * $limitRaiRw;   

                           $resultPreFab=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Description,i.Raised_Date,i.State,i.Approved_Date,i.User_Type 
                            FROM  raw_indent_table i WHERE i.State='Raised' LIMIT $start_fromRaiRw,$limitRaiRw");
                           
                           if(mysqli_num_rows($resultPreFab) > 0){
                            $i=1;
                           while($row2 = mysqli_fetch_array($resultPreFab)){

                               $desRaiRw[$i]=$row2['Description'];
                               $rIdRaiRw[$i]=$row2['R_Indent_Id'];   
                             $utypeRaiRw[$i]=$row2['User_Type'];                        
                              //$pid2[$i]=$Pr_Name2;   
                              //$name2[$i]=$row2['Name'];
                              $rdateRaiRw[$i]=$row2['Raised_Date'];   
                                                       
                             $i++;
                            }
                            echo" <table class='bordered'>";
                        echo"

                      <thead>
                        <tr>
                           <th>Raw Material(s)</th>                       
                           <th>Raised Date</th>                             
                        </tr>
                      </thead>";

                        for($i=1;$i<=count($rIdRaiRw);$i++)
                        {
                           $tnameIdRai="nRai".$i;
                            echo 

                            "<tbody id='modalRaiRw'><tr>
                   
                         <tr name='rnameShowRai' id='$rIdRaiRw[$i]'>
                       <td> <a href='#'>Raised for $desRaiRw[$i] items</a></td>               
                           
                            <td>$rdateRaiRw[$i]</td>                        
                        
                        </tr>  
                         <tr style='display:none' id='$tnameIdRai'>
                          
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
                           <th>Raised Date</th>         
                     
                        </tr>
                      </thead>";
                       echo"</table>";
                        }
                    
                        
                         ?>
                       <!--  <div>
                       <?php  
                      include("database/db_conection.php");
                      $limit=10;
                        $sql = "SELECT COUNT(R_Indent_Id) FROM raw_indent_table WHERE State='Raised'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='adRaiRw' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                                     $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                     ?> 
                  </div> -->
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
                                    <!-- <div class="card-action blue-grey darken-2">
                                        <div id="profit-tristate" class="center-align"></div>
                                    </div> -->
                                </div>
                                
                            </div>
                            <div class="col s12 m6 l3">
                          
                                <div class="card">
                                    <div class="card-content purple white-text">
                                      <a class="modal-trigger" href="#modalRej">
                                        <p class="card-stats-title"><span style="color: white;">Total Rejected</p>
                                        <h4 class="card-stats-number" style="color: white;"><?php echo $_SESSION['rejected_count']; ?></h4></a>
                                      <div id="modalRej" class="modal">
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
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#rawRejected">Raw Materials</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">
                    <div id="productRejected" class="col s12  cyan lighten-4">
                      <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];

                    $limitRejPr=10;

                    $pageRejPr=1;
                    $start_fromRejPr = ($pageRejPr-1) * $limitRejPr;  
                           $resultPrRej=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Product_Id,i.Name,i.Approved_Date, i.Raised_Date,i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Rejected' LIMIT $start_fromRejPr,$limitRejPr");
                           
                           if(mysqli_num_rows($resultPrRej) > 0){
                            $i=1;
                           while($rowPrRej = mysqli_fetch_array($resultPrRej)){

                            $Pr_NameRej="";

                            if($rowPrRej['Product_Id']!==null){
                              $selPId2=$rowPrRej['Product_Id'];
                              $resultRejIn=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId2'");
                              
                                while($rowRejIn = mysqli_fetch_assoc($resultRejIn)){
                                  $Pr_NameRej=$rowRejIn['Product_Name'];
                                }
                              
                            }
                             $pidRej[$i]=$Pr_NameRej;   
                             $unitPrRej[$i]=$rowPrRej['Units'];   
                             $utypePrRej[$i]=$rowPrRej['User_Type'];       
                              $rdatePrRej[$i]=$rowPrRej['Raised_Date'];   
                               $adatePrRej[$i]=$rowPrRej['Approved_Date'];   
                               $campPrRej[$i]=$rowPrRej['Camp_Name'];                                             
                                 $pnamePrRej[$i]=$rowPrRej['Patient_Name'];
                    
                             $i++;
                            }
                            echo" <table id='totRejPro' class='bordered'>";
                        echo"

                      <thead>
                        <tr>
                        <th>Product Name</th>  
                        <th>Measurements</th>
                            <th>Rejected By</th>   
                            <th>Raised Date</th>
                             <th>Rejected Date</th>  
                             <th>Camp Name</th>                                         
                            <th>Patient Name</th>
                        </tr>
                      </thead>";

                        for($i=1;$i<=count($pidRej);$i++)
                        {
                            echo 

                            "<tbody id='modalRejPr'><tr>
                              <td>$pidRej[$i]</td> 
                                <td>$unitPrRej[$i]</td> 
                          <td>$utypePrRej[$i]</td>    
                            <td>$rdatePrRej[$i]</td>                        
                          <td>$adatePrRej[$i]</td>
                          <td>$campPrRej[$i]</td>
                           <td>$pnamePrRej[$i]</td>
                         
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
                            <th>Rejected By</th>   
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
                        $pagLink = "<ul id='adRejPr' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                       <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('totRejPro')">Download as excel</div>
                      </div>
                    </div>
                    <div id="prefabRejected" class="col s12  cyan lighten-4">
                     <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];

                    $limitRejFab=10;

                    $pageRejFab=1;
                    $start_fromRejFab = ($pageRejFab-1) * $limitRejFab;
                           $resultPreFabRej=mysqli_query($dbcon,"SELECT i.Description, i.Units,i.Name,i.Approved_Date, i.Raised_Date,i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM  prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Rejected' LIMIT $start_fromRejFab,$limitRejFab");
                           
                           if(mysqli_num_rows($resultPreFabRej) > 0){
                            $i=1;
                           while($rowPreRej = mysqli_fetch_array($resultPreFabRej)){

                             $nameRRej[$i]=$rowPreRej['Name'];
                             $unitRRej[$i]=$rowPreRej['Units'];   
                             $utypeRRej[$i]=$rowPreRej['User_Type'];    
                              $rdateRRej[$i]=$rowPreRej['Raised_Date'];   
                               $adateRRej[$i]=$rowPreRej['Approved_Date'];   
                               $campRRej[$i]=$rowPreRej['Camp_Name'];                                             
                                 $pnameRRej[$i]=$rowPreRej['Patient_Name'];
                    
                             $i++;
                            }
                            echo" <table id='totRejPreFab' class='bordered'>";
                        echo"

                      <thead>
                        <tr>
                            <th>Name</th>
                            <th>Measurements</th>  
                            <th>Rejected By</th>   
                            <th>Raised Date</th>
                             <th>Rejected Date</th>  
                             <th>Camp Name</th>                                         
                            <th>Patient Name</th>
                        </tr>
                      </thead>";

                        for($i=1;$i<=count($nameRRej);$i++)
                        {
                            echo 

                            "<tbody id='modalRejFab'><tr>
                             <td>$nameRRej[$i]</td> 
                              <td>$unitRRej[$i]</td> 
                          <td>$utypeRRej[$i]</td>         
                            <td>$rdateRRej[$i]</td>                        
                          <td>$adateRRej[$i]</td>
                          <td>$campRRej[$i]</td>
                           <td>$pnameRRej[$i]</td>
                         
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
                            <th>Rejected By</th>   
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
                        $pagLink = "<ul id='adRejFab' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                       <div style="float: left; cursor: pointer;" onclick="downloadAsExcel('totRejPreFab')">Download as excel</div>
                      </div>
                    </div>

                    <div id="rawRejected" class="col s12  cyan lighten-4">
                     <?php
                         include("database/db_conection.php");

                    $u_type=$_SESSION['user_type_Admin'];
                    $limitRejRw=10;

                    $pageRejRw=1;
                    $start_fromRejRw = ($pageRejRw-1) * $limitRejRw;  
                           $resultRawRej=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Description,i.Raised_Date,i.State,i.Approved_Date,i.User_Type
                            FROM  raw_indent_table i WHERE i.State='Rejected' LIMIT $start_fromRejRw,$limitRejRw");
                           
                           if(mysqli_num_rows($resultRawRej) > 0){
                            $i=1;
                           while($rowRawRej = mysqli_fetch_array($resultRawRej)){

                             $desRejRw[$i]=$rowRawRej['Description'];       
                             $rIdRejRw[$i]=$rowRawRej['R_Indent_Id'];       
                             $utypeRejRw[$i]=$rowRawRej['User_Type'];                        
                            
                              $rdateRejRw[$i]=$rowRawRej['Raised_Date'];   
                               $adateRejRw[$i]=$rowRawRej['Approved_Date'];                                
                             $i++;
                            }
                            echo" <table class='bordered'>";
                        echo"

                      <thead>
                        <tr>  
                        <th>Raw Material(s)</th>
                         <th>Rejected By</th> 
                           <th>Raised Date</th>  
                        <th>Rejected Date</th>  
                        </tr>
                      </thead>";

                        for($i=1;$i<=count($rIdRejRw);$i++)
                        {
                           $tnameIdRej="nRej".$i;
                            echo 

                            "<tbody id='modalRejRw'><tr>
                        <tr name='rnameShowRej' id='$rIdRejRw[$i]'>
                      <td> <a href='#'>Raised for $desRejRw[$i] items</a></td>
                     <td>$utypeRejRw[$i]</td>
                   
                    <td>$rdateRejRw[$i]</td>
                     <td>$adateRejRw[$i]</td>
                      
                        </tr>   
                        <tr style='display:none' id='$tnameIdRej'>
                          
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
                         <th>Rejected By</th> 
                           <th>Raised Date</th>  
                        <th>Rejected Date</th>  
                     
                        </tr>
                      </thead>";
                       echo"</table>";
                        }
                    
                        
                         ?>
                       <!--   <div>
                         <?php  
                        include("database/db_conection.php");
                        $limit=10;
                        $sql = "SELECT COUNT(R_Indent_Id) FROM raw_indent_table WHERE State='Rejected'";  
                        $rs_result =  mysqli_query($dbcon,$sql);  
                        $row =  mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $limit);  
                        $pagLink = "<ul id='adRejRw' class='pagination'>";  
                        for ($i=1; $i<=$total_pages; $i++) {  
                               $pagLink .= "<li class='waves-effect' id='$i'>".$i."</a></li>";  
                        };  
                        echo $pagLink . "</ul>";  
                         mysqli_close($dbcon);
                       ?> 
                      </div> -->
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
                                   <!--  <div class="card-action purple darken-2">
                                        <div id="sales-compositebar" class="center-align"></div>
                                    </div> -->
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!--card stats end-->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

                    <!--card widgets start-->
                    <div id="card-widgets">
                        <div class="row">

                            <div class="col s12 m12 l12">
                                <ul id="task-card" class="collection with-header">
                                    <li class="collection-header cyan">
                                        <h4 class="task-card-title" style="font-size: 1.5rem">Indent Information</h4>
                                       <!--  <p class="task-card-date">March 26, 2015</p> -->
                                    </li>
                                    <li class="collection-item">
                                   <a class="modal-trigger" href="#modal2">  <p>Product Indent Raised  <i class="mdi-content-send left"></i></p></a>
                                    </li>
                                    <li class="collection-item">
                                     <a class="modal-trigger" href="#modal3"><p>Pre Fabricated Indent Raised  <i class="mdi-content-send left"></i></p></a>
                                    </li>
                                    <li class="collection-item">
                                     <a class="modal-trigger" href="#modal4"><p>Raw Material Indent Raised  <i class="mdi-content-send left"></i></p></a>
                                    </li> 
                                </ul> 
                            </div>

                            <!-- Product Indent Raised -->
                                <div id="modal2" class="modal modal-fixed-footer">
                                <div class="modal-content left" style="color: black">
                                    <div class="col s12 m12 l8">
                                <div class="card-panel">
                                  <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="">
                                  <div class="row">                                       
                                          <div class="col s12">
                                            <label for="crole">Indent Details *</label>
                                            <?php 
                                              include("database/db_conection.php");

                                              $result=mysqli_query($dbcon,"SELECT i.Indent_Id,i.Units,i.Product_Id,i.TechName,pt.Patient_Name,p.Product_Name FROM indent_table i, patient_details pt,product_details p WHERE i.Patient_Id=pt.Patient_Id and i.Product_Id=p.Product_Id and i.User_Type='Field Technician' and i.State='Raised'");
                                               $option='';
                                               while($row = mysqli_fetch_array($result)){
                                                  $option.='<option value ="'.$row['Indent_Id'].'">'.$row['Product_Name'].'</option>';
                                              }                              
                                            ?>
                                              <select class="error browser-default" id="plist1" name="plist" data-error=".errorTxt6" onchange="fetch_select(this.value,'product');">
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
                                                  


                                      <!--   <div class="input-field col s12">
                                            <textarea rows="2" id="ides" placeholder="Indent Description" name="indentdes" readonly class="materialize-textarea" data-error=".errorTxt7"></textarea>
                                            <label class="active" for="ides">Indent Description</label>
                                        </div> -->
                                         <div class="input-field col s12">
                                          <textarea id="unit" class="materialize-textarea" placeholder="Measurements" name="unit"></textarea>
                                          <label class="active" for="unit">Measurements</label>
                                      </div>  
                                         <div class="input-field col s12">
                                          <input id="fname" readonly type="text" placeholder="Raised By" name="p_name">
                                          <label class="active" for="fname">Raised By</label>
                                      </div>                             
                                        <div class="input-field col s12">
                                          <input id="rdate" placeholder="Indent Raised" readonly type="text" name="p_add">
                                          <label class="active" for="rdate">Indent Raised</label>
                                      </div>       
                                        <div class="input-field col s12">
                                          <input id="pname" readonly type="text" placeholder="Patient Name" name="p_name">
                                          <label class="active" for="pname">Name</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="age" readonly type="number" placeholder="Age" name="p_age">
                                          <label class="active" for="age">Age</label>
                                      </div>
                                       <div class="input-field col s12">
                                          <textarea id="comm" class="materialize-textarea" placeholder="Your Comments" name="comments"></textarea>
                                          <label class="active" for="comm">Your Comments</label>
                                      </div>
                                                                                           
                                      <!--   <div class="input-field col s12">
                                          <textarea id="dis" readonly class="materialize-textarea" placeholder="Reason" name="p_reason"></textarea>
                                          <label class="active" for="dis">Reason</label>
                                      </div> -->
                                      <div class="input-field col s6">
                                             <button class="btn waves-effect waves-light left submit" id="actionReject">Reject
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>

                                        <div class="input-field col s6">
                                            <button class="btn waves-effect waves-light right submit" id="actionApprove">Approve
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

                    <!-- Pre Fabricated Indent Raised -->

                     <div id="modal3" class="modal modal-fixed-footer">
                                <div class="modal-content left" style="color: black">
                                    <div class="col s12 m12 l8">
                                <div class="card-panel">
                                  <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="">
                                  <div class="row">                                       
                                          <div class="col s12">
                                            <label for="crole">Indent Details *</label>
                                            <?php 
                                              include("database/db_conection.php");

                                              $result=mysqli_query($dbcon,"SELECT i.Pre_Id,pt.Patient_Name,i.Name FROM prefab_indent_table i, patient_details pt WHERE i.Patient_Id=pt.Patient_Id and i.User_Type='Field Technician' and i.State='Raised'");
                                               $option='';
                                               while($row = mysqli_fetch_array($result)){
                                                  $option.='<option value ="'.$row['Pre_Id'].'">'.$row['Name'].'</option>';
                                              }                              
                                            ?>
                                              <select class="error browser-default" id="plist1Pre" name="plistPre" data-error=".errorTxt6" onchange="fetch_select(this.value,'prefabricated');">
                                              <option value="0">Please Select</option>
                                              <?php echo $option;?>
                                          </select>
                                          </div>
                                          <div>
                                            <?php
                                             if(isset($_POST['plistPre'])){
                                          
                                               $myinfoPre=$_POST['plistPre'];
                                               $_SESSION['selIdPre']=$myinfoPre;
                                             }
                                            ?>
                                          </div>                                         
                                                                                                      
                                    <!--     <div class="input-field col s12">
                                            <textarea rows="2" id="ides1" placeholder="Indent Description" name="indentdes" readonly class="materialize-textarea" data-error=".errorTxt7"></textarea>
                                            <label class="active" for="ides1">Indent Description</label>
                                        </div> -->
                                         <div class="input-field col s12">
                                          <textarea id="unit1" class="materialize-textarea" placeholder="Measurements" name="unit1"></textarea>
                                          <label class="active" for="unit1">Measurements</label>
                                      </div>
                                                  <div class="input-field col s12">
                                          <input id="fname1" readonly type="text" placeholder="Raised By" name="p_name">
                                          <label class="active" for="fname1">Raised By</label>
                                      </div>     
                                        <div class="input-field col s12">
                                          <input id="rdate1" placeholder="Indent Raised" readonly type="text" name="p_add">
                                          <label class="active" for="rdate1">Indent Raised</label>
                                      </div>       
                                        <div class="input-field col s12">
                                          <input id="pname1" placeholder="Patient Name" readonly type="text" name="p_name">
                                          <label class="active" for="pname1">Name</label>
                                      </div>
                                        <div class="input-field col s12">
                                          <input id="age1" placeholder="Age" readonly type="number" name="p_age">
                                          <label class="active" for="age1">Age</label>
                                      </div>
                                                                                           
                                      <!--   <div class="input-field col s12">
                                          <textarea id="dis1" placeholder="Reason" readonly class="materialize-textarea" name="p_reason"></textarea>
                                          <label class="active" for="dis1">Reason</label>
                                      </div> -->
                                        <div class="input-field col s12">
                                          <textarea id="comm" class="materialize-textarea" placeholder="Your Comments" name="comments"></textarea>
                                          <label class="active" for="comm">Your Comments</label>
                                      </div>
                                       <div class="input-field col s6">
                                             <button class="btn waves-effect waves-light left submit" id="actionRejectPre">Reject
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>

                                        <div class="input-field col s6">
                                            <button class="btn waves-effect waves-light right submit" id="actionApprovePre">Approve
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

                     <!-- Raw Material Indent Raised -->

                     <div id="modal4" class="modal modal-fixed-footer">
                                <div class="modal-content left" style="color: black">
                                    <div class="col s12 m12 l8">
                                <div class="card-panel">
                                  <div class="row">
                                <form class="formValidate" id="formValidate" method="post" action="">
                                  <div class="row">                                       
                                          <div class="col s12">
                                            <label for="crole">Indent Details For Raw Materials *</label>
                                            <?php 
                                              include("database/db_conection.php");

                                              $uArray=[];
                                              $array=[];
                                              $resultR=mysqli_query($dbcon,"SELECT R_Indent_Id,Raised_Date FROM raw_indent_table WHERE User_Type='Store Keeper' and State='Raised'");
                                               $option='';
                                              
                                               while($rowR = mysqli_fetch_array($resultR)){
                                                 $_SESSION['iId']=$rowR['R_Indent_Id'];
                                                // $iIdArray[$i]=$_SESSION['iId'];

                                                // $array  = explode(",", $rowR['Description']);   
                                                // $i++;    
                                                 $option.='<option value ="'.$rowR['R_Indent_Id'].'">Indent Raised on '.$rowR['Raised_Date'].'</option>';                                                                                   
                                              }
                                               // $_SESSION['indArray']=implode(",", $iIdArray);
                                               // $no = 1;
                                               //      $uArray=array_unique($array,SORT_REGULAR);
                                            
                                               //  foreach ($uArray as $line) {
                                               //    $resultRaw=mysqli_query($dbcon,"SELECT R_Id,R_Name FROM raw_material_details WHERE R_Id=$line");
                                               //     while($rowRaw = mysqli_fetch_array($resultRaw)){
                                               //    $option.='<option disabled value ="$no">'.$rowRaw['R_Name'].'</option>';
                                               //    $no++;
                                               //  }
                                               //  }                                     
                                            ?>
                                              <select class="error browser-default" id="plist1" name="plist" data-error=".errorTxt6" onchange="fetch_select(this.value,'rawmaterial_indent');">
                                              <option value="0">Please Select</option>
                                              <?php echo $option;?>
                                          </select>
                                          </div>
                                          <div>
                                         
                                          </div>                                         
                                        <div class="input-field col s12" hidden="true">
                                          <input id="indId" readonly type="text" name="indId" value=<?php echo $_SESSION['iId'];?>>
                                          <label class="active" for="indId"></label>
                                      </div>   
                                      <div class="input-field col s12">   
                                      <textarea id="raw" class="materialize-textarea" placeholder="" name="raw" readonly="readonly"></textarea>                                    
                                          <label class="active" for="raw">Raw Material's Name and Quantity</label>
                                      </div>                                                    
                                         <div class="input-field col s12">
                                          <textarea id="comm" class="materialize-textarea" placeholder="Your Comments" name="comments"></textarea>
                                          <label class="active" for="comm">Your Comments</label>
                                      </div>
                                      <div class="input-field col s6">
                                             <button class="btn waves-effect waves-light left submit" id="actionRejectRaw">Reject
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>

                                        <div class="input-field col s6">
                                            <button class="btn waves-effect waves-light right submit" id="actionApproveRaw">Approve
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
                     
                            <!-- map-card -->
                            
 
                        </div>
                    <!--card widgets end-->

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
                      <li class="tab col s3"><a class="white-text waves-effect waves-light modal-trigger" href="#modal1">Raw materials</a>
                      </li>
                    </ul>
                  </div>
                  
                </div>
              </div>

                 
                 <!-- Raw materials modal info -->

                    <div id="modal1" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">
                            <?php
                     include("database/db_conection.php");

                      $result2=mysqli_query($dbcon,"select R_Name,Quantity,Amount from raw_material_details");
                       if(mysqli_num_rows($result2) > 0){
                        $i=1;
                       while($row2 = mysqli_fetch_array($result2)){
                         $name[$i]=$row2['R_Name'];
                         $qua[$i]=$row2['Quantity'];
                         $amt[$i]=$row2['Amount'];

                         $i++;
                        }
                    }
                    echo" <table id='rawMaterialsAdmin' class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                        <th data-field='id'>Name</th>
                        <th data-field='name'>Quantity</th>
                        <th data-field='price'>Rate</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($name);$i++)
                    {
                        echo 

                        "<tbody><tr>
                      <td width='10%'>$name[$i]</td>
                      <td width='10%'>$qua[$i]</td>
                      <td width='10%'>$amt[$i]</td>
                    </tr>                    
                  </tbody>"; 
                        
                    }

                    echo"</table>";
                     ?>
                        </div>    
                         <div class="modal-footer">
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>

                        <a href="#" onclick="downloadAsExcel('rawMaterialsAdmin');" style="float: left;" class="waves-effect waves-red btn-flat">Download as excel</a>
                      </div>                              
                    </div>

                                     <!-- Product modal info -->

                    <div id="modal5" class="modal modal-fixed-footer">
                        <div class="modal-content left" style="color: black">
                            <?php
                     include("database/db_conection.php");

                      $resultPro=mysqli_query($dbcon,"select Product_Name,Quantity,Amount from product_details");
                       if(mysqli_num_rows($resultPro) > 0){
                        $i=1;
                       while($rowPro = mysqli_fetch_array($resultPro)){
                         $pname[$i]=$rowPro['Product_Name'];
                         $pqua[$i]=$rowPro['Quantity'];
                         $pamt[$i]=$rowPro['Amount'];

                         $i++;
                        }
                    }
                    echo" <table class='bordered'>";
                    echo"
                  <thead>
                    <tr>
                        <th data-field='pid'>Name</th>
                        <th data-field='pname'>Quantity</th>
                        <th data-field='pprice'>Rate</th>
                    </tr>
                  </thead>";

                    for($i=1;$i<=count($pname);$i++)
                    {
                        echo 

                        "<tbody><tr>
                      <td width='10%'>$pname[$i]</td>
                      <td width='10%'>$pqua[$i]</td>
                      <td width='10%'>$pamt[$i]</td>
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
    <footer class="page-footer" style="margin-top: 200px">
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
    <!-- Toast Notification -->
    <!-- <script type="text/javascript">
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
        }, 1500);
        setTimeout(function() {
            Materialize.toast('<span>You can swipe me too!</span>', 3000);
        }, 5000);
        setTimeout(function() {
            Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
        }, 15000);
    });
    </script> -->

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

function fetch_select(val,entity)
//$('#plist').on('change',function()
{
 $.ajax({
 type: 'post',
 dataType: "json",
 url: 'indent-selection.php',
 data: {
  get_option:val,
  indent_type:entity
 },
 success: function (response) {   
if(entity==="prefabricated"){
  //  document.getElementById("ides1").innerHTML=response[0]; 
  document.getElementById("unit1").innerHTML=response[0]; 
  document.getElementById("fname1").value=response[1]
  document.getElementById("rdate1").value=response[2]; 
  document.getElementById("pname1").value=response[3]; 
  document.getElementById("age1").value=response[4]; 
  document.getElementById("dis1").innerHTML=response[5]; 
}
if(entity==="product"){
  document.getElementById("unit").innerHTML=response[0]; 
  //document.getElementById("unit").value=response[1]; 
  document.getElementById("fname").value=response[1]
  document.getElementById("rdate").value=response[2]; 
  document.getElementById("pname").value=response[3]; 
  document.getElementById("age").value=response[4]; 
  document.getElementById("dis").innerHTML=response[5]; 
  }
if(entity==="rawmaterial_indent")
{
  document.getElementById("raw").innerHTML="";
   $.each(response, function(key, value) {
    //For example
    for(i=0;i<value.length-1;i++){
    var rawString=value[0]+"->"+value[1];
     document.getElementById("raw").innerHTML=document.getElementById("raw").innerHTML+rawString+'\n';
    }
})
}
 }
 });
}
</script>

<script type="text/javascript">

    $('#actionApprove').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      a_indent_id:$("#plist1").val(),
      a_indent_state:'Approved',
       comment:$("#comm").val(),
       indent_type:'product'
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

    $('#actionReject').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      a_indent_id:$("#plist1").val(),
      a_indent_state:'Rejected',
       comment:$("#comm").val(),
       indent_type:'product'
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

    $('#actionApprovePre').click(function(e)
    {
       e.preventDefault();
    
     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      a_indent_id:$("#plist1Pre").val(),
      a_indent_state:'Approved',
       comment:$("#comm").val(),
       indent_type:'prefabricated'
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

    $('#actionRejectPre').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      a_indent_id:$("#plist1Pre").val(),
      a_indent_state:'Rejected',
       comment:$("#comm").val(),
        indent_type:'prefabricated'
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

    $('#actionApproveRaw').click(function(e)
    {
       e.preventDefault();
    
     $.ajax({
     type: 'post',
     url: 'raw-material-list.php',
     data: {
      a_indent_id:$("#indId").val(),
      a_indent_state:'Approved',
       comment:$("#comm").val(),
        indent_type:'rawmaterial'
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

    $('#actionRejectRaw').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'raw-material-list.php',
     data: {
      a_indent_id:$("#indId").val(),
      a_indent_state:'Rejected',
       comment:$("#comm").val(),
        indent_type:'rawmaterial'
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


//display the notification
$('#notiId').click(function(e){

   $.ajax({
 type: 'post',
 dataType: "json",
 url: 'notification.php',
 data: {
  get_option:val
 },
 success: function (response) {   
 }
 });

});

$('#liProductIndent').click(function(){
  $('#productIndent').css("display","block");
    $('#preFabIndent').css("display","none");
      $('#rawIndent').css("display","none");
});

$('#liPrefabIndent').click(function(){
  $('#productIndent').css("display","none");
    $('#preFabIndent').css("display","block");
      $('#rawIndent').css("display","none");
});

$('#liRawIndent').click(function(){
  $('#productIndent').css("display","none");
    $('#preFabIndent').css("display","none");
      $('#rawIndent').css("display","block");
});


$(".pagination li").click(function(){
      var pageNum = this.id;
      var ulId=$(this).parent().attr('id');
      var entity="";

     if(ulId==='adAppPr'){
      entity='adAppPrIndent';
     }
     if(ulId==='adAppFab'){
      entity='adAppFabIndent';
     }

      if(ulId==='adAppRw'){
      entity='adAppRwIndent';
     }
     if(ulId==='adRaiPr'){
      entity='adRaiPrIndent';
     }
      if(ulId==='adRaiFab'){
      entity='adRaiFabIndent';
     }
      if(ulId==='adRaiRw'){
      entity='adRaiRwIndent';
     }
      if(ulId==='adRejPr'){
      entity='adRejPrIndent';
     }
      if(ulId==='adRejFab'){
      entity='adRejFabIndent';
     }
     if(ulId==='adRejRw'){
      entity='adRejRwIndent';
     }


      $(".pagination li").removeClass('pgactive');
     $(this).addClass('pgactive');
       //$('#modal1').modal('show');

        $.ajax({
     type: 'post',
     dataType:'json',
     url: 'pagination_admin.php',
     data: {
     fIndentPage:pageNum,
     indent_type:entity
     },
     success: function (response) {   

     if(entity==='adAppPrIndent') 
     {
       $('#modalAppPr tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalAppPr').append(trHTML);
     }

     if(entity==='adAppFabIndent') 
     {
       $('#modalAppFab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td><td>' + response[res][6] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalAppFab').append(trHTML);
     }

     if(entity==='adAppRwIndent') 
     {
       $('#modalAppRw tr').remove();  
       var trHTML = '';   
       
      for(res=1;res<=Object.keys(response).length;res++)
      {   
      var  tnameId="n"+res;   
         trHTML += '<tr name="rnameShow" id='+response[res][3]+'>';
        trHTML += '<td> <a href="#">Raised for '+response[res][0]+' items</a></td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>';
        trHTML+='</tr>';
        trHTML+= '<tr style="display:none" id='+tnameId+'></tr>';
      }
    
       $('#modalAppRw').append(trHTML);
     }

     if(entity==='adRaiPrIndent') 
     {
       $('#modalRaiPr tr').remove();  
       var trHTML = '';   

      for(res=1;res<=Object.keys(response).length;res++)
      {
         var fabId=response[res][5];
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalRaiPr').append(trHTML);
     }

     if(entity==='adRaiFabIndent') 
     {
       $('#modalRaiFab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalRaiFab').append(trHTML);
     }

     if(entity==='adRaiRwIndent') 
     {
       $('#modalRaiRw tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr name="rnameShowRai" id='+response[res][2]+'>';
        trHTML += '<td> <a href="#">Raised for '+response[res][0]+' items</a></td><td>' + response[res][1] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalRaiRw').append(trHTML);
     }

     if(entity==='adRejPrIndent') 
     {
       $('#modalRejPr tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalRejPr').append(trHTML);
     }

     if(entity==='adRejFabIndent') 
     {
       $('#modalRejFab tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalRejFab').append(trHTML);
     }

     if(entity==='adRejRwIndent') 
     {
       $('#modalRejRw tr').remove();  
       var trHTML = '';   
      for(res=1;res<=Object.keys(response).length;res++)
      {
        trHTML += '<tr>';
        trHTML += '<td>' + response[res][0] + '</td><td>' + response[res][1] + '</td><td>' + response[res][2] + '</td>'+ '<td>' 
        + response[res][3] + '</td><td>' + response[res][4] + '</td><td>' + response[res][5] + '</td>';
        trHTML+='</tr>';
      }
       $('#modalRejRw').append(trHTML);
     }
    
  }
  });

  });

 $('tr[name="rnameShow"]').click(function(){
      var rawId=$(this).attr('id');
      var nextId=$(this).next();
      var nextTR= nextId[0].id;
      $('tbody').css({'border-top':'1px solid #ccc'});
      var rawString="";
       document.getElementById(nextTR).innerHTML="";

       $.ajax({
     type: 'post',
     dataType: "json",
     url: 'raw-material-list.php',
     data: {
      rIndentId:rawId
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


$('tr[name="rnameShowRai"]').click(function(){
      var rawId=$(this).attr('id');
      var nextId=$(this).next();
      var nextTR= nextId[0].id;
      $('tbody').css({'border-top':'1px solid #ccc'});
      var rawString="";
       document.getElementById(nextTR).innerHTML="";

       $.ajax({
     type: 'post',
     dataType: "json",
     url: 'raw-material-list.php',
     data: {
      rIndentId:rawId
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

$('tr[name="rnameShowRej"]').click(function(){
      var rawId=$(this).attr('id');
      var nextId=$(this).next();
      var nextTR= nextId[0].id;
      $('tbody').css({'border-top':'1px solid #ccc'});
      var rawString="";
       document.getElementById(nextTR).innerHTML="";

       $.ajax({
     type: 'post',
     dataType: "json",
     url: 'raw-material-list.php',
     data: {
      rIndentId:rawId
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

</script>

</body>

</html>
