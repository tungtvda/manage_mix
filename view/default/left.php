<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 8/15/14
 * Time: 3:43 PM
 */
require_once DIR.'/view/default/public.php';
function view_left($data=array())
{
    $asign=array();
    $asign['danhmuc_left'] ="";
    if(count($data['danhmuc_left'])>0)
    {
       foreach($data['danhmuc_left'] as $row){
           $asign['danhmuc_left'] .=' <aside id="woocommerce_product_categories-2"
           class="widget woocommerce widget_product_categories">';
           $data_dm_2=danhmuc2_getByTop('','danhmuc_id='.$row->id,'position asc');
           if(count($data_dm_2)>0)
           {
               $asign['danhmuc_left'] .='<h3 class="widget-title">'.$row->name.'</h3>
                <ul class="product-categories">';
               foreach($data_dm_2 as $row_dm_2)
               {
                   $count_sp=sanpham_count('danhmuc2_id='.$row_dm_2->id);
                   $asign['danhmuc_left'] .='<li class="cat-item cat-item-39"><a class="item_left" href="'.link_sanpham($row_dm_2).'">'.$row_dm_2->name.'</a>
                <span class="count">('.$count_sp.')</span></li>';
               }

           $asign['danhmuc_left'] .=' </ul>';
           }

    $asign['danhmuc_left'] .='</aside>';
       }
    }

    $asign['noibat_left'] ="";
    if(count($data['noibat_left'])>0)
    {
        $asign['noibat_left'] = print_item('thucdon_left', $data['noibat_left']);
    }
    print_template($asign,'left');
}
