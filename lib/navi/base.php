<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base
 *
 * @author JanThanh
 */
class NaviBase {

    //put your code here
    public static $module;
    public static $controller;
    public static $action;
    public static $param;
    public static $config;
    public static $baseUrl;
    public static $resourceUrl;

    public function __construct($_config) {
        NaviBase::$config = $_config;
        NaviBase::$baseUrl = $this->getBaseUrl();
        NaviBase::$resourceUrl = NaviBase::$baseUrl . '/' . NaviBase::$config['resourceFolder'];
        spl_autoload_register('self::autoLoad');
    }

    private function getBaseUrl() {
        $currentPath = $_SERVER['PHP_SELF'];
        $pathInfo = pathinfo($currentPath);
        $hostName = $_SERVER['HTTP_HOST'];
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';
        return $protocol . $hostName . ($pathInfo['dirname'] != '/' ? $pathInfo['dirname'] : '');
    }

    public function autoLoad($class) {
        $file = strtolower(str_replace('_', NaviBase::$config['ds'], $class) . '.php');
        if (file_exists('application' . NaviBase::$config['ds'] . $file)) {
            include_once 'application' . NaviBase::$config['ds'] . $file;
        } else if (file_exists('lib' . NaviBase::$config['ds'] . $file)) {
            include_once 'lib' . NaviBase::$config['ds'] . $file;
        } else if (file_exists('model' . NaviBase::$config['ds'] . $file)) {
            include_once 'model' . NaviBase::$config['ds'] . $file;
        } else if (file_exists($file)) {
            require_once "$file";
            
        }
    }

    public function run() {
        $module = NaviBase::$config['defaultModule'];
        $controller = NaviBase::$config['defaultController'];
        $action = NaviBase::$config['defaultAction'];
        $param = array();


        if (isset($_GET['router'])) {
            $routers = strtolower(rtrim($_GET['router'], '/\\'));
            unset($_GET['router']);
            foreach (NaviBase::$config['routers'] as $key => $value) {

                $key = str_replace('/', '\/', $key);

                if (preg_match('/^' . $key . '/', $routers, $match)) {
                    $routers = str_replace($match[0], $value, $routers);
                    break;
                }

                if ($routers == $value) {
                    $routers = 'index/error';
                    $param['code'] = '404';
                    $param['message'] = 'Request not found!';
                    break;
                }
            }

            $routers = explode('/', $routers);

            if ($routers[0] != '' && is_dir('application' . NaviBase::$config['ds'] . str_replace('-', '', $routers[0]))) {
                $module = str_replace('-', '', $routers[0]);
                array_shift($routers);
            }

            if (isset($routers[0])) {
                $filepath = 'application' . NaviBase::$config['ds'] . strtolower($module) . NaviBase::$config['ds'] . 'controller' . NaviBase::$config['ds'] . str_replace('-', '', $routers[0]) . '.php';
                if (file_exists($filepath)) {
                    $controller = str_replace('-', '', $routers[0]);
                    array_shift($routers);
                }
            }

            if (isset($routers[0])) {
                $class = ucfirst($module) . '_Controller_' . ucfirst($controller);
                if (method_exists($class, str_replace('-', '', $routers[0])) || $routers[0] == 'error') {
                    $action = str_replace('-', '', $routers[0]);
                    array_shift($routers);
                }
            }
            if (isset($routers[0])) {
                $param = $routers;
            }
        }


        NaviBase::$module = $module;
        NaviBase::$controller = $controller;
        NaviBase::$action = $action;
        NaviBase::$param = $param;

        if ($module != NaviBase::$config['defaultModule']) {
            NaviBase::$baseUrl .= '/' . $module;
        }

        $class = ucfirst($module) . '_Controller_' . ucfirst($controller);

        $controller = new $class();

        if (method_exists($controller, 'init')) {
            $controller->init();
        }
        
        $controller->$action($param);
    }

    public static function app($_config) {
        return new self($_config);
    }

}
