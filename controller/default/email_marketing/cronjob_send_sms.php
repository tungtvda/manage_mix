<?php
if (!defined('DIR')) require_once '../../../config.php';

require_once DIR . '/model/customerService.php';
require_once DIR . '/model/sms_emailService.php';
require_once DIR . '/model/logService.php';
$data_short_code_cus=sms_email_getByTop('','type=1','position asc');
$time_now=_returnGetDateTime();
$dk_find="status=0 and date_time_send<='".$time_now."'";
$data_email=sms_email_getByTop('',$dk_find,'id desc');
if(count($data_email)>0){
    foreach($data_email as $row){
        // send email customer
        if($row->content_email!='')
        {
            $customer=trim($row->customer,',');
            $user=trim($row->customer,',');
            if($customer!=''){

                $array_customer=explode(',',$customer);
                if(count($array_customer)>0){
                    foreach($array_customer as $row_cus){
                        $data_customer=customer_getById($row_cus);
                        if(count($data_customer)>0){
                            $content_email=$row->content_email;
                            foreach($data_short_code_cus as $row)
                            {

                            }
                        }

                    }
                }
            }
        }



    }
}