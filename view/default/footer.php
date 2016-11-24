<?php
require_once DIR . '/view/default/public.php';
function view_footer($data = array())
{
    $asign = array();
    $asign['email']=$data['config'][0]->Email;
    $asign['Logo']=$data['config'][0]->Logo;
    $asign['name']=$data['config'][0]->Name;
    $asign['Hotline']=$data['config'][0]->Hotline;
    $asign['address']=$data['config'][0]->Address;
    $asign['twitter'] = $data['mangxahoi'][0]->twitter;
    $asign['youtube'] = $data['mangxahoi'][0]->youtube;
    $asign['facebook'] = $data['mangxahoi'][0]->facebook;
    $asign['google'] = $data['mangxahoi'][0]->google;
    $asign['linkedin'] = $data['mangxahoi'][0]->linkedin;
    $asign['instagram'] = $data['mangxahoi'][0]->instagram;
    $asign['noibat_footer'] ="";
    if(count($data['noibat_footer'])>0)
    {

        $max=count($data['noibat_footer']);
        $ran=rand(0,$max-1);
        $link=link_newsdetail($data['noibat_footer'][$ran]);
        $asign['noibat_footer'] ='<div id="message-purchased" class="customized " style="display: none;"
     data-loop="0"
     data-initial_delay="5"
     data-notification_per_page="30"
     data-display_time="5"
     data-next_time="60">

    <img width="780" height="780" src="'.$data['noibat_footer'][$ran]->img.'" title="'.$data['noibat_footer'][$ran]->name.'"
         class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="'.$data['noibat_footer'][$ran]->name.'"
         srcset="'.$data['noibat_footer'][$ran]->img.' 780w, '.$data['noibat_footer'][$ran]->img.' 150w, '.$data['noibat_footer'][$ran]->img.' 768w, '.$data['noibat_footer'][$ran]->img.' 124w, '.$data['noibat_footer'][$ran]->img.' 370w, '.$data['noibat_footer'][$ran]->img.' 570w"
         sizes="(max-width: 780px) 100vw, 780px"/>
    <p>
        <a href="'.$link.'">'.$data['noibat_footer'][$ran]->name.'</a>
        </br>
        <span>'.number_format($data['noibat_footer'][$ran]->price,0,",",".").' vnđ</span> | <span><i class="fa fa-thumbs-up">  '.$data['noibat_footer'][$ran]->num_like.' </i></span>
    </p>
</div>';
    }
    print_template($asign, 'footer');
}
