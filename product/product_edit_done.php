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
   
       require_once('../common/common.php');
       $productinfo = array('name'=>$_POST['name'],'price'=>$_POST['price']);
       $productinfo =  sanitize($productinfo);

       $productcode =  $_POST['code']; 
       $beforeimg = $_POST['oldimg'];
       $productimg = $_POST['img'];

   
       $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//DBの名前解決   接続情報
       $user = 'root';
       $password = '';
   
       $dataBaseHost = new PDO($dsn,$user,$password);               // PHP DATABASE OBJECT   ARGG (config , username , password)
       $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);    //エラーの重要度を表す属性   ,   例外の内容
   
       $query_sql = 'UPDATE product SET p_name = ?,p_price=?, p_img = ? WHERE p_code = ?';   //SQL生
       $statement = $dataBaseHost->prepare($query_sql); 
       
       $data[] =   $productinfo['name'];  //カラムに入れるデータ
       $data[] =   $productinfo['price'];
       $data[] =  $productimg;  
       $data[] =  $productcode;
       $statement ->execute($data);//ここで完了
       
       $dataBaseHost = null ; //データベースの解放
       
       if($beforeimg!=$productimg){             //同じ画像の時に更新すると削除されちゃう
             
           if($beforeimg!='')  unlink('./img/'.$beforeimg);
       
       }
   
   }catch(Exception $e)
   {
     print '何らかの理由で登録に失敗した可能性があります';
     exit();
   }

?>
修正しました <br/>
<br/> 

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
