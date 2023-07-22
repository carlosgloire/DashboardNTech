<?php
function generatetoken($length)
{
    $alphanumeric='abcdefghijklmnopqrstuwvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    return substr(str_shuffle(str_repeat($alphanumeric,$length)),0,$length);
}

?>