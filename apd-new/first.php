<html>
<body>
<form method="post" action="first.php">

<?php
//connect to server

    include("database/db_conection.php");

                      $result=mysqli_query($dbcon,"select Product_Id,Product_Name from product_details");
                       $option='';
                       while($row = mysqli_fetch_array($result)){
                          $option.='<option value ="'.$row['Product_Id'].'">'.$row['Product_Name'].'</option>';
                      }             
                 
                    ?>
                     <Select name="select_value" onchange="this.form.submit()">
                       <option value="0">Please Select</option>
                         <?php echo $option;?>
                    
</Select>



                   

</form>

<div>
<?php
$option = isset($_POST['select_value']) ? $_POST['select_value'] : false;
   if($option) {
      echo $_POST['select_value'];
   } else {
     echo "not getting value of select option";
     exit; 
   }
?>
</div>
</body>
</html>