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
                      <li><h4 class="task-card-title" style="padding: 0px 0px 0px 25px; color: white;">APD</h4></li>
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
                          <!--   <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
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
                                   <li><a href="new-raw-materials.php">Raw Materials Form</a></li>
                                    <li class="active"><a href="indent-approve-form.php">Product Indent Form</a></li>
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
                                <form class="formValidate" id="formValidate" method="post" action="">
                                  <div class="row">                                       
                                          <div class="col s12">
                                            <label for="crole">Indent Details *</label>
                                            <?php 
                                              include("database/db_conection.php");

                                              $result=mysqli_query($dbcon,"SELECT i.Indent_Id,i.Product_Id,i.Name,pt.Patient_Name,p.Product_Name FROM indent_table i, patient_details pt,product_details p WHERE i.Patient_Id=pt.Patient_Id and i.Product_Id=p.Product_Id and i.User_Type='Field Technician' and i.State='Raised'");
                                               $option='';
                                               while($row = mysqli_fetch_array($result)){
                                                  $option.='<option value ="'.$row['Indent_Id'].'">'.$row['Product_Name'].'</option>';


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
                                                                 
                                                                                                      
                                  <!--       <div class="input-field col s12">
                                            <textarea rows="2" id="ides" name="indentdes" placeholder="Indent Description" readonly class="materialize-textarea" data-error=".errorTxt7"></textarea>
                                            <label class="active" for="ides">Indent Description</label>
                                        </div> -->
                                      <!--   <div class="input-field col s12">
                                            <label class="active" for="unit">No of Units</label>
                                            <input id="unit" readonly type="text" placeholder="No of Units" name="units" data-error=".errorTxt2">
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
                                          <input id="rdate" readonly type="text" placeholder="Indent Raised" name="p_add">
                                          <label class="active" for="rdate">Indent Raised</label>
                                      </div>       
                                        <div class="input-field col s12">
                                          <input id="pname" readonly type="text" placeholder="Name" name="p_name">
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
                                             <button class="btn waves-effect waves-light left submit" id="btnReject">Reject
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>

                                        <div class="input-field col s6">
                                            <button class="btn waves-effect waves-light right submit" id="btnApprove">Approve
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                           
                                        </div>
                                     <!--  <div class="input-field col s6">
                                             <button class="btn waves-effect waves-light left submit" type="submit" value="actionRej" name="actionReject" onclick="submit_indent('Reject',$_SESSION['selId']);
                                             return false;">Reject
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>

                                        <div class="input-field col s6">
                                            <button class="btn waves-effect waves-light right submit" type="submit" value="actionApp" name="actionApprove" onclick="submit_indent('Approve',$_SESSION['selId']);
                                            return false;">Approve
                                              <i class="mdi-content-send right"></i>
                                            </button>
                                           
                                        </div> -->
                                         
                                    </div>
                                    </form>

                                  </div>
                        </div>
                  </div>

                  <div class="col s12 m12 l6">
                                 
                        <ul class="collapsible collapsible-accordion" data-collapsible1="accordion">
                          <li>
                            <div class="collapsible-header active"><i class="mdi-communication-live-help"></i> Raw Materials Details</div>
                            <div class="collapsible-body" style="">
                           <table>
                             <thead>
                               <th>Name</th>
                               <th>Quantity</th>
                               <th>Rate</th>
                             </thead>
                             <tbody id="iform_tbody">
                               
                             </tbody>
                           </table>
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
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 dataType: "json",
 url: 'indent-selection.php',
 data: {
  get_option:val,
  indent_type:'product'
 },
 success: function (response) {      

  document.getElementById("unit").innerHTML=response[0]; 
  //document.getElementById("unit").value=response[1]; 
  document.getElementById("fname").value=response[1]
  document.getElementById("rdate").value=response[2]; 
  document.getElementById("pname").value=response[3]; 
  document.getElementById("age").value=response[4]; 
  //document.getElementById("dis").innerHTML=response[5]; 
  

    $.ajax({
     type: 'post',
     dataType: "json",
     url: 'raw-material-list.php',
     data: {
      selctedPId:response[6]
     },
     success: function (response1) {   
       $('#iform_tbody').empty();
      $.each(response1
        , function(i, item) {
        //for(var r=0;r<item.length;r++){
          var trHTML = '';    
          trHTML += '<tr><td>' + item[0] + '</td><td>' + item[1] + '</td><td>' + item[2] + '</td></tr>';
         
          $('#iform_tbody').append(trHTML);
       // }   
      });
     }
     });

 }
 });
}
</script>

<script type="text/javascript">

    $('#btnApprove').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      indent_id:$("#plist1").val(),
      indent_state:'Approved',
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

    $('#btnReject').click(function(e)
    {
       e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'indent-selection.php',
     data: {
      indent_id:$("#plist1").val(),
      indent_state:'Rejected',
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
  
    // if(isset($_POST['actionApprove']))
    // {
     
    // $indent_id=$_SESSION['selId'];
    // $u_type=$_SESSION['user_type_Store'];

    // echo "<script>alert($indent_id)</script>";

    //   $sqlquery1= "Update indent_table set State='Approved', User_Type='Store Keeper' where Indent_Id=$indent_id";
    //   $result3=mysqli_query($dbcon,$sqlquery1);

    //   if($result3===true)
    //   {
    //     echo "<script>alert('Record approved')</script>";
    //   }
    //   else {
    //     echo "<script>alert('failed')</script>";
    //   }
    // }

    // if(isset($_POST['actionReject']))
    // {
     
    // $indent_id1=$_SESSION['selId'];
    // $u_type=$_SESSION['user_type_Store'];

    //  echo "<script>alert($u_type)</script>";

    //   $sqlqueryRej= "Update indent_table set State='Rejected', User_Type='Store Keeper' where Indent_Id=$indent_id1";
    //   $resultRej=mysqli_query($dbcon,$sqlqueryRej);

    //   if($resultRej===true)
    //   {
    //     echo "<script>alert('Record rejected.')</script>";
    //   }
    //   else {
    //     echo "<script>alert('failed')</script>";
    //   }
    // }
    ?> -->