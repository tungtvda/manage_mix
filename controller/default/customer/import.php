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
require_once(DIR . "/common/excel_reader2.php");
require_once(DIR . "/common/Classes/PHPExcel/IOFactory.php");

print_r($_FILES['file']);
if(isset($_FILES['file'])){
    $allowedExtensions = array("xls","xlsx","csv");
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if(in_array($ext, $allowedExtensions)) {
        if($_FILES['file']['size']>0){
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
                            print_r($sheet->getCell('G'.$row)->getValue().'/');
                        }
                    }else{
                        print 'File do not have data!';
                    }
                }
     }
     else{
            print 'Maximum file size empty!';
        }
    }else{
        print 'This type of file not allowed!';
    }
}else{
    print 'Select an excel file first!';
};
