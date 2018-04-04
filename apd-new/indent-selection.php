 <?php
  include("database/db_conection.php");
   
   if(isset($_POST['get_option'])){
                                                                  
   $myinfo=$_POST['get_option'];
   $_SESSION['selId']=$myinfo;

    if($_POST['indent_type']==='product')
      {

        $result1=mysqli_query($dbcon,"SELECT i.Indent_Id,i.Description, i.Units,i.TechName,i.Raised_Date,i.Patient_Id,i.Product_Id,p.Patient_Name,p.Age,p.Disease FROM indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.Indent_Id=$myinfo");

        if(mysqli_num_rows($result1) > 0){
          $i=1;
         while($row1 = mysqli_fetch_array($result1)){
          $indents = array($row1['Units'],$row1['TechName'],$row1['Raised_Date'],$row1['Patient_Name'],$row1['Age'],$row1['Disease'],$row1['Product_Id'],$myinfo);
       
         echo json_encode($indents);
          $i++;
          }
      }
    }
     if($_POST['indent_type']==='prefabricated')
      {

        $resultpre=mysqli_query($dbcon,"SELECT i.Pre_Id,i.Description,i.Units,i.TechName,i.Raised_Date,i.Patient_Id,i.Name,p.Patient_Name,p.Age,p.Disease FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.Pre_Id=$myinfo");

        if(mysqli_num_rows($resultpre) > 0){
          $i=1;
         while($rowPre = mysqli_fetch_array($resultpre)){
          $indentsPre = array($rowPre['Units'],$rowPre['TechName'],$rowPre['Raised_Date'],$rowPre['Patient_Name'],$rowPre['Age'],$rowPre['Disease'],$rowPre['Name'],$myinfo);
       
         echo json_encode($indentsPre);
          $i++;
          }
      }
    }

    if($_POST['indent_type']==='rawmaterial_indent')
    {
      $rawIdArray=[];
      $rawUnitArray=[];
      $indentRaw=array();

      $resultRIdnent=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Units,i.R_Ids FROM raw_indent_table i WHERE i.R_Indent_Id=$myinfo");

        if(mysqli_num_rows($resultRIdnent) > 0){
          $i=1;
         while($rowRIndent = mysqli_fetch_array($resultRIdnent)){
           $rawIdArray=[];
          $rawUnitArray=[];

          $rawIdArray=explode(",", $rowRIndent['R_Ids']); 
           $rawUnitArray=explode(",", $rowRIndent['Units']); 

           $no = 1;
           $indentRaw=array();
           foreach ($rawIdArray as $line) {
            $rawId=(int)$line;
            $resultRawInd=mysqli_query($dbcon,"SELECT R_Name FROM raw_material_details WHERE R_Id=$rawId");
             while($rowRaw = mysqli_fetch_array($resultRawInd)){

               $indentRaw[$no] = array($rowRaw['R_Name'],$rawUnitArray[$no-1]);
               $no++;
             }
           }
  
          $i++;
          }

           echo json_encode($indentRaw);
      }
    }
  
  }

