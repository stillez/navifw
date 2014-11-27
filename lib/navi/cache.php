<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cache
 *
 * @author JanThanh
 */
class Navi_Cache {

    public static function wirteObj($name, $obj) {
        file_put_contents('caches/objects/' . $name, gzcompress(serialize($obj)));
    }

    public static function readObj($name, $time = null) {
        if (file_exists('caches/objects/' . $name) && ($time == null || time() - filemtime('caches/objects/' . $name) < $time)) {
            return (unserialize(gzuncompress(file_get_contents('caches/objects/' . $name))));
        } else {
            return null;
        }
    }

}
