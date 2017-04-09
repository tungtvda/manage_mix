<?php
class short_code
{
    public $id,$type,$name,$field,$description,$position;
    public function short_code($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->type=isset($data['type'])?$data['type']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->field=isset($data['field'])?$data['field']:'';
    $this->description=isset($data['description'])?$data['description']:'';
    $this->position=isset($data['position'])?$data['position']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->type=addslashes($this->type);
            $this->name=addslashes($this->name);
            $this->field=addslashes($this->field);
            $this->description=addslashes($this->description);
            $this->position=addslashes($this->position);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->type=stripslashes($this->type);
            $this->name=stripslashes($this->name);
            $this->field=stripslashes($this->field);
            $this->description=stripslashes($this->description);
            $this->position=stripslashes($this->position);
        }
}
