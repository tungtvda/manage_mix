<?php
class log
{
    public $id,$user_id,$module_id,$form_id,$action_id,$item_id,$value_old,$value_new,$description,$created;
    public function log($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->user_id=isset($data['user_id'])?$data['user_id']:'';
    $this->module_id=isset($data['module_id'])?$data['module_id']:'';
    $this->form_id=isset($data['form_id'])?$data['form_id']:'';
    $this->action_id=isset($data['action_id'])?$data['action_id']:'';
    $this->item_id=isset($data['item_id'])?$data['item_id']:'';
    $this->value_old=isset($data['value_old'])?$data['value_old']:'';
    $this->value_new=isset($data['value_new'])?$data['value_new']:'';
    $this->description=isset($data['description'])?$data['description']:'';
    $this->created=isset($data['created'])?$data['created']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->user_id=addslashes($this->user_id);
            $this->module_id=addslashes($this->module_id);
            $this->form_id=addslashes($this->form_id);
            $this->action_id=addslashes($this->action_id);
            $this->item_id=addslashes($this->item_id);
            $this->value_old=addslashes($this->value_old);
            $this->value_new=addslashes($this->value_new);
            $this->description=addslashes($this->description);
            $this->created=addslashes($this->created);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->user_id=stripslashes($this->user_id);
            $this->module_id=stripslashes($this->module_id);
            $this->form_id=stripslashes($this->form_id);
            $this->action_id=stripslashes($this->action_id);
            $this->item_id=stripslashes($this->item_id);
            $this->value_old=stripslashes($this->value_old);
            $this->value_new=stripslashes($this->value_new);
            $this->description=stripslashes($this->description);
            $this->created=stripslashes($this->created);
        }
}
