<?php
require_once DIR.'/model/review_tour.php';
require_once DIR.'/model/sqlconnection.php';
//
function review_tour_Get($command)
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
                $new_obj=new review_tour($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'review_tour');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new review_tour($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function review_tour_getById($id)
{
    return review_tour_Get('select * from review_tour where id='.$id);
}
//
function review_tour_getByAll()
{
    return review_tour_Get('select * from review_tour');
}
//
function review_tour_getByTop($top,$where,$order)
{
    return review_tour_Get("select * from review_tour ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function review_tour_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return review_tour_Get("SELECT * FROM  review_tour ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function review_tour_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return review_tour_Get("SELECT review_tour.id, review_tour.customer_id, review_tour.tour_id, review_tour.tour_name, review_tour.tour_code, review_tour.domain, review_tour.content, review_tour.departure, review_tour.status, review_tour.program, review_tour.show_program, review_tour.tour_guide_full, review_tour.show_tour_guide_full, review_tour.tour_guide_local, review_tour.show_tour_guide_local, review_tour.hotel, review_tour.show_hotel, review_tour.restaurant, review_tour.show_restaurant, review_tour.total, review_tour.transportation, review_tour.show_transportation, review_tour.comment, review_tour.show_coment, review_tour.upcoming_tour, review_tour.created, review_tour.updated, review_tour.updated_by FROM  review_tour ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function review_tour_insert($obj)
{
    return exe_query("insert into review_tour (customer_id,tour_id,tour_name,tour_code,domain,content,departure,status,program,show_program,tour_guide_full,show_tour_guide_full,tour_guide_local,show_tour_guide_local,hotel,show_hotel,restaurant,show_restaurant,total,transportation,show_transportation,comment,show_coment,upcoming_tour,created,updated,updated_by) values ('$obj->customer_id','$obj->tour_id','$obj->tour_name','$obj->tour_code','$obj->domain','$obj->content','$obj->departure','$obj->status','$obj->program','$obj->show_program','$obj->tour_guide_full','$obj->show_tour_guide_full','$obj->tour_guide_local','$obj->show_tour_guide_local','$obj->hotel','$obj->show_hotel','$obj->restaurant','$obj->show_restaurant','$obj->total','$obj->transportation','$obj->show_transportation','$obj->comment','$obj->show_coment','$obj->upcoming_tour','$obj->created','$obj->updated','$obj->updated_by')",'review_tour');
}
//
function review_tour_update($obj)
{
    return exe_query("update review_tour set customer_id='$obj->customer_id',tour_id='$obj->tour_id',tour_name='$obj->tour_name',tour_code='$obj->tour_code',domain='$obj->domain',content='$obj->content',departure='$obj->departure',status='$obj->status',program='$obj->program',show_program='$obj->show_program',tour_guide_full='$obj->tour_guide_full',show_tour_guide_full='$obj->show_tour_guide_full',tour_guide_local='$obj->tour_guide_local',show_tour_guide_local='$obj->show_tour_guide_local',hotel='$obj->hotel',show_hotel='$obj->show_hotel',restaurant='$obj->restaurant',show_restaurant='$obj->show_restaurant',total='$obj->total',transportation='$obj->transportation',show_transportation='$obj->show_transportation',comment='$obj->comment',show_coment='$obj->show_coment',upcoming_tour='$obj->upcoming_tour',created='$obj->created',updated='$obj->updated',updated_by='$obj->updated_by' where id=$obj->id",'review_tour');
}
//
function review_tour_delete($obj)
{
    return exe_query('delete from review_tour where id='.$obj->id,'review_tour');
}
//
function review_tour_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from review_tour '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}

function review_az_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
    $query="
SELECT rv.* ,
cs.name as name_cus,cs.avatar as avatar
FROM
review_tour as rv
LEFT JOIN customer cs on rv.customer_id = cs.id
".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize;

    $result=mysqli_query(ConnectSql(),$query);
    $array_result=array();
    $string='';
    if($result!=false)while($row=mysqli_fetch_array($result))
    {

        $new_obj=new review_tour($row);
        if($row['avatar']=="")
        {
            $avatar=SITE_NAME.'/view/default/themes/images/no-avatar.png';
        }
        else{
            $avatar=SITE_NAME.$row['avatar'];
        }
        $item=array(
            'customer_id'=>$new_obj->customer_id,
            'tour_id'=>$new_obj->tour_id,
            'tour_name'=>$new_obj->tour_name,
            'domain'=>$new_obj->domain,
            'status'=>$new_obj->status,
            'departure'=>$new_obj->departure,
            'program'=>$new_obj->program,
            'show_program'=>$new_obj->show_program,
            'tour_guide_full'=>$new_obj->tour_guide_full,
            'show_tour_guide_full'=>$new_obj->show_tour_guide_full,
            'tour_guide_local'=>$new_obj->tour_guide_local,
            'show_tour_guide_local'=>$new_obj->show_tour_guide_local,
            'hotel'=>$new_obj->hotel,
            'show_hotel'=>$new_obj->show_hotel,
            'restaurant'=>$new_obj->restaurant,
            'show_restaurant'=>$new_obj->show_restaurant,
            'transportation'=>$new_obj->transportation,
            'show_transportation'=>$new_obj->show_transportation,
            'comment'=>$new_obj->comment,
            'show_coment'=>$new_obj->show_coment,
            'upcoming_tour'=>$new_obj->upcoming_tour,
            'created'=>$new_obj->created,
            'name_cus'=>$row['name_cus'],
            'avatar'=>$avatar,
        );
        array_push($array_result,$item);
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
                                        Ngày đánh giá: '.date("d-m-Y", strtotime($new_obj->created)).'
                                    </p>
                                    <div data-et-view="aRDPNZJKSXe:2"></div>
                                    <div class="review_item_reviewer" style="text-align: center">
                                        <div>
                                            <img data-toggle="tooltip" data-placement="top" title="'.$row['name_cus'].'" style="display: initial;" class="avatar-mask ava-pad-bottom ava-default" src="'.$avatar.'" alt="">
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
                                                <p class="review_neg">
                                                    <a href=""><i class="review_item_icon review_item_icon_default fa fa-plus-square" ></i></a>
                                                    '.$new_obj->comment.'
                                                <b class="icon_review_list">';
                                                    if($new_obj->show_program){
                                                        $string.='<a data-toggle="tooltip" data-placement="left" title="Chương trình tour: '.$new_obj->program.'" href="javascript:void(0)"><i class="fa fa-plane "></i></a>';
                                                    }
                                                    if($new_obj->show_tour_guide_full){
                                                        $string.='<a data-toggle="tooltip" data-placement="left" title="Hướng dẫn viên suốt tuyến: '.$new_obj->tour_guide_full.'" href="javascript:void(0)"><i class="fa fa-users"></i></a>';
                                                    }
                                                    if($new_obj->show_tour_guide_local){
                                                        $string.='<a data-toggle="tooltip" data-placement="left" title="Hướng dẫn viên địa phương: '.$new_obj->tour_guide_local.'" href="javascript:void(0)"><i class="fa fa-user "></i></a>';
                                                    }
                                                    if($new_obj->show_hotel){
                                                        $string.='<a data-toggle="tooltip" data-placement="left" title="Khách sạn: '.$new_obj->hotel.'" href="javascript:void(0)"><i class="fa fa-building"></i></a>';
                                                    }
                                                    if($new_obj->show_restaurant){
                                                        $string.='<a data-toggle="tooltip" data-placement="left" title="Ăn uống: '.$new_obj->restaurant.'" href="javascript:void(0)"><i class="fa fa-cutlery  "></i></a>';
                                                    }
                                                    if($new_obj->show_transportation){
                                                        $string.='<a data-toggle="tooltip" data-placement="left" title="Vận chuyển: '.$new_obj->transportation.'" href="javascript:void(0)"><i class="fa fa-car  "></i></a>';
                                                    }
                                        $string.='</b>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>';
    }
    return $string;
}

function review_tour_sum($where, $filed='id')
{
    $result=mysqli_query(ConnectSql(),'select SUM('.$filed.') as sumPoint, COUNT(id) as countReview from review_tour '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
        $row=mysqli_fetch_array($result);
        return $row;
    }
    else return false;
}
function review_tour_count_statis($where)
{
    $result=mysqli_query(ConnectSql(),'select  COUNT(id) as countReview from review_tour '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
        $row=mysqli_fetch_array($result);
        return $row['countReview'];
    }
    else return false;
}