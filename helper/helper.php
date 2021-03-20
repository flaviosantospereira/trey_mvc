<?php

function pre($e, $exit = false)
{
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
    if ($exit){
        exit;
    };
}