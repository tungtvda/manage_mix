<?php
class customer_booking
{
    public $id,$booking_id,$name,$email,$phone,$address,$do_tuoi,$do_tuoi_number,$birthday,$passport,$date_passport,$created_by,$created,$updated;
    public function customer_booking($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->booking_id=isset($data['booking_id'])?$data['booking_id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->email=isset($data['email'])?$data['email']:'';
    $this->phone=isset($data['phone'])?$data['phone']:'';
    $this->address=isset($data['address'])?$data['address']:'';
    $this->do_tuoi=isset($data['do_tuoi'])?$data['do_tuoi']:'';
    $this->do_tuoi_number=isset($data['do_tuoi_number'])?$data['do_tuoi_number']:'';
    $this->birthday=isset($data['birthday'])?$data['birthday']:'';
    $this->passport=isset($data['passport'])?$data['passport']:'';
    $this->date_passport=isset($data['date_passport'])?$data['date_passport']:'';
    $this->created_by=isset($data['created_by'])?$data['created_by']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->updated=isset($data['updated'])?$data['updated']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->booking_id=addslashes($this->booking_id);
            $this->name=addslashes($this->name);
            $this->email=addslashes($this->email);
            $this->phone=addslashes($this->phone);
            $this->address=addslashes($this->address);
            $this->do_tuoi=addslashes($this->do_tuoi);
            $this->do_tuoi_number=addslashes($this->do_tuoi_number);
            $this->birthday=addslashes($this->birthday);
            $this->passport=addslashes($this->passport);
            $this->date_passport=addslashes($this->date_passport);
            $this->created_by=addslashes($this->created_by);
            $this->created=addslashes($this->created);
            $this->updated=addslashes($this->updated);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->booking_id=stripslashes($this->booking_id);
            $this->name=stripslashes($this->name);
            $this->email=stripslashes($this->email);
            $this->phone=stripslashes($this->phone);
            $this->address=stripslashes($this->address);
            $this->do_tuoi=stripslashes($this->do_tuoi);
            $this->do_tuoi_number=stripslashes($this->do_tuoi_number);
            $this->birthday=stripslashes($this->birthday);
            $this->passport=stripslashes($this->passport);
            $this->date_passport=stripslashes($this->date_passport);
            $this->created_by=stripslashes($this->created_by);
            $this->created=stripslashes($this->created);
            $this->updated=stripslashes($this->updated);
        }
}
