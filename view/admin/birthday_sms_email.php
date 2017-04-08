<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_birthday_sms_email($data)
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
    $ft->assign('TABLE-NAME','birthday_sms_email');
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
    return '<th>id</th><th>user</th><th>customer</th><th>content_sms</th><th>content_email</th><th>status</th><th>count_cus</th><th>count_success_sms</th><th>count_success_email</th><th>cus_false_sms</th><th>cus_false_email</th><th>date_send</th><th>created</th><th>created_by</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->user."</td>";
        $TableBody.="<td>".$obj->customer."</td>";
        $TableBody.="<td>".$obj->content_sms."</td>";
        $TableBody.="<td>".$obj->content_email."</td>";
        $TableBody.="<td>".$obj->status."</td>";
        $TableBody.="<td>".$obj->count_cus."</td>";
        $TableBody.="<td>".$obj->count_success_sms."</td>";
        $TableBody.="<td>".$obj->count_success_email."</td>";
        $TableBody.="<td>".$obj->cus_false_sms."</td>";
        $TableBody.="<td>".$obj->cus_false_email."</td>";
        $TableBody.="<td>".$obj->date_send."</td>";
        $TableBody.="<td>".$obj->created."</td>";
        $TableBody.="<td>".$obj->created_by."</td>";
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
    $str_from.='<p><label>user</label><input class="text-input small-input" type="text"  name="user" value="'.(($form!=false)?$form->user:'').'" /></p>';
    $str_from.='<p><label>customer</label><input class="text-input small-input" type="text"  name="customer" value="'.(($form!=false)?$form->customer:'').'" /></p>';
    $str_from.='<p><label>content_sms</label><input class="text-input small-input" type="text"  name="content_sms" value="'.(($form!=false)?$form->content_sms:'').'" /></p>';
    $str_from.='<p><label>content_email</label><input class="text-input small-input" type="text"  name="content_email" value="'.(($form!=false)?$form->content_email:'').'" /></p>';
    $str_from.='<p><label>status</label><input class="text-input small-input" type="text"  name="status" value="'.(($form!=false)?$form->status:'').'" /></p>';
    $str_from.='<p><label>count_cus</label><input class="text-input small-input" type="text"  name="count_cus" value="'.(($form!=false)?$form->count_cus:'').'" /></p>';
    $str_from.='<p><label>count_success_sms</label><input class="text-input small-input" type="text"  name="count_success_sms" value="'.(($form!=false)?$form->count_success_sms:'').'" /></p>';
    $str_from.='<p><label>count_success_email</label><input class="text-input small-input" type="text"  name="count_success_email" value="'.(($form!=false)?$form->count_success_email:'').'" /></p>';
    $str_from.='<p><label>cus_false_sms</label><input class="text-input small-input" type="text"  name="cus_false_sms" value="'.(($form!=false)?$form->cus_false_sms:'').'" /></p>';
    $str_from.='<p><label>cus_false_email</label><input class="text-input small-input" type="text"  name="cus_false_email" value="'.(($form!=false)?$form->cus_false_email:'').'" /></p>';
    $str_from.='<p><label>date_send</label><input class="text-input small-input" type="text"  name="date_send" value="'.(($form!=false)?$form->date_send:'').'" /></p>';
    $str_from.='<p><label>created</label><input class="text-input small-input" type="text"  name="created" value="'.(($form!=false)?$form->created:'').'" /></p>';
    $str_from.='<p><label>created_by</label><input class="text-input small-input" type="text"  name="created_by" value="'.(($form!=false)?$form->created_by:'').'" /></p>';
    return $str_from;
}
