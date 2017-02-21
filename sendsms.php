<?php

//Huong dan chi tiet cach su dung API: http://esms.vn/blog/3-buoc-de-co-the-gui-tin-nhan-tu-website-ung-dung-cua-ban-bang-sms-api-cua-esmsvn
//De lay Key cac ban dang nhap eSMS.vn v� vao quan Quan li API
$APIKey="4439A770776FF3D94879EEAE117B7B";
$SecretKey="D3DBC8862A1A753EAD3FB533FC0CDE";
$YourPhone="01676331802";
$Content="Welcome to esms.vn";

$SendContent=urlencode($Content);
$data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=8";

$curl = curl_init($data);
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);

$obj = json_decode($result,true);
if($obj['CodeResult']==100)
{
    print "<br>";
    print "CodeResult:".$obj['CodeResult'];
    print "<br>";
    print "CountRegenerate:".$obj['CountRegenerate'];
    print "<br>";
    print "SMSID:".$obj['SMSID'];
    print "<br>";
}
else
{
    print "ErrorMessage:".$obj['ErrorMessage'];
}

?>