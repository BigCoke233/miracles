<?php
/**
 * ThemeConfig.php
 * 主题高级设置
 * 
 * Notice: 这些都是普通用户不常用的设置项，故单独放在这里
 */

//主题字体 CDN
$GLOBALS['miraclesFontCDN'] = array(
    'if' => 'on', //是否开启字体 CDN（使用思源宋体/黑体）
    'cdn' => 'google_font' //默认 Google Font，可选项：google_font / font_lolinet，或者直接输入字体文件 url
);