<?php
class tien_te
{
    public $id,$name,$value,$position;
    public function tien_te($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->value=isset($data['value'])?$data['value']:'';
    $this->position=isset($data['position'])?$data['position']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->value=addslashes($this->value);
            $this->position=addslashes($this->position);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->value=stripslashes($this->value);
            $this->position=stripslashes($this->position);
        }
}
