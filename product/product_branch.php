
<?php
session_start();
if(isset($_SESSION['login'] )== false){

print 'ログインできません<br/>';
print'<a href = "../staff_login/staff_login.html">ログイン画面へ<a>';
exit();

}
?>
<script>

<?php





if(isset($_POST['disp']) ==  true ) {
    
    if(isset($_POST['productcode'] ) == false){
        
        header('Location:productng.php?productcode='.$productcode);  
        exit(); 
    }
    
     $productcode = $_POST['productcode'];
      header('Location:product_disp.php?productcode='.$productcode);
      exit(); 
      
 }                            
   
 




if(isset($_POST['edit']) ==  true ) {
    
    if(isset($_POST['productcode'] ) == false){
        
       header('Location:productng.php?prductcode='.$productcode);   
        exit(); 
    }
    
      $productcode = $_POST['productcode'];
      header('Location:product_edit.php?productcode='.$productcode);
      exit(); 
      
 }                            
   
 

     

if(isset($_POST['del']) ==  true  ) {
    
     if(isset($_POST['productcode'] ) == false){
        
         header('Location:productng.php?productcode='.$productcode);   
        exit(); 
      }
    
   
    
     $productcode = $_POST['productcode'];
      header('Location:product_delete.php?productcode='.$productcode);
      exit(); 
      
    
  
 
 
 }


if(isset($_POST['add']) == true){

     
     $productcode = $_POST['productcode'];
     header('Location:product_add.php?productcode='.$productcode);
     exit();



}

 
?>  

/*

  const confirmation = window.document.getElementById('confirmation');
     
     confirmation.addEventlistenner('click',function(){
        if(window.confirm('削除確認画面に進みます')==true) {}
     
     });                           
*/                   
<script>
