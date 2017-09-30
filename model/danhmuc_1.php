<?php

class danhmuc_1
{
    public $id, $tour_quoc_te, $name, $name_url, $img, $position, $title, $keyword, $description;

    public function danhmuc_1($data = array())
    {
        $this->id = isset($data['id']) ? $data['id'] : '';
        $this->tour_quoc_te = isset($data['tour_quoc_te']) ? $data['tour_quoc_te'] : '';
        $this->name = isset($data['name']) ? $data['name'] : '';
        $this->name_url = isset($data['name_url']) ? $data['name_url'] : '';
        $this->img = isset($data['img']) ? $data['img'] : '';
        $this->position = isset($data['position']) ? $data['position'] : '';
        $this->title = isset($data['title']) ? $data['title'] : '';
        $this->keyword = isset($data['keyword']) ? $data['keyword'] : '';
        $this->description = isset($data['description']) ? $data['description'] : '';
        $this->encode();
    }

    public function encode()
    {
        $this->id = addslashes($this->id);
        $this->tour_quoc_te = addslashes($this->tour_quoc_te);
        $this->name = addslashes($this->name);
        $this->name_url = addslashes($this->name_url);
        $this->img = addslashes($this->img);
        $this->position = addslashes($this->position);
        $this->title = addslashes($this->title);
        $this->keyword = addslashes($this->keyword);
        $this->description = addslashes($this->description);
    }

    public function decode()
    {
        $this->id = stripslashes($this->id);
        $this->tour_quoc_te = stripslashes($this->tour_quoc_te);
        $this->name = stripslashes($this->name);
        $this->name_url = stripslashes($this->name_url);
        $this->img = stripslashes($this->img);
        $this->position = stripslashes($this->position);
        $this->title = stripslashes($this->title);
        $this->keyword = stripslashes($this->keyword);
        $this->description = stripslashes($this->description);
    }
}
