<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
// xxxx-0x-xx

$name = $_POST['star'];


$stars['M1']='かに星雲';
$stars['M31']='アンドロメダ星雲';
$stars['M42']='オリオン星雲';
$stars['M45']='すばる';
$stars['sM57']='ドーナツ星雲';

foreach($stars as $key =>$star){

    print $key.'は'.$star;
    print'<br/>';
}

print '検索結果:'.$stars[$name];

?>

</body>
</html>