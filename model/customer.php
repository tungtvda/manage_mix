<?php
class customer
{
    public $id,$name,$mr,$avatar,$code,$category,$company_name,$director_name,$address,$phone,$mobi,$fax,$email,$company_email,$skype,$facebook,$customer_group,$resources_to,$chuc_vu,$phong_ban,$nganh_nghe,$account_number_bank,$bank,$open_bank,$birthday,$cmnd,$date_range_cmnd,$issued_by_cmnd,$number_passport,$date_range_passport,$issued_by_passport,$expiration_date_passport,$gender,$status,$created,$updated,$created_by,$update_by,$note;
    public function customer($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->mr=isset($data['mr'])?$data['mr']:'';
    $this->avatar=isset($data['avatar'])?$data['avatar']:'';
    $this->code=isset($data['code'])?$data['code']:'';
    $this->category=isset($data['category'])?$data['category']:'';
    $this->company_name=isset($data['company_name'])?$data['company_name']:'';
    $this->director_name=isset($data['director_name'])?$data['director_name']:'';
    $this->address=isset($data['address'])?$data['address']:'';
    $this->phone=isset($data['phone'])?$data['phone']:'';
    $this->mobi=isset($data['mobi'])?$data['mobi']:'';
    $this->fax=isset($data['fax'])?$data['fax']:'';
    $this->email=isset($data['email'])?$data['email']:'';
    $this->company_email=isset($data['company_email'])?$data['company_email']:'';
    $this->skype=isset($data['skype'])?$data['skype']:'';
    $this->facebook=isset($data['facebook'])?$data['facebook']:'';
    $this->customer_group=isset($data['customer_group'])?$data['customer_group']:'';
    $this->resources_to=isset($data['resources_to'])?$data['resources_to']:'';
    $this->chuc_vu=isset($data['chuc_vu'])?$data['chuc_vu']:'';
    $this->phong_ban=isset($data['phong_ban'])?$data['phong_ban']:'';
    $this->nganh_nghe=isset($data['nganh_nghe'])?$data['nganh_nghe']:'';
    $this->account_number_bank=isset($data['account_number_bank'])?$data['account_number_bank']:'';
    $this->bank=isset($data['bank'])?$data['bank']:'';
    $this->open_bank=isset($data['open_bank'])?$data['open_bank']:'';
    $this->birthday=isset($data['birthday'])?$data['birthday']:'';
    $this->cmnd=isset($data['cmnd'])?$data['cmnd']:'';
    $this->date_range_cmnd=isset($data['date_range_cmnd'])?$data['date_range_cmnd']:'';
    $this->issued_by_cmnd=isset($data['issued_by_cmnd'])?$data['issued_by_cmnd']:'';
    $this->number_passport=isset($data['number_passport'])?$data['number_passport']:'';
    $this->date_range_passport=isset($data['date_range_passport'])?$data['date_range_passport']:'';
    $this->issued_by_passport=isset($data['issued_by_passport'])?$data['issued_by_passport']:'';
    $this->expiration_date_passport=isset($data['expiration_date_passport'])?$data['expiration_date_passport']:'';
    $this->gender=isset($data['gender'])?$data['gender']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->updated=isset($data['updated'])?$data['updated']:'';
    $this->created_by=isset($data['created_by'])?$data['created_by']:'';
    $this->update_by=isset($data['update_by'])?$data['update_by']:'';
    $this->note=isset($data['note'])?$data['note']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->mr=addslashes($this->mr);
            $this->avatar=addslashes($this->avatar);
            $this->code=addslashes($this->code);
            $this->category=addslashes($this->category);
            $this->company_name=addslashes($this->company_name);
            $this->director_name=addslashes($this->director_name);
            $this->address=addslashes($this->address);
            $this->phone=addslashes($this->phone);
            $this->mobi=addslashes($this->mobi);
            $this->fax=addslashes($this->fax);
            $this->email=addslashes($this->email);
            $this->company_email=addslashes($this->company_email);
            $this->skype=addslashes($this->skype);
            $this->facebook=addslashes($this->facebook);
            $this->customer_group=addslashes($this->customer_group);
            $this->resources_to=addslashes($this->resources_to);
            $this->chuc_vu=addslashes($this->chuc_vu);
            $this->phong_ban=addslashes($this->phong_ban);
            $this->nganh_nghe=addslashes($this->nganh_nghe);
            $this->account_number_bank=addslashes($this->account_number_bank);
            $this->bank=addslashes($this->bank);
            $this->open_bank=addslashes($this->open_bank);
            $this->birthday=addslashes($this->birthday);
            $this->cmnd=addslashes($this->cmnd);
            $this->date_range_cmnd=addslashes($this->date_range_cmnd);
            $this->issued_by_cmnd=addslashes($this->issued_by_cmnd);
            $this->number_passport=addslashes($this->number_passport);
            $this->date_range_passport=addslashes($this->date_range_passport);
            $this->issued_by_passport=addslashes($this->issued_by_passport);
            $this->expiration_date_passport=addslashes($this->expiration_date_passport);
            $this->gender=addslashes($this->gender);
            $this->status=addslashes($this->status);
            $this->created=addslashes($this->created);
            $this->updated=addslashes($this->updated);
            $this->created_by=addslashes($this->created_by);
            $this->update_by=addslashes($this->update_by);
            $this->note=addslashes($this->note);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->mr=stripslashes($this->mr);
            $this->avatar=stripslashes($this->avatar);
            $this->code=stripslashes($this->code);
            $this->category=stripslashes($this->category);
            $this->company_name=stripslashes($this->company_name);
            $this->director_name=stripslashes($this->director_name);
            $this->address=stripslashes($this->address);
            $this->phone=stripslashes($this->phone);
            $this->mobi=stripslashes($this->mobi);
            $this->fax=stripslashes($this->fax);
            $this->email=stripslashes($this->email);
            $this->company_email=stripslashes($this->company_email);
            $this->skype=stripslashes($this->skype);
            $this->facebook=stripslashes($this->facebook);
            $this->customer_group=stripslashes($this->customer_group);
            $this->resources_to=stripslashes($this->resources_to);
            $this->chuc_vu=stripslashes($this->chuc_vu);
            $this->phong_ban=stripslashes($this->phong_ban);
            $this->nganh_nghe=stripslashes($this->nganh_nghe);
            $this->account_number_bank=stripslashes($this->account_number_bank);
            $this->bank=stripslashes($this->bank);
            $this->open_bank=stripslashes($this->open_bank);
            $this->birthday=stripslashes($this->birthday);
            $this->cmnd=stripslashes($this->cmnd);
            $this->date_range_cmnd=stripslashes($this->date_range_cmnd);
            $this->issued_by_cmnd=stripslashes($this->issued_by_cmnd);
            $this->number_passport=stripslashes($this->number_passport);
            $this->date_range_passport=stripslashes($this->date_range_passport);
            $this->issued_by_passport=stripslashes($this->issued_by_passport);
            $this->expiration_date_passport=stripslashes($this->expiration_date_passport);
            $this->gender=stripslashes($this->gender);
            $this->status=stripslashes($this->status);
            $this->created=stripslashes($this->created);
            $this->updated=stripslashes($this->updated);
            $this->created_by=stripslashes($this->created_by);
            $this->update_by=stripslashes($this->update_by);
            $this->note=stripslashes($this->note);
        }
}
