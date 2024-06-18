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

     
   $query_sql = 'SELECT p_name,p_price,p_img FROM product WHERE p_code=?';      //クエリを値として定義しておく
   
   $statement =  $dataBaseHost->prepare($query_sql);   //接続情報から取得したデータベースでクエリを発行
   $data[] =  $product_code;
   $statement->   execute($data);                // 実行メソッド
   
            //DBの接続を切断
   
  
   
    
    $rec = $statement->fetch(PDO:: FETCH_BOTH);
    $productname= $rec['p_name'];     //データベースの接続情報からfetchでデータを 取り出す　
    $product_price= $rec['p_price'];                                                //アロ-演算子は別オブジェクトのインスタンスを取得しているのに使う
    $changeBeforeimg= $rec['p_img'];

    $dataBaseHost = null;
   
    
    if($changeBeforeimg == '' ){
        $disp_img = '';
    }else{   
        $disp_img = '<img src = "./img/'.$changeBeforeimg.'">';
    }    
    

}catch(Exception $e)
{
    print '取得に失敗しました';
    exit();

}


?>


価格修正<br />
<?php print $product_code ;?>
    <br />
    <form method="post" action="product_edit_check.php" enctype ="multipart/form-data" >   
    
       <input type="hidden" name="code" style="width:200px" value = "<?php print$product_code ;?>"><br />
         商品名を入力してください<br />
       <input type="text" name="name" style="width:200px" value = "<?php print$productname;?>"><br />
        金額を入力してください<br />
       <input type="number" name="price" style="width:100px">
        <br />
         
         <input type="hidden" name="oldimg" style="width:400px" value = "<?php print$changeBeforeimg;?>"><br />
         画像を選んでください<br />  <?php /*新しい画像選択 nameプロパティのデータを次ページに値渡しすることで反映される*/ ?>     
         <?php  print $disp_img;?><br />
         <input type="file" name="img" style="width:400px" ><br />
         <input type="button" onclick="history.back()" value="戻る">
         <input type="submit" value="OK">
    
     </form>
</body>
</html>                                          