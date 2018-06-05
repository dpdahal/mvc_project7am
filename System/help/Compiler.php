<?php

function pr($data=array()){
    echo "<pre>";
    print_r($data);
    echo "</pre>";

}

function dd($data=array()){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}