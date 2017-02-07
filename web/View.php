<?php
namespace TT\web;
class View{

    private $tpl="";

    private $content="";

    /**
     * 设置模板
     * @param $tpl
     */
    public function setTpl($tpl){
        $this->tpl=$tpl;
    }

    /**
     * 获取模板
     * @return string
     */
    public function getTpl(){
        return $this->tpl;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content=$content;
    }

    /**
     * 渲染模板..
     */
    public function render($params){
        $tpl = $this->getTpl();
        ob_start();
        foreach($params as $k=>$v) $$k = $v;
        include($tpl);
        $data = ob_get_contents();
        ob_end_clean();
        return $data;
    }
}