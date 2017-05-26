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

/**
 * _GET['kid'] is Kategorie-ID
 */

if(defined('_Forum')) {
    $kategorie  = common::$sql['default']->fetch("SELECT s2.`id`,s1.`intern`,s1.`name` "
            . "FROM `{prefix_forumkats}` AS `s1` "
            . "LEFT JOIN `{prefix_forumsubkats}` AS `s2` "
            . "ON s2.`sid` = s1.`id` "
            . "WHERE s2.`id` = ?;",
        [$id=(int)($_GET['kid'])]);

    if($kategorie['intern'] == 1 && (!common::permission("intforum") && !common::forum_intern($kategorie['id']))) {
        $index = common::error(_error_no_access, 1);
    } else {
        //Filter
        $orderby = 'DESC'; $sortby = 's1.`global` '.$orderby.', s1.`sticky` '.$orderby.', s1.`lp` '.$orderby.', s1.`t_date` '.$orderby;
        if(isset($_POST['orderby']) || isset($_POST['sortby'])) {
            if(isset($_POST['orderby'])) {
                if(strtoupper($_POST['orderby']) == 'ASC')
                    $orderby = 'ASC';
                else
                    $orderby = 'DESC';

                $sortby = 's1.`global` DESC, s1.`sticky` DESC, s1.`lp` '.$orderby.', s1.`t_date` '.$orderby;
            }

            if(isset($_POST['sortby'])) {
                switch (strtolower($_POST['sortby'])) {
                    case 'autor':
                        $sortby = 's1.`global` DESC, s1.`sticky` DESC, s1.`t_reg` '.$orderby.', s1.`t_date` '.$orderby;
                        break;
                    case 'thread':
                        $sortby = 's1.`global` DESC, s1.`sticky` DESC, s1.`topic` '.$orderby.', s1.`t_date` '.$orderby;
                        break;
                    case 'posts':
                        $sortby = 's1.`global` DESC, s1.`sticky` DESC, s1.`posts` '.$orderby.', s1.`t_date` '.$orderby;
                        break;
                    case 'hits':
                        $sortby = 's1.`global` DESC, s1.`sticky` DESC, s1.`hits` '.$orderby.', s1.`t_date` '.$orderby;
                        break;
                }
            }
        }

        $sorts_options_sortby = '';
        $sorts = ['lp'=>_forum_lpost,'autor'=>_autor,'thread'=>_forum_thread,'posts'=>_replies,'hits'=>_hits];
        foreach ($sorts as $var => $text) {
            $sorts_options_sortby .= common::select_field($var,(isset($_POST['sortby']) && $var == strtolower($_POST['sortby'])),$text);
        }

        $sorts_options_orderby = '';
        $sorts = ['desc'=>_forum_sort_descending,'asc'=>_forum_sort_ascending];
        foreach ($sorts as $var => $text) {
            $sorts_options_orderby .= common::select_field($var,(isset($_POST['orderby']) && $var == strtolower($_POST['orderby'])),$text);
        }

        if(empty($_POST['suche'])) {
            $sortby = str_replace('s1.','',$sortby);
            $qry = common::$sql['default']->select("SELECT * FROM `{prefix_forumthreads}` "
                    . "WHERE `kid` = ? OR `global` = 1 "
                    . "ORDER BY ".$sortby." "
                    . "LIMIT ".(($page - 1)*settings::get('m_fthreads')).",".settings::get('m_fthreads').";",
                    array($id));
            
            $_SESSION['search_type'] = "";
            $entrys = common::$sql['default']->rowCount();
        } else {
            common::$gump->sanitize($_POST);
            $filters = array('suche' => 'trim|addslashes|sanitize_string');
            $qry = common::$sql['default']->select("SELECT s1.global,s1.topic,s1.subtopic,s1.t_text,s1.t_email,s1.hits,s1.t_reg,s1.t_date,s1.closed,s1.sticky,s1.id,s1.lp,s1.t_nick "
                    . "FROM `{prefix_forumthreads}` AS s1 "
                    . "WHERE s1.topic LIKE ? AND s1.kid = ? OR s1.subtopic LIKE ? AND s1.kid = ? OR s1.t_text LIKE ? AND s1.kid = ? "
                    . "ORDER BY ".$sortby." "
                    . "LIMIT ".($page - 1)*settings::get('m_fthreads').",".settings::get('m_fthreads').";",
                    array($search="%".common::$gump->filter($_POST, $filters)['suche']."%",$id,$search,$id,$search,$id));
            
            $_SESSION['search_type'] = "text";
            $entrys = common::$sql['default']->rowCount();
        }

        $threads = '';
        foreach($qry as $get) {
            $cntpage = common::cnt("{prefix_forumposts}", " WHERE sid = ".$get['id']);
            $pagenr = !$cntpage ? '1' : ceil($cntpage/settings::get('m_fposts'));
            $getlp = common::$sql['default']->fetch("SELECT `id`,`sid`,`kid`,`date`,`nick`,`reg`,`email` FROM `{prefix_forumposts}` WHERE `sid` = ? ORDER BY `date` DESC;", [$get['id']]);
            $is_lp = common::$sql['default']->rowCount();

            //Check Unreaded
            if($is_lp) {
                $iconpic = "icon_topic_latest.gif";
                if(common::$userid >= 1 && $_SESSION['lastvisit']) {
                    //Check in Posts
                    if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_forumposts}` "
                            . "WHERE `date` >= ? AND `reg` != ? AND `id` = ?;",
                            array($_SESSION['lastvisit'],common::$userid,$getlp['id']))) {
                        $iconpic = "icon_topic_newest.gif";
                    }
                }
            }

            $lpost = '-';
            if($is_lp) {
                $smarty->caching = false;
                $smarty->assign('nick',common::autor($getlp['reg'], '', $getlp['nick'], stringParser::decode($getlp['email'])));
                $smarty->assign('post_link','?action=showthread&kid='.$getlp['kid'].'&id='.$getlp['sid']);
                $smarty->assign('img',$iconpic);
                $smarty->assign('date',date("F j, Y, g:i a", $getlp['date']));
                $lpost = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_thread_lpost.tpl');
                $smarty->clearAllAssign();
            }

            $lpdate = common::$sql['default']->rowCount() ? $getlp['date'] : '';

            //Unreaded
            $frompic = $get['closed'] ? "read_locked" : "read";
            if(common::$userid >= 1 && $_SESSION['lastvisit']) {
                //Check new Threads
                if(common::$sql['default']->rows($test="SELECT `id` FROM `{prefix_forumthreads}` "
                        . "WHERE (`t_date` >= ? || `lp` >= ?) AND `t_reg` != ? AND `id` = ?;",
                        array($lastvisit=$_SESSION['lastvisit'],$lastvisit,common::$userid,$get['id']))) {
                    $frompic = $get['closed'] ? "unread_locked" : "unread";
                }

                //Check new Posts
                if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_forumposts}` "
                        . "WHERE `date` >= ? AND `reg` != ? AND `sid` = ?;",
                        array($_SESSION['lastvisit'],common::$userid,$get['id']))) {
                    $frompic = $get['closed'] ? "unread_locked" : "unread";
                }
            }
            
            $gets = common::$sql['default']->fetch("SELECT `id` FROM `{prefix_forumsubkats}` WHERE `id` = ?;", [$get['id']]);

            //List Threads
            $smarty->caching = false;
            $smarty->assign('new',common::check_new($get['lp']));
            $smarty->assign('kid',$kategorie['id']);
            $smarty->assign('id',$get['id']);
            $smarty->assign('frompic',$frompic);
            $smarty->assign('hl',(!empty($_POST['suche']) ? '&amp;hl='.$_POST['suche'] : ''));
            $smarty->assign('sticky',$get['sticky']);
            $smarty->assign('global',$get['global']);
            $smarty->assign('topic',stringParser::decode($get['topic']));
            $smarty->assign('subtopic',stringParser::decode(common::cut($get['subtopic'],settings::get('l_forumsubtopic'))));
            $smarty->assign('hits',$get['hits']);
            $smarty->assign('replys',common::cnt("{prefix_forumposts}", " WHERE sid = '".$get['id']."'"));
            $smarty->assign('lpost',$lpost);
            $smarty->assign('autor',common::autor($get['t_reg'], '', $get['t_nick'], $get['t_email']));
            $threads .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_show_threads.tpl');
            $smarty->clearAllAssign();
        }

        $smarty->caching = false;
        $smarty->assign('id',$id);
        $smarty->assign('kid',$kategorie['id']);
        $smarty->assign('suchwort',isset($_POST['suche']) ? $_POST['suche'] : '');
        $search = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_skat_search.tpl');
        $smarty->clearAllAssign();

        $nav = common::nav($entrys,settings::get('m_fthreads'),"?action=show&amp;kid=".$kategorie['id']);

        $smarty->caching = false;
        $smarty->assign('nav',$nav);
        $smarty->assign('threads',$threads);
        $smarty->assign('kid',$kategorie['id']);
        $smarty->assign('sorts_options_sortby',$sorts_options_sortby);
        $smarty->assign('sorts_options_orderby',$sorts_options_orderby);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_show_thread.tpl');
        $smarty->clearAllAssign();

        $kat = common::$sql['default']->fetch("SELECT s1.`kattopic`,s2.`name` "
                         . "FROM `{prefix_forumsubkats}` AS `s1` "
                         . "LEFT JOIN `{prefix_forumkats}` AS `s2` "
                         . "ON s1.`sid` = s2.`id` "
                         . "WHERE s1.`id` = ?;",array($id));

        //Breadcrumbs
        $smarty->caching = false;
        $smarty->assign('wherepost','');
        $smarty->assign('wherekat',stringParser::decode($kat['kattopic']));
        $smarty->assign('mainkat',stringParser::decode($kategorie['name']));
        $smarty->assign('tid',0);
        $smarty->assign('kid',$kategorie['id']);
        $wheres = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_subkat_where.tpl');
        $smarty->clearAllAssign();

        /* Wer ist online */
        $qry = common::$sql['default']->select('SELECT `position`,`color` FROM `{prefix_positions}`;'); $team_groups = '';
        foreach($qry as $get) {
            $smarty->caching = false;
            $smarty->assign('color',stringParser::decode($get['color']));
            $smarty->assign('group',stringParser::decode($get['position']));
            $team_groups .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_team_groups.tpl');
            $smarty->clearAllAssign();
        }

        common::update_online($where); //Update Where is online
        $qryo = common::$sql['default']->select("SELECT `id` FROM `{prefix_users}` WHERE `whereami` LIKE ? AND (time+1800) > ".time().";", ["%".$where."%"]);
        if(common::$sql['default']->rowCount()) {
            $i=0; $check = 1; $nick = '';
            $cnto = common::cnt('{prefix_users}', " WHERE (time+1800) > ".time()." AND `whereami` LIKE ?;",'id', ["%".$where."%"]);
            foreach($qryo as $geto) {
                if($i == 5) {
                    $end = "<br />";
                    $i=0;
                }  else  {
                    $end = ($cnto == $check ? "" : ", ");
                }

                $nick .= common::autorcolerd($geto['id']).$end;
                $i++; $check++;
            } //end while
        } else {
            $nick = _forum_nobody_is_online;
        }

        //Stats
        $counter_users = common::online_reg($where,true);
        $counter_gast = common::online_guests($where,true);

        $total_users=($counter_users+$counter_gast);
        $smarty->caching = false;
        $smarty->assign('users',$total_users);
        $smarty->assign('counter_gast',$counter_gast);
        $smarty->assign('regs',$counter_users);
        $smarty->assign('counter_users',$counter_users);
        $smarty->assign('gast',$counter_gast);
        $smarty->assign('total_users',$total_users);
        $smarty->assign('timer',(1800/60/60));
        $forum_user_stats = $smarty->fetch('string:'._forum_online_info0);
        $smarty->clearAllAssign();

        $smarty->caching = false;
        $smarty->assign('nick',$nick);
        $smarty->assign('forum_online_info0',$forum_user_stats);
        $smarty->assign('groups',$team_groups);
        $online = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/online.tpl');
        $smarty->clearAllAssign();

        /* Index */
        $smarty->caching = false;
        $smarty->assign('where',$wheres);
        $smarty->assign('title',stringParser::decode($kat['kattopic']));
        $smarty->assign('mainkat',stringParser::decode($kat['name']));
        $smarty->assign('show',$show);
        $smarty->assign('online',$online);
        $smarty->assign('search',$search);
        $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_show.tpl');
        $smarty->clearAllAssign();
    }
}