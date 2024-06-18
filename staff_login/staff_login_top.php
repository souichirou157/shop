
<?php

session_start();
if(isset($_SESSION['login'] )== false){

print 'ログインできません<br/>';
print'<a href = "staff_login.html">ログイン画面へ<a>';
exit();

}else{

print 'No'.$_SESSION['staffCode'].' '.$_SESSION['staffName'].'さんようこそ<br/>' ;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>六丸農園</title>
</head>
  
<body>


<?php
//クッキーで取得するはず
// $staff_name = $_GET['staff_name'];
// print $staff_name;
print '<a href="../staff/staff_list.php">スタッフ管理画面</a>';
print '<br/>';
print '<br/>';
print '<a href="../product/product_list.php">商品管理画面</a>';
print '<br/>';
print '<br/>';
print '<a href="../order/order_download.php">注文データダウンロード</a>';
print '<br/>';
print '<br/>';
print '<a href = "staff_logout.php">ログアウト</a>'


?>


</body>
</html>