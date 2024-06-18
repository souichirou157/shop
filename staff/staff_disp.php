<?php
session_start();
if(isset($_SESSION['login'] )== false){

print 'ログインできません<br/>';
print'<a href = "../staff_login/staff_login.html">ログイン画面へ<a>';
exit();

}else{

print 'No'.$_SESSION['staffCode'].' '.$_SESSION['staffName'].'さんようこそ<br/>' ;

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
   
  $staff_code = $_GET['staffcode'] ;
  
   $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//接続情報
   $user = 'root'; //ユーザー
   $password = ''; //パスワード
   
   $dataBaseHost =  new PDO($dsn,$user,$password);   //PHP DATABASE OBJECT  (args = {connection, username, password})
   $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);          //エラーの重要度を表す属性   ,   例外の内容

     
   $query_sql = 'SELECT name FROM staff WHERE code=?';      //クエリを値として定義しておく
   
   $statement =  $dataBaseHost->prepare($query_sql);   //接続情報から取得したデータベースでクエリを発行
  
   $data[] = $staff_code;
   $statement->   execute($data);                // 実行メソッド
   
   ;         //DBの接続を切断
   
  
    $rec = $statement->fetch(PDO:: FETCH_BOTH);
    $staffname= $rec['name'];     //データベースの接続情報からfetchでデータを 取り出す　
                                                     //アロ-演算子は別オブジェクトのインスタンスを取得しているのに使う
    

   $dataBaseHost = null;

}catch(Exception $e)
{
    print '取得に失敗しました';
    exit();

}


?>


スタッフ情報<br />
<?php 
      print $staff_code ;
      print'<br/>';
      print $staffname;
      print'<br/>';
      print'<input type = button , onclick= "history.back()", value = "戻る">';

?>
</body>
</html>                                          