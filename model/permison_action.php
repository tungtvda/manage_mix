<?php
class permison_action
{
    public $id,$name,$module_id,$form_id,$status,$position,$note;
    public function permison_action($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->module_id=isset($data['module_id'])?$data['module_id']:'';
    $this->form_id=isset($data['form_id'])?$data['form_id']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->position=isset($data['position'])?$data['position']:'';
    $this->note=isset($data['note'])?$data['note']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->module_id=addslashes($this->module_id);
            $this->form_id=addslashes($this->form_id);
            $this->status=addslashes($this->status);
            $this->position=addslashes($this->position);
            $this->note=addslashes($this->note);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->module_id=stripslashes($this->module_id);
            $this->form_id=stripslashes($this->form_id);
            $this->status=stripslashes($this->status);
            $this->position=stripslashes($this->position);
            $this->note=stripslashes($this->note);
        }
}
