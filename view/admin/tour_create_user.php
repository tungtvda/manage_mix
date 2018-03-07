<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_tour_create_user($data)
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
    $ft->assign('TABLE-NAME','tour_create_user');
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
    return '<th>id</th><th>user_id</th><th>customer_id</th><th>status</th><th>name_cus</th><th>email_cus</th><th>phone_cus</th><th>address_cus</th><th>code_tour</th><th>name_tour</th><th>time_tour</th><th>date_tour</th><th>address_tour</th><th>note_tour</th><th>created</th><th>updated</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->user_id."</td>";
        $TableBody.="<td>".$obj->customer_id."</td>";
        $TableBody.="<td>".$obj->status."</td>";
        $TableBody.="<td>".$obj->name_cus."</td>";
        $TableBody.="<td>".$obj->email_cus."</td>";
        $TableBody.="<td>".$obj->phone_cus."</td>";
        $TableBody.="<td>".$obj->address_cus."</td>";
        $TableBody.="<td>".$obj->code_tour."</td>";
        $TableBody.="<td>".$obj->name_tour."</td>";
        $TableBody.="<td>".$obj->time_tour."</td>";
        $TableBody.="<td>".$obj->date_tour."</td>";
        $TableBody.="<td>".$obj->address_tour."</td>";
        $TableBody.="<td>".$obj->note_tour."</td>";
        $TableBody.="<td>".$obj->created."</td>";
        $TableBody.="<td>".$obj->updated."</td>";
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
    $str_from.='<p><label>user_id</label><input class="text-input small-input" type="text"  name="user_id" value="'.(($form!=false)?$form->user_id:'').'" /></p>';
    $str_from.='<p><label>customer_id</label><input class="text-input small-input" type="text"  name="customer_id" value="'.(($form!=false)?$form->customer_id:'').'" /></p>';
    $str_from.='<p><label>status</label><input class="text-input small-input" type="text"  name="status" value="'.(($form!=false)?$form->status:'').'" /></p>';
    $str_from.='<p><label>name_cus</label><input class="text-input small-input" type="text"  name="name_cus" value="'.(($form!=false)?$form->name_cus:'').'" /></p>';
    $str_from.='<p><label>email_cus</label><input class="text-input small-input" type="text"  name="email_cus" value="'.(($form!=false)?$form->email_cus:'').'" /></p>';
    $str_from.='<p><label>phone_cus</label><input class="text-input small-input" type="text"  name="phone_cus" value="'.(($form!=false)?$form->phone_cus:'').'" /></p>';
    $str_from.='<p><label>address_cus</label><input class="text-input small-input" type="text"  name="address_cus" value="'.(($form!=false)?$form->address_cus:'').'" /></p>';
    $str_from.='<p><label>code_tour</label><input class="text-input small-input" type="text"  name="code_tour" value="'.(($form!=false)?$form->code_tour:'').'" /></p>';
    $str_from.='<p><label>name_tour</label><input class="text-input small-input" type="text"  name="name_tour" value="'.(($form!=false)?$form->name_tour:'').'" /></p>';
    $str_from.='<p><label>time_tour</label><input class="text-input small-input" type="text"  name="time_tour" value="'.(($form!=false)?$form->time_tour:'').'" /></p>';
    $str_from.='<p><label>date_tour</label><input class="text-input small-input" type="text"  name="date_tour" value="'.(($form!=false)?$form->date_tour:'').'" /></p>';
    $str_from.='<p><label>address_tour</label><input class="text-input small-input" type="text"  name="address_tour" value="'.(($form!=false)?$form->address_tour:'').'" /></p>';
    $str_from.='<p><label>note_tour</label><textarea name="note_tour">'.(($form!=false)?$form->note_tour:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'note_tour\'); </script></p>';
    $str_from.='<p><label>created</label><input class="text-input small-input" type="text"  name="created" value="'.(($form!=false)?$form->created:'').'" /></p>';
    $str_from.='<p><label>updated</label><input class="text-input small-input" type="text"  name="updated" value="'.(($form!=false)?$form->updated:'').'" /></p>';
    return $str_from;
}