//for store keeper indent approve/reject
  if(isset($_POST['indent_id']) && !empty($_POST['indent_state']))
    {
     $state=$_POST['indent_state'];
    $indent_id=$_POST['indent_id'];
    $comment=$_POST['comment'];
    $app_date=date('Y/m/d');
    if($state==='Approved'){

       if($_POST['indent_type']==='product')
     {

      $sqlquery1= "Update indent_table set State='Approved', User_Type='Store Keeper',Comments='$comment',Approved_Date='$app_date' where Indent_Id=$indent_id";
      $result3=mysqli_query($dbcon,$sqlquery1);

      if($result3===true)
      {
        $resultArray=array();
        $resultArrayMap=array();
        $resultPrId="";
        $resultRawId="";
         $uQuan=0;
         $quanMsg="";

         $sqlqueryPid= "select Product_Id from indent_table where Indent_Id=$indent_id";
        $resultPid=mysqli_query($dbcon,$sqlqueryPid); 
        if(mysqli_num_rows($resultPid) > 0){
       while($rowPid = mysqli_fetch_array($resultPid)){

        $resultPrId=$rowPid['Product_Id'];
          $resultPro1=mysqli_query($dbcon,"select R_Id, R_Name, Quantity,Amount from raw_material_details where R_Id in (select R_Id from product_mapping_details 
                        where Product_Id in(select Product_Id from product_details where Product_Id='$resultPrId'));");
           if(mysqli_num_rows($resultPro1) > 0){
            $i=1;
            
           while($rowPro1 = mysqli_fetch_array($resultPro1)){
            $resultArray[$i] = array('RId'=>$rowPro1['R_Id'],'Quan'=>$rowPro1['Quantity'],'Amt'=>$rowPro1['Amount']);
            $i++;
            }
     }    
       }
     }

       $resultMp=mysqli_query($dbcon,"select R_Id, Product_Id,Map_Quantity from product_mapping_details where Product_Id='$resultPrId'");
           if(mysqli_num_rows($resultMp) > 0){
            $i1=1;
            
           while($rowMp = mysqli_fetch_array($resultMp)){
            $resultArrayMap[$i1] = array('MQuan'=>$rowMp['Map_Quantity']);
            $i1++;
            }
       }    
     

     for($data=1;$data<=count($resultArray);$data++){

      if($resultArray[$data]['Quan']<=$rowMp['Map_Quantity'])
      {
        $uQuan=0;
        $quanMsg="But some of the raw material(s) are not in stock,Please check.";
      }
      else
      {
        $uQuan=$resultArray[$data]['Quan']-$resultArrayMap[$data]['MQuan'];
      }
      
      //$amt=$uQuan*$resultArray[$data]['Amt'];
      $rid=$resultArray[$data]['RId'];

       $sqlqueryRaw= "Update raw_material_details set Quantity=$uQuan where R_Id=$rid";
        $resultraw=mysqli_query($dbcon,$sqlqueryRaw);
     }
        echo "Indent Approved, ".$quanMsg;
     }
     else {
        echo "Failed";
      }
    }

    if($_POST['indent_type']==='prefabricated')
     {
       $sqlqueryPre= "Update prefab_indent_table set State='Approved', User_Type='Store Keeper',Comments='$comment',Approved_Date='$app_date' where Pre_Id=$indent_id";
      $resultPre=mysqli_query($dbcon,$sqlqueryPre);

      if($resultPre===true)
      {
        echo "Indent Approved";
      }
      else {
        echo "Failed";
      }
     }
      }
      
    
    if($state==='Rejected'){
       if($_POST['indent_type']==='product')
     {
       $sqlqueryRej= "Update indent_table set State='Rejected', User_Type='Store Keeper',Comments='$comment',Approved_Date='$app_date' where Indent_Id=$indent_id";
     }
      if($_POST['indent_type']==='prefabricated')
     {
       $sqlqueryRej= "Update prefab_indent_table set State='Rejected', User_Type='Store Keeper',Comments='$comment',Approved_Date='$app_date' where Pre_Id=$indent_id";
     }

     
      $resultRej=mysqli_query($dbcon,$sqlqueryRej);

      if($resultRej===true)
      {
        echo "Indent rejected";
      }
      else {
        echo "Failed";
      }
    }
  }

