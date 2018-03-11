<?php
class customer_transaction
{
    public $id,$transaction_id,$title,$description,$created_at,$update_at,$created_by,$updated_by,$date,$time,$customer_id;
    public function customer_transaction($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->transaction_id=isset($data['transaction_id'])?$data['transaction_id']:'';
    $this->title=isset($data['title'])?$data['title']:'';
    $this->description=isset($data['description'])?$data['description']:'';
    $this->created_at=isset($data['created_at'])?$data['created_at']:'';
    $this->update_at=isset($data['update_at'])?$data['update_at']:'';
    $this->created_by=isset($data['created_by'])?$data['created_by']:'';
    $this->updated_by=isset($data['updated_by'])?$data['updated_by']:'';
    $this->date=isset($data['date'])?$data['date']:'';
    $this->time=isset($data['time'])?$data['time']:'';
    $this->customer_id=isset($data['customer_id'])?$data['customer_id']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->transaction_id=addslashes($this->transaction_id);
            $this->title=addslashes($this->title);
            $this->description=addslashes($this->description);
            $this->created_at=addslashes($this->created_at);
            $this->update_at=addslashes($this->update_at);
            $this->created_by=addslashes($this->created_by);
            $this->updated_by=addslashes($this->updated_by);
            $this->date=addslashes($this->date);
            $this->time=addslashes($this->time);
            $this->customer_id=addslashes($this->customer_id);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->transaction_id=stripslashes($this->transaction_id);
            $this->title=stripslashes($this->title);
            $this->description=stripslashes($this->description);
            $this->created_at=stripslashes($this->created_at);
            $this->update_at=stripslashes($this->update_at);
            $this->created_by=stripslashes($this->created_by);
            $this->updated_by=stripslashes($this->updated_by);
            $this->date=stripslashes($this->date);
            $this->time=stripslashes($this->time);
            $this->customer_id=stripslashes($this->customer_id);
        }
}
