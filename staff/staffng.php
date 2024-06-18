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


print 'アカウントが指定されていません';

print '<br/>'; 
print '<a href="staff_list.php">選択画面に戻る</a>';

 
?>    
<script>
    
  setTimeout(()=>{
    window.document.location = 'staff_list.php';
  },10000);
 
</script>

</body>
</html>


