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
  $cart =  $_SESSION['cart'] ;
  $max = count($cart);
if (isset($_SESSION['cart'])) {
     $_SESSION['cart'] = array();
     

  ?>
  <script type="text/javascript">
    window.document.write('カートの中を削除しました<br/>');
    $max =0;
    $_SESSION['cart']=null;
  </script>

  <?php
  print'<a href = "shop_list.php">商品リストに戻る<a><br/>';
}
?>



</body>
</html>                                          