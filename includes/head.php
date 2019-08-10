<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'getLoginAction') {
    echo $this->options->loginAction;
    exit;
  }
}?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php 
    $banner = '';
    $description = '';
    if($this->is('post') || $this->is('page')){
        if(isset($this->fields->banner))
            $banner=$this->fields->banner;
        if(isset($this->fields->excerpt))
            $description = $this->fields->excerpt;
    }else{
        $description = Helper::options()->description;
    }
    ?>
    <title><?php Contents::title($this); ?></title>
    <meta name="author" content="<?php $this->author(); ?>" />
    <meta name="description" content="<?php if($description != '') echo $description; else $this->excerpt(50); ?>" />
    <meta property="og:title" content="<?php Contents::title($this); ?>" />
    <meta property="og:description" content="<?php if($description != '') echo $description; else $this->excerpt(50); ?>" />
    <meta property="og:site_name" content="<?php Helper::options()->title(); ?>" />
    <meta property="og:type" content="<?php if($this->is('post') || $this->is('page')) echo 'article'; else echo 'website'; ?>" />
    <meta property="og:url" content="<?php $this->permalink(); ?>" />
    <meta property="og:image" content="<?php echo $banner; ?>" />
    <meta property="article:published_time" content="<?php echo date('c', $this->created); ?>" />
    <meta property="article:modified_time" content="<?php echo date('c', $this->modified); ?>" />
    <meta name="twitter:title" content="<?php Contents::title($this); ?>" />
    <meta name="twitter:description" content="<?php if($description != '') echo $description; else $this->excerpt(50); ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content<?php echo $banner; ?>" />
	<link rel="icon" type="image/png" href="<?php Utils::indexTheme('favicon.ico'); ?>" />
    <?php $this->header('description=&'); ?>
	<?php $this->options->headerEcho(); ?>
	<!-- css -->
	<?php if($this->options->CDN && $this->options->CDN=1): ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/css/prism.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/css/owo.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/css/fancybox.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/css/prism.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/css/main/miracles.min.css" />
	<?php else: ?>
	<link rel="stylesheet" href="<?php Utils::indexTheme('assets/css/prism.css'); ?>" />
	<link rel="stylesheet" href="<?php Utils::indexTheme('assets/css/owo.min.css'); ?>" />
	<link rel="stylesheet" href="<?php Utils::indexTheme('assets/css/nprogress.css'); ?>" />
	<link rel="stylesheet" href="<?php Utils::indexTheme('assets/css/fancybox.css'); ?>" />
	<link rel="stylesheet" href="<?php Utils::indexTheme('assets/css/main/miracles.min.css'); ?>" />
	<?php endif; ?>
	<!-- icon font -->
	<link rel="stylesheet" href="//at.alicdn.com/t/font_1165190_nsy3b6pbkb.css" />
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:300|Noto+Serif+SC:300&display=swap" rel="stylesheet">
	<style>.body-dark .pio-action .pio-home{background-image: url(<?php Utils::indexTheme('images/icons/home.png'); ?>);}.body-dark .pio-action .pio-close{background-image: url(<?php Utils::indexTheme('images/icons/remove.png'); ?>);}.body-dark .pio-action .pio-skin{background-image: url(<?php Utils::indexTheme('images/icons/skin.png'); ?>);}.body-dark .pio-action .pio-info{background-image: url(<?php Utils::indexTheme('images/icons/info.png'); ?>);}.body-dark .pio-action .pio-night{background-image: url(<?php Utils::indexTheme('images/icons/night.png'); ?>);}@media (min-width:992px) {.search{background-image:url(<?php Utils::indexTheme('images/search.png'); ?>);}.login{background-image:url(<?php Utils::indexTheme('images/login.png'); ?>)}}.search {background-position: bottom right;background-repeat: no-repeat}.login {background-position: bottom left;background-repeat:no-repeat}<?php $this->options->cssEcho(); ?></style>
  </head>
  <body class="<?php if($this->options->bodyFonts && $this->options->bodyFonts=1): ?> body-serif<?php endif; ?><?php if($this->options->grayTheme && $this->options->grayTheme=1): ?> body-gray<?php endif; ?> body-contentsize-normal">
  <!--[if lt IE 9]>
    <div class="message error browsehappy" role="dialog">当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>.</div>
  <![endif]-->