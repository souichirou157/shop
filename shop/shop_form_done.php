<?php
session_start();
session_regenerate_id(true);


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
try{
    require_once('../common/common.php');
    $cart = $_SESSION['cart'];
    $NumberofProductsSelected=  $_SESSION['NumberofProductsSelected'];//商品数量
    $max = count($cart);//注文数の総計
    $order_info = array('お名前'=>$_POST['username'],'emailアドレス'=>$_POST['mailaddress'],'郵便番号1'=>$_POST['postnum1'],'郵便番号2'=>$_POST['postnum2'],'発送先住所'=>$_POST['address'],'電話番号'=>$_POST['telephone_number']);
    $_SESSION['new_member'] =  $order_info;
    $total=0;
    $order_info  = sanitize($order_info);
    print $order_info['お名前'].'様';
    print '</br>';
    print 'ご注文ありがとうございます</br>';
    print 'ご登録email宛てに確認メールをお送りしましたのでご確認ください。';
    print '</br>';
    print '</br>';
    print '</br>';
    print '</br>';
    print '------------------------商品情報-------------------------';
    print '</br>';
    

    //注文情報と商品情報表示
    for($i =0 ;$i < $max ;$i++){
     
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';//DBの名前解決   接続情報
        $user = 'root';
        $password = '';
        $dataBaseHost = new PDO($dsn,$user,$password);               // PHP DATABASE OBJECT   ARGG (config , username , password)
        $dataBaseHost-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);    //エラーの重要度を表す属性   ,   例外の内容
    
        $query = 'SELECT p_name , p_price FROM product WHERE p_code=?';
        $order[0] = $cart[$i];
        $statement =  $dataBaseHost -> prepare($query);
        $statement -> execute($order); //ここで完了
        
        $rec = $statement -> fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['p_name'];
        $pro_price = $rec['p_price'];
        $prices[] =   $pro_price;
        $quantity      = $NumberofProductsSelected[$i]; 
        $translation = $rec['p_price']*$quantity;
        $total+=$translation;

     
//テキスト追加

        print '注文商品::'.$pro_name;
        print '</br>';       
        print  '商品価格::'.$prices[$i].'円'; 
        print '</br>';
        print '商品数量::'.$quantity ;
        print '</br>';
        print '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;小計'."￥". $translation.'也--';
        print '</br>';
    }
    print '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;総額'."￥". $total.'也--</br>';
    print '</br>';
    print '</br>';

$lock = 'LOCK TABLES DATE_SALES WRITE ,DATE_SALES_PRODUCT WRITE';
$stmt = $dataBaseHost->prepare($lock);
$stmt -> execute();
//注文情報を挿入
$insert_query = 'INSERT INTO DATE_SALES(member_code,member_name,email,first_post_num,second_post_num,address,telephonenumber) VALUES(?,?,?,?,?,?,?)'; 
   $stmt  =  $dataBaseHost-> prepare($insert_query);
   $data = array();
   $data[] = 0;
   $data[] =  $order_info['お名前'];
   $data[] =  $order_info['emailアドレス'];
   $data[] =  $order_info['郵便番号1'];
   $data[] =  $order_info['郵便番号2'];
   $data[] =  $order_info['発送先住所'];
   $data[] =  $order_info['電話番号'] ;
   $stmt-> execute($data);
  
 //最後の注文データを取得しておく
$sql = 'SELECT LAST_INSERT_ID()';
$stmt = $dataBaseHost -> prepare($sql);
$stmt -> execute();
//最後の注文情報を取り出す
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
$lastdata = $rec['LAST_INSERT_ID()'];



for($i =0; $i < $max ;$i++){

    $insert_query = 'INSERT INTO DATE_SALES_PRODUCT(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
    $stmt  =  $dataBaseHost-> prepare($insert_query);
    $orderData = array();
    $orderData[] = $lastdata;
    $orderData[] = $cart[$i];
    $orderData[] =   $prices[$i];
    $orderData[] =   $NumberofProductsSelected[$i];
    
   $stmt-> bindParam('code_sales', $lastdata);
   $stmt-> bindParam('code_product', $cart[$i]);
   $stmt-> bindParam('price',  $prices[$i]);
   $stmt-> bindParam('quantity',  $NumberofProductsSelected[$i]);
    $stmt->execute($orderData);
}


$unlock = 'UNLOCK TABLES';
$stmt = $dataBaseHost->prepare($unlock);
$stmt -> execute();


    $dataBaseHost = null; //接続を切って終了
  
     
        

   
  $cart = 0;
  $_SESSION['cart'] = $cart;



}catch(Exception $e){
    print '注文情報の登録時に障害が発生しました';
    print '</br>';
    print '</br>';
    print '<a href="shop_list.php">商品リストに戻る</a>';
    print $e;
    exit();
}





print 'お客様情報</br>';
print'<table border = "1">';
foreach($order_info as $key =>$val){
    print'<tr>';
    print '<td>'.$key.'</td>';
    print '<td>'.$val.'</td>';
    print '</tr>';
}
print '</table>';
print '</br>';
print '</br>';
print '</br>';
print '登録した情報を使って会員登録ができます->';
print '<small><a href="member_add.php" >こちらから</a></small>';


print '</br>';
print '</br>';  
print'商品発着について';
print '</br>';
print '商品代金振り込み確認後に梱包・発送いたします </br>';
print '※<small>送料は無料です</small>';
print '</br>';  
print '--------振込先-----------</br>';
print '〇〇銀行六丸支店</br>普通口座&emsp;&emsp;&emsp;1234567</br>';
print '住所〇〇県〇〇郡六丸村</br>';
print '宛先名::六丸農園';


print '</br>';  
print '</br>';  
print '<a href="shop_list.php">商品リストに戻る</a>';

// $title ='確認メール';
// $header = 'From:tarou7684@gmail.com';
// mb_language('japanese');
// mb_internal_encoding('UTF-8');
// mb_send_mail($order_info['emailアドレス'],$title,$title,$header);

// $title ='確認メール';
// $header = 'From:tarou7684@gmail.com';
// mb_language('japanese');
// mb_internal_encoding('UTF-8');
// mb_send_mail($order_info['emailアドレス'],$title,$title,$header);


?>




</body>
</html> 

