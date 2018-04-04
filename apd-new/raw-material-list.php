 <?php
  include("database/db_conection.php");

  if(isset($_POST['get_option1'])){
                                                                  
   $myinfo=$_POST['get_option1'];
   //$_SESSION['selPId']=$myinfo;

   $result1=mysqli_query($dbcon,"SELECT r.R_Id,r.Quantity,r.Amount FROM raw_material_details r WHERE r.R_Id=$myinfo");

  if(mysqli_num_rows($result1) > 0){
    $i=1;
    $masterArray=array();
    $resultArray=array();
    $totalAmt=array();
   while($row1 = mysqli_fetch_array($result1)){
    $totalAmt[$i]=$row1['Quantity']*$row1['Amount'];
    $resultArray[$i] = array($row1['Quantity'],$row1['Amount'],$totalAmt[$i]);
    $i++;
    }
    //$masterArray=$resultArray;
    echo json_encode($resultArray);
}
}
   if(isset($_POST['selctedPId'])){

     $myinfo=$_POST['selctedPId'];

    $resultPro1=mysqli_query($dbcon,"select R_Id, R_Name, Quantity,Amount from raw_material_details where R_Id in (select R_Id from product_mapping_details 
                        where Product_Id in(select Product_Id from product_details where Product_Id='$myinfo'));");
     if(mysqli_num_rows($resultPro1) > 0){
      $i=1;
      $resultArray=array();
     while($rowPro1 = mysqli_fetch_array($resultPro1)){
      $resultArray[$i] = array($rowPro1['R_Name'],$rowPro1['Quantity'],$rowPro1['Amount']);
      $i++;
      }

       echo json_encode($resultArray);
     }    
    }

    if(isset($_POST['rawIdArray']) && !empty($_POST['sName']))
    {
      $rIdArray=$_POST['rawIdArray'];
      $rUnitArray=$_POST['rawUnitArray'];
      $sname=$_POST['sName'];
      $desc=$_POST['des'];
     
      $curr_date=date('Y/m/d');
      $rArray=[];

      $resultRawIndent="insert into raw_indent_table (Description,Units,State,User_Type,TechName,R_Ids,Raised_Date) 
        values ('$desc','$rUnitArray','Raised','Store Keeper','$sname','$rIdArray','$curr_date')";
      $rowRawIndent=mysqli_query($dbcon,$resultRawIndent);

      if($rowRawIndent===true)
      {
        echo "Indent raised";
      }
      else
      {
        echo "Failed";
      }
    }

    //for admin indent approve/reject
   if(isset($_POST['a_indent_id']) && !empty($_POST['a_indent_state']))
    {
     $a_state=$_POST['a_indent_state'];
    $a_indent_id=$_POST['a_indent_id'];
      $comment=$_POST['comment'];
    $app_date=date('Y/m/d');

    //$iArray=explode(",", $a_indent_id);

    if($a_state==='Approved'){
     
      
      $sqlquery1= "Update raw_indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where R_Indent_Id=$a_indent_id";
      $result3=mysqli_query($dbcon,$sqlquery1);      
   
    if($result3===true)
      {
        echo "Indent Approved";
      }
      else {
        echo "Failed";
    }

  }
    if($a_state==='Rejected'){

      
        $sqlqueryRej= "Update raw_indent_table set State='$a_state', User_Type='Admin',Comments='$comment',Approved_Date='$app_date' where R_Indent_Id=$a_indent_id";
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

if(isset($_POST['rIndentId']))
{
  $rawId=$_POST['rIndentId'];

   $rawIdArray=[];
      $rawUnitArray=[];
      $indentRaw=array();

      $resultRIdnent=mysqli_query($dbcon,"SELECT i.R_Indent_Id,i.Units,i.R_Ids FROM raw_indent_table i WHERE i.R_Indent_Id=$rawId");

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

// get raised raw material
   mysqli_close($dbcon);   
   ?>


