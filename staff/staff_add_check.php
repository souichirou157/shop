<?php
session_start();
if(isset($_SESSION['login'] )== false){

print 'ログインできません<br/>';
print'<a href = "../staff_login/staff_login.html">ログイン画面へ<a>';
exit();

}else{

print 'No'.$_SESSION['staffCode'].' '.$_SESSION['staffName'].'さんようこそ<br/>' ;

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
    
    require_once('../common/common.php');
    $staffinfo = array('name'=>$_POST['name'] ,'pass'=>$_POST['pass'],'pass2'=>$_POST['pass2']);
    $staffinfo =  sanitize($staffinfo);

    
    if($staffinfo['name']=='')
    {
        print'スタッフ名が入力されてません　<br />';
    }
    else
    {
        print'スタッフ名:';
        print $staffinfo['name'];
        print'<br />';
    }
    
    if($staffinfo['pass']=='')
    {
         print'パスワードが入力されてません<br />';
    }
    if($staffinfo['pass']!==$staffinfo['pass2'])
    {
         print'パスワードが一致しません<br />';
    }
    
    if($staffinfo['name']==''||$staffinfo['pass']==''||$staffinfo['pass']!==$staffinfo['pass2'])
    {
        print'<form>';
        print'<input type="button" onclick="history.back()" value="戻る">';
            print'</form>';
    }
    else
    {
        $staffinfo['pass']=md5($staffinfo['pass']);
        print'<form id = "form" method="post" action="staff_add_done.php">';
        print'<input type="hidden" name="name" value="'.$staffinfo['name'].'">';
        print'<input type="hidden" name="pass" value="'.$staffinfo['pass'].'">';
        print'<br />';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input id = "done" type="submit" value="OK">';
        print'</form>';
        print '<p id = "message"></p>';
    }
    ?>

</body>
</html>
