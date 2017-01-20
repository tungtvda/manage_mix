<?php
class permison_form
{
    public $id,$module_id,$name,$url,$status,$position;
    public function permison_form($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->module_id=isset($data['module_id'])?$data['module_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->url=isset($data['url'])?$data['url']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->position=isset($data['position'])?$data['position']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->module_id=addslashes($this->module_id);
            $this->name=addslashes($this->name);
            $this->url=addslashes($this->url);
            $this->status=addslashes($this->status);
            $this->position=addslashes($this->position);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->module_id=stripslashes($this->module_id);
            $this->name=stripslashes($this->name);
            $this->url=stripslashes($this->url);
            $this->status=stripslashes($this->status);
            $this->position=stripslashes($this->position);
        }
}
