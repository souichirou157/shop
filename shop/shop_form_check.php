<?php
session_start();


if(isset($_SESSION['member_login'] )== false){

print 'ようこそ名無しさん<br/>';
print'<a href = "member_login.html" >ログイン<a><br/>';

}else{

print 'No'.$_SESSION['member_name'].'<br/>' ;
print'<a href = "member_logout.html">ログアウト<a>';
}


?>


<?php
require_once('../common/common.php');


$post = sanitize($_POST);
$username    = $post['username'];
$mailaddress = $post['mailaddress'];
$postnum1    = $post['postnum1']; 
$postnum2    = $post['postnum2'];
$address     = $post['adress'];
$postnumber  = $postnum1.$postnum2 ;
$telephone_number = $_POST['telephone_number'];




if($username == '' || $postnumber == '' || $telephone_number == '' || $address == ''){
    print'お名前、郵便番号、住所、電話番号は必須です';
    print'</br>';
    print'<a href = "shop_form.html" >入力画面に戻る</a>';
   ?>
   <script>
    
    setTimeout(() => {
        window.alert('強制的に前ページに戻ります');
        window.document.location = 'shop_form.html';     
    }, 1000);
   
   </script>
   <?php

   return ;
}

if(preg_match('/\A[0-9]+\z/', $postnumber)== 0) {
    print'郵便番号は半角数字で入力してください';
    print'</br>';
    print'<a href = "shop_form.html" >入力画面に戻る</a>';
    ?>
   <script>
    
    setTimeout(() => {
        window.alert('強制的に前ページに戻ります');
        window.document.location = 'shop_form.html';     
    }, 1000);
   
   </script>
   <?php

   return ;

}
if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $telephone_number)== 0)  {

    print '電話番号は数字とハイフンで入力して下さい';
    print'</br>';
    print'<a href = "shop_form.html" >入力画面に戻る</a>';

    ?>
    <script>
     
     setTimeout(() => {
         window.alert('強制的に前ページに戻ります');
         window.document.location = 'shop_form.html';     
     }, 1000);
    
    </script>
    <?php

    return ;
}

if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$mailaddress)==0) {
    print 'メールアドレスの値が不正です';
    print'</br>';
    print'<a href = "shop_form.html" >入力画面に戻る</a>';

    ?>
    <script>
     
     setTimeout(() => {
         window.alert('強制的に前ページに戻ります');
         window.document.location = 'shop_form.html';     
     }, 1000);
    
    </script>
    <?php

    return  ;
    
}

if(!null){
    


print'入力情報確認';
print '<table border=1>';

print'<tr>';
print '<td>お名前</td>';
print '<td>'.$username.'</td>';
print '</tr>';

print'<tr>';
print '<td>郵便番号</td>';
print '<td>〒'.$postnumber.'</td>';
print '</tr>';

print'<tr>';
print '<td>お届け先住所</td>';
print '<td>'.$address.'</td>';
print '</tr>';

print'<tr>';
print '<td>ご連絡先</td>';
print '<td>'.$telephone_number.'</td>';
print '</tr>';



print '</table>';

print '注文を確定しますか?';

    print '<form method="post"  action="shop_form_done.php">';


    print '<input type="hidden" name = "username"         style="width:200px;"       value="'.$username.'"><br/>';
    
    print '<input type="hidden" name = "mailaddress"      style="width:200px;"       value="'.$mailaddress.'"><br/>';
    
    
    print '<input type="hidden" name = "postnum1"          style="width:70px;"         value="'.$postnum1.'"><br/> ';
    print '<input type="hidden" name = "postnum2"          style="width:70px;"         value="'.$postnum2.'"><br/> ';

    print '<input type="hidden" name = "address"          style="width:70px;"         value="'.$address.'"><br/> ';
    
    print '<input type="hidden" name = "telephone_number" style="width:200px;"        value="'.$telephone_number.'"><br/>';
    
    print '<input type = "submit" value="注文を確定">';

    print '</form>';

}
?>
    
