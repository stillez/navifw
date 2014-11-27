<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..', // thu muc goc
    'ds' => DIRECTORY_SEPARATOR,
    'resourceFolder' => 'public', // ->/public/js or css or images..
    'sourceLanguage' => 'vi', // cau hinh ngon ngu su dung
    'defaultModule' => 'Default',
    'defaultController' => 'Index',
    'defaultAction' => 'index',
    'defaultTemplate' => 'default',
    'db' => array(
        'connectionString' => 'mysql:host=localhost;dbname=navifw;charset=utf8',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => '',
        'charset' => 'uft8',
    ), // thong so ket noi db
     'routers' => array(
        'tin-tuc' => 'news',
        'about' => 'index/about',
    ), //cau hinh mot so duong dan
    'recourdPerPage' => 20,
    'mail' => array(
        'Host' => 'smtp.gmail.com',
        'Port' => 465,
        'SMTPDebug' => 2,
        'Debugoutput' => 'html',
        'SMTPSecure' => 'ssl',
        'SMTPAuth' => true,
        'Username' => 'gmail_cua_ban@gmail.com',
        'Password' => 'pass_word_ung_dung'
    )
);
