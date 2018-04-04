<?php
$servername = "localhost";
$username = "root";  //your user name for php my admin if in local most probaly it will be "root"
$password = "";  //password probably it will be empty
$databasename = "apd"; //Your db nane
// Create connection
$conn = new mysqli($servername, $username, $password,$databasename);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$result=mysqli_query($conn,"select Count(Product_Id) as total from product_details");

echo "<br />\n";

echo "query executed";
echo "<br />\n";
 while($row=mysqli_fetch_assoc($result))
  {
        echo $row['total'];
  }     
  
  echo "<br />\n";
  
  $result1=mysqli_query($conn,"select * from indent_table");
  if(mysqli_num_rows($result1) > 0){
	  while($row1 = mysqli_fetch_array($result1)){
		  echo $row1['Indent_Id'];
		  echo "  ";
		  echo $row1['Description'];
		  echo "  ";
		  echo $row1['State'];
		  echo "<br />\n";
	  }
  }

  $result2=mysqli_query($conn,"select * from users WHERE User_Name='Admin' AND Password='Admin123*'");
  if(mysqli_num_rows($result2)){
    while($row2 = mysqli_fetch_array($result2)){
      echo $row2['User_Type'];  
      $user_type=$row2['User_Type'];
      echo $user_type;
      if($user_type='Admin')
      {
      	echo "hi";
      }
    }
  }

?>