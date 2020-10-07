<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * Language.php
 * 多语言 / 多語言 / Multi-Languages
 * 
 * Author:  Eltrac(BigCoke233)
 * License: MIT
 */

class Lang 
{
    public static function getLang() {
        $provided_lang = glob(Helper::options()->themeFile("lang/*.php"));
        if(in_array($GLOBALS['miraclesLang'].'.php', $provided_lang)){
            require_once("lang/"+$GLOBALS['miraclesLang'].".php");
            $GLOBALS['miraclesLangError']=false;
        }else{
            require_once("lang/zh-cn.php");
            $GLOBALS['miraclesLangError']=true;
        }
    }
}

//快速获取对应语言文本
function gt($a, $b) {
    return $GLOBALS[$a][$b];
}
function gtecho($a, $b) {
    echo $GLOBALS[$a][$b];
}
//有参数的文本获取
function gta($a, $b, $c) {
    $content = str_replace('%s', $c, $GLOBALS[$a][$b]);
    return $content;
}
function gtaecho($a, $b, $c) {
    $content = str_replace('%s', $c, $GLOBALS[$a][$b]);
    echo $content;
}