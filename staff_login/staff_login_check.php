
<?php
try{

  require_once('../common/common.php');
  $stafflogin = array('name'=>$_POST['name'],'pass'=>$_POST['pass']);
  $stafflogin =  sanitize($stafflogin);

 
 //パスワードをハッシュ化　--データベースのパスワードがハッシュ化されている為
  $staffpass = md5($stafflogin['pass']);
  
 
   

  //接続情報の定義
  $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';


  //一つの情報としてインスタンス化
  $dbHostConfig =   new PDO($dsn,$user,$password);
  $dbHostConfig-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //エラーが出ると参照しているエラー属性を実行する    
  
  
  //クエリが入る
  $query = 'SELECT code FROM  staff  WHERE password=? AND name=?';
  
  
  //接続上から実行するクエリを参照
  $statement =  $dbHostConfig-> prepare($query);
  //コピーした値を認証に使う
  // $data[] =  $staffcode;
  $data[] =   $staffpass;
  $data[] =   $stafflogin['name'];
  //入力した値を使ってクエリを実行
  $statement -> execute($data);
  
  //切断したら修了
  $dbHostConfig = null;
  
  
  //配列にあるデータベースのデータを取り出す
  $rec = $statement->fetch(PDO::FETCH_ASSOC);
  
  if($rec==false)
  {

    print 'スタッフコードかパスワードが間違いです';
    print '<a href = "staff_login.html">戻る</a>';
  
  
  }else{
  
      session_start();
      session_regenerate_id(true); //暗号カギを生成しなおす
      $_SESSION['login'] = true;
      $_SESSION['staffName'] = $stafflogin['name']; //ログインした名前表示する為に入れとく 
      $_SESSION['staffCode'] = $rec['code'];
      header('Location:staff_login_top.php?'); 
      exit();//セッションが強制終了
   }
}catch(Exception $e)


{
  // print$staffName;  
  print'ネットワークの障害によりログインできません'.$e->getMessage();
  exit();
}        
      


?>