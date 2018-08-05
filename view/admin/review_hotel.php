<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_review_hotel($data)
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
    $ft->assign('TABLE-NAME','review_hotel');
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
    return '<th>id</th><th>customer_id</th><th>hotel_id</th><th>hotel_name</th><th>hotel_code</th><th>domain</th><th>content</th><th>start_date</th><th>end_date</th><th>status</th><th>clear</th><th>show_clear</th><th>comfort</th><th>show_comfort</th><th>convenient</th><th>show_convenient</th><th>staff</th><th>show_staff</th><th>room</th><th>show_room</th><th>price</th><th>show_price</th><th>food</th><th>show_food</th><th>place</th><th>show_place</th><th>total</th><th>comment</th><th>show_coment</th><th>upcoming_tour</th><th>created</th><th>updated</th><th>updated_by</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->customer_id."</td>";
        $TableBody.="<td>".$obj->hotel_id."</td>";
        $TableBody.="<td>".$obj->hotel_name."</td>";
        $TableBody.="<td>".$obj->hotel_code."</td>";
        $TableBody.="<td>".$obj->domain."</td>";
        $TableBody.="<td>".$obj->content."</td>";
        $TableBody.="<td>".$obj->start_date."</td>";
        $TableBody.="<td>".$obj->end_date."</td>";
        $TableBody.="<td>".$obj->status."</td>";
        $TableBody.="<td>".$obj->clear."</td>";
        $TableBody.="<td>".$obj->show_clear."</td>";
        $TableBody.="<td>".$obj->comfort."</td>";
        $TableBody.="<td>".$obj->show_comfort."</td>";
        $TableBody.="<td>".$obj->convenient."</td>";
        $TableBody.="<td>".$obj->show_convenient."</td>";
        $TableBody.="<td>".$obj->staff."</td>";
        $TableBody.="<td>".$obj->show_staff."</td>";
        $TableBody.="<td>".$obj->room."</td>";
        $TableBody.="<td>".$obj->show_room."</td>";
        $TableBody.="<td>".$obj->price."</td>";
        $TableBody.="<td>".$obj->show_price."</td>";
        $TableBody.="<td>".$obj->food."</td>";
        $TableBody.="<td>".$obj->show_food."</td>";
        $TableBody.="<td>".$obj->place."</td>";
        $TableBody.="<td>".$obj->show_place."</td>";
        $TableBody.="<td>".$obj->total."</td>";
        $TableBody.="<td>".$obj->comment."</td>";
        $TableBody.="<td>".$obj->show_coment."</td>";
        $TableBody.="<td>".$obj->upcoming_tour."</td>";
        $TableBody.="<td>".$obj->created."</td>";
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
    $str_from.='<p><label>customer_id</label><input class="text-input small-input" type="text"  name="customer_id" value="'.(($form!=false)?$form->customer_id:'').'" /></p>';
    $str_from.='<p><label>hotel_id</label><input class="text-input small-input" type="text"  name="hotel_id" value="'.(($form!=false)?$form->hotel_id:'').'" /></p>';
    $str_from.='<p><label>hotel_name</label><input class="text-input small-input" type="text"  name="hotel_name" value="'.(($form!=false)?$form->hotel_name:'').'" /></p>';
    $str_from.='<p><label>hotel_code</label><input class="text-input small-input" type="text"  name="hotel_code" value="'.(($form!=false)?$form->hotel_code:'').'" /></p>';
    $str_from.='<p><label>domain</label><input class="text-input small-input" type="text"  name="domain" value="'.(($form!=false)?$form->domain:'').'" /></p>';
    $str_from.='<p><label>content</label><input class="text-input small-input" type="text"  name="content" value="'.(($form!=false)?$form->content:'').'" /></p>';
    $str_from.='<p><label>start_date</label><input class="text-input small-input" type="text"  name="start_date" value="'.(($form!=false)?$form->start_date:'').'" /></p>';
    $str_from.='<p><label>end_date</label><input class="text-input small-input" type="text"  name="end_date" value="'.(($form!=false)?$form->end_date:'').'" /></p>';
    $str_from.='<p><label>status</label><input class="text-input small-input" type="text"  name="status" value="'.(($form!=false)?$form->status:'').'" /></p>';
    $str_from.='<p><label>clear</label><input class="text-input small-input" type="text"  name="clear" value="'.(($form!=false)?$form->clear:'').'" /></p>';
    $str_from.='<p><label>show_clear</label><input class="text-input small-input" type="text"  name="show_clear" value="'.(($form!=false)?$form->show_clear:'').'" /></p>';
    $str_from.='<p><label>comfort</label><input class="text-input small-input" type="text"  name="comfort" value="'.(($form!=false)?$form->comfort:'').'" /></p>';
    $str_from.='<p><label>show_comfort</label><input class="text-input small-input" type="text"  name="show_comfort" value="'.(($form!=false)?$form->show_comfort:'').'" /></p>';
    $str_from.='<p><label>convenient</label><input class="text-input small-input" type="text"  name="convenient" value="'.(($form!=false)?$form->convenient:'').'" /></p>';
    $str_from.='<p><label>show_convenient</label><input class="text-input small-input" type="text"  name="show_convenient" value="'.(($form!=false)?$form->show_convenient:'').'" /></p>';
    $str_from.='<p><label>staff</label><input class="text-input small-input" type="text"  name="staff" value="'.(($form!=false)?$form->staff:'').'" /></p>';
    $str_from.='<p><label>show_staff</label><input class="text-input small-input" type="text"  name="show_staff" value="'.(($form!=false)?$form->show_staff:'').'" /></p>';
    $str_from.='<p><label>room</label><input class="text-input small-input" type="text"  name="room" value="'.(($form!=false)?$form->room:'').'" /></p>';
    $str_from.='<p><label>show_room</label><input class="text-input small-input" type="text"  name="show_room" value="'.(($form!=false)?$form->show_room:'').'" /></p>';
    $str_from.='<p><label>price</label><input class="text-input small-input" type="text"  name="price" value="'.(($form!=false)?$form->price:'').'" /></p>';
    $str_from.='<p><label>show_price</label><input class="text-input small-input" type="text"  name="show_price" value="'.(($form!=false)?$form->show_price:'').'" /></p>';
    $str_from.='<p><label>food</label><input class="text-input small-input" type="text"  name="food" value="'.(($form!=false)?$form->food:'').'" /></p>';
    $str_from.='<p><label>show_food</label><input class="text-input small-input" type="text"  name="show_food" value="'.(($form!=false)?$form->show_food:'').'" /></p>';
    $str_from.='<p><label>place</label><input class="text-input small-input" type="text"  name="place" value="'.(($form!=false)?$form->place:'').'" /></p>';
    $str_from.='<p><label>show_place</label><input class="text-input small-input" type="text"  name="show_place" value="'.(($form!=false)?$form->show_place:'').'" /></p>';
    $str_from.='<p><label>total</label><input class="text-input small-input" type="text"  name="total" value="'.(($form!=false)?$form->total:'').'" /></p>';
    $str_from.='<p><label>comment</label><textarea name="comment">'.(($form!=false)?$form->comment:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'comment\'); </script></p>';
    $str_from.='<p><label>show_coment</label><input class="text-input small-input" type="text"  name="show_coment" value="'.(($form!=false)?$form->show_coment:'').'" /></p>';
    $str_from.='<p><label>upcoming_tour</label><textarea name="upcoming_tour">'.(($form!=false)?$form->upcoming_tour:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'upcoming_tour\'); </script></p>';
    $str_from.='<p><label>created</label><input class="text-input small-input" type="text"  name="created" value="'.(($form!=false)?$form->created:'').'" /></p>';
    $str_from.='<p><label>updated</label><input class="text-input small-input" type="text"  name="updated" value="'.(($form!=false)?$form->updated:'').'" /></p>';
    $str_from.='<p><label>updated_by</label><input class="text-input small-input" type="text"  name="updated_by" value="'.(($form!=false)?$form->updated_by:'').'" /></p>';
    return $str_from;
}
