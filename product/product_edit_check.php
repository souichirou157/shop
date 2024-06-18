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
 $productinfo = array('code'=>$_POST['code'] ,'name'=>$_POST['name'],'price'=>$_POST['price']);
 $productinfo =  sanitize($productinfo);

$before_img  = $_POST['oldimg'];//古い画像    
$product_newimg = $_FILES['img']; //新しい画像



    
    
    
     if($product_newimg['size'] > 0){
        if($product_newimg['size'] >1000000){
            
            print '画像が大きすぎます';
         
         }else{
         
            move_uploaded_file($product_newimg['tmp_name'],'./img/'.$product_newimg['name']);
            
            //画像サイズに問題なければこのぺーじで画像がアップロードされる
           
            print '<img src = "./img/'.$product_newimg['name'].'">'; 
            print'<br/>';
            print$product_newimg['tmp_name'];                                                      //name tmp_nameはFILESのフィールド
    
          }
    
    } 
    
    
    
    if($productinfo['name'] == '')
    {
        print'商品名が入力されてません　<br />';
    
    }else {
    
        print'商品名:';
        print $productinfo['name'];
        print'<br />';
    }
  
  
  
         
    
    if(preg_match('/\A[0-9]+\z/',$productinfo['price'])== 0|| $product_newimg['size'] >1000000)
    {
               print'間違っています';
       
     }else {
  
    
    
        print'価格:';
        print $productinfo['price'];
        print'<br />';
    
  
     
     
     } 
     
    
    
    if($productinfo['name']==''|| preg_match('/\A[0-9]+\z/',$productinfo['price'])== 0|| $product_newimg['size'] > 1000000)
    {
        print'<form>';
        print'<input type="button" onclick="history.back()" value="戻る">';
            print'</form>';
    }
    else
    {
        print'この商品を追加します';
        print'<form method="post" action="product_edit_done.php">'; 
        print'<input type="hidden" name="code" value="'.$productinfo['code'].'">';
        print'<input type="hidden" name="name" value="'.$productinfo['name'].'">';
        print'<input type="hidden" name="price" value="'.$productinfo['price'].'">';
        print'<br />';
        print'<input type="hidden" name="oldimg" value="'.$before_img.'">';
        print'<input type="hidden" name="img" value="'.$product_newimg['name'].'">';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input type="submit" value="OK">';
        print'</form>';
    }   
?>
</body>
</html>
