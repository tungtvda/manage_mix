<?php
class permison_module
{
    public $id,$name,$url,$status,$position;
    public function permison_module($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->url=isset($data['url'])?$data['url']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->position=isset($data['position'])?$data['position']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->url=addslashes($this->url);
            $this->status=addslashes($this->status);
            $this->position=addslashes($this->position);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->url=stripslashes($this->url);
            $this->status=stripslashes($this->status);
            $this->position=stripslashes($this->position);
        }
}
