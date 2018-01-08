<?php
class danhmuc_2
{
    public $id,$danhmuc1_id,$name,$name_url,$img,$position,$content_short,$title,$keyword,$description;
    public function danhmuc_2($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->danhmuc1_id=isset($data['danhmuc1_id'])?$data['danhmuc1_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->name_url=isset($data['name_url'])?$data['name_url']:'';
    $this->img=isset($data['img'])?$data['img']:'';
    $this->position=isset($data['position'])?$data['position']:'';
        $this->content_short=isset($data['content_short'])?$data['content_short']:'';
    $this->title=isset($data['title'])?$data['title']:'';
    $this->keyword=isset($data['keyword'])?$data['keyword']:'';
    $this->description=isset($data['description'])?$data['description']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->danhmuc1_id=addslashes($this->danhmuc1_id);
            $this->name=addslashes($this->name);
            $this->name_url=addslashes($this->name_url);
            $this->img=addslashes($this->img);
            $this->position=addslashes($this->position);
            $this->content_short=addslashes($this->content_short);
            $this->title=addslashes($this->title);
            $this->keyword=addslashes($this->keyword);
            $this->description=addslashes($this->description);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->danhmuc1_id=stripslashes($this->danhmuc1_id);
            $this->name=stripslashes($this->name);
            $this->name_url=stripslashes($this->name_url);
            $this->img=stripslashes($this->img);
            $this->position=stripslashes($this->position);
            $this->content_short=stripslashes($this->content_short);
            $this->title=stripslashes($this->title);
            $this->keyword=stripslashes($this->keyword);
            $this->description=stripslashes($this->description);
        }
}
