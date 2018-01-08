<?php
class booking_transactions
{
    public $id,$booking_id,$customer_id,$user_id,$name,$description,$created,$updated;
    public function booking_transactions($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->booking_id=isset($data['booking_id'])?$data['booking_id']:'';
    $this->customer_id=isset($data['customer_id'])?$data['customer_id']:'';
    $this->user_id=isset($data['user_id'])?$data['user_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->description=isset($data['description'])?$data['description']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->updated=isset($data['updated'])?$data['updated']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->booking_id=addslashes($this->booking_id);
            $this->customer_id=addslashes($this->customer_id);
            $this->user_id=addslashes($this->user_id);
            $this->name=addslashes($this->name);
            $this->description=addslashes($this->description);
            $this->created=addslashes($this->created);
            $this->updated=addslashes($this->updated);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->booking_id=stripslashes($this->booking_id);
            $this->customer_id=stripslashes($this->customer_id);
            $this->user_id=stripslashes($this->user_id);
            $this->name=stripslashes($this->name);
            $this->description=stripslashes($this->description);
            $this->created=stripslashes($this->created);
            $this->updated=stripslashes($this->updated);
        }
}
