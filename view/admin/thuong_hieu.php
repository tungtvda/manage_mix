<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_thuong_hieu($data)
{
    $ft=new FastTemplate(DIR.'/view/admin/templates');
    $ft->define('header','header.tpl');
    $ft->define('body','body.tpl');
    $ft->define('footer','footer.tpl');
    //
    $ft->assign('TAB1-CLASS',isset($data['tab1_class'])?$data['tab1_class']:'');
    $ft->assign('TAB2-CLASS',isset($data['tab2_class'])?$data['tab2_class']:'');
    $ft->assign('USER-NAME',isset($data['username'])?$data['username']:'');
    $ft->assign('NOTIFICATION-CONTENT',isset($data['notififation_content'])?$data['notififation_content']:'');
    $ft->assign('TABLE-HEADER',showTableHeader());
    $ft->assign('PAGING',showPaging($data['count_paging'],20,$data['page']));
    $ft->assign('TABLE-BODY',showTableBody($data['table_body']));
    $ft->assign('TABLE-NAME','thuong_hieu');
    $ft->assign('CONTENT-BOX-LEFT',isset($data['content_box_left'])?$data['content_box_left']:'');
    $ft->assign('CONTENT-BOX-RIGHT',isset($data['content_box_right'])?$data['content_box_right']:' ');
    $ft->assign('NOTIFICATION',isset($data['notification'])?$data['notification']:' ');
    $ft->assign('SITE-NAME',isset($data['sitename'])?$data['sitename']:SITE_NAME);
    $ft->assign('FORM',showFrom(isset($data['form'])?$data['form']:'',isset($data['listfkey'])?$data['listfkey']:array()));
    //
    print $ft->parse_and_return('header');
    print $ft->parse_and_return('body');
    print $ft->parse_and_return('footer');
}
//
function showTableHeader()
{
    return '<th>active</th><th>name</th><th>logo</th><th>icon</th><th>banner</th><th>banner_qc</th><th>email</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->active."</td>";
        $TableBody.="<td>".$obj->name."</td>";
        $TableBody.="<td><img src=\"".$obj->logo."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td><img src=\"".$obj->icon."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td><img src=\"".$obj->banner."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td><img src=\"".$obj->banner_qc."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td>".$obj->email."</td>";
        $TableBody.="<td><a href=\"?action=edit&id=".$obj->id."\" title=\"Edit\"><img src=\"".SITE_NAME."/view/admin/Themes/images/pencil.png\" alt=\"Edit\"></a>";
//        $TableBody.="<a href=\"?action=delete&id=".$obj->id."\" title=\"Delete\" onClick=\"return confirm('Bạn có chắc chắc muốn xóa?')\"><img src=\"".SITE_NAME."/view/admin/Themes/images/cross.png\" alt=\"Delete\"></a> ";
        $TableBody.="</td>";
        $TableBody.="</tr>";
    }
    return $TableBody;
}
//
function showFrom($form,$ListKey=array())
{
    $str_from='';
    $str_from.='<p><label>active</label><input  type="checkbox"  name="active" value="1" '.(($form!=false)?(($form->active=='1')?'checked':''):'').' /></p>';
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>logo</label><input class="text-input small-input" type="text"  name="logo" value="'.(($form!=false)?$form->logo:'').'"/><a class="button" onclick="openKcEditor(\'logo\');">Upload ảnh</a></p>';
    $str_from.='<p><label>icon</label><input class="text-input small-input" type="text"  name="icon" value="'.(($form!=false)?$form->icon:'').'"/><a class="button" onclick="openKcEditor(\'icon\');">Upload ảnh</a></p>';
    $str_from.='<p><label>banner</label><input class="text-input small-input" type="text"  name="banner" value="'.(($form!=false)?$form->banner:'').'"/><a class="button" onclick="openKcEditor(\'banner\');">Upload ảnh</a></p>';
    $str_from.='<p><label>link_banner</label><input class="text-input small-input" type="text"  name="link_banner" value="'.(($form!=false)?$form->link_banner:'').'" /></p>';
    $str_from.='<p><label>banner_qc</label><input class="text-input small-input" type="text"  name="banner_qc" value="'.(($form!=false)?$form->banner_qc:'').'"/><a class="button" onclick="openKcEditor(\'banner_qc\');">Upload ảnh</a></p>';
    $str_from.='<p><label>link_banner_qc</label><input class="text-input small-input" type="text"  name="link_banner_qc" value="'.(($form!=false)?$form->link_banner_qc:'').'" /></p>';
    $str_from.='<p><label>link_khoi_hanh</label><input class="text-input small-input" type="text"  name="link_khoi_hanh" value="'.(($form!=false)?$form->link_khoi_hanh:'').'" /></p>';
    $str_from.='<p><label>email</label><input class="text-input small-input" type="text"  name="email" value="'.(($form!=false)?$form->email:'').'" /></p>';
    $str_from.='<p><label>mat_khau_ung_dung</label><input class="text-input small-input" type="text"  name="mat_khau_ung_dung" value="'.(($form!=false)?$form->mat_khau_ung_dung:'').'" /></p>';
    $str_from.='<p><label>chu_ky_email</label><textarea name="chu_ky_email">'.(($form!=false)?$form->chu_ky_email:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'chu_ky_email\'); </script></p>';
    return $str_from;
}
