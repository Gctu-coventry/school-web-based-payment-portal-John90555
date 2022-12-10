<?php
$url = 'http://localhost/work/postrefundApi.php';
$uID = $_POST['userOrderID'];
$amount = $_POST['amountToRefund'];
// $data = array();
// $data['orderId'] = $uID;
// $data['amount'] = $amount;
// $postStr = '';
// foreach($data as $key=>$value){
//     $postStr .= $key.'='.urlencode($value).'&';
// }
// $postStr = substr($postStr, 0, -1);
echo $amount;
echo $uID;

$curl = curl_init();
curl_setopt($curl,CURLOPT_URL, 'http://localhost/work/postrefundApi.php');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $uID);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($curl);
curl_close($curl);
echo $result;
header("Location: adminPending.php");
?>