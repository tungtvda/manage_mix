<?php
class user
{
    public $id,$name,$user_role,$permison_module,$permison_form,$permison_action,$mr,$address,$phone,$mobi,$user_name,$user_code,$user_email,$password,$login_two_steps,$code_login,$phong_ban,$chuc_vu,$nganh_nghe,$gender,$birthday,$avatar,$guides,$guide_card_number,$tax_code,$cmnd,$date_range_cmnd,$issued_by_cmnd,$number_passport,$date_range_passport,$issued_by_passport,$expiration_date_passport,$dan_toc,$ho_khau_tt,$hon_nhan,$bang_cap,$language,$account_number_bank,$bank,$open_bank,$religion,$note,$status,$created,$token_code,$time_token,$updated;
    public function user($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->user_role=isset($data['user_role'])?$data['user_role']:'';
    $this->permison_module=isset($data['permison_module'])?$data['permison_module']:'';
    $this->permison_form=isset($data['permison_form'])?$data['permison_form']:'';
    $this->permison_action=isset($data['permison_action'])?$data['permison_action']:'';
    $this->mr=isset($data['mr'])?$data['mr']:'';
    $this->address=isset($data['address'])?$data['address']:'';
    $this->phone=isset($data['phone'])?$data['phone']:'';
    $this->mobi=isset($data['mobi'])?$data['mobi']:'';
    $this->user_name=isset($data['user_name'])?$data['user_name']:'';
    $this->user_code=isset($data['user_code'])?$data['user_code']:'';
    $this->user_email=isset($data['user_email'])?$data['user_email']:'';
    $this->password=isset($data['password'])?$data['password']:'';
    $this->login_two_steps=isset($data['login_two_steps'])?$data['login_two_steps']:'';
    $this->code_login=isset($data['code_login'])?$data['code_login']:'';
    $this->phong_ban=isset($data['phong_ban'])?$data['phong_ban']:'';
    $this->chuc_vu=isset($data['chuc_vu'])?$data['chuc_vu']:'';
    $this->nganh_nghe=isset($data['nganh_nghe'])?$data['nganh_nghe']:'';
    $this->gender=isset($data['gender'])?$data['gender']:'';
    $this->birthday=isset($data['birthday'])?$data['birthday']:'';
    $this->avatar=isset($data['avatar'])?$data['avatar']:'';
    $this->guides=isset($data['guides'])?$data['guides']:'';
    $this->guide_card_number=isset($data['guide_card_number'])?$data['guide_card_number']:'';
    $this->tax_code=isset($data['tax_code'])?$data['tax_code']:'';
    $this->cmnd=isset($data['cmnd'])?$data['cmnd']:'';
    $this->date_range_cmnd=isset($data['date_range_cmnd'])?$data['date_range_cmnd']:'';
    $this->issued_by_cmnd=isset($data['issued_by_cmnd'])?$data['issued_by_cmnd']:'';
    $this->number_passport=isset($data['number_passport'])?$data['number_passport']:'';
    $this->date_range_passport=isset($data['date_range_passport'])?$data['date_range_passport']:'';
    $this->issued_by_passport=isset($data['issued_by_passport'])?$data['issued_by_passport']:'';
    $this->expiration_date_passport=isset($data['expiration_date_passport'])?$data['expiration_date_passport']:'';
    $this->dan_toc=isset($data['dan_toc'])?$data['dan_toc']:'';
    $this->ho_khau_tt=isset($data['ho_khau_tt'])?$data['ho_khau_tt']:'';
    $this->hon_nhan=isset($data['hon_nhan'])?$data['hon_nhan']:'';
    $this->bang_cap=isset($data['bang_cap'])?$data['bang_cap']:'';
    $this->language=isset($data['language'])?$data['language']:'';
    $this->account_number_bank=isset($data['account_number_bank'])?$data['account_number_bank']:'';
    $this->bank=isset($data['bank'])?$data['bank']:'';
    $this->open_bank=isset($data['open_bank'])?$data['open_bank']:'';
    $this->religion=isset($data['religion'])?$data['religion']:'';
    $this->note=isset($data['note'])?$data['note']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->token_code=isset($data['token_code'])?$data['token_code']:'';
    $this->time_token=isset($data['time_token'])?$data['time_token']:'';
    $this->updated=isset($data['updated'])?$data['updated']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->user_role=addslashes($this->user_role);
            $this->permison_module=addslashes($this->permison_module);
            $this->permison_form=addslashes($this->permison_form);
            $this->permison_action=addslashes($this->permison_action);
            $this->mr=addslashes($this->mr);
            $this->address=addslashes($this->address);
            $this->phone=addslashes($this->phone);
            $this->mobi=addslashes($this->mobi);
            $this->user_name=addslashes($this->user_name);
            $this->user_code=addslashes($this->user_code);
            $this->user_email=addslashes($this->user_email);
            $this->password=addslashes($this->password);
            $this->login_two_steps=addslashes($this->login_two_steps);
            $this->code_login=addslashes($this->code_login);
            $this->phong_ban=addslashes($this->phong_ban);
            $this->chuc_vu=addslashes($this->chuc_vu);
            $this->nganh_nghe=addslashes($this->nganh_nghe);
            $this->gender=addslashes($this->gender);
            $this->birthday=addslashes($this->birthday);
            $this->avatar=addslashes($this->avatar);
            $this->guides=addslashes($this->guides);
            $this->guide_card_number=addslashes($this->guide_card_number);
            $this->tax_code=addslashes($this->tax_code);
            $this->cmnd=addslashes($this->cmnd);
            $this->date_range_cmnd=addslashes($this->date_range_cmnd);
            $this->issued_by_cmnd=addslashes($this->issued_by_cmnd);
            $this->number_passport=addslashes($this->number_passport);
            $this->date_range_passport=addslashes($this->date_range_passport);
            $this->issued_by_passport=addslashes($this->issued_by_passport);
            $this->expiration_date_passport=addslashes($this->expiration_date_passport);
            $this->dan_toc=addslashes($this->dan_toc);
            $this->ho_khau_tt=addslashes($this->ho_khau_tt);
            $this->hon_nhan=addslashes($this->hon_nhan);
            $this->bang_cap=addslashes($this->bang_cap);
            $this->language=addslashes($this->language);
            $this->account_number_bank=addslashes($this->account_number_bank);
            $this->bank=addslashes($this->bank);
            $this->open_bank=addslashes($this->open_bank);
            $this->religion=addslashes($this->religion);
            $this->note=addslashes($this->note);
            $this->status=addslashes($this->status);
            $this->created=addslashes($this->created);
            $this->token_code=addslashes($this->token_code);
            $this->time_token=addslashes($this->time_token);
            $this->updated=addslashes($this->updated);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->user_role=stripslashes($this->user_role);
            $this->permison_module=stripslashes($this->permison_module);
            $this->permison_form=stripslashes($this->permison_form);
            $this->permison_action=stripslashes($this->permison_action);
            $this->mr=stripslashes($this->mr);
            $this->address=stripslashes($this->address);
            $this->phone=stripslashes($this->phone);
            $this->mobi=stripslashes($this->mobi);
            $this->user_name=stripslashes($this->user_name);
            $this->user_code=stripslashes($this->user_code);
            $this->user_email=stripslashes($this->user_email);
            $this->password=stripslashes($this->password);
            $this->login_two_steps=stripslashes($this->login_two_steps);
            $this->code_login=stripslashes($this->code_login);
            $this->phong_ban=stripslashes($this->phong_ban);
            $this->chuc_vu=stripslashes($this->chuc_vu);
            $this->nganh_nghe=stripslashes($this->nganh_nghe);
            $this->gender=stripslashes($this->gender);
            $this->birthday=stripslashes($this->birthday);
            $this->avatar=stripslashes($this->avatar);
            $this->guides=stripslashes($this->guides);
            $this->guide_card_number=stripslashes($this->guide_card_number);
            $this->tax_code=stripslashes($this->tax_code);
            $this->cmnd=stripslashes($this->cmnd);
            $this->date_range_cmnd=stripslashes($this->date_range_cmnd);
            $this->issued_by_cmnd=stripslashes($this->issued_by_cmnd);
            $this->number_passport=stripslashes($this->number_passport);
            $this->date_range_passport=stripslashes($this->date_range_passport);
            $this->issued_by_passport=stripslashes($this->issued_by_passport);
            $this->expiration_date_passport=stripslashes($this->expiration_date_passport);
            $this->dan_toc=stripslashes($this->dan_toc);
            $this->ho_khau_tt=stripslashes($this->ho_khau_tt);
            $this->hon_nhan=stripslashes($this->hon_nhan);
            $this->bang_cap=stripslashes($this->bang_cap);
            $this->language=stripslashes($this->language);
            $this->account_number_bank=stripslashes($this->account_number_bank);
            $this->bank=stripslashes($this->bank);
            $this->open_bank=stripslashes($this->open_bank);
            $this->religion=stripslashes($this->religion);
            $this->note=stripslashes($this->note);
            $this->status=stripslashes($this->status);
            $this->created=stripslashes($this->created);
            $this->token_code=stripslashes($this->token_code);
            $this->time_token=stripslashes($this->time_token);
            $this->updated=stripslashes($this->updated);
        }
}
