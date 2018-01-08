<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_setting_hoa_hong($data)
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
    $ft->assign('TABLE-NAME','setting_hoa_hong');
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
    return '<th>id</th><th>hoa_hong_3</th><th>hoa_hong_4</th><th>hoa_hong_5</th><th>hoa_hong_dai_ly</th><th>hoa_hong_gt_f1</th><th>hoa_hong_gt_f2</th><th>hoa_hong_gt_f3</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->hoa_hong_3."</td>";
        $TableBody.="<td>".$obj->hoa_hong_4."</td>";
        $TableBody.="<td>".$obj->hoa_hong_5."</td>";
        $TableBody.="<td>".$obj->hoa_hong_dai_ly."</td>";
        $TableBody.="<td>".$obj->hoa_hong_gt_f1."</td>";
        $TableBody.="<td>".$obj->hoa_hong_gt_f2."</td>";
        $TableBody.="<td>".$obj->hoa_hong_gt_f3."</td>";
//        $TableBody.="<td>".$obj->muc_4_don_hang."</td>";
//        $TableBody.="<td>".$obj->muc_4_thanh_vien."</td>";
//        $TableBody.="<td>".$obj->muc_5_don_hang."</td>";
//        $TableBody.="<td>".$obj->muc_5_thanh_vien_3."</td>";
//        $TableBody.="<td>".$obj->muc_5_thanh_vien_4."</td>";
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
    $str_from.='<p><label>Hoa hồng 3 sao</label><input class="text-input small-input" type="text"  name="hoa_hong_3" value="'.(($form!=false)?$form->hoa_hong_3:'').'" /></p>';
    $str_from.='<p><label>Hoa hồng 4 sao</label><input class="text-input small-input" type="text"  name="hoa_hong_4" value="'.(($form!=false)?$form->hoa_hong_4:'').'" /></p>';
    $str_from.='<p><label>Hoa hồng 5 sao</label><input class="text-input small-input" type="text"  name="hoa_hong_5" value="'.(($form!=false)?$form->hoa_hong_5:'').'" /></p>';
    $str_from.='<p><label>Hoa hồng đại lý</label><input class="text-input small-input" type="text"  name="hoa_hong_dai_ly" value="'.(($form!=false)?$form->hoa_hong_dai_ly:'').'" /></p>';
    $str_from.='<p><label>Hoa hồng giới thiệu f1</label><input class="text-input small-input" type="text"  name="hoa_hong_gt_f1" value="'.(($form!=false)?$form->hoa_hong_gt_f1:'').'" /></p>';
    $str_from.='<p><label>Hoa hồng giới thiệu f2</label><input class="text-input small-input" type="text"  name="hoa_hong_gt_f2" value="'.(($form!=false)?$form->hoa_hong_gt_f2:'').'" /></p>';
    $str_from.='<p><label>Hoa hồng giới thiệu f3</label><input class="text-input small-input" type="text"  name="hoa_hong_gt_f3" value="'.(($form!=false)?$form->hoa_hong_gt_f3:'').'" /></p>';
    $str_from.='<p><label>Điều kiện đơn hàng lên mức 4</label><input class="text-input small-input" type="text"  name="muc_4_don_hang" value="'.(($form!=false)?$form->muc_4_don_hang:'').'" /></p>';
    $str_from.='<p><label>Điều kiện thành viên lên mức 4</label><input class="text-input small-input" type="text"  name="muc_4_thanh_vien" value="'.(($form!=false)?$form->muc_4_thanh_vien:'').'" /></p>';
    $str_from.='<p><label>Điều kiện đơn hàng lên mức 5</label><input class="text-input small-input" type="text"  name="muc_5_don_hang" value="'.(($form!=false)?$form->muc_5_don_hang:'').'" /></p>';
    $str_from.='<p><label>Điều kiện đơn hàng lên mức 5 khi giới thiệu thành viên 3 sao</label><input class="text-input small-input" type="text"  name="muc_5_thanh_vien_3" value="'.(($form!=false)?$form->muc_5_thanh_vien_3:'').'" /></p>';
    $str_from.='<p><label>Điều kiện đơn hàng lên mức 5 khi giới thiệu thành viên 4 sao</label><input class="text-input small-input" type="text"  name="muc_5_thanh_vien_4" value="'.(($form!=false)?$form->muc_5_thanh_vien_4:'').'" /></p>';
    return $str_from;
}
