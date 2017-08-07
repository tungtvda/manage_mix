<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_rut_tien($data)
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
    $ft->assign('TABLE-NAME','rut_tien');
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
    return '<th>id</th><th>code</th><th>user_tiep_thi_id</th><th>admin_confirm_id</th><th>name</th><th>price</th><th>price_confirm</th><th>status</th><th>yeu_cau</th><th>yeu_cau_confirm</th><th>date_send</th><th>date_confirm</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->code."</td>";
        $TableBody.="<td>".$obj->user_tiep_thi_id."</td>";
        $TableBody.="<td>".$obj->admin_confirm_id."</td>";
        $TableBody.="<td>".$obj->name."</td>";
        $TableBody.="<td>".$obj->price."</td>";
        $TableBody.="<td>".$obj->price_confirm."</td>";
        $TableBody.="<td>".$obj->status."</td>";
        $TableBody.="<td>".$obj->yeu_cau."</td>";
        $TableBody.="<td>".$obj->yeu_cau_confirm."</td>";
        $TableBody.="<td>".$obj->date_send."</td>";
        $TableBody.="<td>".$obj->date_confirm."</td>";
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
    $str_from.='<p><label>code</label><input class="text-input small-input" type="text"  name="code" value="'.(($form!=false)?$form->code:'').'" /></p>';
    $str_from.='<p><label>user_tiep_thi_id</label><input class="text-input small-input" type="text"  name="user_tiep_thi_id" value="'.(($form!=false)?$form->user_tiep_thi_id:'').'" /></p>';
    $str_from.='<p><label>admin_confirm_id</label><input class="text-input small-input" type="text"  name="admin_confirm_id" value="'.(($form!=false)?$form->admin_confirm_id:'').'" /></p>';
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>price</label><input class="text-input small-input" type="text"  name="price" value="'.(($form!=false)?$form->price:'').'" /></p>';
    $str_from.='<p><label>price_confirm</label><input class="text-input small-input" type="text"  name="price_confirm" value="'.(($form!=false)?$form->price_confirm:'').'" /></p>';
    $str_from.='<p><label>status</label><input class="text-input small-input" type="text"  name="status" value="'.(($form!=false)?$form->status:'').'" /></p>';
    $str_from.='<p><label>yeu_cau</label><textarea name="yeu_cau">'.(($form!=false)?$form->yeu_cau:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'yeu_cau\'); </script></p>';
    $str_from.='<p><label>yeu_cau_confirm</label><textarea name="yeu_cau_confirm">'.(($form!=false)?$form->yeu_cau_confirm:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'yeu_cau_confirm\'); </script></p>';
    $str_from.='<p><label>date_send</label><input class="text-input small-input" type="text"  name="date_send" value="'.(($form!=false)?$form->date_send:'').'" /></p>';
    $str_from.='<p><label>date_confirm</label><input class="text-input small-input" type="text"  name="date_confirm" value="'.(($form!=false)?$form->date_confirm:'').'" /></p>';
    return $str_from;
}
