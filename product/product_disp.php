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
try{
   
  $product_code = $_GET['productcode'] ;
  
   $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//接続情報
   $user = 'root'; //ユーザー
   $password = ''; //パスワード
   
   $dataBaseHost =  new PDO($dsn,$user,$password);   //PHP DATABASE OBJECT  (args = {connection, username, password})
   $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);          //エラーの重要度を表す属性   ,   例外の内容

     
   $query_sql = 'SELECT * FROM product WHERE p_code=?';      //クエリを値として定義しておく
   
   $statement =  $dataBaseHost->prepare($query_sql);   //接続情報から取得したデータベースでクエリを発行
  
   $data[] = $product_code;
   $statement->   execute($data);                // 実行メソッド
   
   ;         //DBの接続を切断
   
  
    $rec = $statement->fetch(PDO:: FETCH_BOTH);
    $productname= $rec['p_name'];     //データベースの接続情報からfetchでデータを 取り出す　
    $productprice = $rec['p_price'];                                                 //アロ-演算子は別オブジェクトのインスタンスを取得しているのに使う
    $productimg = $rec['p_img'];
    
    
    if( $productimg!= ''){
    
        $productimg = '<img src = "./img/'.$productimg.'">';
     
     }else{
      $productimg = '画像なし';
    }
   $dataBaseHost = null;     //DB接続はGC対象外なので、自分で開放が必要

}catch(Exception $e)
{
    print '取得に失敗しました';
    exit();

}


?>


スタッフ情報<br />
<?php 
      print $product_code ;
      print'<br/>';
      print $productname;
      print'<br/>';
      print $productprice;
      print'<br/>';
      print $productimg ;
      print'<input type = button , onclick= "history.back()", value = "戻る">';

?>
</body>
</html>                                          