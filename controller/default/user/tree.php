<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../../config.php';
}
require_once DIR.'/controller/default/public.php';
require_once DIR.'/function/function.php';
_returnCheckExitUser();
$data_user=user_getById($_SESSION['user_id']);
if(count($data_user)==0)
{
    redict(_returnLinkDangNhap());
}

$permison_module=explode(',',$data_user[0]->permison_module);
$permison_form=explode(',',$data_user[0]->permison_form);
$permison_action=explode(',',$data_user[0]->permison_action);


$data_permison_module=permison_module_getByTop('','id!=1','position asc');
$arr_module=array();
if(count($data_permison_module)>0){
    foreach($data_permison_module as $row_module){
        $check_exit_action=0;
        $data_permison_form=permison_form_getByTop('','id!=1 and module_id='.$row_module->id,'position asc');
        $arr_form=array();
        if(count($data_permison_form)>0)
        {
            foreach($data_permison_form as $row_form){
                $arr_action=array();
                $data_permison_action=permison_action_getByTop('','form_id='.$row_form->id,'position desc');
                if(count($data_permison_action)>0)
                {
                    foreach($data_permison_action as $row_action){
                        //'mảng cấp 3
                        $checked_action=false;
                        if(in_array($row_action->id,$permison_action))
                        {
                            $checked_action=true;
                        }
                        $item_action=array(
                            "id"=>$row_action->id,
                            "text"=>$row_action->name,
                            "checked"=>$checked_action,
                            "check_module"=>$row_module->id,
                            "check_form"=>$row_form->id,
                            "check_action"=>1
                        );
                        array_push($arr_action,$item_action);
                    }

                }

                //'mảng cấp 2
                $children_action='';
                if(count($arr_action)>0)
                {
                    $children_action=$arr_action;
                }
                $checked_form=false;
                if(in_array($row_form->id,$permison_form))
                {
                    $checked_form=true;
                }
                $item_form=array(
                    "id"=>$row_form->id,
                    "text"=>$row_form->name,
                    "children"=>$children_action,
                    "check_module"=>$row_module->id,
                    "check_form"=>$row_form->id,
                );
                array_push($arr_form,$item_form);
            }
        }else{
            $data_permison_action=permison_action_getByTop('','module_id='.$row_module->id,'position desc');
            if(count($data_permison_action)>0)
            {
                $check_exit_action=1;
                $arr_action=array();
                foreach($data_permison_action as $row_action){
                    //'mảng cấp 2 không có form
                    $checked_action=false;
                    if(in_array($row_action->id,$permison_action))
                    {
                        $checked_action=true;
                    }
                    $item_action=array(
                        "id"=>$row_action->id,
                        "text"=>$row_action->name,
                        "checked"=>$checked_action,
                        "check_module"=>$row_module->id,
                        "check_form"=>'',
                        "check_action"=>1
                    );
                    array_push($arr_action,$item_action);
                }
            }
        }
        // mảng cấp 1
        $children_module='';
        if($check_exit_action==1&&count($arr_action)>0)
        {
            $children_module=$arr_action;
        }
        else{
            if(count($arr_form)>0)
            {
                $children_module=$arr_form;
            }
        }


        $checked_module=false;
        if(in_array($row_module->id,$permison_module))
        {
            $checked_module=true;
        }
        $item_module=array(
            "id"=>$row_module->id,
            "text"=>$row_module->name,
            "children"=>$children_module,
            "check_module"=>$row_module->id,
            "check_form"=>'',
        );

        array_push($arr_module,$item_module);
    }
}

echo json_encode($arr_module);
