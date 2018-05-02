<?php
class tour_list_dichvu
{
    public $id,$tour_id,$name,$type,$price,$number,$total,$note;
    public function tour_list_dichvu($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->tour_id=isset($data['tour_id'])?$data['tour_id']:'';
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
            $this->tour_id=addslashes($this->tour_id);
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
            $this->tour_id=stripslashes($this->tour_id);
            $this->name=stripslashes($this->name);
            $this->type=stripslashes($this->type);
            $this->price=stripslashes($this->price);
            $this->number=stripslashes($this->number);
            $this->total=stripslashes($this->total);
            $this->note=stripslashes($this->note);
        }
}
