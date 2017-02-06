<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_permison_module($data)
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
    $ft->assign('TABLE-NAME','permison_module');
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
    return '<th>id</th><th>name</th><th>icon</th><th>url</th><th>action_count</th><th>dk_count</th><th>active</th><th>status</th><th>position</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->name."</td>";
        $TableBody.="<td>".$obj->icon."</td>";
        $TableBody.="<td>".$obj->url."</td>";
        $TableBody.="<td>".$obj->action_count."</td>";
        $TableBody.="<td>".$obj->dk_count."</td>";
        $TableBody.="<td>".$obj->active."</td>";
        $TableBody.="<td>".$obj->status."</td>";
        $TableBody.="<td>".$obj->position."</td>";
        $TableBody.="<td><a href=\"?action=edit&id=".$obj->id."\" title=\"Edit\"><img src=\"".SITE_NAME."/view/admin/Themes/images/pencil.png\" alt=\"Edit\"></a>";
        $TableBody.="<a href=\"?action=delete&id=".$obj->id."\" title=\"Delete\" onClick=\"return confirm('Bạn có chắc chắc muốn xóa?')\"><img src=\"".SITE_NAME."/view/admin/Themes/images/cross.png\" alt=\"Delete\"></a> ";
        $TableBody.="</td>";
        $TableBody.="</tr>";
    }
    return $TableBody;
}
//
function showFrom($form,$ListKey=array())
{
    $str_from='';
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>icon</label><input class="text-input small-input" type="text"  name="icon" value="'.(($form!=false)?$form->icon:'').'" /></p>';
    $str_from.='<p><label>url</label><input class="text-input small-input" type="text"  name="url" value="'.(($form!=false)?$form->url:'').'" /></p>';
    $str_from.='<p><label>action_count</label><input class="text-input small-input" type="text"  name="action_count" value="'.(($form!=false)?$form->action_count:'').'" /></p>';
    $str_from.='<p><label>dk_count</label><input class="text-input small-input" type="text"  name="dk_count" value="'.(($form!=false)?$form->dk_count:'').'" /></p>';
    $str_from.='<p><label>active</label><input class="text-input small-input" type="text"  name="active" value="'.(($form!=false)?$form->active:'').'" /></p>';
    $str_from.='<p><label>status</label><input  type="checkbox"  name="status" value="1" '.(($form!=false)?(($form->status=='1')?'checked':''):'').' /></p>';
    $str_from.='<p><label>position</label><input class="text-input small-input" type="text"  name="position" value="'.(($form!=false)?$form->position:'').'" /></p>';
    return $str_from;
}
