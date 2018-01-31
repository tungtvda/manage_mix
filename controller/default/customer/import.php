<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR . "/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
require_once(DIR . "/common/Classes/PHPExcel/IOFactory.php");
$res = array(
    'success' => 0,
    'mess' => 'Lỗi! bạn vui lòng F5 và thử lại',
);

if(isset($_FILES['file'])){
    $allowedExtensions = array("xls","xlsx","csv");
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if(in_array($ext, $allowedExtensions)) {
        if($_FILES['file']['size']>1000){
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            $file = "uploads/".$_FILES['file']['name'];
             move_uploaded_file($_FILES['file']['tmp_name'], $file);
                if (!file_exists($file)) {
                    print_r('File do not exist');
                }
                else{

                    $objPHPExcel = PHPExcel_IOFactory::load($file);
                    $sheet = $objPHPExcel->getSheet(0);
                  //  print_r($objPHPExcel->getActiveSheet()->getCell('B8')->getValue());
                    //It returns the highest number of rows
                    $total_rows = $sheet->getHighestRow();
                    //It returns the highest number of columns
                    $total_columns = $sheet->getHighestColumn();
                    if($total_rows>2){
                        for($row =2; $row <= $total_rows; $row++) {
                            $new_customer = new customer();
                            $new_customer->name=$sheet->getCell('B'.$row)->getValue();
                            $new_customer->mr=$sheet->getCell('C'.$row)->getValue();
                            $new_customer->address=$sheet->getCell('D'.$row)->getValue();
                            $new_customer->birthday=$sheet->getCell('E'.$row)->getValue();
                            $new_customer->phone=$sheet->getCell('F'.$row)->getValue();
                            $new_customer->mobi=$sheet->getCell('G'.$row)->getValue();
                            $new_customer->email=$sheet->getCell('H'.$row)->getValue();
                            $new_customer->director_name=$sheet->getCell('I'.$row)->getValue();
                            $new_customer->company_name=$sheet->getCell('J'.$row)->getValue();
                            $new_customer->chuc_vu=$sheet->getCell('K'.$row)->getValue();
                            $new_customer->note=$sheet->getCell('L'.$row)->getValue();
                            $new_customer->created=date('Y-m-d');
                            $new_customer->updated=date('Y-m-d');
                            $new_customer->created_by=$_SESSION['user_id'];
                            $new_customer->update_by=$_SESSION['user_id'];
                            $new_customer->code=_randomBooking('cus', 'customer_count', 'code');
                            if($new_customer->email){
                                if (!preg_match("/^[a-zA-Z ]*$/",$new_customer->email)) {
                                    $email = customer_getByTop('',"customer.email ='$new_customer->email'",'');
                                    if(count($email)<1){
                                        customer_insert($new_customer);
                                    }
                                }
                            }
                            $res = array(
                                'success' => 1,
                                'mess' => 'Import successfully!',
                            );
                        }
                    }else{
                        $res = array(
                            'success' => 0,
                            'mess' => 'File do not have data!',
                        );
                    }
                }
     }
     else{
             $res = array(
                 'success' => 0,
                 'mess' => 'Maximum file size empty!',
             );
        }
    }else{
        $res = array(
            'success' => 0,
            'mess' => 'This type of file not allowed!',
        );

    }
}else{
    $res = array(
        'success' => 0,
        'mess' => 'Select an excel file first!',
    );
};
echo json_encode($res);
