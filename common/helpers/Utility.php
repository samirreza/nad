<?php
namespace nad\common\helpers;

class Utility
{
    public static function IsNullOrEmpty($prop){
        return (!isset($prop) || (is_string($prop) && trim($prop) === '') || empty($prop));
    }
}
