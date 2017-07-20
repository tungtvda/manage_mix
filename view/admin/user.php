<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_user($data)
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
    $ft->assign('TABLE-NAME','user');
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
    return '<th>id</th><th>name</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->id."\"/></td>";
        $TableBody.="<td>".$obj->id."</td>";
        $TableBody.="<td>".$obj->name."</td>";
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
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>user_role</label><input class="text-input small-input" type="text"  name="user_role" value="'.(($form!=false)?$form->user_role:'').'" /></p>';
    $str_from.='<p><label>permison_module</label><input class="text-input small-input" type="text"  name="permison_module" value="'.(($form!=false)?$form->permison_module:'').'" /></p>';
    $str_from.='<p><label>permison_form</label><input class="text-input small-input" type="text"  name="permison_form" value="'.(($form!=false)?$form->permison_form:'').'" /></p>';
    $str_from.='<p><label>permison_action</label><input class="text-input small-input" type="text"  name="permison_action" value="'.(($form!=false)?$form->permison_action:'').'" /></p>';
    $str_from.='<p><label>mr</label><input class="text-input small-input" type="text"  name="mr" value="'.(($form!=false)?$form->mr:'').'" /></p>';
    $str_from.='<p><label>hoa_hong</label><input class="text-input small-input" type="text"  name="hoa_hong" value="'.(($form!=false)?$form->hoa_hong:'').'" /></p>';
    $str_from.='<p><label>address</label><input class="text-input small-input" type="text"  name="address" value="'.(($form!=false)?$form->address:'').'" /></p>';
    $str_from.='<p><label>phone</label><input class="text-input small-input" type="text"  name="phone" value="'.(($form!=false)?$form->phone:'').'" /></p>';
    $str_from.='<p><label>mobi</label><input class="text-input small-input" type="text"  name="mobi" value="'.(($form!=false)?$form->mobi:'').'" /></p>';
    $str_from.='<p><label>user_name</label><input class="text-input small-input" type="text"  name="user_name" value="'.(($form!=false)?$form->user_name:'').'" /></p>';
    $str_from.='<p><label>user_code</label><input class="text-input small-input" type="text"  name="user_code" value="'.(($form!=false)?$form->user_code:'').'" /></p>';
    $str_from.='<p><label>user_email</label><input class="text-input small-input" type="text"  name="user_email" value="'.(($form!=false)?$form->user_email:'').'" /></p>';
    $str_from.='<p><label>password</label><input class="text-input small-input" type="text"  name="password" value="'.(($form!=false)?$form->password:'').'" /></p>';
    $str_from.='<p><label>login_two_steps</label><input class="text-input small-input" type="text"  name="login_two_steps" value="'.(($form!=false)?$form->login_two_steps:'').'" /></p>';
    $str_from.='<p><label>code_login</label><input class="text-input small-input" type="text"  name="code_login" value="'.(($form!=false)?$form->code_login:'').'" /></p>';
    $str_from.='<p><label>phong_ban</label><input class="text-input small-input" type="text"  name="phong_ban" value="'.(($form!=false)?$form->phong_ban:'').'" /></p>';
    $str_from.='<p><label>chuc_vu</label><input class="text-input small-input" type="text"  name="chuc_vu" value="'.(($form!=false)?$form->chuc_vu:'').'" /></p>';
    $str_from.='<p><label>nganh_nghe</label><input class="text-input small-input" type="text"  name="nganh_nghe" value="'.(($form!=false)?$form->nganh_nghe:'').'" /></p>';
    $str_from.='<p><label>gender</label><input class="text-input small-input" type="text"  name="gender" value="'.(($form!=false)?$form->gender:'').'" /></p>';
    $str_from.='<p><label>birthday</label><input class="text-input small-input" type="text"  name="birthday" value="'.(($form!=false)?$form->birthday:'').'" /></p>';
    $str_from.='<p><label>avatar</label><input class="text-input small-input" type="text"  name="avatar" value="'.(($form!=false)?$form->avatar:'').'" /></p>';
    $str_from.='<p><label>skype</label><input class="text-input small-input" type="text"  name="skype" value="'.(($form!=false)?$form->skype:'').'" /></p>';
    $str_from.='<p><label>facebook</label><input class="text-input small-input" type="text"  name="facebook" value="'.(($form!=false)?$form->facebook:'').'" /></p>';
    $str_from.='<p><label>ngay_lam_viec</label><input class="text-input small-input" type="text"  name="ngay_lam_viec" value="'.(($form!=false)?$form->ngay_lam_viec:'').'" /></p>';
    $str_from.='<p><label>ngay_chinh_thuc</label><input class="text-input small-input" type="text"  name="ngay_chinh_thuc" value="'.(($form!=false)?$form->ngay_chinh_thuc:'').'" /></p>';
    $str_from.='<p><label>guides</label><input class="text-input small-input" type="text"  name="guides" value="'.(($form!=false)?$form->guides:'').'" /></p>';
    $str_from.='<p><label>guide_card_number</label><input class="text-input small-input" type="text"  name="guide_card_number" value="'.(($form!=false)?$form->guide_card_number:'').'" /></p>';
    $str_from.='<p><label>tax_code</label><input class="text-input small-input" type="text"  name="tax_code" value="'.(($form!=false)?$form->tax_code:'').'" /></p>';
    $str_from.='<p><label>cmnd</label><input class="text-input small-input" type="text"  name="cmnd" value="'.(($form!=false)?$form->cmnd:'').'" /></p>';
    $str_from.='<p><label>date_range_cmnd</label><input class="text-input small-input" type="text"  name="date_range_cmnd" value="'.(($form!=false)?$form->date_range_cmnd:'').'" /></p>';
    $str_from.='<p><label>issued_by_cmnd</label><input class="text-input small-input" type="text"  name="issued_by_cmnd" value="'.(($form!=false)?$form->issued_by_cmnd:'').'" /></p>';
    $str_from.='<p><label>number_passport</label><input class="text-input small-input" type="text"  name="number_passport" value="'.(($form!=false)?$form->number_passport:'').'" /></p>';
    $str_from.='<p><label>date_range_passport</label><input class="text-input small-input" type="text"  name="date_range_passport" value="'.(($form!=false)?$form->date_range_passport:'').'" /></p>';
    $str_from.='<p><label>issued_by_passport</label><input class="text-input small-input" type="text"  name="issued_by_passport" value="'.(($form!=false)?$form->issued_by_passport:'').'" /></p>';
    $str_from.='<p><label>expiration_date_passport</label><input class="text-input small-input" type="text"  name="expiration_date_passport" value="'.(($form!=false)?$form->expiration_date_passport:'').'" /></p>';
    $str_from.='<p><label>dan_toc</label><input class="text-input small-input" type="text"  name="dan_toc" value="'.(($form!=false)?$form->dan_toc:'').'" /></p>';
    $str_from.='<p><label>ho_khau_tt</label><input class="text-input small-input" type="text"  name="ho_khau_tt" value="'.(($form!=false)?$form->ho_khau_tt:'').'" /></p>';
    $str_from.='<p><label>hon_nhan</label><input class="text-input small-input" type="text"  name="hon_nhan" value="'.(($form!=false)?$form->hon_nhan:'').'" /></p>';
    $str_from.='<p><label>bang_cap</label><input class="text-input small-input" type="text"  name="bang_cap" value="'.(($form!=false)?$form->bang_cap:'').'" /></p>';
    $str_from.='<p><label>language</label><input class="text-input small-input" type="text"  name="language" value="'.(($form!=false)?$form->language:'').'" /></p>';
    $str_from.='<p><label>account_number_bank</label><input class="text-input small-input" type="text"  name="account_number_bank" value="'.(($form!=false)?$form->account_number_bank:'').'" /></p>';
    $str_from.='<p><label>bank</label><input class="text-input small-input" type="text"  name="bank" value="'.(($form!=false)?$form->bank:'').'" /></p>';
    $str_from.='<p><label>open_bank</label><input class="text-input small-input" type="text"  name="open_bank" value="'.(($form!=false)?$form->open_bank:'').'" /></p>';
    $str_from.='<p><label>religion</label><input class="text-input small-input" type="text"  name="religion" value="'.(($form!=false)?$form->religion:'').'" /></p>';
    $str_from.='<p><label>note</label><textarea name="note">'.(($form!=false)?$form->note:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'note\'); </script></p>';
    $str_from.='<p><label>status</label><input class="text-input small-input" type="text"  name="status" value="'.(($form!=false)?$form->status:'').'" /></p>';
    $str_from.='<p><label>created</label><input class="text-input small-input" type="text"  name="created" value="'.(($form!=false)?$form->created:'').'" /></p>';
    $str_from.='<p><label>token_code</label><input class="text-input small-input" type="text"  name="token_code" value="'.(($form!=false)?$form->token_code:'').'" /></p>';
    $str_from.='<p><label>time_token</label><input class="text-input small-input" type="text"  name="time_token" value="'.(($form!=false)?$form->time_token:'').'" /></p>';
    $str_from.='<p><label>memori_login</label><input class="text-input small-input" type="text"  name="memori_login" value="'.(($form!=false)?$form->memori_login:'').'" /></p>';
    $str_from.='<p><label>updated</label><input class="text-input small-input" type="text"  name="updated" value="'.(($form!=false)?$form->updated:'').'" /></p>';
    $str_from.='<p><label>created_by</label><input class="text-input small-input" type="text"  name="created_by" value="'.(($form!=false)?$form->created_by:'').'" /></p>';
    $str_from.='<p><label>updated_by</label><input class="text-input small-input" type="text"  name="updated_by" value="'.(($form!=false)?$form->updated_by:'').'" /></p>';
    return $str_from;
}
