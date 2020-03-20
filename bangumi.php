<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 追番页面
 * 
 * @author Kengwang
 * @for BigCoke233/miracles
 *
 * @package custom
 */
//判断是否为HTPS
function is_https() {
    if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        return true;
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    }
    return false;
}
define('IS_HTTPS',is_https());
$this->need('includes/head.php');
$this->need('includes/header.php');
$this->need('libs/Bangumi.php');
if ($this->fields->uid == !'' && $this->fields->sessdata == !'') {
    bilibili::setUserInfo($this->fields->uid, $this->fields->sessdata);
    if (empty($_GET['page']) || $_GET['page'] == 0) $page = 1; else $page = $_GET['page'];
    $bgmdataraw = bilibili::getFollowingListRaw($page,16);
    $bgmlist = bilibili::getFormatList($bgmdataraw['data']['list']);
} else {
    $bgmdataraw = array();
    $bgmlist = array();
}

//  Uncomment for debugging
/*
if ($_GET['dbg'] == 'fuck') {
    echo "<pre>";
    print_r($bgmlist);
    echo "</pre>";
}
if ($_GET['dbg'] == 'rawlist') {
    echo "<pre>";
    print_r($bgmdataraw);
    echo "</pre>";
}
*/

?>
    <main class="main-container container">
        <div class="post-body"><div class="post-content">
<?php 
//番组链接 $bgm['link'];
//番组名字 $bgm['name'];
//番组封面 $bgm['img'];
//番组介绍 $bgm['des'];
//观看进度 $bgm['watched'] . "/" . $bgm['all']
//更新至   $bgm['new']['title'];
//观看状态 if ($bgm['basket'] == 0) echo '想看';
//         if ($bgm['basket'] == 1) echo '在看';
//         if ($bgm['basket'] == 2) echo '看完';
/** 
开始循环
<?php
if ($bgmdataraw['data']['total'] != 0): 
  foreach ($bgmlist as $bgm) : ?>
  //content
  <?php endforeach;
  else: ?>
  //if nothing
<?php endif; ?>
**/
?>
				<div class="container-fluid"><div class="row">
                <?php
                if ($bgmdataraw['data']['total'] != 0): //没有东西
                    foreach ($bgmlist as $bgm) : ?>
					
                    <div class="bangumi-item col-md-4 col-lg-3"><a href="<?php echo $bgm['link']; ?>" target="_blank" class="no-line bangumi-link">
					  <div class="bangumi-banner">
					    <?php $db=Typecho_Db::get();
                        $load_image = $db->fetchAll($db->select('value')->from('table.options')->where('name = %s', "theme:Miracles")->limit(1));
                        $load_image = explode("\";",explode("\"",explode("\"loading_image\";",$load_image[0]["value"],2)[1],2)[1],2)[0]; ?>
					    <img src="<?php if(IS_HTTPS):?>/usr/themes/Miracles/images/loading/<?php echo $load_image;?>.gif" data-original="<?php echo $bgm['img']; else: echo $bgm['img']; endif;?>" referrerpolicy="no-referrer">
						<div class="bangumi-des">
						  <p><?php echo $bgm['des']; ?></p>
						</div>
					  </div>
					  <div class="bangumi-content">
					    <h3 class="bangumi-title" title="<?php echo $bgm['name'];?>"><?php echo $bgm['name'];?></h3>
						<div class="bangumi-progress" style="width:100%">
						  <div class="bangumi-progress-bar" style="width:<?php echo round(($bgm['watched']/$bgm['all'])*100); ?>%"></div>
						</div>
						<div class="bangumi-progress-num">进度：<?php echo $bgm['watched']; echo ' / '; echo $bgm['all'];?></div>
					  </div></a>
					</div>
					
                    <?php endforeach;
                    else: ?>
                    <h1 class="about-name"><?php echo '啥也没有呐 !!!∑(ﾟДﾟノ)ノ';?></h1>
                <?php endif; ?>
				</div></div>
                <br>
          </div>
		</div>
		<div class="post-pagenav">
         <?php if ($page != 1): ?><a class="post-pagenav-left" href="?page=<?php echo $page - 1; ?>"><i
         class="iconfont icon-chevron-left"></i></a> <?php endif; ?>
         <?php if ($bgmdataraw['data']['pn'] * $bgmdataraw['data']['ps'] < $bgmdataraw['data']['total']): ?>
         <a class="post-pagenav-right" href="?page=<?php echo $page + 1; ?>"><i
         class="iconfont icon-chevron-right"></i></a>
         <?php endif; ?>
         </div>
		 <br>
        <?php $this->need('includes/comments.php');
        ?>
    </main>
<?php $this->need('includes/footer.php');
?>