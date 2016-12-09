<?php
require_once DIR . '/view/default/public.php';
function view_script_table($data = array())
{
    $count=$data['count'];
    require_once DIR . '/view/default/template/script_table.php';
}
