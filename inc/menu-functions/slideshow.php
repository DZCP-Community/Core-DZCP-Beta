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

function slideshow() {
    $qry = common::$sql['default']->select("SELECT `id`,`desc`,`showbez`,`bez`,`url`,`target` FROM `{prefix_slideshow}` ORDER BY `pos` ASC LIMIT 4;");
    if(common::$sql['default']->rowCount()) {
        $pic = ''; $tabs = '';
        foreach($qry as $get) {
            if(empty($get['desc']) && !$get['showbez'])
                $slideroverlay = '';
            else if(!empty($get['desc']) && !$get['showbez'])
                $slideroverlay = '<div class="slideroverlay"><span>'.bbcode::parse_html(common::wrap(stringParser::decode($get['desc']))).'</span></div>';
            else
                $slideroverlay = '<div class="slideroverlay"><h2>'.bbcode::parse_html(common::wrap(stringParser::decode($get['bez']))).'</h2><span>'.bbcode::parse_html(common::wrap(stringParser::decode($get['desc']))).'</span></div>';

            $image = '';
            foreach(array("jpg", "gif", "png") as $endung) {
                if(file_exists(basePath."/inc/images/slideshow/".$get['id'].".".$endung)) {
                    $image = "../inc/images/slideshow/".$get['id'].".".$endung;
                    break;
                }
            }

            $pic .= show("menu/slideshowbild", array("image" => "<img src=\"".$image."\" alt=\"\" />",
                                                     "link" => "'".$get['url']."'",
                                                     "bez" => common::cut(stringParser::decode($get['bez']),32),
                                                     "text" => $slideroverlay,
                                                     "target" => $get['target']));

            $tabs .= '<a href="#" class="slidertabs" id="slider'.$get['id'].'"></a>';
        }

        return show("menu/slideshow", array("pic" => $pic, "tabs" => $tabs));
    }

    return '';
}