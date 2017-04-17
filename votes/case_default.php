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

if(defined('_Votes')) {
    $whereIntern = ' AND `intern` = 0';
    if(common::permission('votes')) {
        $whereIntern = '';
    }

    $fvote = '';
    if(!settings::get('forum_vote'))
        $fvote = empty($whereIntern) ? ' AND `forum` = 0' : ' AND `forum` = 0';

    $qry = common::$sql['default']->select('SELECT votes.*,sum(votes_result.`stimmen`) as `ges_stimmen` FROM `{prefix_votes}` as votes, `{prefix_vote_results}` as `votes_result`'
            . ' WHERE votes.`id` = votes_result.`vid` '.$whereIntern.$fvote.''
            . ' GROUP by votes.`id` '.common::orderby_sql(['titel','datum','von','ges_stimmen'], 'ORDER BY `datum`;'));
    foreach($qry as $get) {
        $qryv = common::$sql['default']->select('SELECT * FROM `{prefix_vote_results}` '
                           . 'WHERE `vid` = '.$get['id'].' ORDER BY `id`;');

        $check = ''; $ipcheck = false; $intern = '';
        $stimmen = $get['ges_stimmen'];
        $vid = 'vid_'.$get['id'];
        if($get['intern']) {
            $showVoted = '';
            $intern = _votes_intern;
        }

        $results = ''; $color2 = 0;
        $ipcheck = !common::count_clicks('vote',$get['id'],0,false);
        foreach($qryv as $getv) {
            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            if($ipcheck || cookie::get('vid_'.$get['id']) != false || $get['closed']) {
                $percent = @round($getv['stimmen']/$stimmen*100,2);
                $rawpercent = @round($getv['stimmen']/$stimmen*100,0);
                $balken = show(_votes_balken, ["width" => $rawpercent]);
                $result_head = _votes_results_head;
                $votebutton = "";
                $results .= show($dir."/votes_results", ["answer" => stringParser::decode($getv['sel']),
                                                              "percent" => $percent,
                                                              "class" => $class,
                                                              "stimmen" => $getv['stimmen'],
                                                              "balken" => $balken]);
            } else {
                $result_head = _votes_results_head_vote;
                $votebutton = '<input id="voteSubmit_'.$get['id'].'" type="submit" value="'._button_value_vote.'" class="submit" />';
                $results .= show($dir."/votes_vote", ["id" => $getv['id'],
                                                           "answer" => stringParser::decode($getv['sel']),
                                                           "class" => $class]);
            }
        }

        $showVoted = '';
        if($get['intern'] && $stimmen != 0 && ($get['von'] == common::$userid || common::permission('votes'))) {
            $showVoted = ' <a href="?action=showvote&amp;id='.$get['id'].'"><img src="../inc/images/lupe.gif" alt="" title="'.
            _show_who_voted.'" class="icon" /></a>';
        }

        if(isset($_GET['show']) && $_GET['show'] == $get['id']) {
            $moreicon = "collapse";
            $display = "";
        } else {
            $moreicon = "expand";
            $display = "none";
        }

        $ftitel = $get['forum'] ? stringParser::decode($get['titel']).' (Forum)' : stringParser::decode($get['titel']);
        $titel = show(_votes_titel, ["titel" => $ftitel,
                                          "vid" => $get['id'],
                                          "icon" => $moreicon,
                                          "intern" => $intern]);

        $closed = $get['closed'] ? _closedicon_votes : '';
        $class = ($color2 % 2) ? "contentMainSecond" : "contentMainFirst"; $color2++;
        $show .= show($dir."/votes_show", ["datum" => date("d.m.Y", $get['datum']),
                                                "titel" => $titel,
                                                "vid" => $get['id'],
                                                "display" => $display,
                                                "result_head" => $result_head,
                                                "results" => $results,
                                                "show" => $showVoted,
                                                "closed" => $closed,
                                                "autor" => common::autor($get['von']),
                                                "class" => $class,
                                                "votebutton" => $votebutton,
                                                "stimmen" => $stimmen]);
    }

    if(empty($show)) {
        $show = show(_no_entrys_yet, ["colspan" => "4"]);
    }
    
    $index = show($dir."/votes", ["show" => $show,
                                       "order_titel" => common::orderby('titel'),
                                       "order_autor" => common::orderby('von'),
                                       "order_datum" => common::orderby('datum'),
                                       "order_stimmen" => common::orderby('ges_stimmen')]);
}