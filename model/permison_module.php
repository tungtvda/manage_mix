<?php
class permison_module
{
    public $id,$name,$icon,$url,$action_count,$dk_count,$active,$status,$position;
    public function permison_module($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->icon=isset($data['icon'])?$data['icon']:'';
    $this->url=isset($data['url'])?$data['url']:'';
    $this->action_count=isset($data['action_count'])?$data['action_count']:'';
    $this->dk_count=isset($data['dk_count'])?$data['dk_count']:'';
    $this->active=isset($data['active'])?$data['active']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->position=isset($data['position'])?$data['position']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->icon=addslashes($this->icon);
            $this->url=addslashes($this->url);
            $this->action_count=addslashes($this->action_count);
            $this->dk_count=addslashes($this->dk_count);
            $this->active=addslashes($this->active);
            $this->status=addslashes($this->status);
            $this->position=addslashes($this->position);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->icon=stripslashes($this->icon);
            $this->url=stripslashes($this->url);
            $this->action_count=stripslashes($this->action_count);
            $this->dk_count=stripslashes($this->dk_count);
            $this->active=stripslashes($this->active);
            $this->status=stripslashes($this->status);
            $this->position=stripslashes($this->position);
        }
}
