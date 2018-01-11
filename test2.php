<?php
//Visist http://http://esms.vn/SMSApi/ApiSendSMSNormal for more information about API
//� 2013 esms.vn
//Website: http://esms.vn/
//Hotline: 0902.435.340

//Huong dan chi tiet cach su dung API: http://esms.vn/blog/3-buoc-de-co-the-gui-tin-nhan-tu-website-ung-dung-cua-ban-bang-sms-api-cua-esmsvn
//De lay Key cac ban dang nhap eSMS.vn v� vao quan Quan li API
$APIKey="4439A770776FF3D94879EEAE117B7B";
$SecretKey="D3DBC8862A1A753EAD3FB533FC0CDE";
$YourPhone="01676331802";
$ch = curl_init();


$SampleXml = "<RQST>"
    . "<APIKEY>". $APIKey ."</APIKEY>"
    . "<SECRETKEY>". $SecretKey ."</SECRETKEY>"
    . "<ISFLASH>0</ISFLASH>"
    . "<SMSTYPE>7</SMSTYPE>"
    . "<CONTENT>". 'Welcome to SMS - from PHP http://esms.vn' ."</CONTENT>"
    . "<CONTACTS>"
    . "<CUSTOMER>"
    . "<PHONE>". $YourPhone ."</PHONE>"
    . "</CUSTOMER>"
    . "</CONTACTS>"
    . "</RQST>";


curl_setopt($ch, CURLOPT_URL,            "http://api.esms.vn/MainService.svc/xml/SendMultipleMessage_V2/" );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_POSTFIELDS,     $SampleXml );
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));

$result=curl_exec ($ch);
$xml = simplexml_load_string($result);

if ($xml === false) {
    die('Error parsing XML');
}

//now we can loop through the xml structure
//Tham khao them ve SMSTYPE de gui tin nhan hien thi ten cong ty hay gui bang dau so 8755... tai day :http://esms.vn/SMSApi/ApiSendSMSNormal

print "Ket qua goi API: " . $xml->CodeResult . "\n";


?>