<?php

class tour
{
    public $id, $tour_quoc_te, $DanhMuc1Id, $DanhMuc2Id, $danhmuc_multi, $promotion, $packages, $name, $name_url, $count_down, $code, $img,$price_tiep_thi, $price_sales, $price, $price_2, $price_3, $price_4, $price_5, $price_6, $price_number, $price_number_2, $price_number_3, $price_number_4, $price_number_5, $price_number_6, $name_price, $name_price_2, $name_price_3, $name_price_4, $name_price_5, $name_price_6, $so_cho, $durations, $departure, $departure_time, $destination, $vehicle, $hotel, $summary, $highlights, $schedule, $price_list, $content, $list_img, $title, $keyword, $description, $inclusion, $exclusion, $updated;

    public function tour($data = array())
    {
        $this->id = isset($data['id']) ? $data['id'] : '';
        $this->tour_quoc_te = isset($data['tour_quoc_te']) ? $data['tour_quoc_te'] : '';
        $this->DanhMuc1Id = isset($data['DanhMuc1Id']) ? $data['DanhMuc1Id'] : '';
        $this->DanhMuc2Id = isset($data['DanhMuc2Id']) ? $data['DanhMuc2Id'] : '';
        $this->danhmuc_multi = isset($data['danhmuc_multi']) ? $data['danhmuc_multi'] : '';
        $this->promotion = isset($data['promotion']) ? $data['promotion'] : '';
        $this->packages = isset($data['packages']) ? $data['packages'] : '';
        $this->name = isset($data['name']) ? $data['name'] : '';
        $this->name_url = isset($data['name_url']) ? $data['name_url'] : '';
        $this->count_down = isset($data['count_down']) ? $data['count_down'] : '';
        $this->code = isset($data['code']) ? $data['code'] : '';
        $this->img = isset($data['img']) ? $data['img'] : '';
        $this->price_tiep_thi = isset($data['price_tiep_thi']) ? $data['price_tiep_thi'] : '';
        $this->price_sales = isset($data['price_sales']) ? $data['price_sales'] : '';
        $this->price = isset($data['price']) ? $data['price'] : '';
        $this->price_2 = isset($data['price_2']) ? $data['price_2'] : '';
        $this->price_3 = isset($data['price_3']) ? $data['price_3'] : '';
        $this->price_4 = isset($data['price_4']) ? $data['price_4'] : '';
        $this->price_5 = isset($data['price_5']) ? $data['price_5'] : '';
        $this->price_6 = isset($data['price_6']) ? $data['price_6'] : '';
        $this->price_number = isset($data['price_number']) ? $data['price_number'] : '';
        $this->price_number_2 = isset($data['price_number_2']) ? $data['price_number_2'] : '';
        $this->price_number_3 = isset($data['price_number_3']) ? $data['price_number_3'] : '';
        $this->price_number_4 = isset($data['price_number_4']) ? $data['price_number_4'] : '';
        $this->price_number_5 = isset($data['price_number_5']) ? $data['price_number_5'] : '';
        $this->price_number_6 = isset($data['price_number_6']) ? $data['price_number_6'] : '';
        $this->name_price = isset($data['name_price']) ? $data['name_price'] : '';
        $this->name_price_2 = isset($data['name_price_2']) ? $data['name_price_2'] : '';
        $this->name_price_3 = isset($data['name_price_3']) ? $data['name_price_3'] : '';
        $this->name_price_4 = isset($data['name_price_4']) ? $data['name_price_4'] : '';
        $this->name_price_5 = isset($data['name_price_5']) ? $data['name_price_5'] : '';
        $this->name_price_6 = isset($data['name_price_6']) ? $data['name_price_6'] : '';
        $this->so_cho = isset($data['so_cho']) ? $data['so_cho'] : '';
        $this->durations = isset($data['durations']) ? $data['durations'] : '';
        $this->departure = isset($data['departure']) ? $data['departure'] : '';
        $this->departure_time = isset($data['departure_time']) ? $data['departure_time'] : '';
        $this->destination = isset($data['destination']) ? $data['destination'] : '';
        $this->vehicle = isset($data['vehicle']) ? $data['vehicle'] : '';
        $this->hotel = isset($data['hotel']) ? $data['hotel'] : '';
        $this->summary = isset($data['summary']) ? $data['summary'] : '';
        $this->highlights = isset($data['highlights']) ? $data['highlights'] : '';
        $this->schedule = isset($data['schedule']) ? $data['schedule'] : '';
        $this->price_list = isset($data['price_list']) ? $data['price_list'] : '';
        $this->content = isset($data['content']) ? $data['content'] : '';
        $this->list_img = isset($data['list_img']) ? $data['list_img'] : '';
        $this->title = isset($data['title']) ? $data['title'] : '';
        $this->keyword = isset($data['keyword']) ? $data['keyword'] : '';
        $this->description = isset($data['description']) ? $data['description'] : '';
        $this->inclusion = isset($data['inclusion']) ? $data['inclusion'] : '';
        $this->exclusion = isset($data['exclusion']) ? $data['exclusion'] : '';
        $this->updated = isset($data['updated']) ? $data['updated'] : '';
//          $this->encode();
    }

