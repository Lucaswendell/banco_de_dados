<?php
function url($param = null){
    $url = SITE['url'];
    if(isset($param)){
        $url = $url."/".$param; 
    }
    return $url;
}

function dd($var){
    var_dump($var);
    die();
}