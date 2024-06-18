<?php
session_start();
if(isset($_SESSION['login'] )== false){

print 'ログインできません<br/>';
print'<a href = "staff_login.html">ログイン画面へ<a>';
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


スタッフ修正<br />
<?php print $staff_code ;?>
    <br />
    <form method="post" action="staff_edit_check.php">   
     <input type="hidden" name="code" style="width:200px" value = "<?php print$staff_code;?>"><br />

        スタッフ名を入力してください<br />
        <input type="text" name="name" style="width:200px" value = "<?php print$staffname;?>"><br />
        パスワードを入力してください<br />
        <input type="password" name="pass" style="width:100px"><br />
        パスワードをもう一度入力してください<br />
        <input type="password" name="pass2" style="width:100px"><br />
        <br />
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
     </form>
</body>
</html>                                          