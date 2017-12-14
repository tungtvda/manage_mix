<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_booking_tour_custom($data)
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
    $ft->assign('TABLE-NAME','booking_tour_custom');
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
    return '<th>id</th><th>booking_id</th><th>name</th><th>code</th><th>chuong_trinh</th><th>chuong_trinh_price</th><th>thoi_gian</th><th>thoi_gian_price</th><th>nguoi_lon</th><th>tre_em</th><th>tre_em_5</th><th>so_nguoi_price</th><th>khach_san</th><th>khach_san_price</th><th>ngay_khoi_hanh_cus</th><th>ngay_khoi_hanh_price</th><th>hang_bay</th><th>hang_bay_price</th><th>khac</th><th>khac_price</th><th>note</th>';
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
        $TableBody.="<td>".$obj->code."</td>";
        $TableBody.="<td>".$obj->chuong_trinh."</td>";
        $TableBody.="<td>".$obj->chuong_trinh_price."</td>";
        $TableBody.="<td>".$obj->thoi_gian."</td>";
        $TableBody.="<td>".$obj->thoi_gian_price."</td>";
        $TableBody.="<td>".$obj->nguoi_lon."</td>";
        $TableBody.="<td>".$obj->tre_em."</td>";
        $TableBody.="<td>".$obj->tre_em_5."</td>";
        $TableBody.="<td>".$obj->so_nguoi_price."</td>";
        $TableBody.="<td>".$obj->khach_san."</td>";
        $TableBody.="<td>".$obj->khach_san_price."</td>";
        $TableBody.="<td>".$obj->ngay_khoi_hanh_cus."</td>";
        $TableBody.="<td>".$obj->ngay_khoi_hanh_price."</td>";
        $TableBody.="<td>".$obj->hang_bay."</td>";
        $TableBody.="<td>".$obj->hang_bay_price."</td>";
        $TableBody.="<td>".$obj->khac."</td>";
        $TableBody.="<td>".$obj->khac_price."</td>";
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
    $str_from.='<p><label>code</label><input class="text-input small-input" type="text"  name="code" value="'.(($form!=false)?$form->code:'').'" /></p>';
    $str_from.='<p><label>chuong_trinh</label><textarea name="chuong_trinh">'.(($form!=false)?$form->chuong_trinh:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'chuong_trinh\'); </script></p>';
    $str_from.='<p><label>chuong_trinh_price</label><input class="text-input small-input" type="text"  name="chuong_trinh_price" value="'.(($form!=false)?$form->chuong_trinh_price:'').'" /></p>';
    $str_from.='<p><label>thoi_gian</label><textarea name="thoi_gian">'.(($form!=false)?$form->thoi_gian:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'thoi_gian\'); </script></p>';
    $str_from.='<p><label>thoi_gian_price</label><input class="text-input small-input" type="text"  name="thoi_gian_price" value="'.(($form!=false)?$form->thoi_gian_price:'').'" /></p>';
    $str_from.='<p><label>nguoi_lon</label><input class="text-input small-input" type="text"  name="nguoi_lon" value="'.(($form!=false)?$form->nguoi_lon:'').'" /></p>';
    $str_from.='<p><label>tre_em</label><input class="text-input small-input" type="text"  name="tre_em" value="'.(($form!=false)?$form->tre_em:'').'" /></p>';
    $str_from.='<p><label>tre_em_5</label><input class="text-input small-input" type="text"  name="tre_em_5" value="'.(($form!=false)?$form->tre_em_5:'').'" /></p>';
    $str_from.='<p><label>so_nguoi_price</label><input class="text-input small-input" type="text"  name="so_nguoi_price" value="'.(($form!=false)?$form->so_nguoi_price:'').'" /></p>';
    $str_from.='<p><label>khach_san</label><input class="text-input small-input" type="text"  name="khach_san" value="'.(($form!=false)?$form->khach_san:'').'" /></p>';
    $str_from.='<p><label>khach_san_price</label><input class="text-input small-input" type="text"  name="khach_san_price" value="'.(($form!=false)?$form->khach_san_price:'').'" /></p>';
    $str_from.='<p><label>ngay_khoi_hanh_cus</label><input class="text-input small-input" type="text"  name="ngay_khoi_hanh_cus" value="'.(($form!=false)?$form->ngay_khoi_hanh_cus:'').'" /></p>';
    $str_from.='<p><label>ngay_khoi_hanh_price</label><input class="text-input small-input" type="text"  name="ngay_khoi_hanh_price" value="'.(($form!=false)?$form->ngay_khoi_hanh_price:'').'" /></p>';
    $str_from.='<p><label>hang_bay</label><input class="text-input small-input" type="text"  name="hang_bay" value="'.(($form!=false)?$form->hang_bay:'').'" /></p>';
    $str_from.='<p><label>hang_bay_price</label><input class="text-input small-input" type="text"  name="hang_bay_price" value="'.(($form!=false)?$form->hang_bay_price:'').'" /></p>';
    $str_from.='<p><label>khac</label><textarea name="khac">'.(($form!=false)?$form->khac:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'khac\'); </script></p>';
    $str_from.='<p><label>khac_price</label><input class="text-input small-input" type="text"  name="khac_price" value="'.(($form!=false)?$form->khac_price:'').'" /></p>';
    $str_from.='<p><label>note</label><textarea name="note">'.(($form!=false)?$form->note:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'note\'); </script></p>';
    return $str_from;
}
