<?php
class rut_tien
{
    public $id,$code,$user_tiep_thi_id,$admin_confirm_id,$name,$price,$price_confirm,$status,$yeu_cau,$yeu_cau_confirm,$date_send,$date_confirm;
    public function rut_tien($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->code=isset($data['code'])?$data['code']:'';
    $this->user_tiep_thi_id=isset($data['user_tiep_thi_id'])?$data['user_tiep_thi_id']:'';
    $this->admin_confirm_id=isset($data['admin_confirm_id'])?$data['admin_confirm_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->price=isset($data['price'])?$data['price']:'';
    $this->price_confirm=isset($data['price_confirm'])?$data['price_confirm']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->yeu_cau=isset($data['yeu_cau'])?$data['yeu_cau']:'';
    $this->yeu_cau_confirm=isset($data['yeu_cau_confirm'])?$data['yeu_cau_confirm']:'';
    $this->date_send=isset($data['date_send'])?$data['date_send']:'';
    $this->date_confirm=isset($data['date_confirm'])?$data['date_confirm']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->code=addslashes($this->code);
            $this->user_tiep_thi_id=addslashes($this->user_tiep_thi_id);
            $this->admin_confirm_id=addslashes($this->admin_confirm_id);
            $this->name=addslashes($this->name);
            $this->price=addslashes($this->price);
            $this->price_confirm=addslashes($this->price_confirm);
            $this->status=addslashes($this->status);
            $this->yeu_cau=addslashes($this->yeu_cau);
            $this->yeu_cau_confirm=addslashes($this->yeu_cau_confirm);
            $this->date_send=addslashes($this->date_send);
            $this->date_confirm=addslashes($this->date_confirm);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->code=stripslashes($this->code);
            $this->user_tiep_thi_id=stripslashes($this->user_tiep_thi_id);
            $this->admin_confirm_id=stripslashes($this->admin_confirm_id);
            $this->name=stripslashes($this->name);
            $this->price=stripslashes($this->price);
            $this->price_confirm=stripslashes($this->price_confirm);
            $this->status=stripslashes($this->status);
            $this->yeu_cau=stripslashes($this->yeu_cau);
            $this->yeu_cau_confirm=stripslashes($this->yeu_cau_confirm);
            $this->date_send=stripslashes($this->date_send);
            $this->date_confirm=stripslashes($this->date_confirm);
        }
}
