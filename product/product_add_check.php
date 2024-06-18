<?php
session_start();
if(isset($_SESSION['login'] )== false){

print 'ログインできません<br/>';
print'<a href = "../staff_login/staff_login.html">ログイン画面へ<a>';
exit();

}else{

print 'No'.$_SESSION['staffCode'].' '.$_SESSION['staffName'].'<br/>' ;

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

    <?php
    
    require_once('../common/common.php');
    $productinfo = array('name'=>$_POST['name'] ,'price'=>$_POST['price']);
    $productinfo =  sanitize($productinfo);
    $product_img = $_FILES['img'];

    if($product_img['size'] > 0){
     
        if($product_img['size'] >1000000){
    
            print '画像が大きすぎます';
         
         }else{
            move_uploaded_file($product_img['tmp_name'],'./img/'.$product_img['name']);
           
            print '<img src = "./img/'.$product_img['name'].'">'; 
            print'<br/>';                                                       //name tmp_nameはFILESのフィールド
    
          }
    
    } 
    
    
    if( $productinfo['name'] == '')
    {
        print'商品名が入力されてません <br />';
    }else {
    
    
        print'商品名:';
        print  $productinfo['name'] ;
        print'<br />';
    }
  
  
  
         
    
    if(preg_match('/\A[0-9]+\z/', $productinfo['price'])== 0)
    {
        print'価格が入力されていないか間違っています';
    
    }else {
  
    
    
        print'価格:';
        print $productinfo['price'];
        print'<br />';
    
  
     
     
     }
    
    if($productinfo['name']==''|| preg_match('/\A[0-9]+\z/',$productinfo['price'])== 0)
    {
        print'<form>';
        print'<input type="button" onclick="history.back()" value="戻る">';
            print'</form>';
    }
    else
    {
        print'この商品を追加します';
        print'<form method="post" action="product_add_done.php">';
        print'<input type="hidden" name="name" value="'.$productinfo['name'].'">';
        print'<input type="hidden" name="price" value="'.$productinfo['price'].'">';
        print'<input type="hidden" name="img" value="'.$product_img['name'].'">';      //nameフィールド
        print'<br />';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input type="submit" value="OK">';
        print'</form>';
    }   
    
    
    ?>
</body>
</html>
