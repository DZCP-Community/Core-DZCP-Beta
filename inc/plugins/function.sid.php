<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 12.05.2016
 * Time: 23:11
 */
function smarty_function_sid($params, &$smarty) {
    return common::$sid;
}