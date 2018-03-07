<?php
class transaction
{
    public $id,$created_by,$customer_id,$created_at,$updated_at,$updated_by;
    public function transaction($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->created_by=isset($data['created_by'])?$data['created_by']:'';
    $this->customer_id=isset($data['customer_id'])?$data['customer_id']:'';
    $this->created_at=isset($data['created_at'])?$data['created_at']:'';
    $this->updated_at=isset($data['updated_at'])?$data['updated_at']:'';
    $this->updated_by=isset($data['updated_by'])?$data['updated_by']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->created_by=addslashes($this->created_by);
            $this->customer_id=addslashes($this->customer_id);
            $this->created_at=addslashes($this->created_at);
            $this->updated_at=addslashes($this->updated_at);
            $this->updated_by=addslashes($this->updated_by);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->created_by=stripslashes($this->created_by);
            $this->customer_id=stripslashes($this->customer_id);
            $this->created_at=stripslashes($this->created_at);
            $this->updated_at=stripslashes($this->updated_at);
            $this->updated_by=stripslashes($this->updated_by);
        }
}
