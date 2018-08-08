<?php
require_once DIR.'/model/review_hotel.php';
require_once DIR.'/model/sqlconnection.php';
//
function review_hotel_Get($command)
{
            $array_result=array();
    $key=md5($command);
    if(CACHE)
    {
        $mycache=ConnectCache();
        $cachecommand=$mycache->get($key);
        if($cachecommand)
        {
            $array_result=$cachecommand;
        }
        else
        {
          $result=mysqli_query(ConnectSql(),$command);
            if($result!=false)while($row=mysqli_fetch_array($result))
            {
                $new_obj=new review_hotel($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'review_hotel');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new review_hotel($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function review_hotel_getById($id)
{
    return review_hotel_Get('select * from review_hotel where id='.$id);
}
//
function review_hotel_getByAll()
{
    return review_hotel_Get('select * from review_hotel');
}
//
function review_hotel_getByTop($top,$where,$order)
{
    return review_hotel_Get("select * from review_hotel ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function review_hotel_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return review_hotel_Get("SELECT * FROM  review_hotel ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function review_hotel_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return review_hotel_Get("SELECT review_hotel.id, review_hotel.customer_id, review_hotel.hotel_id, review_hotel.hotel_name, review_hotel.hotel_code, review_hotel.domain, review_hotel.content, review_hotel.start_date, review_hotel.end_date, review_hotel.status, review_hotel.clear, review_hotel.show_clear, review_hotel.comfort, review_hotel.show_comfort, review_hotel.convenient, review_hotel.show_convenient, review_hotel.staff, review_hotel.show_staff, review_hotel.room, review_hotel.show_room, review_hotel.price, review_hotel.show_price, review_hotel.food, review_hotel.show_food, review_hotel.place, review_hotel.show_place, review_hotel.total, review_hotel.comment, review_hotel.show_coment, review_hotel.upcoming_tour, review_hotel.created, review_hotel.updated, review_hotel.updated_by FROM  review_hotel ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function review_hotel_insert($obj)
{
    return exe_query("insert into review_hotel (customer_id,hotel_id,hotel_name,hotel_code,domain,content,start_date,end_date,status,clear,show_clear,comfort,show_comfort,convenient,show_convenient,staff,show_staff,room,show_room,price,show_price,food,show_food,place,show_place,total,comment,show_coment,upcoming_tour,created,updated,updated_by) values ('$obj->customer_id','$obj->hotel_id','$obj->hotel_name','$obj->hotel_code','$obj->domain','$obj->content','$obj->start_date','$obj->end_date','$obj->status','$obj->clear','$obj->show_clear','$obj->comfort','$obj->show_comfort','$obj->convenient','$obj->show_convenient','$obj->staff','$obj->show_staff','$obj->room','$obj->show_room','$obj->price','$obj->show_price','$obj->food','$obj->show_food','$obj->place','$obj->show_place','$obj->total','$obj->comment','$obj->show_coment','$obj->upcoming_tour','$obj->created','$obj->updated','$obj->updated_by')",'review_hotel');
}
//
function review_hotel_update($obj)
{
    return exe_query("update review_hotel set customer_id='$obj->customer_id',hotel_id='$obj->hotel_id',hotel_name='$obj->hotel_name',hotel_code='$obj->hotel_code',domain='$obj->domain',content='$obj->content',start_date='$obj->start_date',end_date='$obj->end_date',status='$obj->status',clear='$obj->clear',show_clear='$obj->show_clear',comfort='$obj->comfort',show_comfort='$obj->show_comfort',convenient='$obj->convenient',show_convenient='$obj->show_convenient',staff='$obj->staff',show_staff='$obj->show_staff',room='$obj->room',show_room='$obj->show_room',price='$obj->price',show_price='$obj->show_price',food='$obj->food',show_food='$obj->show_food',place='$obj->place',show_place='$obj->show_place',total='$obj->total',comment='$obj->comment',show_coment='$obj->show_coment',upcoming_tour='$obj->upcoming_tour',created='$obj->created',updated='$obj->updated',updated_by='$obj->updated_by' where id=$obj->id",'review_hotel');
}
//
function review_hotel_delete($obj)
{
    return exe_query('delete from review_hotel where id='.$obj->id,'review_hotel');
}
//
function review_hotel_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from review_hotel '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}


function review_az_hotel_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
    $query="
SELECT rv.* ,
cs.name as name_cus,cs.avatar as avatar
FROM
review_hotel as rv
LEFT JOIN customer cs on rv.customer_id = cs.id
".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize;

    $result=mysqli_query(ConnectSql(),$query);

    $string='';
    $count=0;
    if($result!=false)while($row=mysqli_fetch_array($result))
    {
        $count++;
        $new_obj=new review_hotel($row);
        if($row['avatar']=="")
        {
            $arrayColor=array('#f09960','#325e98','#7cbe65','#ea6b6b','#39b4e8');
            $name_cus='';
            if($row['name_cus']!=''){
                $name_cus= strtoupper(substr(LocDau($row['name_cus']),  0,1));
            }
            $avatar='<div data-toggle="tooltip" data-placement="top" title="'.$row['name_cus'].'" class="noavatart" style="background:'.$arrayColor[array_rand($arrayColor)].';">'.$name_cus.'</div>';
        }
        else{
            $img=SITE_NAME.$row['avatar'];
            $avatar=' <img data-toggle="tooltip" data-placement="top" title="'.$row['name_cus'].'" style="display: initial;" class="avatar-mask ava-pad-bottom ava-default" src="'.$img.'" alt="">';
        }
        $textPoint='Tuyệt vời';
        if($new_obj->total>=1 &&$new_obj->total<=2.9){
            $textPoint='Rất kém';
        }
        if($new_obj->total>=3 && $new_obj->total<=4.9){
            $textPoint='Kém';
        }
        if($new_obj->total>=5 && $new_obj->total<=6.9){
            $textPoint='Trung bình';
        }
        if($new_obj->total>=7 && $new_obj->total<=8.9){
            $textPoint='Tốt';
        }
        $string.=' <li class="review_item clearfix review_featured  ">
                                    <p class="review_item_date">
                                        Ngày đánh giá: '.date("d-m-Y H:i", strtotime($new_obj->created)).'
                                    </p>
                                    <div data-et-view="aRDPNZJKSXe:2"></div>
                                    <div class="review_item_reviewer" style="text-align: center">
                                        <div style="display: inline-block;">
                                       '.$avatar.'

                                        </div>
                                        <a  href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="'.$row['name_cus'].'" class="reviewer_country name_cus_list">
                                       '.$row['name_cus'].'
                                        </a>
                                    </div><!-- .review_item_reviewer -->
                                    <div class="review_item_review">
                                        <div class="review_item_review_container lang_ltr">
                                            <div class="review_item_review_header">
                                                <div class="review_item_header_score_container">
                                                    <span class=" review-score-widget review-score-widget__superb review-score-widget__score-only  review-score-widget__no-subtext    ">
                                                        <span class="review-score-badge" role="link" aria-label="'.$new_obj->total.'" data-toggle="tooltip" data-placement="left" title="'.$textPoint.'">
                                                            '.$new_obj->total.'
                                                         </span>
                                                    </span>
                                                </div>
                                                <div class="review_item_header_content_container">
                                                    <div class="review_item_header_content review_item_header_scoreword">
                                                      '.$new_obj->content.'
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review_item_review_content">
                                                <div class="review_neg">';
        if($new_obj->show_coment){
            $comment=$new_obj->comment;
            if (strlen($comment) >150) {
                $comment1=strip_tags($comment);
                $comment2 = substr($comment1, 0, 150);
                $comment = substr($comment2, 0, strrpos($comment2, ' ')) . "...";
                $string.='<a  title="Xem thêm" class="show_full_comment" data-id="'.$new_obj->id.'" data-value="short" href="javascript:void(0)">
                                                            <i id="icon_show_hide_review_'.$new_obj->id.'" class="review_item_icon review_item_icon_view glyphicon glyphicon-plus-sign" ></i>
                                                            </a>';
            }else{
                if($comment!=''){
                    $string.='<a href="javascript:void(0)"><i class="review_item_icon review_item_icon_default glyphicon glyphicon-minus-sign " ></i></a>';
                }
            }

            $string.=' <p class="long_comment" id="long_comment_'.$new_obj->id.'" hidden> '.$new_obj->comment.'</p>';
            $string.='<p class="short_comment" id="short_comment_'.$new_obj->id.'"> '.$comment.'</p>';
        }

        $string.=' <p class="icon_review icon_review_list">';
        if($new_obj->show_clear){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Sạch sẽ: '.$new_obj->clear.'" href="javascript:void(0)"><i class="glyphicon glyphicon-heart-empty"></i></a>';
        }
        if($new_obj->show_comfort){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Thoải mái: '.$new_obj->comfort.'" href="javascript:void(0)"><i class="glyphicon glyphicon-thumbs-up"></i></a>';
        }
        if($new_obj->show_convenient){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Tiện nghi: '.$new_obj->convenient.'" href="javascript:void(0)"><i class="glyphicon glyphicon-sort-by-alphabet "></i></a>';
        }
        if($new_obj->show_staff){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Nhân viên phục vụ: '.$new_obj->staff.'" href="javascript:void(0)"><i class="glyphicon glyphicon-user"></i></a>';
        }
        if($new_obj->show_room){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Phòng: '.$new_obj->room.'" href="javascript:void(0)"><i class="glyphicon glyphicon-credit-card"></i></a>';
        }
        if($new_obj->show_price){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Giá tiền: '.$new_obj->price.'" href="javascript:void(0)"><i class="glyphicon glyphicon-usd"></i></a>';
        }
        if($new_obj->show_food){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Đồ ăn: '.$new_obj->food.'" href="javascript:void(0)"><i class="glyphicon glyphicon-cutlery"></i></a>';
        }
        if($new_obj->show_place){
            $string.='<a data-toggle="tooltip" data-placement="top" title="Địa điểm: '.$new_obj->place.'" href="javascript:void(0)"><i class="glyphicon glyphicon-map-marker"></i></a>';
        }
        $string.='</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>';
    }
    $array_result=array(
        'string'=>$string,
        'count'=>$count,
    );
    return $array_result;
}

function review_hotel_sum($where, $filed='id')
{
    $result=mysqli_query(ConnectSql(),'select SUM('.$filed.') as sumPoint, COUNT(id) as countReview from review_hotel '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
        $row=mysqli_fetch_array($result);
        return $row;
    }
    else return false;
}
function review_hotel_count_statis($where)
{
    $result=mysqli_query(ConnectSql(),'select  COUNT(id) as countReview from review_hotel '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
        $row=mysqli_fetch_array($result);
        return $row['countReview'];
    }
    else return false;
}