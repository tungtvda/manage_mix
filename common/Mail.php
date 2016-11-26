<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */

require_once('class.phpmailer.php');  
function SendMail($Sendto,$Body,$Subject)
{
    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";

    $mail->IsSMTP();

    $mail->SMTPDebug = 0;

    $mail->Debugoutput = "html";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = 'qsg546.qsoft@gmail.com';
    $mail->Password = 'edbhqegduzpmwuui';
    $mail->SetFrom('thanhtuyen@mixmedia.vn', 'Hệ thống quản lý MIXTOURIST');
    $mail->AddReplyTo('thanhtuyen@mixmedia.vn', "");
    $mail->AddAddress($Sendto,'test');
    $mail->Subject = "" . $Subject . "";
    $mail->MsgHTML("" . $Body . "");
    $mail->AltBody = "" . $Subject . "";

    if (!$mail->Send()) {
//        $loi = "Đã xảy ra lỗi khi đặt tour, Quý khách vui lòng thực hiện lại: " . $mail->ErrorInfo;
//        echo "<script>alert('{$loi}');</script>";
    } else {
//        echo "<script>alert('Quý khách đã đặt tour thành công, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất, Xin cảm ơn!')</script>";

    }
}  
?>