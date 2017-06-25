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

if(defined('_News')) {
    //-> Klapptext
    $klapp = '';
    if ($_POST['klapptitel']) {
        $smarty->caching = false;
        $smarty->assign('klapplink', $_POST['klapptitel']);
        $smarty->assign('which', 'collapse');
        $smarty->assign('id', '_prev');
        $klapp = $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/news_klapplink.tpl');
        $smarty->clearAllAssign();
    }

    $links1 = '';
    if(!empty($_POST['url1'])) {
        $smarty->caching = false;
        $smarty->assign('link',$_POST['link1']);
        $smarty->assign('url',common::links($_POST['url1']));
        $smarty->assign('target',"_blank");
        $links1 = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_link.tpl');
        $smarty->clearAllAssign();
    }

    $links2 = '';
    if(!empty($_POST['url2'])) {
        $smarty->caching = false;
        $smarty->assign('link',$_POST['link2']);
        $smarty->assign('url',common::links($_POST['url2']));
        $smarty->assign('target',"_blank");
        $links2 = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_link.tpl');
        $smarty->clearAllAssign();
    }

    $links3 = '';
    if(!empty($_POST['url3'])) {
        $smarty->caching = false;
        $smarty->assign('link',$_POST['link3']);
        $smarty->assign('url',common::links($_POST['url3']));
        $smarty->assign('target',"_blank");
        $links3 = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_link.tpl');
        $smarty->clearAllAssign();
    }

    $links = '';
    if (!empty($links1) || !empty($links2) || !empty($links3)) {
        $smarty->caching = false;
        $smarty->assign('link1',$links1);
        $smarty->assign('link2',$links2);
        $smarty->assign('link3',$links3);
        $links = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_links.tpl');
        $smarty->clearAllAssign();
    }

    $intern = ''; $sticky = '';
    if(isset($_POST['intern']) && $_POST['intern'] == 1) {
        $intern = _votes_intern;
    }
    
    if (isset($_POST['sticky']) && $_POST['sticky'] == 1) {
        $sticky = _news_sticky;
    }

    //empty news kat image
    foreach(common::SUPPORTED_PICTURE as $end) {
        if (file_exists(basePath . "/inc/images/nopic." . $end)) {
            $newsimage = '../inc/images/nopic.' . $end;
            break;
        }
    }
    
    $katimg = common::$sql['default']->fetch("SELECT `katimg` FROM `{prefix_newskat}` WHERE `id` = ?;", [(int)($_POST['kat'])],'katimg');
    if(!empty($katimg) && common::$sql['default']->rowCount() && file_exists(basePath.'/inc/images/uploads/newskat/'.stringParser::decode($katimg))) {
        $newsimage = '../inc/images/uploads/newskat/'.stringParser::decode($katimg);
    }

    //Test
    $input = <<< EOI
    
    Ein Test,
Texte ganz viele...

Test 123456
    
[url=http://fdgdfgf.de/fff]gff[/url]
    
[video height=400 width=600 autoplay=0]http://hammermaps.de/videoplayback.mp4[/video]    
    
[divx]http://hammermaps.de/videoplayback.mp4[/divx]

[divx height=200 width=300]http://hammermaps.de/videoplayback.mp4[/divx]
    
[divx autoplay=1]http://hammermaps.de/videoplayback.mp4[/divx]

[vimeo height=200 width=300]192417650[/vimeo]

[golem]19024[/golem]

[golem height=200 width=300]19024[/golem]

[golem autoplay=0]19024[/golem]
    
From [url=http://www.ushistory.org/Declaration/document/index.htm]ushistory.org[/url]:

[center][b][size=5]In CONGRESS, July 4, 1776[/size]
The unanimous Declaration of the thirteen united States of America[/b][/center]

[b][size=6]W[/size][/b]hen in the Course of human events it becomes necessary for one people to dissolve the political bands which have connected them with another and to assume among the powers of the earth, the separate and equal station to which the Laws of Nature and of Nature's God entitle them, a decent respect to the opinions of mankind requires that they should declare the causes which impel them to the separation.

[right][color=green][i]--- written by Thomas Jefferson[/i][/color][/right]

[border color=red size=3]This text is in a medium red border![/border]
[border size=10]This text is in a fat blue border![/border]
[border color=green]This text is in a normal green border![/border]

[quote]Test[/quote]


[code]if(\$xxxx) { echo "test"; }[/code]

[Youtube height=200 width=300]mUcDzTGBEFM[/youtube]

[Youtube]mUcDzTGBEFM[/youtube]

[u]Underline a misspelled word[/u]

[s]dddddddddddddddd[/s]

[hide]show this on level 1[/hide]

[hide level=2]show this on level 2[/hide]

[hide level=3]show this on level 3[/hide]

[hide level=4]show this on level 4[/hide]


EOI;

    //Smileys Test
   // $test = bbcode_base::getInstance();
 //   foreach ($test->GetSmileys() as $tag => $Smiley) {
      //  echo bbcode_base::parse_html((string)$input).'<p>';
 //   }
//    die();

    //-> News Preview
    $smarty->caching = false;
    $smarty->assign('titel',stringParser::decode($_POST['titel']));
    $smarty->assign('kat',$newsimage);
    $smarty->assign('id',1);
    $smarty->assign('comments',_news_comments_prev);
    $smarty->assign('showmore','');
    $smarty->assign('dp','compact');
    $smarty->assign('notification_page','');
    $smarty->assign('sticky',$sticky);
    $smarty->assign('intern',$intern);
    $smarty->assign('more',bbcode_base::parse_html((string)$_POST['morenews']));
    $smarty->assign('text',bbcode_base::parse_html((string)$_POST['newstext']));
    $smarty->assign('datum',date("j.m.y H:i", time()));
    $smarty->assign('links',$links);
    $smarty->assign('autor',common::autor());
    $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_show_full.tpl');
    $smarty->clearAllAssign();

    common::update_user_status_preview();
    header('Content-Type: text/html; charset=utf-8');
    exit(utf8_encode('<table class="mainContent" cellspacing="1">'.$index.'</table>'));
}