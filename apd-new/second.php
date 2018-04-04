<?php
$option = isset($_POST['select_value']) ? $_POST['select_value'] : false;
   if($option) {
      echo $_POST['select_value'];
   } else {
     echo "not getting value of select option";
     exit; 
   }
?>