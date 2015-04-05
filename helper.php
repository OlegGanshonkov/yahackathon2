<?php

function encode($var)
{
    $var = trim($var);
    $var = strip_tags($var);
    $var = mysql_escape_string($var);
    return $var;
}
