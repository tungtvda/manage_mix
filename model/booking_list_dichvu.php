<?php
class booking_list_dichvu
{
    public $id,$booking_id,$name,$type,$price,$number,$total,$note;
    public function booking_list_dichvu($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->booking_id=isset($data['booking_id'])?$data['booking_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->type=isset($data['type'])?$data['type']:'';
    $this->price=isset($data['price'])?$data['price']:'';
    $this->number=isset($data['number'])?$data['number']:'';
    $this->total=isset($data['total'])?$data['total']:'';
    $this->note=isset($data['note'])?$data['note']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->booking_id=addslashes($this->booking_id);
            $this->name=addslashes($this->name);
            $this->type=addslashes($this->type);
            $this->price=addslashes($this->price);
            $this->number=addslashes($this->number);
            $this->total=addslashes($this->total);
            $this->note=addslashes($this->note);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->booking_id=stripslashes($this->booking_id);
            $this->name=stripslashes($this->name);
            $this->type=stripslashes($this->type);
            $this->price=stripslashes($this->price);
            $this->number=stripslashes($this->number);
            $this->total=stripslashes($this->total);
            $this->note=stripslashes($this->note);
        }
}
