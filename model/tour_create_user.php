<?php
class tour_create_user
{
    public $id,$user_id,$customer_id,$status,$name_cus,$email_cus,$phone_cus,$address_cus,$code_tour,$name_tour,$time_tour,$date_tour,$address_tour,$note_tour,$created,$updated;
    public function tour_create_user($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->user_id=isset($data['user_id'])?$data['user_id']:'';
    $this->customer_id=isset($data['customer_id'])?$data['customer_id']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->name_cus=isset($data['name_cus'])?$data['name_cus']:'';
    $this->email_cus=isset($data['email_cus'])?$data['email_cus']:'';
    $this->phone_cus=isset($data['phone_cus'])?$data['phone_cus']:'';
    $this->address_cus=isset($data['address_cus'])?$data['address_cus']:'';
    $this->code_tour=isset($data['code_tour'])?$data['code_tour']:'';
    $this->name_tour=isset($data['name_tour'])?$data['name_tour']:'';
    $this->time_tour=isset($data['time_tour'])?$data['time_tour']:'';
    $this->date_tour=isset($data['date_tour'])?$data['date_tour']:'';
    $this->address_tour=isset($data['address_tour'])?$data['address_tour']:'';
    $this->note_tour=isset($data['note_tour'])?$data['note_tour']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->updated=isset($data['updated'])?$data['updated']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->user_id=addslashes($this->user_id);
            $this->customer_id=addslashes($this->customer_id);
            $this->status=addslashes($this->status);
            $this->name_cus=addslashes($this->name_cus);
            $this->email_cus=addslashes($this->email_cus);
            $this->phone_cus=addslashes($this->phone_cus);
            $this->address_cus=addslashes($this->address_cus);
            $this->code_tour=addslashes($this->code_tour);
            $this->name_tour=addslashes($this->name_tour);
            $this->time_tour=addslashes($this->time_tour);
            $this->date_tour=addslashes($this->date_tour);
            $this->address_tour=addslashes($this->address_tour);
            $this->note_tour=addslashes($this->note_tour);
            $this->created=addslashes($this->created);
            $this->updated=addslashes($this->updated);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->user_id=stripslashes($this->user_id);
            $this->customer_id=stripslashes($this->customer_id);
            $this->status=stripslashes($this->status);
            $this->name_cus=stripslashes($this->name_cus);
            $this->email_cus=stripslashes($this->email_cus);
            $this->phone_cus=stripslashes($this->phone_cus);
            $this->address_cus=stripslashes($this->address_cus);
            $this->code_tour=stripslashes($this->code_tour);
            $this->name_tour=stripslashes($this->name_tour);
            $this->time_tour=stripslashes($this->time_tour);
            $this->date_tour=stripslashes($this->date_tour);
            $this->address_tour=stripslashes($this->address_tour);
            $this->note_tour=stripslashes($this->note_tour);
            $this->created=stripslashes($this->created);
            $this->updated=stripslashes($this->updated);
        }
}