    public function encode()
    {
        $this->id = addslashes($this->id);
        $this->tour_quoc_te = addslashes($this->tour_quoc_te);
        $this->DanhMuc1Id = addslashes($this->DanhMuc1Id);
        $this->DanhMuc2Id = addslashes($this->DanhMuc2Id);
        $this->danhmuc_multi = addslashes($this->danhmuc_multi);
        $this->promotion = addslashes($this->promotion);
        $this->packages = addslashes($this->packages);
        $this->name = addslashes($this->name);
        $this->name_url = addslashes($this->name_url);
        $this->count_down = addslashes($this->count_down);
        $this->code = addslashes($this->code);
        $this->img = addslashes($this->img);
        $this->price_tiep_thi = addslashes($this->price_tiep_thi);
        $this->price_sales = addslashes($this->price_sales);
        $this->price = addslashes($this->price);
        $this->price_2 = addslashes($this->price_2);
        $this->price_3 = addslashes($this->price_3);
        $this->price_4 = addslashes($this->price_4);
        $this->price_5 = addslashes($this->price_5);
        $this->price_6 = addslashes($this->price_6);
        $this->price_number = addslashes($this->price_number);
        $this->price_number_2 = addslashes($this->price_number_2);
        $this->price_number_3 = addslashes($this->price_number_3);
        $this->price_number_4 = addslashes($this->price_number_4);
        $this->price_number_5 = addslashes($this->price_number_5);
        $this->price_number_6 = addslashes($this->price_number_6);
        $this->name_price = addslashes($this->name_price);
        $this->name_price_2 = addslashes($this->name_price_2);
        $this->name_price_3 = addslashes($this->name_price_3);
        $this->name_price_4 = addslashes($this->name_price_4);
        $this->name_price_5 = addslashes($this->name_price_5);
        $this->name_price_6 = addslashes($this->name_price_6);
        $this->so_cho = addslashes($this->so_cho);
        $this->durations = addslashes($this->durations);
        $this->departure = addslashes($this->departure);
        $this->departure_time = addslashes($this->departure_time);
        $this->destination = addslashes($this->destination);
        $this->vehicle = addslashes($this->vehicle);
        $this->hotel = addslashes($this->hotel);
//            $this->summary=addslashes($this->summary);
//            $this->highlights=addslashes($this->highlights);
//            $this->schedule=addslashes($this->schedule);
//            $this->price_list=addslashes($this->price_list);
//            $this->content=addslashes($this->content);
//            $this->list_img=addslashes($this->list_img);
        $this->title = addslashes($this->title);
        $this->keyword = addslashes($this->keyword);
        $this->description = addslashes($this->description);
//            $this->inclusion=addslashes($this->inclusion);
//            $this->exclusion=addslashes($this->exclusion);
        $this->updated = addslashes($this->updated);
    }

    public function decode()
    {
        $this->id = stripslashes($this->id);
        $this->tour_quoc_te = stripslashes($this->tour_quoc_te);
        $this->DanhMuc1Id = stripslashes($this->DanhMuc1Id);
        $this->DanhMuc2Id = stripslashes($this->DanhMuc2Id);
        $this->danhmuc_multi = stripslashes($this->danhmuc_multi);
        $this->promotion = stripslashes($this->promotion);
        $this->packages = stripslashes($this->packages);
        $this->name = stripslashes($this->name);
        $this->name_url = stripslashes($this->name_url);
        $this->count_down = stripslashes($this->count_down);
        $this->code = stripslashes($this->code);
        $this->img = stripslashes($this->img);
        $this->price_tiep_thi = stripslashes($this->price_tiep_thi);
        $this->price_sales = stripslashes($this->price_sales);
        $this->price = stripslashes($this->price);
        $this->price_2 = stripslashes($this->price_2);
        $this->price_3 = stripslashes($this->price_3);
        $this->price_4 = stripslashes($this->price_4);
        $this->price_5 = stripslashes($this->price_5);
        $this->price_6 = stripslashes($this->price_6);
        $this->price_number = stripslashes($this->price_number);
        $this->price_number_2 = stripslashes($this->price_number_2);
        $this->price_number_3 = stripslashes($this->price_number_3);
        $this->price_number_4 = stripslashes($this->price_number_4);
        $this->price_number_5 = stripslashes($this->price_number_5);
        $this->price_number_6 = stripslashes($this->price_number_6);
        $this->name_price = stripslashes($this->name_price);
        $this->name_price_2 = stripslashes($this->name_price_2);
        $this->name_price_3 = stripslashes($this->name_price_3);
        $this->name_price_4 = stripslashes($this->name_price_4);
        $this->name_price_5 = stripslashes($this->name_price_5);
        $this->name_price_6 = stripslashes($this->name_price_6);
        $this->so_cho = stripslashes($this->so_cho);
        $this->durations = stripslashes($this->durations);
        $this->departure = stripslashes($this->departure);
        $this->departure_time = stripslashes($this->departure_time);
        $this->destination = stripslashes($this->destination);
        $this->vehicle = stripslashes($this->vehicle);
        $this->hotel = stripslashes($this->hotel);
//            $this->summary=stripslashes($this->summary);
//            $this->highlights=stripslashes($this->highlights);
//            $this->schedule=stripslashes($this->schedule);
//            $this->price_list=stripslashes($this->price_list);
//            $this->content=stripslashes($this->content);
//            $this->list_img=stripslashes($this->list_img);
        $this->title = stripslashes($this->title);
        $this->keyword = stripslashes($this->keyword);
        $this->description = stripslashes($this->description);
//            $this->inclusion=stripslashes($this->inclusion);
//            $this->exclusion=stripslashes($this->exclusion);
        $this->updated = stripslashes($this->updated);

    }
}
