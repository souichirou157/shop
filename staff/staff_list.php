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
<title>登録</title>
</head>
<body>
<h1>現在の時刻</h1>
<p id = "time">:</p>
<script> 
const date = new Date();
const time = window.document.getElementById('time');


time.textContent = date;
</script>


<?php
try{
       
   $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//接続情報
   $user = 'root'; //ユーザー
   $password = ''; //パスワード
   
   $dataBaseHost =  new PDO($dsn,$user,$password);   //PHP DATABASE OBJECT  (args = {connection, username, password})
   $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);          //エラーの重要度を表す属性   ,   例外の内容

     
   $query_sql = 'SELECT code,name FROM staff WHERE 1';      //クエリを値として定義しておく
   
   $statement =  $dataBaseHost->prepare($query_sql);   //接続情報から取得したデータベースでクエリを発行
   
   $statement->   execute();                // 実行メソッド
   
   $dataBaseHost = null;         //DBの接続を切断
   
   print'<form method = "post" action = "staff_branch.php">';
   
   while(true)
   {
    
    $rec = $statement->fetch(PDO:: FETCH_BOTH);      //データベースの接続情報からfetchでデータを 取り出す　
                                                     //アローン演算子は別オブジェクトのインスタンスを取得しているのに使う
    
    if($rec==false) break;
    
    
    print'<input type = radio  name = "staffcode" value = "'.$rec['code'].'" >'; //ここのnameがつぎのedit.phpにコピーされる
    print $rec['name'];
    print '<br/>';
    
    
   }


}catch(Exception $e)
{
    print '取得に失敗しました';
    exit();

}

print'<input type = "submit"   name = "disp" value = "参照">';
print'<input type = "submit"   name = "edit" value =  "更新">';
print '<input id="confirmation" type = "submit"  name = "del"  value =  "削除">';
print '<input type = "submit"  name = "add"  value =  "追加" >';
print'</form>';              

print '<a href="../staff_login/staff_login_top.php">トップ画面に戻る</a>';



?>




</body>

</html>