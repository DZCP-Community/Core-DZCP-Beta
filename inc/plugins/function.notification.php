<?php
//{notification index="global"}

function smarty_function_notification($params, &$smarty) {
    if(array_key_exists($params['index'],notification::$notification_index))
        return notification::get($params['index']);

    return "";
}