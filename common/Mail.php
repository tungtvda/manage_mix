<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */

require_once('class.phpmailer.php');
function SendMail($Sendto,$Body,$Subject, $return='', $title_mail='Hệ thống quản lý MIXTOURIST', $domain='mix',$data=array())
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
//    $mail->Username = 'qsg546.qsoft@gmail.com';
//    $mail->Password = 'edbhqegduzpmwuui';
    if($domain=='az'){
        $mail->Username = 'tiepthilienket.azbooking@gmail.com';
        $mail->Password = 'rhypxfkzxcxdfkjy';
    }else{
        $mail->Username = 'manage.system.mixtourist@gmail.com';
//        $mail->Password = 'ttulgbiqnksxueze';
        $mail->Password = 'bgogoyjwpkpemdns';
    }

    $mail->SetFrom('thanhtuyen@mixmedia.vn', $title_mail);
    $mail->AddReplyTo('thanhtuyen@mixmedia.vn', "");
    $mail->AddAddress($Sendto,'');
    $mail->Subject = "" . $Subject . "";
    $mail->MsgHTML("" . $Body . "");
    $mail->AddAttachment($_FILES['file_attack']['tmp_name'],$_FILES['file_attack']['name']);
    $mail->AddAttachment($_FILES['file_attack2']['tmp_name'],$_FILES['file_attack2']['name']);
    $mail->AltBody = "" . $Subject . "";

    if (!$mail->Send()) {
        if($return==1){
            return 0;
        }
//        $loi = "Đã xảy ra lỗi khi đặt tour, Quý khách vui lòng thực hiện lại: " . $mail->ErrorInfo;
//        echo "<script>alert('{$loi}');</script>";
    } else {
        if($return==1){
            return 1;
        }

    }
}
?>