<?php
session_start();


if(isset($_SESSION['member_login'] )== false){

print 'ようこそ名無しさん<br/>';
print'<a href = "member_login.html">ログイン<a><br/>';

}else{

print 'No'.$_SESSION['member_name'].'<br/>' ;
print'<a href = "member_logout.html">ログアウト<a>';
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
try{
   
  $product_code = $_GET['productcode'] ;//前ページのコードコピー
  $product_name = $_GET['productname'];


  //以前までのカートの中身と選んでいるだけの商品の数も保存する
 
  //リストで商品選択->初期値がセット
 //ここで前回のセッションが続いているか判定する
  
 
 if(empty($_SESSION['cart'])){  //最初の1つ目はカートの案内を出す
    print '<br/>';
    print'<a href="cart_look.php">内容をカートで確認できます</a>';
    print '<br/>';

  }else if($_SESSION['cart'] == true){
    $cart =  $_SESSION['cart']; 
    $max  = count($cart);
    $NumberofProductsSelected = $_SESSION['NumberofProductsSelected'];
    if(in_array($product_code,$cart)==true){
      print 'この商品は既に選択されています、注文しますか?';
      print '<br/>';
      print '<br/>';
      print '※<small>注文する場合は数量が更新されます</small>';
      print '<br/>';
      print '<br/>';
      print '<a href="shop_list.php">商品リストに戻る</a>';
      print '<br/>';
      print '<br/>';
      print '<a href="cart_look.php">カートで数量を更新する</a>';

      return ;
    }
  }

 
  $cart[] = $product_code;//１:リストで選択した野菜のコード
  $_SESSION['cart'] = $cart;//２:追加
  $NumberofProductsSelected[] = 1;
  $_SESSION['NumberofProductsSelected'] =  $NumberofProductsSelected;//sessionデータ更新



  // $cart[] = $product_name;
  foreach($cart as $key =>$val)
  {
    print $val.'   ';
  }
  
  
  
  
  

    
    print'<br>';
    print $product_name.'をカートに追加しました';
    print'<br>';
    print'<a href="shop_list.php">商品一覧に戻る</a>';
    print'<br/>';
  
 
 
 
 

}catch(Exception $e)
{
    print '取得に失敗しました';
    $_SESSION['cart']=array();
    exit();

}
?>



<?php


?>



</body>
</html>                                          