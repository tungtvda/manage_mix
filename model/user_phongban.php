<?php
class user_phongban
{
    public $id,$name,$position,$description;
    public function user_phongban($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->position=isset($data['position'])?$data['position']:'';
    $this->description=isset($data['description'])?$data['description']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->position=addslashes($this->position);
            $this->description=addslashes($this->description);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->position=stripslashes($this->position);
            $this->description=stripslashes($this->description);
        }
}
