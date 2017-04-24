<?php
class booking_cost
{
    public $id,$booking_id,$user_id,$name,$price,$description,$created,$created_by,$updated,$updated_by;
    public function booking_cost($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->booking_id=isset($data['booking_id'])?$data['booking_id']:'';
    $this->user_id=isset($data['user_id'])?$data['user_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->price=isset($data['price'])?$data['price']:'';
    $this->description=isset($data['description'])?$data['description']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->created_by=isset($data['created_by'])?$data['created_by']:'';
    $this->updated=isset($data['updated'])?$data['updated']:'';
    $this->updated_by=isset($data['updated_by'])?$data['updated_by']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->booking_id=addslashes($this->booking_id);
            $this->user_id=addslashes($this->user_id);
            $this->name=addslashes($this->name);
            $this->price=addslashes($this->price);
            $this->description=addslashes($this->description);
            $this->created=addslashes($this->created);
            $this->created_by=addslashes($this->created_by);
            $this->updated=addslashes($this->updated);
            $this->updated_by=addslashes($this->updated_by);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->booking_id=stripslashes($this->booking_id);
            $this->user_id=stripslashes($this->user_id);
            $this->name=stripslashes($this->name);
            $this->price=stripslashes($this->price);
            $this->description=stripslashes($this->description);
            $this->created=stripslashes($this->created);
            $this->created_by=stripslashes($this->created_by);
            $this->updated=stripslashes($this->updated);
            $this->updated_by=stripslashes($this->updated_by);
        }
}
