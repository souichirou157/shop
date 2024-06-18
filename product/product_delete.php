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
   
   $product_code = $_GET['productcode'];   //ラジオボタンで選択したcodeの値を受けとりコピー　
  
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
             //データベースの接続情報からfetchでデータを 取り出す　
    $productName =   $rec['p_name'];                                    //アロ-演算子は別オブジェクトのインスタンスを取得しているのに使
    $productimg = $rec['p_img'];
    $dataBaseHost = null;
   
   if($productimg == "") {
         
         $disp_img = '';
     }else {
     
          $disp_img = '<img src = "./img/'.$productimg.'">';
      
      }


}catch(Exception $e)
{
    print '取得に失敗しました';
    exit();

}


?>

商品情報削除<br />
<?php  print  $product_code;?> 
 <?php print  $productName;?> 
 <?php print  $disp_img;?>
 <br />
 を削除してよろしいですか?
    <form  id = "form" method="post" action="product_delete_done.php">   
     <input type="hidden" name="productcode" style="width:200px" value = "<?php print$product_code;?>"><br />

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
     </form>


<script>
  window.document.getElementById('form').addEventListener('click',function(){

    if(!window.confirm('本当によろしいですか?'))
    {
        window.location.href = window.location.href;
    }else{
        window.document.location = 'product_delete_done.php';
    }
  
});
  
</script>
</body>
</html>                                          