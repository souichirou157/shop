<?php

session_start();
if(isset($_SESSION['login'] )== false){

print 'ログインできません<br/>';
print'<a href = "staff_login.html">ログイン画面へ<a>';
exit();

}else{

print 'No'.$_SESSION['staffCode'].' '.$_SESSION['staffName'].'さんようこそ<br/>' ;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $season = array('year'=>$_POST['year'],'month'=>$_POST['month'],'day'=>$_POST['day']);

    try{
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//DBの名前解決   接続情報
        $user = 'root';
        $password = '';
        $dataBaseHost = new PDO($dsn,$user,$password);               // PHP DATABASE OBJECT   ARGG (config , username , password)
        $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);    //エラーの重要度を表す属性   ,   例外の内容

        $query = '';

        $stmt = $dataBaseHost -> prepare($query);


        $data[]= $season['year'];
        $data[]= $season['month'];
        $data[]= $season['day'];

        $stmt-> execute($data);

        $dataBaseHost = null;
    }catch(Exception $e){

        print $e;
    }
    ?>
</body>
</html>