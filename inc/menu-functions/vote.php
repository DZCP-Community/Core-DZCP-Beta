<?php
/**
 * DZCP - deV!L`z ClanPortal - Mainpage ( dzcp.de )
 * deV!L`z Clanportal ist ein Produkt von CodeKing,
 * geändert dürch my-STARMEDIA und Codedesigns.
 *
 * Diese Datei ist ein Bestandteil von dzcp.de
 * Diese Version wurde speziell von Lucas Brucksch (Codedesigns) für dzcp.de entworfen bzw. verändert.
 * Eine Weitergabe dieser Datei außerhalb von dzcp.de ist nicht gestattet.
 * Sie darf nur für die Private Nutzung (nicht kommerzielle Nutzung) verwendet werden.
 *
 * Homepage: http://www.dzcp.de
 * E-Mail: info@web-customs.com
 * E-Mail: lbrucksch@codedesigns.de
 * Copyright 2017 © CodeKing, my-STARMEDIA, Codedesigns
 */

function vote($ajax = false) {
    $get = common::$sql['default']->fetch("SELECT `id`,`closed`,`titel`,`intern` FROM `{prefix_votes}` WHERE `menu` = 1 AND `forum` = 0;"); $vote = '';
    if(common::$sql['default']->rowCount()) {
        if(!$get['intern'] || common::$chkMe >= 1) {
            $qryv = common::$sql['default']->select("SELECT `id`,`stimmen`,`sel` FROM `{prefix_vote_results}` WHERE `vid` = ? ORDER BY `what`;", [$get['id']]);
            $results = '';
            foreach($qryv as $getv) {
                $ipcheck = !common::count_clicks('vote',$get['id'],0,false);
                $stimmen = common::sum("{prefix_vote_results}", " WHERE `vid` = '".$get['id']."'", "stimmen", [$get['id']]);
                if($stimmen != 0) {
                    if($ipcheck || cookie::get('vid_'.$get['id']) != false || $get['closed']) {
                        $percent = round($getv['stimmen']/$stimmen*100,1);
                        $rawpercent = round($getv['stimmen']/$stimmen*100,0);
                        $balken = show(_votes_balken, ["width" => $rawpercent]);

                        $votebutton = "";
                        $results .= show("menu/vote_results", ["answer" => stringParser::decode($getv['sel']),
                                                                    "percent" => $percent,
                                                                    "stimmen" => $getv['stimmen'],
                                                                    "balken" => $balken]);
                    } else {
                        $votebutton = '<input id="contentSubmitVote" type="submit" value="'._button_value_vote.'" class="voteSubmit" />';
                        $results .= show("menu/vote_vote", ["id" => $getv['id'], "answer" => stringParser::decode($getv['sel'])]);
                    }
                } else {
                    $votebutton = '<input id="contentSubmitVote" type="submit" value="'._button_value_vote.'" class="voteSubmit" />';
                    $results .= show("menu/vote_vote", ["id" => $getv['id'], "answer" => stringParser::decode($getv['sel'])]);
                }
            }

            $vote = show("menu/vote", ["titel" => stringParser::decode($get['titel']),
                                            "vid" => $get['id'],
                                            "results" => $results,
                                            "votebutton" => $votebutton,
                                            "stimmen" => $stimmen]);
        }
    }

    return empty($vote) ? '<div style="margin:2px 0;text-align:center;">'._vote_menu_no_vote.'</div>' : ($ajax ? $vote : '<div id="navVote">'.$vote.'</div>');
}