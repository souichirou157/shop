<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$studentnum=$_POST['student'];


if($studentnum ==1) print $studentnum.'年性ならあなたは南校舎です';
if($studentnum ==2) print $studentnum.'年性ならあなたは西校舎です';
if($studentnum ==3) print $studentnum.'年性ならあなたは北校舎です';
if($studentnum > 3) print 'あなたの校舎は3年性と同じです';

// switch($studentnum)
// {
//     case 1:print $studentnum.'年性ならあなたは南校舎です'; break;
//     case 2:print $studentnum.'年性ならあなたは西校舎です'; break;
//     case 3:print $studentnum.'年性ならあなたは北校舎です'; break;

//     default :print 'あなたの校舎は3年性と同じです';

// }


?>

</body>
</html>