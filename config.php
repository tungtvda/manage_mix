<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */
define("SITE_NAME", "http://localhost/nhahang");
define("DIR", dirname(__FILE__));
define('SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','nhahang');
define('CACHE',false);
define('DATETIME_FORMAT',"y-m-d H:i:s");
define('PRIVATE_KEY','hoidinhnvbk');
session_start();
require_once DIR.'/common/minifi.output.php';
ob_start("minify_output");

//define("SITE_NAME", "http://vietgardens.com");
//define("DIR", dirname(__FILE__));
//define('SERVER','localhost');
//define('DB_USERNAME','dulichado_garden');
//define('DB_PASSWORD','iBqjKvEMY');
//define('DB_NAME','dulichado_garden');
//define('CACHE',false);
//define('DATETIME_FORMAT',"y-m-d H:i:s");
//define('PRIVATE_KEY','hoidinhnvbk');
//session_start();
//require_once DIR.'/common/minifi.output.php';
//ob_start("minify_output");

require_once DIR.'/model/contactService.php';
require_once DIR.'/model/booking_tableService.php';
require_once DIR.'/model/dangky_emailService.php';
require_once DIR.'/model/danhgiaService.php';
function contact()
{
    if (isset($_POST['name_contact'])) {

        $ten=addslashes(strip_tags($_POST['name_contact']));
        $email=addslashes(strip_tags($_POST['email_contact']));
        $dienthoai=addslashes(strip_tags($_POST['phone_contact']));
        $diachi=addslashes(strip_tags($_POST['address_contact']));
        $noidung=addslashes(strip_tags($_POST['message_contact']));
        if($ten==""||$email==""||$dienthoai=="")
        {
            echo "<script>alert('Bạn vui lòng điền đẩy đủ thông tin liên hệ')</script>";
        }
        else
        {
            $new = new contact();
            $new->name_kh=$ten;
            $new->email=$email;
            $new->phone=$dienthoai;
            $new->address=$diachi;
            $new->content=$noidung;
            $new->status=0;
            $new->created=date(DATETIME_FORMAT);
            contact_insert($new);
            $link_web=SITE_NAME;
            $subject = "Viet Gardens thông báo liên hệ từ khách hàng";
            $message='';
            $message .='<div style="float: left; width: 100%">

                            <p>Tên khách hàng: <span style="color: #132fff; font-weight: bold">'.$ten.'</span>,</p>
                            <p>Email: <span style="color: #132fff; font-weight: bold">'.$email.'</span>,</p>
                            <p>Số điện thoại: <span style="color: #132fff; font-weight: bold">'.$dienthoai.'</span>,</p>
                            <p>Địa chỉ: <span style="color: #132fff; font-weight: bold">'.$diachi.'</span>,</p>
                            <p>Ngày gửi: <span style="color: #132fff; font-weight: bold">'.date(DATETIME_FORMAT).'</span>,</p>
                            <p>'.$noidung.'</p>


                        </div>';
            SendMail('sales@vietgardens.com', $message, $subject);
            echo "<script>alert('Viet Gardens cảm ơn quý khách đã gửi liên hệ đến chúng tôi, Viet Gardens sẽ liên hệ với bạn sớm nhất, xin cảm ơn!')</script>";

            echo "<script>window.location.href='$link_web';</script>";

        }

    }
}

