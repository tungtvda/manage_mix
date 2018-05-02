<?php
class birthday_sms_email
{
    public $id,$user,$customer,$content_sms,$content_email,$status,$count_cus,$count_success_sms,$count_success_email,$cus_false_sms,$cus_false_email,$date_send,$created,$created_by;
    public function birthday_sms_email($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->user=isset($data['user'])?$data['user']:'';
    $this->customer=isset($data['customer'])?$data['customer']:'';
    $this->content_sms=isset($data['content_sms'])?$data['content_sms']:'';
    $this->content_email=isset($data['content_email'])?$data['content_email']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->count_cus=isset($data['count_cus'])?$data['count_cus']:'';
    $this->count_success_sms=isset($data['count_success_sms'])?$data['count_success_sms']:'';
    $this->count_success_email=isset($data['count_success_email'])?$data['count_success_email']:'';
    $this->cus_false_sms=isset($data['cus_false_sms'])?$data['cus_false_sms']:'';
    $this->cus_false_email=isset($data['cus_false_email'])?$data['cus_false_email']:'';
    $this->date_send=isset($data['date_send'])?$data['date_send']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->created_by=isset($data['created_by'])?$data['created_by']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->user=addslashes($this->user);
            $this->customer=addslashes($this->customer);
            $this->content_sms=addslashes($this->content_sms);
            $this->content_email=addslashes($this->content_email);
            $this->status=addslashes($this->status);
            $this->count_cus=addslashes($this->count_cus);
            $this->count_success_sms=addslashes($this->count_success_sms);
            $this->count_success_email=addslashes($this->count_success_email);
            $this->cus_false_sms=addslashes($this->cus_false_sms);
            $this->cus_false_email=addslashes($this->cus_false_email);
            $this->date_send=addslashes($this->date_send);
            $this->created=addslashes($this->created);
            $this->created_by=addslashes($this->created_by);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->user=stripslashes($this->user);
            $this->customer=stripslashes($this->customer);
            $this->content_sms=stripslashes($this->content_sms);
            $this->content_email=stripslashes($this->content_email);
            $this->status=stripslashes($this->status);
            $this->count_cus=stripslashes($this->count_cus);
            $this->count_success_sms=stripslashes($this->count_success_sms);
            $this->count_success_email=stripslashes($this->count_success_email);
            $this->cus_false_sms=stripslashes($this->cus_false_sms);
            $this->cus_false_email=stripslashes($this->cus_false_email);
            $this->date_send=stripslashes($this->date_send);
            $this->created=stripslashes($this->created);
            $this->created_by=stripslashes($this->created_by);
        }
}
