<?php
    include("database/db_conection.php");
  
    if(isset($_POST['units'])&&!empty($_POST['desc'])&&!empty($_POST['name'])&&!empty($_POST['page'])&&!empty($_POST['padd'])&&!empty($_POST['preas']))
    {
     
    $var1=$_SESSION["selietm"];

    $p_total=0;
    $p_name=$_POST['p_name'];
    $p_age=$_POST['p_age'];
    $p_disease=$_POST['p_reason'];
    $indent_des=$_POST['indentdes'];
    $indent_units=$_POST['units'];
    $curr_date=date('Y/m/d');
    $p_id=0;

      $result=mysqli_query($dbcon,"select Count(Patient_Id) as total from patient_details");
      while($row=mysqli_fetch_assoc($result))
      {
        $p_total=$row['total'];
      }                                          

      $sqlquery="insert into patient_details (Patient_Id, Patient_Name, Age, Disease) 
        values ($p_total+1,'$p_name',$p_age,'$p_disease')";

      $result1=mysqli_query($dbcon,$sqlquery);

      $result2= mysqli_query($dbcon,"select Patient_Id from patient_details where Patient_Name='$p_name'");
        while($row1 = mysqli_fetch_array($result2)){
          $p_id=$row1['Patient_Id'];
        }

        echo "<script>alert($p_id)</script>";

      $sqlquery1= "insert into indent_table (Description, Units, State, User_Type, Name, Raised_Date, Patient_Id) 
        values ('$indent_des',$indent_units,'Raised','Field Technician','$var1','$curr_date',$p_id)";
      $result3=mysqli_query($dbcon,$sqlquery1);

      if($result3===true)
      {
        echo "<script>alert('Indent raised for pre fabricated entity')</script>";
      }
      else {
        echo "<script>alert('failed')</script>";
      }    
    }
     exit();
    mysqli_close($dbcon);
    ?>