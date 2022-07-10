<?php 
function _nice_date($date='')
{
    if(!empty($date)):
        return date('d M Y', strtotime($date));
    endif;
}