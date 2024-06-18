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
商品追加<br />
    <br />
    <form method="post" action="product_add_check.php" enctype="multipart/form-data">
        
        商品名を入力してください<br />
        <input type="text" name="name" style="width:200px"><br />
        
        価格を入力してください<br />
        <input type="number" name="price" style="width:100px"><br />
        画像を選択してください<br/>
        <input type="file" name="img" style="width:400px" vaule="参照"><br />

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
     </form>



<script>

</script>
</body>
</html>                   
