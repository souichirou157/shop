
<?php 

session_start();

$_SESSION = array(); //暗号かぎを削除

//15分後にユーザーがアクティブでなければクッキーが無効になる
if(isset($_COOKIE[session_name()] )== true)  setcookie(session_name(),'',time()-42000,'/');

session_destroy();

print 'ログアウトしました';

print '<br/>';

print '<a id = "locate" href = "staff_login.html">ログイン画面に戻る</a>'

?>
<script type="text/javascript">
  
  const a = window.document.getElementById('locate');
  window.location.href ='';
  if(setTimeout(()=>{

    window.location.href = 'staff_login.html';
  },10000));
  
 

</script>
<?php


?>