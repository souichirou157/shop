<?php
session_start();
if(isset($_SESSION['member_login'] )== false){

print 'ようこそ名無しさん<br/>';
print'<a href = "member_login.html">ログイン<a>';
print'<br/>';
}else{

print 'No'.$_SESSION['member_name'].'<br/>' ;
print'<a href = "member_logout.html">ログアウト<a>';
print'<br/>';
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

  require_once('../common/common.php');

  if(!empty($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    $NumberofProductsSelected = $_SESSION['NumberofProductsSelected'];
    $max = count($cart);
  }else{

    print '<img src="../img/cart.png" alt="">';
    print'<br>';
    print'<br>';
    print'商品カートは空です';
    print'<br>';
    print '<a href="shop_list.php">商品リストに戻る</a>';
    return ;
  }

 var_dump($cart);
 print'</br>';


   $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//接続情報
   $user = 'root'; //ユーザー
   $password = ''; //パスワード
   
   $dataBaseHost =  new PDO($dsn,$user,$password);   //PHP DATABASE OBJECT  (args = {connection, username, password})
   $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);          //エラーの重要度を表す属性   ,   例外の内容

     
             
foreach($cart as $key => $val){
  //  print $val;
        
        $query_sql = 'SELECT * FROM product WHERE p_code=?';      //クエリを値として定義しておく
   
        $statement = $dataBaseHost->prepare($query_sql);   //接続情報から取得したデータベースでクエリを発行
       
        $data[0] = $val;//
        $statement->execute($data);                // 実行メソッド
        
   
  
    $rec = $statement->fetch(PDO:: FETCH_BOTH);
    $product_code[] = $rec['p_code'];
    $productname[]= $rec['p_name'];     //データベースの接続情報からfetchでデータを 取り出す　
    $productprice[]= $rec['p_price'];                                                 //アロ-演算子は別オブジェクトのインスタンスを取得しているのに使う

    
    if($rec['p_img']!= ''){
    
        $productimg[] = '<img src = "../product/img/'.$rec['p_img'].'">';
     
     }else{
      $productimg[] = 'image_non_title';
    }
} 

   $dataBaseHost = null;       //DBの接続を切断//DB接続はGC対象外なので、自分で開放が必要

}catch(Exception $e)
{
    print '取得に失敗しました';
    exit();

}


?>



商品情報<br />
<?php
 print'<a href ="shop_list.php">商品リストに戻る</a>';
print'<form  method="post"action="numproduct_add.php">';
print'<table border = "1">';

print '<tr>';
print '<td>商品コード</td>';
print '<td>商品名</td>';
print '<td>価格</td>';
print '<td>数量</td>';
print '<td>購入金額</td>';
print '<td>更新</td>';
print '<td>項目を削除</td>';
print '</tr>';

  for($i =0 ; $i < $max ;$i++)
  {
    print '<tr>';
      print '<td>'.$product_code[$i].'</td>' ; 
      print '<td>'.$productimg[$i].'</td>';
      print'<br/>';
      print'<br/>';
      print '<td>'. $productname[$i].':'."¥".$productprice[$i].'</td>';
      print '<td><input type="number" name="NumberofProductsSelected'.$i.'" value="'.$NumberofProductsSelected[$i].'"></td>';
      print '<td>'."¥".$productprice[$i]*$NumberofProductsSelected[$i].'</td>';
      print '<td><input class="addbtn"type="submit" value="更新" style="all:unset;height:100%;"></td>';
      print '<td><input type = "checkbox" name = "'.$i.'">選択</td>';
      print '</tr>';  
    }

    ?>
    <script type="text/javascript">
     const btn = document.querySelector('.addbtn');
     btn.style.background="aqua";
     
     </script>
    <?php



print '</table>';  
print '<input type="hidden" name ="max" value = "'.$max.'"    style="width: 150px;">';
print'</form>';
 
 

 


  print'<br/>';
  print'<form  method="post"action="rem_cart.php">';
  print'<br/>';
  print'<input type="submit" value="カートをクリア" >';
  print'<br/>';
  print'<br/>';
  print'';
  print'</form>';


  print '<a href="shop_form.html" >注文手続きに進む</a>';




?>

</body>
</html>                                          