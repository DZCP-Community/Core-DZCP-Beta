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

function fvote($id, $ajax=false) {
    $get = common::$sql['default']->fetch("SELECT `id`,`closed`,`titel` FROM `{prefix_votes}` WHERE `id` = ? ".(common::permission("votes") ? ";" : " AND `intern` = 0;"), [(int)($id)]);
    if(common::$sql['default']->rowCount()) {
        $results = ''; $votebutton = '';
        $qryv = common::$sql['default']->select("SELECT `id`,`stimmen`,`sel` FROM `{prefix_vote_results}` WHERE `vid` = ? ORDER BY `id` ASC;", [$get['id']]);
        if(common::$sql['default']->rowCount()) {
            foreach($qryv as $getv) {
                $stimmen = common::sum('{prefix_vote_results}', " WHERE `vid` = ?", "stimmen", [$get['id']]);
                if($stimmen != 0) {
                    if(common::ipcheck("vid_".$get['id']) || cookie::get('vid_'.$get['id']) != false || $get['closed']) {
                        $percent = round($getv['stimmen']/$stimmen*100,1);
                        $rawpercent = round($getv['stimmen']/$stimmen*100,0);
                        $balken = show(_votes_balken, ["width" => $rawpercent]);

                        $votebutton = "";
                        $results .= show("forum/vote_results", ["answer" => stringParser::decode($getv['sel']),
                                                                     "percent" => $percent,
                                                                     "stimmen" => $getv['stimmen'],
                                                                     "balken" => $balken]);
                    } else {
                        $votebutton = '<input id="contentSubmitFVote" type="submit" value="'._button_value_vote.'" class="voteSubmit" />';
                        $results .= show("forum/vote_vote", ["id" => $getv['id'], "answer" => stringParser::decode($getv['sel'])]);
                    }
                } else {
                    $votebutton = '<input id="contentSubmitFVote" type="submit" value="'._button_value_vote.'" class="voteSubmit" />';
                    $results .= show("forum/vote_vote", ["id" => $getv['id'], "answer" => stringParser::decode($getv['sel'])]);
                }
            }
        }

        $getf = common::$sql['default']->fetch("SELECT `id`,`kid` FROM `{prefix_forumthreads}` WHERE `vote` = ?;", [$get['id']]);
        $vote = show("forum/vote", ["titel" => stringParser::decode($get['titel']),
                                         "vid" => $get['id'],
                                         "fid" => $getf['id'],
                                         "kid" => $getf['kid'],
                                         "results" => $results,
                                         "votebutton" => $votebutton,
                                         "stimmen" => $stimmen]);
    }

    return empty($vote) ? '<div style="margin:2px 0;text-align:center;">'._no_entrys.'</div>' : ($ajax ? $vote : '<div id="navFVote">'.$vote.'</div>');
}