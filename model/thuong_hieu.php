<?php
class thuong_hieu
{
    public $id,$active,$name,$domain,$logo,$icon,$banner,$link_banner,$banner_qc,$link_banner_qc,$link_khoi_hanh,$email,$mat_khau_ung_dung,$email_reply,$chu_ky_email;
    public function thuong_hieu($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->active=isset($data['active'])?$data['active']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->domain=isset($data['domain'])?$data['domain']:'';
    $this->logo=isset($data['logo'])?$data['logo']:'';
    $this->icon=isset($data['icon'])?$data['icon']:'';
    $this->banner=isset($data['banner'])?$data['banner']:'';
    $this->link_banner=isset($data['link_banner'])?$data['link_banner']:'';
    $this->banner_qc=isset($data['banner_qc'])?$data['banner_qc']:'';
    $this->link_banner_qc=isset($data['link_banner_qc'])?$data['link_banner_qc']:'';
    $this->link_khoi_hanh=isset($data['link_khoi_hanh'])?$data['link_khoi_hanh']:'';
    $this->email=isset($data['email'])?$data['email']:'';
    $this->mat_khau_ung_dung=isset($data['mat_khau_ung_dung'])?$data['mat_khau_ung_dung']:'';
    $this->email_reply=isset($data['email_reply'])?$data['email_reply']:'';
    $this->chu_ky_email=isset($data['chu_ky_email'])?$data['chu_ky_email']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->active=addslashes($this->active);
            $this->name=addslashes($this->name);
            $this->domain=addslashes($this->domain);
            $this->logo=addslashes($this->logo);
            $this->icon=addslashes($this->icon);
            $this->banner=addslashes($this->banner);
            $this->link_banner=addslashes($this->link_banner);
            $this->banner_qc=addslashes($this->banner_qc);
            $this->link_banner_qc=addslashes($this->link_banner_qc);
            $this->link_khoi_hanh=addslashes($this->link_khoi_hanh);
            $this->email=addslashes($this->email);
            $this->mat_khau_ung_dung=addslashes($this->mat_khau_ung_dung);
            $this->email_reply=addslashes($this->email_reply);
            $this->chu_ky_email=addslashes($this->chu_ky_email);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->active=stripslashes($this->active);
            $this->name=stripslashes($this->name);
            $this->domain=stripslashes($this->domain);
            $this->logo=stripslashes($this->logo);
            $this->icon=stripslashes($this->icon);
            $this->banner=stripslashes($this->banner);
            $this->link_banner=stripslashes($this->link_banner);
            $this->banner_qc=stripslashes($this->banner_qc);
            $this->link_banner_qc=stripslashes($this->link_banner_qc);
            $this->link_khoi_hanh=stripslashes($this->link_khoi_hanh);
            $this->email=stripslashes($this->email);
            $this->mat_khau_ung_dung=stripslashes($this->mat_khau_ung_dung);
            $this->email_reply=stripslashes($this->email_reply);
            $this->chu_ky_email=stripslashes($this->chu_ky_email);
        }
}
