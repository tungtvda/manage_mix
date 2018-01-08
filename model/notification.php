<?php
class notification
{
    public $id,$user_id,$user_send_id,$name,$link,$status,$content,$created;
    public function notification($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->user_id=isset($data['user_id'])?$data['user_id']:'';
    $this->user_send_id=isset($data['user_send_id'])?$data['user_send_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->link=isset($data['link'])?$data['link']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->content=isset($data['content'])?$data['content']:'';
    $this->created=isset($data['created'])?$data['created']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->user_id=addslashes($this->user_id);
            $this->user_send_id=addslashes($this->user_send_id);
            $this->name=addslashes($this->name);
            $this->link=addslashes($this->link);
            $this->status=addslashes($this->status);
            $this->content=addslashes($this->content);
            $this->created=addslashes($this->created);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->user_id=stripslashes($this->user_id);
            $this->user_send_id=stripslashes($this->user_send_id);
            $this->name=stripslashes($this->name);
            $this->link=stripslashes($this->link);
            $this->status=stripslashes($this->status);
            $this->content=stripslashes($this->content);
            $this->created=stripslashes($this->created);
        }
}