//for admin indent approve/reject
   if(isset($_POST['a_indent_id']) && !empty($_POST['a_indent_state']))
    {
     $a_state=$_POST['a_indent_state'];
    $a_indent_id=$_POST['a_indent_id'];
      $comment=$_POST['comment'];
    $app_date=date('Y/m/d');

    if($a_state==='Approved'){
      
      if($_POST['indent_type']==='product')
      {
        $sqlquery1= "Update indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where Indent_Id=$a_indent_id";
        $result3=mysqli_query($dbcon,$sqlquery1);
         if($result3===true)
        {
          $resultArray=array();
        $resultArrayMap=array();
        $resultPrId="";
        $resultRawId="";
        $uQuan=0;
        $quanMsg="";

         $sqlqueryPid= "select Product_Id from indent_table where Indent_Id=$a_indent_id";
        $resultPid=mysqli_query($dbcon,$sqlqueryPid); 
        if(mysqli_num_rows($resultPid) > 0){
       while($rowPid = mysqli_fetch_array($resultPid)){

        $resultPrId=$rowPid['Product_Id'];
          $resultPro1=mysqli_query($dbcon,"select R_Id, R_Name, Quantity,Amount from raw_material_details where R_Id in (select R_Id from product_mapping_details 
                        where Product_Id in(select Product_Id from product_details where Product_Id='$resultPrId'));");
           if(mysqli_num_rows($resultPro1) > 0){
            $i=1;
            
           while($rowPro1 = mysqli_fetch_array($resultPro1)){
            $resultArray[$i] = array('RId'=>$rowPro1['R_Id'],'Quan'=>$rowPro1['Quantity'],'Amt'=>$rowPro1['Amount']);
            $i++;
            }
     }    
       }
     }

       $resultMp=mysqli_query($dbcon,"select R_Id, Product_Id,Map_Quantity from product_mapping_details where Product_Id='$resultPrId'");
           if(mysqli_num_rows($resultMp) > 0){
            $i1=1;
            
           while($rowMp = mysqli_fetch_array($resultMp)){
            $resultArrayMap[$i1] = array('MQuan'=>$rowMp['Map_Quantity']);
            $i1++;
            }
       }    
     

     for($data=1;$data<=count($resultArray);$data++){
      if($resultArray[$data]['Quan']<=$rowMp['Map_Quantity']){
         $uQuan=0;
         $quanMsg="But some of the raw material(s) are not in stock,Please check.";
      }
      else
      {
        $uQuan=$resultArray[$data]['Quan']-$resultArrayMap[$data]['MQuan'];
      }
      
      //$amt=$uQuan*$resultArray[$data]['Amt'];
      $rid=$resultArray[$data]['RId'];

       $sqlqueryRaw= "Update raw_material_details set Quantity=$uQuan where R_Id=$rid";
        $resultraw=mysqli_query($dbcon,$sqlqueryRaw);
     }
        echo "Indent Approved, ".$quanMsg;
        }
        else {
          echo "Failed";
        }
      }

      
      if($_POST['indent_type']==='prefabricated')
      {
        $sqlqueryPre= "Update prefab_indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where Pre_Id=$a_indent_id";
         $resultPre=mysqli_query($dbcon,$sqlqueryPre);

      if($resultPre===true)
      {
        echo "Indent Approved";
      }
      else {
        echo "Failed";
       }
      }
      if($_POST['indent_type']==='rawmaterial')
      {
        $sqlquery1= "Update raw_indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where R_Indent_Id=$a_indent_id";
        $resultPre=mysqli_query($dbcon,$sqlqueryPre);

      if($resultPre===true)
      {
        echo "Indent Approved";
      }
      else {
        echo "Failed";
       }
      }
    }
     
    if($a_state==='Rejected'){

      if($_POST['indent_type']==='product')
      {
       $sqlqueryRej= "Update indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where Indent_Id=$a_indent_id";
      }
       if($_POST['indent_type']==='prefabricated')
      {
       $sqlqueryRej= "Update prefab_indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where Pre_Id=$a_indent_id";
      }
       if($_POST['indent_type']==='rawmaterial')
      {
       $sqlqueryRej= "Update raw_indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where R_Indent_Id=$a_indent_id";
      }
      $resultRej=mysqli_query($dbcon,$sqlqueryRej);

      if($resultRej===true)
      {
        echo "Indent rejected";
      }
      else {
        echo "Failed";
      }
    }
  }

  if(isset($_POST['get_image'])){
                                                                  
   $myinfo=$_POST['get_image'];
   $_SESSION['selId']=$myinfo;

  
    $resultImage=mysqli_query($dbcon,"select Product_Path from product_details where Product_Id='$myinfo'");
    while($rowImage = mysqli_fetch_array($resultImage)){
      $pImage=$rowImage['Product_Path'];
      //echo "Selected".$pImage;
      echo $pImage;
    }
  
  }

    if(isset($_POST['p_id']))
    {
   
    $p_total=0;

    $pr_id=$_POST['p_id'];
    $p_name=$_POST['pi_name'];
    $p_age=$_POST['age'];
    // $p_disease=$_POST['reason'];
    // $indent_des=$_POST['comm'];
     $indent_units=$_POST['unit'];
    $p_addd=$_POST['add'];
    $p_camp=$_POST['cmp'];
    $tName=$_POST['techName'];

     $curr_date=date('Y/m/d');
    $pt_id=0;

      $result=mysqli_query($dbcon,"select Count(Patient_Id) as total from patient_details");
      while($row=mysqli_fetch_assoc($result))
      {
        $p_total=$row['total'];
      }                                          

      $sqlquery="insert into patient_details (Patient_Id, Patient_Name, Age) 
        values ($p_total+1,'$p_name',$p_age)";

      $result1=mysqli_query($dbcon,$sqlquery);

      $result2= mysqli_query($dbcon,"select Patient_Id from patient_details where Patient_Name='$p_name'");
        while($row1 = mysqli_fetch_array($result2)){
          $pt_id=$row1['Patient_Id'];
        }

      if($_POST['indent_type']==='Product')
      {
        $sqlquery1= "insert into indent_table (Units,State, User_Type,TechName, Product_Id, Raised_Date, Patient_Id,Camp_Name) 
        values ('$indent_units','Raised','Field Technician','$tName','$pr_id','$curr_date',$pt_id,'$p_camp')";
      }

      if($_POST['indent_type']==='Prefabricated')
      {
        $sqlquery1= "insert into prefab_indent_table (Units,State, User_Type,TechName, Name, Raised_Date, Patient_Id,Camp_Name) 
         values ('$indent_units','Raised','Field Technician','$tName','$pr_id','$curr_date',$pt_id,'$p_camp')";
      }
      $result3=mysqli_query($dbcon,$sqlquery1);

      if($result3===true)
      {
        echo "Indent Raised";
      }
      else {
        echo "failed";
      }
    }


    //raw material quantity update

    if(isset($_POST['r_id']))
    {
     
    $raw_upquan=$_POST['up_quan'];
    $raw_upamt=$_POST['up_amt'];
     $raw_prquan=$_POST['pr_quan'];
    $raw_pramt=$_POST['pr_amt'];
    $raw_id=$_POST['r_id'];

     $total_quantity=($raw_prquan)+($raw_upquan);
     $total_amount=($raw_pramt)+($raw_upamt);

      $sqlquery1= "Update raw_material_details set Quantity=$total_quantity, Amount=$total_amount where R_Id=$raw_id";
      $result3=mysqli_query($dbcon,$sqlquery1);

      if($result3===true)
      {
        echo "Record Updated";
      }
      else {
        echo "failed";
      }
    }

     if(isset($_POST['prdIndentId'])){
                                                                  
       $prId=$_POST['prdIndentId'];

        if($_POST['indent_type']==='product')
          {

        $resultEditPr=mysqli_query($dbcon,"SELECT i.Indent_Id,i.Units,i.Patient_Id,i.Product_Id,i.Camp_Name,p.Patient_Name,p.Age,p.Address,pr.Product_Name 
          FROM indent_table i, patient_details p,product_details pr WHERE i.Patient_Id=p.Patient_Id and i.Product_Id=pr.Product_Id and i.Indent_Id=$prId");

        if(mysqli_num_rows($resultEditPr) > 0){
          $i=1;
         while($rowEditPr = mysqli_fetch_array($resultEditPr)){
          $indentsEdit = array($rowEditPr['Product_Name'],$rowEditPr['Units'],$rowEditPr['Camp_Name'],$rowEditPr['Patient_Name'],$rowEditPr['Age'],$rowEditPr['Address'],$rowEditPr['Patient_Id'],$prId);
       
         echo json_encode($indentsEdit);
          $i++;
          }
      }
    }
     if($_POST['indent_type']==='prefabricated')
      {

         $resultEditFab=mysqli_query($dbcon,"SELECT i.Pre_Id,i.Units,i.Patient_Id,i.Name,i.Camp_Name,p.Patient_Name,p.Age,p.Address
          FROM prefab_indent_table i, patient_details p WHERE i.Patient_Id=p.Patient_Id and i.Pre_Id=$prId");

        if(mysqli_num_rows($resultEditFab) > 0){
          $i=1;
         while($rowEditFab = mysqli_fetch_array($resultEditFab)){
          $indentsEditFab = array($rowEditFab['Name'],$rowEditFab['Units'],$rowEditFab['Camp_Name'],$rowEditFab['Patient_Name'],$rowEditFab['Age'],$rowEditFab['Address'],$rowEditFab['Patient_Id'],$prId);
       
         echo json_encode($indentsEditFab);
          $i++;
          }
      }
  }
}

  if(isset($_POST['prInId']))
  {
    $prId=$_POST['prInId'];
    $patId=$_POST['ptId'];
    $prUnit=$_POST['prInUnit'];
     $prCamp= $_POST['prInCamp'];
     $prName= $_POST['prInName'];
     $prAge=$_POST['prInAge'];
     $prAdd=$_POST['prInAddress'];
      $curr_date=date('Y/m/d');

    if($_POST['indent_type']==='product')
      {
      $sqlqueryEdit= "Update indent_table i,patient_details p set i.Units='$prUnit',i.Camp_Name='$prCamp',i.Raised_Date='$curr_date',p.Patient_Name='$prName',p.Age=$prAge,p.Address='$prAdd' 
      where i.Indent_Id=$prId and p.Patient_Id=$patId";
        $resultEdit=mysqli_query($dbcon,$sqlqueryEdit);
         if($resultEdit===true)
        {
         echo "Record Updated";
      }
      else {
        echo "failed";
      }
    }

    if($_POST['indent_type']==='prefabricated')
      {
      $sqlqueryEditFab= "Update prefab_indent_table i,patient_details p set i.Units='$prUnit',i.Camp_Name='$prCamp',i.Raised_Date='$curr_date',p.Patient_Name='$prName',p.Age=$prAge,p.Address='$prAdd' 
      where i.Pre_Id=$prId and p.Patient_Id=$patId";
        $resultEditFab=mysqli_query($dbcon,$sqlqueryEditFab);
         if($resultEditFab===true)
        {
         echo "Record Updated";
      }
      else {
        echo "failed";
      }
    }
  }
  
     mysqli_close($dbcon);
   ?>
