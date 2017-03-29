<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_tour($data)
{
    $ft=new FastTemplate(DIR.'/view/admin/templates');
    $ft->assign('count_contact',$_SESSION['contact']);
    $ft->assign('booking_hotel',$_SESSION['booking_hotel']);
    $ft->assign('count_booking',$_SESSION['booking']);
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
    $ft->assign('TABLE-NAME','tour');
    $ft->assign('CONTENT-BOX-LEFT',isset($data['content_box_left'])?$data['content_box_left']:'');
    $ft->assign('CONTENT-BOX-RIGHT',isset($data['content_box_right'])?$data['content_box_right']:' ');
    $ft->assign('NOTIFICATION',isset($data['notification'])?$data['notification']:' ');
    $ft->assign('SITE-NAME',isset($data['sitename'])?$data['sitename']:SITE_NAME);
    $ft->assign('kichhoat_tour', 'active');
    $ft->assign('kichhoat_tour_hienthi', 'display: block');
    $ft->assign('FORM',showFrom(isset($data['form'])?$data['form']:'',isset($data['listfkey'])?$data['listfkey']:array()));
    //
    print $ft->parse_and_return('header');
    print $ft->parse_and_return('body');
    print $ft->parse_and_return('footer');
}
//
function showTableHeader()
{
    return '<th>id</th><th>DanhMuc1Id</th><th>DanhMuc2Id</th><th>promotion</th><th>packages</th><th>name</th><th>code</th><th>img</th><th>price_sales</th><th>price</th>';
}
//
function showTableBody($data)
{
    $danhmuc_id_get='';
    if(isset($_GET['DanhMuc1Id'])&&$_GET['DanhMuc1Id']!=''){
        $danhmuc_id_get='&DanhMuc1Id='.$_GET['DanhMuc1Id'];
    }
    else{
        if(isset($_GET['DanhMuc2Id'])&&$_GET['DanhMuc2Id']!=''){
            $danhmuc_id_get='&DanhMuc2Id='.$_GET['DanhMuc2Id'];
        }
    }
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->DanhMuc1Id."</td>";
        $TableBody.="<td>".$obj->DanhMuc2Id."</td>";
        $TableBody.="<td>".$obj->promotion."</td>";
        $TableBody.="<td>".$obj->packages."</td>";
        $TableBody.="<td>".$obj->name."</td>";
        $TableBody.="<td>".$obj->code."</td>";
        $TableBody.="<td><img src=\"".$obj->img."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td>".$obj->price_sales."</td>";
        $TableBody.="<td>".$obj->price."</td>";
        $TableBody.="<td><a href=\"?action=edit&id=".$obj->id.$danhmuc_id_get."\" title=\"Edit\"><img src=\"".SITE_NAME."/view/admin/Themes/images/pencil.png\" alt=\"Edit\"></a>";
        $TableBody.="<a href=\"?action=delete&id=".$obj->id.$danhmuc_id_get."\" title=\"Delete\" onClick=\"return confirm('Bạn có chắc chắc muốn xóa?')\"><img src=\"".SITE_NAME."/view/admin/Themes/images/cross.png\" alt=\"Delete\"></a> ";
        $TableBody.="</td>";
        $TableBody.="</tr>";
    }
    return $TableBody;
}
//
function showFrom($form,$ListKey=array())
{
    $str_from='';
    $str_from.='<p><label>Chọn danh mục cấp 1</label>';
    $str_from.='<select name="DanhMuc1Id" id="DanhMuc1Id">';
    if($form!=false)
    {
        if(isset($ListKey['DanhMuc1Id']))
        {
            foreach($ListKey['DanhMuc1Id'] as $key)
            {
                $str_from.='<option value="'.$key->id.'" '.(($form!=false)?(($form->DanhMuc1Id==$key->id)?'selected':''):'').'>'.$key->name.'</option>';
            }
        }
    }
    else
    {

        if(isset($ListKey['DanhMuc1Id']))
        {
            foreach($ListKey['DanhMuc1Id'] as $key)
            {
                $str_from.='<option value="'.$key->id.'" '.(($form!=false)?(($form->DanhMuc1Id==$key->id)?'selected':''):'').'>'.$key->name.'</option>';
            }
        }
    }
    $str_from.='</select></p>';
    $str_from.='<p><label>Chọn danh mục cấp 2</label>';
    $str_from.='<select name="DanhMuc2Id" id="DanhMuc2Id">';
    if($form!=false)
    {
        $str_from .= '<option value="1">Chọn danh mục cấp 2</option>';
        if(isset($ListKey['DanhMuc2Id']))
        {
            foreach($ListKey['DanhMuc2Id'] as $key)
            {
                $str_from.='<option value="'.$key->id.'" '.(($form!=false)?(($form->DanhMuc2Id==$key->id)?'selected':''):'').'>'.$key->name.'</option>';
            }
        }
    }
    else
    {
        $str_from .= '<option value="1">Chọn danh mục cấp 2</option>';
    }
    $str_from.='</select></p>';
    $str_from.='<p><label>promotion</label><input  type="checkbox"  name="promotion" value="1" '.(($form!=false)?(($form->promotion=='1')?'checked':''):'').' /></p>';
    $str_from.='<p><label>packages</label><input  type="checkbox"  name="packages" value="1" '.(($form!=false)?(($form->packages=='1')?'checked':''):'').' /></p>';
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>name_url</label><input class="text-input small-input" type="text"  name="name_url" value="'.(($form!=false)?$form->name_url:'').'" /></p>';
    $str_from.='<p><label>Count down</label><input class="text-input small-input" type="text"  name="count_down" value="'.(($form!=false)?$form->count_down:'').'" /></p>';
    $str_from.='<p><label>code</label><input class="text-input small-input" type="text"  name="code" value="'.(($form!=false)?$form->code:'').'" /></p>';
    $str_from.='<p><label>img</label><input class="text-input small-input" type="text"  name="img" value="'.(($form!=false)?$form->img:'').'"/><a class="button" onclick="openKcEditor(\'img\');">Upload ảnh</a></p>';
    $str_from.='<p><label>price_sales</label><input class="text-input small-input" type="text"  name="price_sales" value="'.(($form!=false)?$form->price_sales:'').'" /></p>';
    $str_from.='<p><label>Tên Giá - Giá(1)- đây sẽ là giá chính để hiển thị</label>
    <input style="width: 40%" class="text-input small-input" type="text"  name="name_price" value="'.(($form!=false)?$form->name_price:'Giá người lớn').'" />
<input  style="width: 40%" class="text-input small-input" type="text"  name="price" value="'.(($form!=false)?$form->price:'').'" />
</p>';
    $str_from.='<p><label>Đơn giá theo số người(1)___Chú ý: định dạng theo  <span style="color: blue">songuoi1-gia1,songuoi2-gia2</span>___Ví dụ: <span style="color: red">1-1000000,2-2000000,3-3000000</span></label>
<input style="width: 100%" class="text-input small-input" type="text"  name="price_number" value="'.(($form!=false)?$form->price_number:'Giá trẻ em 5-11 tuổi').'" /></p>';

    $str_from.='<p><label>Tên Giá - Giá(2)</label>
<input style="width: 40%" class="text-input small-input" type="text"  name="name_price_2" value="'.(($form!=false)?$form->name_price_2:'').'" />
<input style="width: 40%" class="text-input small-input" type="text"  name="price_2" value="'.(($form!=false)?$form->price_2:'').'" />
</p>';
    $str_from.='<p><label>Đơn giá theo số người(2)___Chú ý: định dạng theo  <span style="color: blue">songuoi1-gia1,songuoi2-gia2</span>___Ví dụ: <span style="color: red">1-1000000,2-2000000,3-3000000</span></label>
<input style="width: 100%" class="text-input small-input" type="text"  name="price_number_2" value="'.(($form!=false)?$form->price_number_2:'').'" /></p>';

    $str_from.='<p><label>Tên Giá - Giá(3)</label>
<input style="width: 40%" class="text-input small-input" type="text"  name="name_price_3" value="'.(($form!=false)?$form->name_price_3:'Giá trẻ em duwowis5 tuổi').'" />
<input style="width: 40%" class="text-input small-input" type="text"  name="price_3" value="'.(($form!=false)?$form->price_3:'').'" />
</p>';
    $str_from.='<p><label>Đơn giá theo số người(3)___Chú ý: định dạng theo  <span style="color: blue">songuoi1-gia1,songuoi2-gia2</span>___Ví dụ: <span style="color: red">1-1000000,2-2000000,3-3000000</span></label>
<input style="width: 100%" class="text-input small-input" type="text"  name="price_number_3" value="'.(($form!=false)?$form->price_number_3:'').'" /></p>';

    $str_from.='<p><label>Tên Giá - Giá(4)</label>
<input style="width: 40%" class="text-input small-input" type="text"  name="name_price_4" value="'.(($form!=false)?$form->name_price_4:'').'" />
<input style="width: 40%" class="text-input small-input" type="text"  name="price_4" value="'.(($form!=false)?$form->price_4:'').'" /></p>';
    $str_from.='<p><label>Đơn giá theo số người(4)___Chú ý: định dạng theo  <span style="color: blue">songuoi1-gia1,songuoi2-gia2</span>___Ví dụ: <span style="color: red">1-1000000,2-2000000,3-3000000</span></label>
<input style="width: 100%" class="text-input small-input" type="text"  name="price_number_4" value="'.(($form!=false)?$form->price_number_4:'').'" /></p>';

    $str_from.='<p><label>Tên Giá - Giá(5)</label>
<input style="width: 40%" class="text-input small-input" type="text"  name="name_price_5" value="'.(($form!=false)?$form->name_price_5:'').'" />
<input style="width: 40%" class="text-input small-input" type="text"  name="price_5" value="'.(($form!=false)?$form->price_5:'').'" />
</p>';
    $str_from.='<p><label>Đơn giá theo số người(5)___Chú ý: định dạng theo  <span style="color: blue">songuoi1-gia1,songuoi2-gia2</span>___Ví dụ: <span style="color: red">1-1000000,2-2000000,3-3000000</span></label>
<input style="width: 100%" class="text-input small-input" type="text"  name="price_number_5" value="'.(($form!=false)?$form->price_number_5:'').'" /></p>';


    $str_from.='<p><label>price_6</label>
<input style="width: 40%" class="text-input small-input" type="text"  name="name_price_6" value="'.(($form!=false)?$form->name_price_6:'').'" />
<input style="width: 40%" class="text-input small-input" type="text"  name="price_6" value="'.(($form!=false)?$form->price_6:'').'" />
</p>';
    $str_from.='<p><label>Đơn giá theo số người(6)___Chú ý: định dạng theo  <span style="color: blue">songuoi1-gia1,songuoi2-gia2</span>___Ví dụ: <span style="color: red">1-1000000,2-2000000,3-3000000</span></label>
<input style="width: 100%" class="text-input small-input" type="text"  name="price_number_6" value="'.(($form!=false)?$form->price_number_6:'').'" /></p>';


    $str_from.='<p><label>Số chỗ nếu có</label><input class="text-input small-input" type="text"  name="so_cho" value="'.(($form!=false)?$form->so_cho:'').'" /></p>';
    $str_from.='<p><label>durations</label><input class="text-input small-input" type="text"  name="durations" value="'.(($form!=false)?$form->durations:'').'" /></p>';
    $str_from.='<p><label>departure</label><input class="text-input small-input" type="text"  name="departure" value="'.(($form!=false)?$form->departure:'').'" /></p>';
    $str_from.='<p><label>departure</label>';
//    $str_from.='<select name="departure">';
//    if(isset($ListKey['departure']))
//    {
//        $str_from.='<option value="">Điểm khởi hành</option>';
//        foreach($ListKey['departure'] as $key)
//        {
//            $str_from.='<option value="'.$key->id.'" '.(($form!=false)?(($form->departure==$key->id)?'selected':''):'').'>'.$key->name.'</option>';
//        }
//    }
//    $str_from.='</select></p>';
    $str_from.='<p><label>Điểm khởi hành</label>';
    $arr_check=array();
    if($form!=false){
        $arr_check=explode(',',$form->departure);
    }
    foreach($ListKey['departure'] as $key)
    {
        $checked='';
        if(in_array($key->id,$arr_check)){
            $checked='checked';
        }
        $str_from.=$key->name.' <input style="margin-top: -4px;" '.$checked.'  class="text-input small-input show_'.$key->id.'" type="checkbox"  name="departure[]" value="'.$key->id.'" /> --- ';
    }

    $str_from.='</p>';
    $str_from.='<p><label>departure_time</label><input class="text-input small-input" type="text"  name="departure_time" value="'.(($form!=false)?$form->departure_time:'').'" /></p>';
    $str_from.='<p><label>destination</label><input class="text-input small-input" type="text"  name="destination" value="'.(($form!=false)?$form->destination:'').'" /></p>';
    $str_from.='<p><label>vehicle</label><input class="text-input small-input" type="text"  name="vehicle" value="'.(($form!=false)?$form->vehicle:'').'" /></p>';
    $str_from.='<p><label>hotel</label><input class="text-input small-input" type="text"  name="hotel" value="'.(($form!=false)?$form->hotel:'').'" /></p>';
    $str_from.='<p><label>summary</label><textarea name="summary">'.(($form!=false)?$form->summary:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'summary\'); </script></p>';
    $str_from.='<p><label>highlights</label><textarea name="highlights">'.(($form!=false)?$form->highlights:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'highlights\'); </script></p>';
    $str_from.='<p><label>schedule</label><textarea name="schedule">'.(($form!=false)?$form->schedule:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'schedule\'); </script></p>';
    $str_from.='<p><label>price_list</label><textarea name="price_list">'.(($form!=false)?$form->price_list:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'price_list\'); </script></p>';
    $str_from.='<p><label>content</label><textarea name="content">'.(($form!=false)?$form->content:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'content\'); </script></p>';
    $str_from.='<p><label>list_img</label><textarea name="list_img">'.(($form!=false)?$form->list_img:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'list_img\'); </script></p>';
    $str_from.='<p><label>title</label><input class="text-input small-input" type="text"  name="title" value="'.(($form!=false)?$form->title:'').'" /></p>';
    $str_from.='<p><label>keyword</label><input class="text-input small-input" type="text"  name="keyword" value="'.(($form!=false)?$form->keyword:'').'" /></p>';
    $str_from.='<p><label>description</label><input class="text-input small-input" type="text"  name="description" value="'.(($form!=false)?$form->description:'').'" /></p>';
    $str_from.='<p><label>inclusion</label><textarea name="inclusion">'.(($form!=false)?$form->inclusion:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'inclusion\'); </script></p>';
    $str_from.='<p><label>exclusion</label><textarea name="exclusion">'.(($form!=false)?$form->exclusion:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'exclusion\'); </script></p>';
    $str_from.='<p hidden><label>updated</label><input class="text-input small-input" type="text"  name="updated" value="'.(($form!=false)?$form->updated:'').'" /></p>';
    return $str_from;
}
