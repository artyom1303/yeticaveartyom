<?php

function price_format ($number)
{
    $number = ceil($number);
    if($number<1000)
    {
        $result = $number;
    }
    else
    {
        $result = number_format($number,0,","," ");
    }
    return $result.'<b class="rub">p</b>';
}

function timer()
{
    $now = new DateTime('now');
    $tomorrow_midnight = new DateTime('tomorrow midnight');
    $interval = $now->diff($tomorrow_midnight);
    return $interval->format('%h:%i');
}

function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';
    if (!file_exists($name)) {
    return $result;
    }
    ob_start();
    extract($data);
    require($name);
    $result = ob_get_clean();
    return $result;
}

?>
