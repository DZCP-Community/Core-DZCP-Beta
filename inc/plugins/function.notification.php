<?php
//{notification index="global"}

function smarty_function_notification($params, &$smarty) {
    return notification::get($params['index']);
}