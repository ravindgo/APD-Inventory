 <?php
  include("database/db_conection.php");
   
   if(isset($_POST['fIndentPage'])){

    $limit=10;
     $page=$_POST['fIndentPage'];
      $start_from = ($page-1) * $limit;  
    
     if($_POST['indent_type']==='fieldRequestPr'){
      
      $result3=mysqli_query($dbcon,"SELECT i.Indent_Id, i.Description, i.Units, i.State, i.Product_Id, i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.TechName,i.Camp_Name,p.Patient_Name FROM indent_table i,
      patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Raised' LIMIT $start_from,$limit");
     if(mysqli_num_rows($result3) > 0){
      $i=1;
       $resultArray2=array();
     while($row3 = mysqli_fetch_array($result3)){

       $Pr_Name3="";

      if($row3['Product_Id']!==null){
        $selPId3=$row3['Product_Id'];
        $resultPrName3=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId3'");
        
          while($rowPrName3 = mysqli_fetch_assoc($resultPrName3)){
            $Pr_Name3=$rowPrName3['Product_Name'];
          }
        
      }
      $resultArray2[$i] = array($Pr_Name3,$row3['Units'],$row3['TechName'],$row3['Raised_Date'],$row3['Camp_Name'],$row3['Patient_Name']);
       $i++;
      }
      echo json_encode($resultArray2);
    }
  }

     if($_POST['indent_type']==='fieldRequestFab')
     {
      $result4=mysqli_query($dbcon,"SELECT i.Pre_Id,i.Description, i.Units, i.State,i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.TechName,i.Camp_Name,p.Patient_Name FROM prefab_indent_table i,
          patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Raised' LIMIT $start_from,$limit");
         if(mysqli_num_rows($result4) > 0){
          $i=1;
           $resultArray4=array();
         while($row4 = mysqli_fetch_array($result4)){

          $resultArray4[$i] = array($row4['Name'],$row4['Units'],$row4['TechName'],$row4['Raised_Date'],$row4['Camp_Name'],$row4['Patient_Name']);
           $i++;
          }
          echo json_encode($resultArray4);
        }
     }

      if($_POST['indent_type']==='fieldAppPr')
      {
          $result5=mysqli_query($dbcon,"SELECT i.Description, i.Units, i.State, i.Product_Id, i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i,
        patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Approved' LIMIT $start_from,$limit");
       if(mysqli_num_rows($result5) > 0){
        $i=1;
         $resultArray5=array();
       while($row5 = mysqli_fetch_array($result5)){

         $Pr_Name5="";

        if($row5['Product_Id']!==null){
          $selPId5=$row5['Product_Id'];
          $resultPrName5=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId5'");
          
            while($rowPrName5 = mysqli_fetch_assoc($resultPrName5)){
              $Pr_Name5=$rowPrName5['Product_Name'];
            }
          
        }
        $resultArray5[$i] = array($Pr_Name5,$row5['Units'],$row5['User_Type'],$row5['Raised_Date'],$row5['Approved_Date'],$row5['Camp_Name'],$row5['Patient_Name']);
         $i++;
        }
        echo json_encode($resultArray5);
      }
  }
      if($_POST['indent_type']==='fieldAppFab')
      {
      $result6=mysqli_query($dbcon,"SELECT i.Description, i.Units, i.State,i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM prefab_indent_table i,
          patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Approved' LIMIT $start_from,$limit");
         if(mysqli_num_rows($result6) > 0){
          $i=1;
           $resultArray6=array();
         while($row6 = mysqli_fetch_array($result6)){

          $resultArray6[$i] = array($row6['Name'],$row6['Units'],$row6['User_Type'],$row6['Raised_Date'],$row6['Approved_Date'],$row6['Camp_Name'],$row6['Patient_Name']);
           $i++;
          }
          echo json_encode($resultArray6);
        }
     }
      if($_POST['indent_type']==='fieldRejPr')
      {
      $result7=mysqli_query($dbcon,"SELECT i.Description, i.Units, i.State, i.Product_Id, i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM indent_table i,
        patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Rejected' LIMIT $start_from,$limit");
       if(mysqli_num_rows($result7) > 0){
        $i=1;
         $resultArray7=array();
       while($row7 = mysqli_fetch_array($result7)){

         $Pr_Name7="";

        if($row7['Product_Id']!==null){
          $selPId7=$row7['Product_Id'];
          $resultPrName7=mysqli_query($dbcon,"SELECT Product_Id,Product_Name from product_details where Product_Id='$selPId7'");
          
            while($rowPrName7 = mysqli_fetch_assoc($resultPrName7)){
              $Pr_Name7=$rowPrName7['Product_Name'];
            }
          
        }
        $resultArray7[$i] = array($Pr_Name7,$row7['Units'],$row7['User_Type'],$row7['Raised_Date'],$row7['Approved_Date'],$row7['Camp_Name'],$row7['Patient_Name']);
         $i++;
        }
        echo json_encode($resultArray7);
      }
     }
      if($_POST['indent_type']==='fieldRejFab')
      {
     $result8=mysqli_query($dbcon,"SELECT i.Description, i.Units, i.State,i.Name,i.Raised_Date, i.Approved_Date, i.Patient_Id,i.User_Type,i.Camp_Name,p.Patient_Name FROM prefab_indent_table i,
          patient_details p WHERE i.Patient_Id=p.Patient_Id and i.State='Rejected' LIMIT $start_from,$limit");
         if(mysqli_num_rows($result8) > 0){
          $i=1;
           $resultArray8=array();
         while($row8 = mysqli_fetch_array($result8)){

          $resultArray8[$i] = array($row8['Name'],$row8['Units'],$row8['User_Type'],$row8['Raised_Date'],$row8['Approved_Date'],$row8['Camp_Name'],$row8['Patient_Name']);
           $i++;
          }
          echo json_encode($resultArray8);
        }
     }

     if($_POST['indent_type']==='rawMat')
     {
       
         $result9=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Description,i.Raised_Date,i.State,i.Approved_Date,i.User_Type 
        FROM raw_indent_table i LIMIT $start_from,$limit");
         if(mysqli_num_rows($result9) > 0){
          $i=1;
           $resultArray9=array();
         while($row9 = mysqli_fetch_array($result9)){

          $resultArray9[$i] = array($row9['Description'],$row9['R_Indent_Id'],$row9['User_Type'],$row9['State'],$row9['Raised_Date'],$row9['Approved_Date']);
           $i++;
          }
          echo json_encode($resultArray9);
        }
     }                                                                  
}
     mysqli_close($dbcon);
   ?>
