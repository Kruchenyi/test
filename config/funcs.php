<?php


function dump($data)
{
    echo '<pre>';
    var_dump($data);
    '</pre>';
}
function dd($data)
{
    dump($data);
    die;
}

function printR($data)
{
    echo '<pre>';
    print_r($data);
    '</pre>';
}

function load($data)
{
    $dataArray = [];

    foreach ($_POST as $key => $value) {
        if (in_array($key, $data)) {
            $dataArray[$key] = h($value);
        }
    }
    return $dataArray;
}
function h($data)
{
    return htmlspecialchars($data, ENT_QUOTES);
}

function old($data)
{
    foreach ($_POST as $key => $value) {
        if ($key == $data) {
            return $value;
        }
    }
}

function getCountry($data){
    
}