 <?php
  include("database/db_conection.php");
   
   if(isset($_POST['get_option'])){
                                                                  
   $myinfo=$_POST['get_option'];
   $_SESSION['selId']=$myinfo;

  $result1=mysqli_query($dbcon,"SELECT i.Indent_Id,i.Description, i.Units,i.Raised_Date,i.Patient_Id,p.Patient_Name,p.Age,p.Disease FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.Indent_Id=$myinfo");

  if(mysqli_num_rows($result1) > 0){
    $i=1;
   while($row1 = mysqli_fetch_array($result1)){
    $indents = array($row1['Description'],$row1['Units'],$row1['Raised_Date'],$row1['Patient_Name'],$row1['Age'],$row1['Disease'],$myinfo);
 
   echo json_encode($indents);
    $i++;
    }
}
   mysqli_close($dbcon);
  }
   ?>
