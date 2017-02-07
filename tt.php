<?php

/**
 * Class TT
 * lzw
 */
namespace TT;

defined('APP_PATH') or define('APP_PATH', dirname((__DIR__)));
defined('VENDOR_PATH') or define('VENDOR_PATH',(dirname(__DIR__)));

abstract class TT{

    private static $configs=[];
    private static $container=[];
    public static $classloader=[];

    /**
     * 配置文件
     * @param array $configs
     */
    public static function setConfigs($configs=[]){
        self::$configs=$configs;
    }

    public static function getConfig($name){
        return self::$configs[$name];
    }

    public static function getContainer($name){
        if(!$name)return self::$container;
        return self::$container[$name];
    }

    public static function getClassPath($class)
    {
        return self::$classloader->findFile($class);
    }

    /**
     * 初始化数据
     */
    public static function init(){
        $c=[
            'request'=>"\TT\web\Request",
            'view'=>"\TT\web\View",
        ];
        foreach($c as $k=>$v){
            self::$container[$k]=new $v();
        }
    }

    /**
     * 初始化类
     * @param $classname
     * @param string $param
     * @return mixed
     * @throws Exception
     */
    public static function createClass($classname,$param=""){
        if(is_string($classname)){
            return new $classname($param);
        }else{
            throw new Exception("class create error: {$classname}");
        }
    }
}
TT::$classloader=require (VENDOR_PATH."/vendor/autoload.php");