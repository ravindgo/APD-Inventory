 <?php
  include("database/db_conection.php");
   
   if(isset($_POST['userType'])){
                                                                  
   $myinfo=$_POST['userType'];

 $result=mysqli_query($dbcon,"select User_Id,User_Name,Email from users where User_Name='$myinfo'");
   if(mysqli_num_rows($result) > 0){
    $i=1;
   while($row = mysqli_fetch_array($result)){  

    $users=array($row['User_Id'],$row['User_Name'],$row['Email']);
     echo json_encode($users);
     $i++;
    }
  }
  }


//update user profile
   if(isset($_POST['uId']))
    {
      if((!empty($_POST['uNewPass'])) && (!empty($_POST['uCnfPass'])))
      {
        if($_POST['uNewPass'] == $_POST['uCnfPass'])
        {
          $uid=$_POST['uId'];
          $password=$_POST['uNewPass'];
        $sqlquery1= "Update users set Password='$password' where User_Id=$uid";
      $result3=mysqli_query($dbcon,$sqlquery1);

      if($result3===true)
      {
        echo "Password changed successfully";
      }
      else {
        echo "Failed";
      }
    }
    else
    {
      echo "Password is not matching";
    }
    }
    else
    {
      echo "Please enter the password";
    }     
   }

   if(isset($_POST['userId']))
   {
     $id=$_POST['userId'];

      $sqlQueryDel="delete from users where User_Id=$id";
      $resultDel=mysqli_query($dbcon,$sqlQueryDel);

      if($resultDel===true)
      {
        echo "User deleted successfully.";
      }
      else {
        echo "Failed";
      }
   }

  mysqli_close($dbcon);
   ?>