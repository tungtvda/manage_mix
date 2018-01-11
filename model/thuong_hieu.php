<?php
class thuong_hieu
{
    public $id,$active,$name,$logo,$email,$mat_khau_send_email,$email_template;
    public function thuong_hieu($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->active=isset($data['active'])?$data['active']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->logo=isset($data['logo'])?$data['logo']:'';
    $this->email=isset($data['email'])?$data['email']:'';
    $this->mat_khau_send_email=isset($data['mat_khau_send_email'])?$data['mat_khau_send_email']:'';
    $this->email_template=isset($data['email_template'])?$data['email_template']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->active=addslashes($this->active);
            $this->name=addslashes($this->name);
            $this->logo=addslashes($this->logo);
            $this->email=addslashes($this->email);
            $this->mat_khau_send_email=addslashes($this->mat_khau_send_email);
            $this->email_template=addslashes($this->email_template);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->active=stripslashes($this->active);
            $this->name=stripslashes($this->name);
            $this->logo=stripslashes($this->logo);
            $this->email=stripslashes($this->email);
            $this->mat_khau_send_email=stripslashes($this->mat_khau_send_email);
            $this->email_template=stripslashes($this->email_template);
        }
}