function booking_table()
{
    if (isset($_POST['date_book'])) {

        $date_book=addslashes(strip_tags($_POST['date_book']));
        $time_book=addslashes(strip_tags($_POST['time_book']));
        $member_book=addslashes(strip_tags($_POST['member_book']));
        $name_book=addslashes(strip_tags($_POST['name_book']));
        $email_book=addslashes(strip_tags($_POST['email_book']));
        $phone_book=addslashes(strip_tags($_POST['phone_book']));
        $yeucau_book=addslashes(strip_tags($_POST['yeucau_book']));
        if($date_book==""||$time_book==""||$member_book==""||$name_book==""||$email_book==""||$phone_book=="")
        {
            echo "<script>alert('Bạn vui lòng điền đẩy đủ thông tin đặt bàn')</script>";
        }
        else
        {
            $radom = rand(100, 100000000);
            $id_chung = $radom . '_' . $email_book;
            $new = new booking_table();
            $new->status=0;
            $new->name=$name_book;
            $new->phone=$phone_book;
            $new->email=$email_book;
            $new->address='';
            $new->id_chung=$id_chung;
            $new->member=$member_book;
            $new->booking_date=$date_book;
            $new->booking_time=$time_book;
            $new->content=$yeucau_book;
            $new->created=date(DATETIME_FORMAT);
            booking_table_insert($new);
            $subject = "Viet Gardens thông báo đặt bàn";
            $subject1 = "Viet Gardens xác nhận đặt bàn";
            $message='';
            $message .='<div style="float: left; width: 100%">

                            <p>Tên khách hàng: <span style="color: #132fff; font-weight: bold">'.$name_book.'</span>,</p>
                            <p>Email: <span style="color: #132fff; font-weight: bold">'.$email_book.'</span>,</p>
                            <p>Số điện thoại: <span style="color: #132fff; font-weight: bold">'.$phone_book.'</span>,</p>
                            <p>Số người: <span style="color: #132fff; font-weight: bold">'.$member_book.'</span>,</p>
                            <p>Ngày đặt: <span style="color: #132fff; font-weight: bold">'.$date_book.'</span>,</p>
                            <p>Thời gian: <span style="color: #132fff; font-weight: bold">'.$time_book.'</span>,</p>

                            <p>Ngày gửi: <span style="color: #132fff; font-weight: bold">'.date(DATETIME_FORMAT).'</span>,</p>
                            <p>'.$yeucau_book.'</p>


                        </div>';

            $total=0;
            if(isset($_SESSION['cart'])&&count($_SESSION['cart'])>0){
                $message .='<div style="float: left; width: 100%"> <talbe> <thead>
                                    <tr>
                                        <th class="product-name">Thực đơn</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
                foreach ($_SESSION['cart'] as $key=>$sp) {
                    $data_sanpham=sanpham_getById($sp['id']);
                    if(count($data_sanpham)>0){
                        $img=$data_sanpham[0]->img;
                        $code=$data_sanpham[0]->code;
                        $name=$data_sanpham[0]->name;
                        $price=number_format($data_sanpham[0]->price,0,",",".");
                        $num=$sp['soluong'];
                        $link=link_sanphamdetail($data_sanpham[0]);
                        $thanhtien=$data_sanpham[0]->price*$num;
                        $total+=$data_sanpham[0]->price*$num;
                        $new_gh = new booking_food();
                        $new_gh->id_chung=$id_chung;
                        $new_gh->name=$name;
                        $new_gh->code=$code;
                        $new_gh->img=$img;
                        $new_gh->link=$link;
                        $new_gh->quantity=$num;
                        $new_gh->price=$data_sanpham[0]->price;
                        $new_gh->total=$data_sanpham[0]->price*$num;
                        booking_food_insert($new_gh);
                        $message .='<tr class="cart_item">
                                        <td class="product-name">
                                            <div class="product-thumbnail">
                                                <a href="'.$link.'"><img width="150" height="150" src="'.$img.'" class="attachment-thumbnail size-thumbnail wp-post-image" alt="'.$name.'" srcset="'.$img.' 150w, '.$img.' 768w,'.$img.'  124w, '.$img.' 370w,'.$img.'  570w, '.$img.' 780w" sizes="(max-width: 150px) 100vw, 150px"></a>							</div>
                                            <div class="product-link">
                                                <a href="'.$link.'">'.$name.'</a>							</div>
                                        </td>
                                        <td class="product-price">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>'.$price.' vnđ</span>						</td>
                                        <td class="product-quantity">
                                                '.$num.'
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>'.number_format($thanhtien,0,",",".").' vnđ</span>						</td>

                                    </tr>';
                    }
                }
                unset($_SESSION['cart']);

            }
            $message .=' </tbody></table></div>';
            SendMail('sales@vietgardens.com', $message, $subject);
            SendMail($email_book, $message, $subject1);
            echo "<script>alert('Viet Gardens cảm ơn quý khách đã đặt bàn tại nhà hàng, Viet Gardens sẽ liên hệ với bạn sớm nhất, xin cảm ơn!')</script>";
            $link_web=SITE_NAME;
            echo "<script>window.location.href='$link_web';</script>";
        }

    }
}
function returnCountData(){
    $count_contact=contact_count('status=0');
    $_SESSION['contact']=$count_contact;
    $count_table=booking_table_count('status=0');
    $_SESSION['booking_table']=$count_table;
    $count_dangky=dangky_email_count('status=0');
    $_SESSION['dangky_email']=$count_dangky;
    $count_danhgia=danhgia_count('status=0');
    $_SESSION['danhgia_thucdon']=$count_danhgia;
}
