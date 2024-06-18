<?php
session_start();
  
if(isset($_SESSION['login'] )== false){
print 'ログインできません<br/>';
print'<a href = "../staff_login/staff_login.html">ログイン画面へ<a>';
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
</head>
<body>




  <?php
    if(isset($_POST['disp']) ==  true ) {
      
      if(isset($_POST['staffcode'] ) == false){
        header('Location:staffng.php?staffcode='.$staffCode);  
        exit(); 
      }
   
      
      $staffCode = $_POST['staffcode'];
      header('Location:staff_disp.php?staffcode='.$staffCode); 
      exit();
    
    }
    
    if(isset($_POST['edit']) ==  true ) {
      if(isset($_POST['staffcode'] ) == false){
        header('Location:staffng.php?staffcode='.$staffCode);  
        exit(); 
      }

    
      $staffCode = $_POST['staffcode'];
      header('Location:staff_edit.php?staffcode='.$staffCode); 
      exit(); 
    }
    
    
    if(isset($_POST['del']) ==  true  ) {
    
     if(isset($_POST['staffcode'] ) == false){
        
        header('Location:staffng.php?staffcode='.$staffCode);  
        exit(); 
      }
    
      
      $staffCode = $_POST['staffcode'];
      header('Location:staff_delete.php?staffcode='.$staffCode); 
      exit();
    }
    
    if(isset($_POST['add']) == true){
      $staffCode = $_POST['staffcode'];
      header('Location:staff_add.php?staffcode='.$staffCode);
      exit();
    }

  ?>

</body>
</html>
