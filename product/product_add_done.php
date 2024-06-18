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

<?php
   try
   {   
    /*前ページのinputタグのデータをコピーして受け取る*/
                                   /*タグの一つ一つを連想配列思えば良い*/
  
    require_once('../common/common.php');
    $productinfo = array('name'=>$_POST['name'] ,'price'=>$_POST['price'],'img'=>$_POST['img']);
    $productinfo =  sanitize($productinfo);
   
    
       $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//DBの名前解決   接続情報
       $user = 'root';
       $password = '';
   
       $dataBaseHost = new PDO($dsn,$user,$password);               // PHP DATABASE OBJECT   ARGG (config , username , password)
       $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);    //エラーの重要度を表す属性   ,   例外の内容
   
       $query_sql = 'INSERT INTO product(p_name,p_price,p_img) VALUES(?,?,?)';   //SQL生
       $statement = $dataBaseHost->prepare($query_sql); 
       
       $data[] =$productinfo['name'];  //カラムに入れるデータ
       $data[] =$productinfo['price'];        
       $data[] =$productinfo['img'];  
       $statement ->execute($data);//ここで完了
       
       
       $dataBaseHost = null ; //データベースの解放
       print $productinfo['name'];
       print'<br/>';
       print $productinfo['price'].'円';
       print '<br/>';
       print 'を追加しました<br/>';
   
   }catch(Exception $e)
   {
     print '何らかの理由で登録に失敗した可能性があります';
     exit();
   }

?>
<a href="product_list.php">一覧へ戻る</a>
<br/>
<script>
  window.document.write('※一定時間たつとメニュー画面に移動します');
  setTimeout(()=>{
    window.document.location = 'product_list.php';
  },10000);
 
</script>
</body>
</html>
