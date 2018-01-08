<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_booking_cost($data)
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
    $ft->assign('TABLE-NAME','booking_cost');
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
    return '<th>id</th><th>booking_id</th><th>user_id</th><th>name</th><th>price</th><th>description</th><th>created</th><th>created_by</th><th>updated</th><th>updated_by</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->booking_id."</td>";
        $TableBody.="<td>".$obj->user_id."</td>";
        $TableBody.="<td>".$obj->name."</td>";
        $TableBody.="<td>".$obj->price."</td>";
        $TableBody.="<td>".$obj->description."</td>";
        $TableBody.="<td>".$obj->created."</td>";
        $TableBody.="<td>".$obj->created_by."</td>";
        $TableBody.="<td>".$obj->updated."</td>";
        $TableBody.="<td>".$obj->updated_by."</td>";
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
    $str_from.='<p><label>booking_id</label><input class="text-input small-input" type="text"  name="booking_id" value="'.(($form!=false)?$form->booking_id:'').'" /></p>';
    $str_from.='<p><label>user_id</label><input class="text-input small-input" type="text"  name="user_id" value="'.(($form!=false)?$form->user_id:'').'" /></p>';
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>price</label><input class="text-input small-input" type="text"  name="price" value="'.(($form!=false)?$form->price:'').'" /></p>';
    $str_from.='<p><label>description</label><textarea name="description">'.(($form!=false)?$form->description:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'description\'); </script></p>';
    $str_from.='<p><label>created</label><input class="text-input small-input" type="text"  name="created" value="'.(($form!=false)?$form->created:'').'" /></p>';
    $str_from.='<p><label>created_by</label><input class="text-input small-input" type="text"  name="created_by" value="'.(($form!=false)?$form->created_by:'').'" /></p>';
    $str_from.='<p><label>updated</label><input class="text-input small-input" type="text"  name="updated" value="'.(($form!=false)?$form->updated:'').'" /></p>';
    $str_from.='<p><label>updated_by</label><input class="text-input small-input" type="text"  name="updated_by" value="'.(($form!=false)?$form->updated_by:'').'" /></p>';
    return $str_from;
}
