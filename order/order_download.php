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

<h1>ダウンロードしたいデータの日付を設定してください</h1>
   
<form method="post" name ="search" action="order_done_download.php">


<select name="year">
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
</select>
<!------after call function by create child Node------>
<select name="month" ></select>
<select name="day" ></select>

<input type="submit" value="ダウンロードする">
</form>
   

<?php
require_once('../common/common.php');
?>
<script type="text/javascript">
    searchdataMacker(12,search.month);
    searchdataMacker(31,search.day);

    for(let i = 9;i <=30;i++)search.day[i].textContent = search.day[i].value.slice(1);
    for(let i = 9;i<=11;i++)  search.month[i].textContent = search.month[i].value.slice(1);

    // for(let i = 9;i<=11||i <=30;i++)
    // {
    //     // if( search.day[i]) 
    //     search.day[i].textContent = search.day[i].value.slice(1);
    //     // if(search.month[i])    
    //     search.month[i].textContent = search.month[i].value.slice(1);
        
    
    // }
</script>
<?php
?>
</body>
</html>