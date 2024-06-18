<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$date = $_POST['WesternCalendar'];

$eraname;

$eraname= $date[0].$date[1].$date[2].$date[3];

require_once('../common/common.php');



$calender =  Calendar($eraname);

if($eraname > 2024)  {
    print '未来のことはわかりません';
}else {
    print $eraname.'の元号は'.$calender.'です';
}


?>
    
</body>
</html>

