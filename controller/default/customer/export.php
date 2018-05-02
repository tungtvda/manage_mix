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
require_once(DIR . "/common/Classes/PHPExcel.php");
$res = array(
    'success' => 0,
    'mess' => 'Lỗi! bạn vui lòng F5 và thử lại',
);
$objXLS = new PHPExcel();
$objXLS->getActiveSheet()->setTitle('List User');
$objXLS->setActiveSheetIndex(0);
$objXLS->getActiveSheet()->SetCellValue('A1', 'STT');
$objXLS->getActiveSheet()->SetCellValue('B1', 'Họ Tên');
$objXLS->getActiveSheet()->SetCellValue('C1', 'Danh Xưng');
$objXLS->getActiveSheet()->SetCellValue('D1', 'Địa Chỉ ');
$objXLS->getActiveSheet()->SetCellValue('E1', 'Di Động ');
$objXLS->getActiveSheet()->SetCellValue('F1', 'Điện Thoại  ');
$objXLS->getActiveSheet()->SetCellValue('G1', 'Email ');
$objXLS->getActiveSheet()->SetCellValue('H1', 'Ngành Nghề');
$objXLS->getActiveSheet()->SetCellValue('I1', 'Tên Công Ty ');
$objXLS->getActiveSheet()->SetCellValue('J1', 'Chức vụ');
$objXLS->getActiveSheet()->SetCellValue('K1', 'Note ');
$i=1;
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FF0000'),
        'size'  => 15

    ));

$listUser = customer_getByAll();
foreach ($listUser as $item){
    $i++;
    $objXLS->getActiveSheet()->SetCellValue('A'.$i, $i);
    $objXLS->getActiveSheet()->SetCellValue('B'.$i, $item->name);
    $objXLS->getActiveSheet()->SetCellValue('C'.$i, $item->mr);
    $objXLS->getActiveSheet()->SetCellValue('D'.$i, $item->address);
    $objXLS->getActiveSheet()->SetCellValue('E'.$i, $item->phone);
    $objXLS->getActiveSheet()->SetCellValue('F'.$i, $item->mobi);
    $objXLS->getActiveSheet()->SetCellValue('G'.$i, $item->email);
    $objXLS->getActiveSheet()->SetCellValue('H'.$i, $item->director_name);
    $objXLS->getActiveSheet()->SetCellValue('I'.$i, $item->company_name);
    $objXLS->getActiveSheet()->SetCellValue('J'.$i, $item->chuc_vu);
    $objXLS->getActiveSheet()->SetCellValue('K'.$i, $item->note);

}
$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');
$fileName = time().'.xlsx';
if (!file_exists('exports')) {
    mkdir('exports', 0777, true);
}
$objWriter->save(__DIR__."/exports/".$fileName);
$res = array(
    'success' => 1,
    'mess' =>'Export successfully',
    'url'=>SITE_NAME.'/controller/default/customer/exports/'.$fileName
);
echo json_encode($res);