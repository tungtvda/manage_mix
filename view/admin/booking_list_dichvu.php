<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_booking_list_dichvu($data)
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
    $ft->assign('TABLE-NAME','booking_list_dichvu');
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
    return '<th>id</th><th>booking_id</th><th>name</th><th>type</th><th>price</th><th>number</th><th>total</th><th>note</th>';
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
        $TableBody.="<td>".$obj->name."</td>";
        $TableBody.="<td>".$obj->type."</td>";
        $TableBody.="<td>".$obj->price."</td>";
        $TableBody.="<td>".$obj->number."</td>";
        $TableBody.="<td>".$obj->total."</td>";
        $TableBody.="<td>".$obj->note."</td>";
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
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>type</label><input class="text-input small-input" type="text"  name="type" value="'.(($form!=false)?$form->type:'').'" /></p>';
    $str_from.='<p><label>price</label><input class="text-input small-input" type="text"  name="price" value="'.(($form!=false)?$form->price:'').'" /></p>';
    $str_from.='<p><label>number</label><input class="text-input small-input" type="text"  name="number" value="'.(($form!=false)?$form->number:'').'" /></p>';
    $str_from.='<p><label>total</label><input class="text-input small-input" type="text"  name="total" value="'.(($form!=false)?$form->total:'').'" /></p>';
    $str_from.='<p><label>note</label><textarea name="note">'.(($form!=false)?$form->note:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'note\'); </script></p>';
    return $str_from;
}
