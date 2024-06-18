<?php
session_start();
session_regenerate_id(true);


?>


<?php

$new_memberInfo =$_SESSION['new_member'];

print 'こちらの情報で間違いない場合は登録ボタンを押してください</br>';
print '※<small>訂正箇所がある場合は直接修正してください</small>';


print '<form method= "post" name="member" action="member_add_check.php">';

print'<table border = "1">';
$i=0;
foreach($new_memberInfo as $key =>$val)
{
    print'<tr id="member_list">';
    print '<td>修正<input type="radio" value="' . $key . '" onclick="(function(){window.document.getElementById(' . $i . ').disabled=false ;}())"></td>';
    print '<td>'.$key.'</td>';
    print '<td><input id='.$i.'  class="member".'.$i.' type = "text" name="'.$key.'" value="'.$val.'" disabled="true"style="width :180px;"></td>';
    print '</tr>';
    $i++;
}
print '</table>';
print '<input type = "submit" value="登録">';
print '</form>';
print '<input id = "edit" type = "button" value="修正を完了">';
print'<tr>';

?>
<script type="text/javascript">
    
    function check(){
///個々の実装に問題あるはず
        for(let i =0; i < 5;i++){
            if(window.document.getElementById(`${i}`).disabled == false) window.document.getElementById(`${i}`).disabled = true;
            console.log(window.document.getElementById(`${i}`));
        }
    }
    window.document.getElementById('edit').addEventListener('input',function(){check()});
</script>
<?php
  



// try{
//     foreach($new_memberInfo as $key =>$val){
//     }
// }catch(Exception $e){
//         print $e;
//         return ;
// }

// print '取得完了';

?>
