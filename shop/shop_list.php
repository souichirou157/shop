<?php
session_start();
if(isset($_SESSION['member_login'] )== false){

print 'ようこそ名無しさん<br/>';
print'<a href = "member_login.html">ログイン<a>';

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
<title>登録</title>
  


</head>


<body >
<h1>現在の時刻</h1>


<p id = "time">:</p>



<script> 
const date = new Date();
const time = window.document.getElementById('time');


time.textContent = date.toDateString();

</script>


<?php
try{
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//接続情報
    $user = 'root'; //ユーザー
    $password = ''; //パスワード
    $dataBaseHost =  new PDO($dsn,$user,$password);   //PHP DATABASE OBJECT  (args = {connection, username, password})
    $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);          //エラーの重要度を表す属性   ,   例外の内容
    $query_sql = 'SELECT p_code,p_name,p_price FROM product WHERE 1';      //クエリを値として定義しておく
    $statement =  $dataBaseHost->prepare($query_sql);   //接続情報から取得したデータベースでクエリを発行
    $statement->   execute();                // 実行メソッド
    $dataBaseHost = null;         //DBの接続を切断
   
   
    
    while(true)
    {
        $rec = $statement->fetch(PDO:: FETCH_BOTH);      //データベースの接続情報からfetchでデータを 取り出す　
                                                     //アローン演算子は別オブジェクトのインスタンスを取得しているのに使う
                                                     //ここでデータベースから取り出すからキーの名前はカラムになる
        if($rec==false) break;
        print  $rec['p_name'];
        print  $rec['p_price'];
        print'<a href="shop_product.php?productcode='.$rec['p_code'].'&productname='.$rec['p_name'].'">カートに入れる</a>';
        print '<br/>';
       
   }

   
   print'<pre>';
 
  if(empty($_SESSION['cart'])){
    print'<a id = "zero" href="cart_look.php">購入する商品を選択してください</a>';
   }else
   {
       print'<a href="cart_look.php">カートの中身を見る</a>';
   }

   
   
}catch(Exception $e)
{
    print '取得に失敗しました';
    exit();

}
 





?>

<script>
    const zero = window.document.getElementById('zero');
    zero.style.color = 'rgb(255,0,0)';
    zero.style.fontSize = "18px";
</script>


</body>

</html>