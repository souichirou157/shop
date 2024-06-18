
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<?php

function Calendar($year)
{
    if((1868<=$year) && ($year <=1911))  $ret = '明治';

    if((1912<=$year) && ($year <=1925))  $ret  = '大正';
    
    if((1926<=$year) && ($year <=1988)) $ret = '昭和';
    
    if((1989<=$year) && ($year <=2018)) $ret = '平成';
    
    if((2019<=$year) && ($year <=2024)) $ret = '令和';
    
    return $ret;
}


function sanitize($beforeVal)
{
    
    foreach($beforeVal as $key => $val)
    {
        $afterVal[$key] = htmlspecialchars($val,ENT_QUOTES,'UTF-8');
    }

    return $afterVal;
}


// $staffinfo = array('name'=>$_POST['name'] ,'pass'=>$_POST['pass'],'pass2'=>$_POST['pass2']);
// $staffinfo =  sanitize($staffinfo);


class ExampleException extends Exception{
    public function Detectsnegativevalues($product) {
     if($product < 0){
       throw new Exception("Exception:: The selected value is outside the default range");
    }}

}



?>
<script type="text/javascript">
function searchdataMacker(limit,obj){
    let option;
    for(let i = 1; i <=limit;i++){
        option = window.document.createElement('option');
        option.value = "0"+i.toString();
        option.textContent = "0"+i.toString();
        console.log(obj.name);
        obj.appendChild(option)
    }     
}
</script>
<?php



?>
    
</body>
</html>

