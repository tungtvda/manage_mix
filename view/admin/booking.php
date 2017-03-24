<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_booking($data)
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
    $ft->assign('TABLE-NAME','booking');
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
    return '<th>id</th><th>code_booking</th><th>id_tour</th><th>name_tour</th><th>code_tour</th><th>price_tour</th><th>price_11</th><th>price_5</th><th>price_new</th><th>price_11_new</th><th>price_5_new</th><th>vat</th><th>nguon_tour</th><th>tien_te</th><th>ty_gia</th><th>ngay_bat_dau</th><th>han_thanh_toan</th><th>loai_khach_hang</th><th>hinh_thuc_thanh_toan</th><th>id_customer</th><th>diem_don</th><th>diem_tra</th><th>ngay_khoi_hanh</th><th>ngay_ket_thuc</th><th>phuong_tien</th><th>num_nguoi_lon</th><th>num_tre_em</th><th>num_tre_em_5</th><th>price_number</th><th>price_number_2</th><th>price_number_3</th><th>total_price</th><th>tien_thanh_toan</th><th>user_id</th><th>status</th><th>confirm_admin</th><th>created_by</th><th>updated_by</th><th>created</th><th>updated</th><th>note</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->code_booking."</td>";
        $TableBody.="<td>".$obj->id_tour."</td>";
        $TableBody.="<td>".$obj->name_tour."</td>";
        $TableBody.="<td>".$obj->code_tour."</td>";
        $TableBody.="<td>".$obj->price_tour."</td>";
        $TableBody.="<td>".$obj->price_11."</td>";
        $TableBody.="<td>".$obj->price_5."</td>";
        $TableBody.="<td>".$obj->price_new."</td>";
        $TableBody.="<td>".$obj->price_11_new."</td>";
        $TableBody.="<td>".$obj->price_5_new."</td>";
        $TableBody.="<td>".$obj->vat."</td>";
        $TableBody.="<td>".$obj->nguon_tour."</td>";
        $TableBody.="<td>".$obj->tien_te."</td>";
        $TableBody.="<td>".$obj->ty_gia."</td>";
        $TableBody.="<td>".$obj->ngay_bat_dau."</td>";
        $TableBody.="<td>".$obj->han_thanh_toan."</td>";
        $TableBody.="<td>".$obj->loai_khach_hang."</td>";
        $TableBody.="<td>".$obj->hinh_thuc_thanh_toan."</td>";
        $TableBody.="<td>".$obj->id_customer."</td>";
        $TableBody.="<td>".$obj->diem_don."</td>";
        $TableBody.="<td>".$obj->diem_tra."</td>";
        $TableBody.="<td>".$obj->ngay_khoi_hanh."</td>";
        $TableBody.="<td>".$obj->ngay_ket_thuc."</td>";
        $TableBody.="<td>".$obj->phuong_tien."</td>";
        $TableBody.="<td>".$obj->num_nguoi_lon."</td>";
        $TableBody.="<td>".$obj->num_tre_em."</td>";
        $TableBody.="<td>".$obj->num_tre_em_5."</td>";
        $TableBody.="<td>".$obj->price_number."</td>";
        $TableBody.="<td>".$obj->price_number_2."</td>";
        $TableBody.="<td>".$obj->price_number_3."</td>";
        $TableBody.="<td>".$obj->total_price."</td>";
        $TableBody.="<td>".$obj->tien_thanh_toan."</td>";
        $TableBody.="<td>".$obj->user_id."</td>";
        $TableBody.="<td>".$obj->status."</td>";
        $TableBody.="<td>".$obj->confirm_admin."</td>";
        $TableBody.="<td>".$obj->created_by."</td>";
        $TableBody.="<td>".$obj->updated_by."</td>";
        $TableBody.="<td>".$obj->created."</td>";
        $TableBody.="<td>".$obj->updated."</td>";
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
    $str_from.='<p><label>code_booking</label><input class="text-input small-input" type="text"  name="code_booking" value="'.(($form!=false)?$form->code_booking:'').'" /></p>';
    $str_from.='<p><label>id_tour</label><input class="text-input small-input" type="text"  name="id_tour" value="'.(($form!=false)?$form->id_tour:'').'" /></p>';
    $str_from.='<p><label>name_tour</label><input class="text-input small-input" type="text"  name="name_tour" value="'.(($form!=false)?$form->name_tour:'').'" /></p>';
    $str_from.='<p><label>code_tour</label><input class="text-input small-input" type="text"  name="code_tour" value="'.(($form!=false)?$form->code_tour:'').'" /></p>';
    $str_from.='<p><label>price_tour</label><input class="text-input small-input" type="text"  name="price_tour" value="'.(($form!=false)?$form->price_tour:'').'" /></p>';
    $str_from.='<p><label>price_11</label><input class="text-input small-input" type="text"  name="price_11" value="'.(($form!=false)?$form->price_11:'').'" /></p>';
    $str_from.='<p><label>price_5</label><input class="text-input small-input" type="text"  name="price_5" value="'.(($form!=false)?$form->price_5:'').'" /></p>';
    $str_from.='<p><label>price_new</label><input class="text-input small-input" type="text"  name="price_new" value="'.(($form!=false)?$form->price_new:'').'" /></p>';
    $str_from.='<p><label>price_11_new</label><input class="text-input small-input" type="text"  name="price_11_new" value="'.(($form!=false)?$form->price_11_new:'').'" /></p>';
    $str_from.='<p><label>price_5_new</label><input class="text-input small-input" type="text"  name="price_5_new" value="'.(($form!=false)?$form->price_5_new:'').'" /></p>';
    $str_from.='<p><label>vat</label><input class="text-input small-input" type="text"  name="vat" value="'.(($form!=false)?$form->vat:'').'" /></p>';
    $str_from.='<p><label>nguon_tour</label><input class="text-input small-input" type="text"  name="nguon_tour" value="'.(($form!=false)?$form->nguon_tour:'').'" /></p>';
    $str_from.='<p><label>tien_te</label><input class="text-input small-input" type="text"  name="tien_te" value="'.(($form!=false)?$form->tien_te:'').'" /></p>';
    $str_from.='<p><label>ty_gia</label><input class="text-input small-input" type="text"  name="ty_gia" value="'.(($form!=false)?$form->ty_gia:'').'" /></p>';
    $str_from.='<p><label>ngay_bat_dau</label><input class="text-input small-input" type="text"  name="ngay_bat_dau" value="'.(($form!=false)?$form->ngay_bat_dau:'').'" /></p>';
    $str_from.='<p><label>han_thanh_toan</label><input class="text-input small-input" type="text"  name="han_thanh_toan" value="'.(($form!=false)?$form->han_thanh_toan:'').'" /></p>';
    $str_from.='<p><label>loai_khach_hang</label><input class="text-input small-input" type="text"  name="loai_khach_hang" value="'.(($form!=false)?$form->loai_khach_hang:'').'" /></p>';
    $str_from.='<p><label>hinh_thuc_thanh_toan</label><input class="text-input small-input" type="text"  name="hinh_thuc_thanh_toan" value="'.(($form!=false)?$form->hinh_thuc_thanh_toan:'').'" /></p>';
    $str_from.='<p><label>id_customer</label><input class="text-input small-input" type="text"  name="id_customer" value="'.(($form!=false)?$form->id_customer:'').'" /></p>';
    $str_from.='<p><label>diem_don</label><input class="text-input small-input" type="text"  name="diem_don" value="'.(($form!=false)?$form->diem_don:'').'" /></p>';
    $str_from.='<p><label>diem_tra</label><input class="text-input small-input" type="text"  name="diem_tra" value="'.(($form!=false)?$form->diem_tra:'').'" /></p>';
    $str_from.='<p><label>ngay_khoi_hanh</label><input class="text-input small-input" type="text"  name="ngay_khoi_hanh" value="'.(($form!=false)?$form->ngay_khoi_hanh:'').'" /></p>';
    $str_from.='<p><label>ngay_ket_thuc</label><input class="text-input small-input" type="text"  name="ngay_ket_thuc" value="'.(($form!=false)?$form->ngay_ket_thuc:'').'" /></p>';
    $str_from.='<p><label>phuong_tien</label><input class="text-input small-input" type="text"  name="phuong_tien" value="'.(($form!=false)?$form->phuong_tien:'').'" /></p>';
    $str_from.='<p><label>num_nguoi_lon</label><input class="text-input small-input" type="text"  name="num_nguoi_lon" value="'.(($form!=false)?$form->num_nguoi_lon:'').'" /></p>';
    $str_from.='<p><label>num_tre_em</label><input class="text-input small-input" type="text"  name="num_tre_em" value="'.(($form!=false)?$form->num_tre_em:'').'" /></p>';
    $str_from.='<p><label>num_tre_em_5</label><input class="text-input small-input" type="text"  name="num_tre_em_5" value="'.(($form!=false)?$form->num_tre_em_5:'').'" /></p>';
    $str_from.='<p><label>price_number</label><input class="text-input small-input" type="text"  name="price_number" value="'.(($form!=false)?$form->price_number:'').'" /></p>';
    $str_from.='<p><label>price_number_2</label><input class="text-input small-input" type="text"  name="price_number_2" value="'.(($form!=false)?$form->price_number_2:'').'" /></p>';
    $str_from.='<p><label>price_number_3</label><input class="text-input small-input" type="text"  name="price_number_3" value="'.(($form!=false)?$form->price_number_3:'').'" /></p>';
    $str_from.='<p><label>total_price</label><input class="text-input small-input" type="text"  name="total_price" value="'.(($form!=false)?$form->total_price:'').'" /></p>';
    $str_from.='<p><label>tien_thanh_toan</label><input class="text-input small-input" type="text"  name="tien_thanh_toan" value="'.(($form!=false)?$form->tien_thanh_toan:'').'" /></p>';
    $str_from.='<p><label>user_id</label><input class="text-input small-input" type="text"  name="user_id" value="'.(($form!=false)?$form->user_id:'').'" /></p>';
    $str_from.='<p><label>status</label><input class="text-input small-input" type="text"  name="status" value="'.(($form!=false)?$form->status:'').'" /></p>';
    $str_from.='<p><label>confirm_admin</label><input class="text-input small-input" type="text"  name="confirm_admin" value="'.(($form!=false)?$form->confirm_admin:'').'" /></p>';
    $str_from.='<p><label>created_by</label><input class="text-input small-input" type="text"  name="created_by" value="'.(($form!=false)?$form->created_by:'').'" /></p>';
    $str_from.='<p><label>updated_by</label><input class="text-input small-input" type="text"  name="updated_by" value="'.(($form!=false)?$form->updated_by:'').'" /></p>';
    $str_from.='<p><label>created</label><input class="text-input small-input" type="text"  name="created" value="'.(($form!=false)?$form->created:'').'" /></p>';
    $str_from.='<p><label>updated</label><input class="text-input small-input" type="text"  name="updated" value="'.(($form!=false)?$form->updated:'').'" /></p>';
    $str_from.='<p><label>note</label><textarea name="note">'.(($form!=false)?$form->note:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'note\'); </script></p>';
    return $str_from;
}
