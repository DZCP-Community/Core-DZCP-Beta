<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 12.05.2016
 * Time: 23:11
 */

//{lang msgID="language_german"}

function smarty_function_lang($params, &$smarty) {
    $params['msgID']='_'.$params['msgID'];
    if(!defined($params['msgID'])) {
        return 'MsgID: "'.$params['msgID'].'"" is not exists!';
    }

    return constant($params['msgID']);
}