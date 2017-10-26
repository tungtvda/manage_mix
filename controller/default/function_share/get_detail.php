<?php
if (!defined('DIR')) require_once '../../../config.php';
if (isset($_POST['id']) && isset($_POST['table'])) {
    $id=_return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $table = _returnPostParamSecurity('table');
    if ($id != '' && $table != '') {


        $file_model = $table . 'Service.php';
        require_once DIR . '/model/' . $file_model;

        $function_id = $table . '_getById';
        $data_check = $function_id($id);
        if (count($data_check) > 0) {
            if(isset($data_check[0]->code)){
                if($data_check[0]->code==''){
                    $data_check[0]->code=_randomBooking('cus','customer_count');
                }
            }
            if(isset($data_check[0]->created)){
                if($data_check[0]->created==''){
                    $data_check[0]->created=_returnDateNotTimieFormatConvertVn($data_check[0]->created);
                }
            }
            if(isset($data_check[0]->birthday)){
                    $data_check[0]->birthday=_returnDateNotTimieFormatConvertVn($data_check[0]->birthday);
            }
            switch($table){
                case 'sms_email':
                    require_once DIR . '/model/customerService.php';
                    $data_check[0]->count_cus=0;
                    $data_check[0]->css_height='';
                    $array_cus=explode(',',$data_check[0]->customer);
                    $data_check[0]->date_time_send=date('d-m-Y H:i:s', strtotime($data_check[0]->date_time_send));
                    $string_cus='';
                    if(count($array_cus)>0){
                        $stt=1;
                        foreach($array_cus as $row){
                            $data_cus=customer_getById($row);

                            if(count($data_cus)>0){
                                $string_cus.='<tr class="row_'.$data_cus[0]->id.' " value="'.$data_cus[0]->id.'" role="row">
                                            <td style="text-align: center">'.$stt.'</td>
                                            <td>
                                                '.$data_cus[0]->name.' - '.$data_cus[0]->code.'
                                            </td>
                                            <td style="text-align: center">
                                                <img title="'.$data_cus[0]->name.'" style="width: 30px" src="http://localhost/manage_mix/view/default/themes/images/no-avatar.png"><label style="display: none">Trần Hoài Anh</label>
                                            </td>
                                            <td>'.$data_cus[0]->email.'</td>
                                            <td>'.$data_cus[0]->phone.'</td>
                                            <td>'.$data_cus[0]->mobi.'</td>
                                            <td hidden="">
                                                <div class="hidden-sm hidden-xs action-buttons">


                                                </div>

                                                <div class="hidden-md hidden-lg">
                                                    <div class="inline pos-rel">
                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>';
                                $stt++;
                            }
                        }
                        $data_check[0]->count_cus=$stt;
                        if($stt>=5){
                            $data_check[0]->css_height='div_list_cus';
                        }

                        $data_check[0]->customer=$string_cus;
                    }
                    break;
                case 'booking_cost':
                    $data_check[0]->created=date('d-m-Y', strtotime($data_check[0]->created));
                    break;
                case 'user':
                    $data_check[0]->created=date('d-m-Y', strtotime($data_check[0]->date_range_cmnd));
                    break;
            }
          echo $data=json_encode($data_check[0]);
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}