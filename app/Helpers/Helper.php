<?php

function NumberFormat($number)
{
    return number_format($number, 0, ',','.');
}

function DateFormat($date, $format = "D-M-Y || H:m:s")
{
    return \Carbon\Carbon::parse($date)->isoFormat($format);
}

?>