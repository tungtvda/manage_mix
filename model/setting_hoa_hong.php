<?php
class setting_hoa_hong
{
    public $id,$hoa_hong_3,$hoa_hong_4,$hoa_hong_5,$hoa_hong_dai_ly,$hoa_hong_gt_f1,$hoa_hong_gt_f2,$hoa_hong_gt_f3,$muc_4_don_hang,$muc_4_thanh_vien,$muc_5_don_hang,$muc_5_thanh_vien_3,$muc_5_thanh_vien_4;
    public function setting_hoa_hong($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->hoa_hong_3=isset($data['hoa_hong_3'])?$data['hoa_hong_3']:'';
    $this->hoa_hong_4=isset($data['hoa_hong_4'])?$data['hoa_hong_4']:'';
    $this->hoa_hong_5=isset($data['hoa_hong_5'])?$data['hoa_hong_5']:'';
    $this->hoa_hong_dai_ly=isset($data['hoa_hong_dai_ly'])?$data['hoa_hong_dai_ly']:'';
    $this->hoa_hong_gt_f1=isset($data['hoa_hong_gt_f1'])?$data['hoa_hong_gt_f1']:'';
    $this->hoa_hong_gt_f2=isset($data['hoa_hong_gt_f2'])?$data['hoa_hong_gt_f2']:'';
    $this->hoa_hong_gt_f3=isset($data['hoa_hong_gt_f3'])?$data['hoa_hong_gt_f3']:'';
    $this->muc_4_don_hang=isset($data['muc_4_don_hang'])?$data['muc_4_don_hang']:'';
    $this->muc_4_thanh_vien=isset($data['muc_4_thanh_vien'])?$data['muc_4_thanh_vien']:'';
    $this->muc_5_don_hang=isset($data['muc_5_don_hang'])?$data['muc_5_don_hang']:'';
    $this->muc_5_thanh_vien_3=isset($data['muc_5_thanh_vien_3'])?$data['muc_5_thanh_vien_3']:'';
    $this->muc_5_thanh_vien_4=isset($data['muc_5_thanh_vien_4'])?$data['muc_5_thanh_vien_4']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->hoa_hong_3=addslashes($this->hoa_hong_3);
            $this->hoa_hong_4=addslashes($this->hoa_hong_4);
            $this->hoa_hong_5=addslashes($this->hoa_hong_5);
            $this->hoa_hong_dai_ly=addslashes($this->hoa_hong_dai_ly);
            $this->hoa_hong_gt_f1=addslashes($this->hoa_hong_gt_f1);
            $this->hoa_hong_gt_f2=addslashes($this->hoa_hong_gt_f2);
            $this->hoa_hong_gt_f3=addslashes($this->hoa_hong_gt_f3);
            $this->muc_4_don_hang=addslashes($this->muc_4_don_hang);
            $this->muc_4_thanh_vien=addslashes($this->muc_4_thanh_vien);
            $this->muc_5_don_hang=addslashes($this->muc_5_don_hang);
            $this->muc_5_thanh_vien_3=addslashes($this->muc_5_thanh_vien_3);
            $this->muc_5_thanh_vien_4=addslashes($this->muc_5_thanh_vien_4);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->hoa_hong_3=stripslashes($this->hoa_hong_3);
            $this->hoa_hong_4=stripslashes($this->hoa_hong_4);
            $this->hoa_hong_5=stripslashes($this->hoa_hong_5);
            $this->hoa_hong_dai_ly=stripslashes($this->hoa_hong_dai_ly);
            $this->hoa_hong_gt_f1=stripslashes($this->hoa_hong_gt_f1);
            $this->hoa_hong_gt_f2=stripslashes($this->hoa_hong_gt_f2);
            $this->hoa_hong_gt_f3=stripslashes($this->hoa_hong_gt_f3);
            $this->muc_4_don_hang=stripslashes($this->muc_4_don_hang);
            $this->muc_4_thanh_vien=stripslashes($this->muc_4_thanh_vien);
            $this->muc_5_don_hang=stripslashes($this->muc_5_don_hang);
            $this->muc_5_thanh_vien_3=stripslashes($this->muc_5_thanh_vien_3);
            $this->muc_5_thanh_vien_4=stripslashes($this->muc_5_thanh_vien_4);
        }
}
