<?php
namespace TT\web;
class ErrorHandler{
    /**
     * 注册错误处理
     */
    public function register(){
        error_reporting(0);
        ini_set("display_errors",false);
        set_exception_handler([$this,"exceptionHandler"]);
        set_error_handler([$this,"errorHandler"]);
    }

    public function errorHandler($code, $message, $file, $line){
        if (error_reporting() & $code) {
            $exception = new \ErrorException($message, $code, $code, $file, $line);
            throw $exception;
        }else{
            return false;
        }
    }

    public function exceptionHandler($exception){
        restore_error_handler();
        restore_exception_handler();
        if(PHP_SAPI!="cli"){
            http_send_status(500);
        }
        $this->logError($exception);
        exit(1);
    }

    public function logError($error){
        $env=\TT\TT::getConfig("env");
        if($env=="prod"){
            Log::writeLog("",$error);
        }
    }
}