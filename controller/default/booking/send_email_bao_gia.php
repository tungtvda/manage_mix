<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/thuong_hieuService.php';
require_once DIR . '/model/bookingService.php';
require_once DIR . '/model/customerService.php';
require_once DIR . '/email_template/tem_01_2018/index.php';
$email_tem = returnEmail01218();

if (isset($_GET['id']) && isset($_GET['thuong_hieu']) && isset($_GET['email'])) {
    $id = _return_mc_decrypt(_returnGetParamSecurity('id'));
    $booking = booking_getById($id);
    if ($booking) {

        $thuong_hieu = _returnGetParamSecurity('thuong_hieu');
        $data_thuong_hieu = thuong_hieu_getById($thuong_hieu);
        $doman = 'mixtourrist.com.vn';
        $name_thuong_hieu = 'Công ty Du lịch Mix Tourist';
        if ($data_thuong_hieu) {
            $doman = $data_thuong_hieu[0]->domain;
            $name_thuong_hieu = $data_thuong_hieu[0]->name;
        }
        if (!strpos($doman, "http")) {
            $doman = 'http://' . $doman;
        }
        $array_check_noti = array(
            'domain' => $doman,
        );
        $content_noti = returnCURL($array_check_noti, $doman . '/noi-dung-email/danh-sach-tour-giam-gia.html');
        $email_tem = str_replace('{{TOUR_NOI_BAT}}', $content_noti, $email_tem);
        $email_tem = str_replace('{{DATE_NOW}}', _returnGetDateTime(), $email_tem);
        $email_tem = str_replace('{{WEBSITE}}', $data_thuong_hieu[0]->name, $email_tem);
        $email_tem = str_replace('{{NAME}}', $data_thuong_hieu[0]->name, $email_tem);
        $email_tem = str_replace('{{LINK_WEBSITE}}', $doman, $email_tem);
        $email_tem = str_replace('{{LOGO}}', $data_thuong_hieu[0]->logo, $email_tem);
        $email_tem = str_replace('{{BANNER}}', $data_thuong_hieu[0]->banner, $email_tem);
        $email_tem = str_replace('{{BANNER_QC}}', $data_thuong_hieu[0]->banner_qc, $email_tem);
        $email_tem = str_replace('{{LINK_BANNER_QC}}', $data_thuong_hieu[0]->link_banner_qc, $email_tem);
        $email_tem = str_replace('{{LINK_KHOI_HANH}}', $data_thuong_hieu[0]->link_khoi_hanh, $email_tem);
        $user_data = user_getById($_SESSION['user_id']);
        $footer = $data_thuong_hieu[0]->chu_ky_email;
        if ($user_data) {
            $footer = $user_data[0]->chu_ky_email;
        }
        $email_tem = str_replace('{{FOOTER}}', $footer, $email_tem);
        $title = 'Bảng báo giá ' . $booking[0]->name_tour;
        $email_tem = str_replace('{{TITLE}}', $title, $email_tem);

        // khách hàng
        $data_cus = customer_getById($booking[0]->id_customer);
        $name_cus = '';
        if ($data_cus) {
            $name_cus = $data_cus[0]->name;
        }
        $do_tuoi_nguoi_lon=$booking[0]->name_price;
        $do_tuoi_tre_em_m1=$booking[0]->name_price_m1;
        $do_tuoi_tre_em_m2=$booking[0]->name_price_m2;
        $do_tuoi_tre_em_m3=$booking[0]->name_price_m3;


        if($do_tuoi_tre_em_m2!=''){
            $name_price_tre_em_m2='Đơn giá trẻ em '.$do_tuoi_tre_em_m2;
        }
        if($do_tuoi_tre_em_m3!=''){
            $name_price_tre_em_m3='Đơn giá trẻ em '.$do_tuoi_tre_em_m3;
        }

        $price_new = _returnDataEditAdd($booking, 'price_new');
        $price_tre_em_m1_new = _returnDataEditAdd($booking, 'price_tre_em_m1_new');
        $price_tre_em_m2_new = _returnDataEditAdd($booking, 'price_tre_em_m2_new');
        $price_tre_em_m3_new = _returnDataEditAdd($booking, 'price_tre_em_m3_new');

        if ($price_new == '') {
            $price_new = 0;
        }
        if ($price_tre_em_m1_new == '') {
            $price_tre_em_m1_new = 0;
        }
        if ($price_tre_em_m2_new == '') {
            $price_tre_em_m2_new = 0;
        }
        if ($price_tre_em_m3_new == '') {
            $price_tre_em_m3_new = 0;
        }
        $price_new_format = number_format((float)$price_new, 0, ",", ".");
        $price_tre_em_m1_new_format = number_format((float)$price_tre_em_m1_new, 0, ",", ".") ;
        $price_tre_em_m2_new_format = number_format((float)$price_tre_em_m2_new, 0, ",", ".") ;
        $price_tre_em_m3_new_format = number_format((float)$price_tre_em_m3_new, 0, ",", ".") ;

        $num_nguoi_lon = _returnDataEditAdd($booking, 'num_nguoi_lon');
        if (!$num_nguoi_lon) {
            $num_nguoi_lon = 1;
        }
        $num_tre_em_m1= _returnDataEditAdd($booking, 'num_tre_em_m1');
        if (!$num_tre_em_m1) {
            $num_tre_em_m1 = 0;
        }
        $num_tre_em_m2= _returnDataEditAdd($booking, 'num_tre_em_m2');
        if (!$num_tre_em_m2) {
            $num_tre_em_m2 = 0;
        }
        $num_tre_em_m3= _returnDataEditAdd($booking, 'num_tre_em_m3');
        if (!$num_tre_em_m3) {
            $num_tre_em_m3 = 0;
        }
        $giaban=$price_new*$num_nguoi_lon;
        $giaban_format=number_format((float)$giaban, 0, ",", ".");
        $content = '  <div class="content_data" style="float: left; width: 100%">
                                            <div style="float: left;width: 100%">
                                                <p style="font-weight: normal">
                                                    Kính chào quý khách <b>' . $name_cus . '</b> ! </p>
                                                <p style="font-weight: normal; line-height: 25px"> Đầu tiên, <b style="color: #0061AB;">' . $name_thuong_hieu . '</b> xin gửi lời cảm ơn chân thành và
                                                    sâu sắc nhất tới quý khách hàng đã và đang ủng hộ dịch vụ của chúng tôi.
                                                    Tiếp
                                                    theo, chúng tôi xin trân trọng gửi tới quý khách bảng giá dịch vụ cho
                                                    đơn hàng <b style="color: #0061AB;">"'.$booking[0]->code_booking.'"</b>
                                                    tour <b style="color: #0061AB;">"'.$booking[0]->name_tour.'"</b> tới quý khách như sau:</p>

                                                <table class="bang_gia" style="width: 100%; margin-bottom: 20px">
                                                    <tr>
                                                        <th style=" color: #FFFFFF;background-color: #508abb;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 50px; text-align: center">
                                                            #
                                                        </th>
                                                        <th style="  color: #FFFFFF;background-color: #508abb;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                            Độ tuổi
                                                        </th>
                                                        <th style="  color: #FFFFFF;background-color: #508abb;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 100px">
                                                            Đơn giá (vnđ)
                                                        </th>
                                                        <th style="  color: #FFFFFF;background-color: #508abb;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 90px">
                                                            Số lượng
                                                        </th>
                                                        <th style="  color: #FFFFFF;background-color: #508abb;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 150px">
                                                            Thành tiền (vnđ)
                                                        </th>
                                                    </tr>
                                                    <tbody>
                                                    <tr>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; text-align: center">
                                                            1
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                            Người lớn '.$do_tuoi_nguoi_lon.'
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 100px">
                                                            '.$price_new_format.'
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 90px">
                                                           '.$num_nguoi_lon.'
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 150px">
                                                            '.$giaban_format.'
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; text-align: center">
                                                            2
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                           Trẻ em 10-12 tuổi
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 100px">
                                                            2.000.000
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 90px">
                                                           1
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 150px">
                                                            2.000.000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; text-align: center">
                                                           3
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                            Trẻ em 2-10 tuổi
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 100px">
                                                            1.000.000
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 90px">
                                                            1
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 150px">
                                                            1.000.000
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; text-align: center">
                                                           4
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                            Trẻ em dưới tuổi
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 100px">
                                                            500.000
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 90px">
                                                            1
                                                        </td>
                                                        <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 150px">
                                                            500.000
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th style="background-color: #e5f5ff;border: 1px solid #e1edff;padding: 5px 5px; color: red;   text-align: right;font-size: 14px;"
                                                            colspan="4">Tổng tiền
                                                        </th>
                                                        <th style="background-color: #e5f5ff;border: 1px solid #e1edff;padding: 5px 5px;color: red; text-align: left;font-size: 14px;">
                                                            15.500.000 vnđ
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th style="background-color: #e5f5ff;border: 1px solid #e1edff;padding: 5px 5px; color: red;   text-align: right;font-size: 14px;"
                                                            colspan="4">Đặt cọc
                                                        </th>
                                                        <th style="background-color: #e5f5ff;border: 1px solid #e1edff;padding: 5px 5px;color: red; text-align: left;font-size: 14px;">
                                                            5.000.000 vnđ
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th style="background-color: #e5f5ff;border: 1px solid #e1edff;padding: 5px 5px; color: red;   text-align: right;font-size: 14px;"
                                                            colspan="4">Còn lại
                                                        </th>
                                                        <th style="background-color: #e5f5ff;border: 1px solid #e1edff;padding: 5px 5px;color: red; text-align: left;font-size: 14px;">
                                                            10.000.000 vnđ
                                                        </th>
                                                    </tr>
                                                    </tfoot>
                                                </table>

                                            </div>
                                            <p style="text-align: center; text-transform: uppercase">
                                                <span style="font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif !important;mso-line-height-rule:exactly;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;    color: #0061AB;">Thông tin tour</span>
                                            </p>
                                            <div style="float: left; width: 100%; margin-bottom: 20px; ">

                                                    <table class="bang_gia" style="width: 100%; margin-bottom: 20px">
                                                        <tbody>
                                                        <tr>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; ">
                                                                Tour
                                                            </td>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                                <a href="">	Tour du lịch Malaysia - Singapore 6 Ngày 5 Đêm Tháng 1</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; ">
                                                                Mã tour
                                                            </td>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                                123124123
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; ">
                                                               Tên đoàn
                                                            </td>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                                123124123
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; ">
                                                                Ngày đặt tour
                                                            </td>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                                29-12-2017 15:31:35
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; ">
                                                                Ngày khởi hành
                                                            </td>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                                29-12-2017 15:31:35
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left; width: 50px; ">
                                                                Điểm đón
                                                            </td>
                                                            <td style="background-color: #f4fbff;border: 1px solid #e1edff;padding: 5px 5px;font-size: 12px;text-align: left;width: 180px;">
                                                               Hà Nội
                                                            </td>
                                                        </tr>
                                                    </table>

                                            </div>
                                        </div>';

        $email_tem = str_replace('{{CONTENT}}', $content, $email_tem);
    }

    echo $email_tem;
//    $content_noti=json_decode($content_noti,true);

}
