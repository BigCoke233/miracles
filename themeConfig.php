<?php
/**
 * ThemeConfig.php
 * 主题高级设置
 * 
 * Notice: 这些都是普通用户不常用的设置项，故单独放在这里
 * 通常 'on' 表示开启；'off' 则表示关闭
 */

//主题字体 CDN
$GLOBALS['miraclesFontCDN'] = array(
    'if' => 'on', //是否开启字体 CDN（使用思源宋体/黑体）
    'cdn' => 'google_font' //默认 Google Font，可选项：google_font / font_lolinet，或者直接输入字体文件 url
);

//是否剪裁文章缩略图
//使用 TimThumb 剪裁文章缩略图能达到最好效果，但会消耗服务器资源
$GLOBALS['miraclesIfTimThumb'] = 'off';

//图片剪裁大小（开启上一条才会有效）
$GLOBALS['miraclesIfTimThumbSize'] = 'regular';//可选：regular / big / large / huge

//TimThumb 允许的外部链接
//如果你使用的外部图床或者 CDN 被 TimThumb 屏蔽，请将其域名加入到下面的数组
$GLOBALS['miraclesTimThumbAllowList'] = array (
    'flickr.com',
    'staticflickr.com',
    'picasa.com',
    'img.youtube.com',
    'upload.wikimedia.org',
    'photobucket.com',
    'imgur.com',
    'imageshack.us',
    'tinypic.com',
    'jsdelivr.net'
);