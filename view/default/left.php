<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 8/15/14
 * Time: 3:43 PM
 */
require_once DIR.'/view/default/public.php';
function view_left($data=array())
{
    $asign=array();
    $trangchu_active = ($data['active'] == 'trangchu') ? 'active' : '';

    $permison_module=_returnQuyen(1);
    $permison_form=_returnQuyen(2);
    $string_left_menu="";
    if(count($data['data_permison_module'])>0){
        foreach($data['data_permison_module'] as $row_module){
            if(in_array($row_module->id,$permison_module)||$permison_module==null) {
                $url_module=SITE_NAME.'/'.$row_module->url;
                $icon_module=$row_module->icon;
                $name_module=$row_module->name;
                $user_active = ($data['active'] == $row_module->active) ? 'active open' : '';
                $data_permison_form=permison_form_getByTop('','id!=1 and status=1 and module_id='.$row_module->id,'position asc');
                if(count($data_permison_form)>0){

                    $string_left_menu.=' <li class="'.$user_active.'">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa '.$icon_module.'"></i>
                                <span class="menu-text">
                                   '.$name_module.'
                                </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                <b class="arrow"></b>

                <ul class="submenu">';
                    foreach($data_permison_form as $row_form)
                    {
                        if(in_array($row_form->id,$permison_form)||$permison_form==null){
                            $url_form=SITE_NAME.'/'.$row_form->url;
                            $name_form=$row_form->name;
                            $data_permison_action=permison_action_getByTop('',' status=1 and form_id='.$row_form->id,'position desc');
                            $user_active_sub = ($data['active_sub'] == $row_form->active) ? 'active' : '';
                            if(count($data_permison_action)>0)
                            {
                                $count_form='';
                                if($data['active_sub'] == $row_form->active&&$row_form->action_count!='')
                                {
                                    $action_count=$row_form->action_count;
                                    $data_count=$action_count($row_form->dk_count);
                                    $count_form='<span class="badge badge-primary">'.$data_count.'</span>';
                                }

                                $string_left_menu.='<li class="'.$user_active_sub.'">
                        <a href="'.$url_form.'">
                            <i class="menu-icon fa fa-caret-right"></i>
                           '.$name_form.'
                          '.$count_form.'
                        </a>

                        <b class="arrow"></b>
                    </li>';
                            }
                        }


                    }


                    $string_left_menu.='</ul>
            </li>';
                }
                else{
                    $data_permison_action=permison_action_getByTop('','status=1 and module_id='.$row_module->id,'position desc');
                    if(count($data_permison_action)>0)
                    {
                        $count_module='';
                        if($data['active_sub'] == $row_module->active&&$row_module->action_count!='')
                        {
                            $action_count=$row_module->action_count;
                            $data_count=$action_count($row_module->dk_count);
                            $count_module='<span class="badge badge-primary">'.$data_count.'</span>';
                        }

                        $string_left_menu.='<li class="'.$user_active.'">
                <a href="'.$url_module.'">
                    <i class="menu-icon fa '.$icon_module.'"></i>
                    <span class="menu-text"> '.$name_module.'</span>
                    '.$count_module.'
                </a>

                <b class="arrow"></b>
                </li>';
                    }

                }
            }
        }
    }
    require_once DIR . '/view/default/template/left.php';
}
