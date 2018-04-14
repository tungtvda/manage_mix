<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_review_tour($data)
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
    $ft->assign('TABLE-NAME','review_tour');
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
    return '<th>id</th><th>tour_id</th><th>tour_name</th><th>tour_code</th><th>domain</th><th>content</th><th>departure</th><th>status</th><th>program</th><th>show_program</th><th>tour_guide_full</th><th>show_tour_guide_full</th><th>tour_guide_local</th><th>show_tour_guide_local</th><th>hotel</th><th>show_hotel</th><th>restaurant</th><th>show_restaurant</th><th>transportation</th><th>show_transportation</th><th>comment</th><th>show_coment</th><th>upcoming_tour</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->tour_id."</td>";
        $TableBody.="<td>".$obj->tour_name."</td>";
        $TableBody.="<td>".$obj->tour_code."</td>";
        $TableBody.="<td>".$obj->domain."</td>";
        $TableBody.="<td>".$obj->content."</td>";
        $TableBody.="<td>".$obj->departure."</td>";
        $TableBody.="<td>".$obj->status."</td>";
        $TableBody.="<td>".$obj->program."</td>";
        $TableBody.="<td>".$obj->show_program."</td>";
        $TableBody.="<td>".$obj->tour_guide_full."</td>";
        $TableBody.="<td>".$obj->show_tour_guide_full."</td>";
        $TableBody.="<td>".$obj->tour_guide_local."</td>";
        $TableBody.="<td>".$obj->show_tour_guide_local."</td>";
        $TableBody.="<td>".$obj->hotel."</td>";
        $TableBody.="<td>".$obj->show_hotel."</td>";
        $TableBody.="<td>".$obj->restaurant."</td>";
        $TableBody.="<td>".$obj->show_restaurant."</td>";
        $TableBody.="<td>".$obj->transportation."</td>";
        $TableBody.="<td>".$obj->show_transportation."</td>";
        $TableBody.="<td>".$obj->comment."</td>";
        $TableBody.="<td>".$obj->show_coment."</td>";
        $TableBody.="<td>".$obj->upcoming_tour."</td>";
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
    $str_from.='<p><label>tour_id</label><input class="text-input small-input" type="text"  name="tour_id" value="'.(($form!=false)?$form->tour_id:'').'" /></p>';
    $str_from.='<p><label>tour_name</label><input class="text-input small-input" type="text"  name="tour_name" value="'.(($form!=false)?$form->tour_name:'').'" /></p>';
    $str_from.='<p><label>tour_code</label><input class="text-input small-input" type="text"  name="tour_code" value="'.(($form!=false)?$form->tour_code:'').'" /></p>';
    $str_from.='<p><label>domain</label><input class="text-input small-input" type="text"  name="domain" value="'.(($form!=false)?$form->domain:'').'" /></p>';
    $str_from.='<p><label>content</label><input class="text-input small-input" type="text"  name="content" value="'.(($form!=false)?$form->content:'').'" /></p>';
    $str_from.='<p><label>departure</label><input class="text-input small-input" type="text"  name="departure" value="'.(($form!=false)?$form->departure:'').'" /></p>';
    $str_from.='<p><label>status</label><input class="text-input small-input" type="text"  name="status" value="'.(($form!=false)?$form->status:'').'" /></p>';
    $str_from.='<p><label>program</label><input class="text-input small-input" type="text"  name="program" value="'.(($form!=false)?$form->program:'').'" /></p>';
    $str_from.='<p><label>show_program</label><input class="text-input small-input" type="text"  name="show_program" value="'.(($form!=false)?$form->show_program:'').'" /></p>';
    $str_from.='<p><label>tour_guide_full</label><input class="text-input small-input" type="text"  name="tour_guide_full" value="'.(($form!=false)?$form->tour_guide_full:'').'" /></p>';
    $str_from.='<p><label>show_tour_guide_full</label><input class="text-input small-input" type="text"  name="show_tour_guide_full" value="'.(($form!=false)?$form->show_tour_guide_full:'').'" /></p>';
    $str_from.='<p><label>tour_guide_local</label><input class="text-input small-input" type="text"  name="tour_guide_local" value="'.(($form!=false)?$form->tour_guide_local:'').'" /></p>';
    $str_from.='<p><label>show_tour_guide_local</label><input class="text-input small-input" type="text"  name="show_tour_guide_local" value="'.(($form!=false)?$form->show_tour_guide_local:'').'" /></p>';
    $str_from.='<p><label>hotel</label><input class="text-input small-input" type="text"  name="hotel" value="'.(($form!=false)?$form->hotel:'').'" /></p>';
    $str_from.='<p><label>show_hotel</label><input class="text-input small-input" type="text"  name="show_hotel" value="'.(($form!=false)?$form->show_hotel:'').'" /></p>';
    $str_from.='<p><label>restaurant</label><input class="text-input small-input" type="text"  name="restaurant" value="'.(($form!=false)?$form->restaurant:'').'" /></p>';
    $str_from.='<p><label>show_restaurant</label><input class="text-input small-input" type="text"  name="show_restaurant" value="'.(($form!=false)?$form->show_restaurant:'').'" /></p>';
    $str_from.='<p><label>transportation</label><input class="text-input small-input" type="text"  name="transportation" value="'.(($form!=false)?$form->transportation:'').'" /></p>';
    $str_from.='<p><label>show_transportation</label><input class="text-input small-input" type="text"  name="show_transportation" value="'.(($form!=false)?$form->show_transportation:'').'" /></p>';
    $str_from.='<p><label>comment</label><textarea name="comment">'.(($form!=false)?$form->comment:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'comment\'); </script></p>';
    $str_from.='<p><label>show_coment</label><input class="text-input small-input" type="text"  name="show_coment" value="'.(($form!=false)?$form->show_coment:'').'" /></p>';
    $str_from.='<p><label>upcoming_tour</label><textarea name="upcoming_tour">'.(($form!=false)?$form->upcoming_tour:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'upcoming_tour\'); </script></p>';
    $str_from.='<p><label>created</label><input class="text-input small-input" type="text"  name="created" value="'.(($form!=false)?$form->created:'').'" /></p>';
    $str_from.='<p><label>updated</label><input class="text-input small-input" type="text"  name="updated" value="'.(($form!=false)?$form->updated:'').'" /></p>';
    $str_from.='<p><label>updated_by</label><input class="text-input small-input" type="text"  name="updated_by" value="'.(($form!=false)?$form->updated_by:'').'" /></p>';
    return $str_from;
}
