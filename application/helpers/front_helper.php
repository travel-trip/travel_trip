<?php

function getHeaderLink($page = null){
    
    $resultArray = array();
    $CI = & get_instance();
    $CI->config->load('global');
    switch ($page) {
        case 'home':
            $link_array = $CI->config->item('home_links');
           
            break;
        case 'country':
            break;
        case 'tour':
            break;

        default:
            break;
    }
}