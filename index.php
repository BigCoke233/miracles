<?php
/**
 * Born to be the Miracles. 生为奇迹
 * 作者：<a href="https://guhub.cn">Eltrac</a> | 帮助文档：<a href="https://mira.guhub.cn">GitHub Wiki</a>
 * 
 * @package     Miracles
 * @author      Eltrac
 * @version     1.4.2
 * @link        https://guhub.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container">
	  <div class="post-list"><!-- 文章循环开始 -->
	    <?php while($this->next()): ?>
		<br />
                <!-- 文章卡片 -->
                <div class="post-item ">
                    <div class="container-fluid"><div class="row">
			  <div class="col-md-6 post-banner-box">
			    <a href="<?php $this->permalink(); ?>" class="post-link">
			      <div class="post-banner">
				    <img src="/usr/themes/Miracles/images/loading/<?php echo $this->options->loading_image ?>.gif" data-original="<?php 
					if($this->fields->banner && $this->fields->banner=!''): 
					  echo $this->fields->banner(); 
					else: 
					  if($this->options->randomBanner==''){
						echo Utils::indexTheme('images/postbg/'); echo mt_rand(1,mt_rand(1,20)); echo '.jpg';
					  }
					  else{
						$banner_url = explode(',',$this->options->randomBanner);
						echo $banner_url[mt_rand(0,count($banner_url)-1)];}
					endif; ?>">
				  </div>
				</a>
			  </div>
			  <div class="col-md-6 post-item-content">
			    <a href="<?php $this->permalink(); ?>" class="post-link">
				  <h1 class="post-title"><?php $this->sticky(); ?><?php $this->title(); ?></h1>
				</a>
				<p class="post-excerpt">
				  <?php if($this->fields->excerpt && $this->fields->excerpt!='') {
				    echo $this->fields->excerpt;
				  }else{
					echo $this->excerpt(130);
				  }
				  ?>
				</p>
				<p class="post-meta"><i class="iconfont icon-block"></i> <?php $this->category(','); ?>&emsp;<i class="iconfont icon-comments"></i> <?php $this->commentsNum('0', '1', '%d'); ?>&emsp;<i class="iconfont icon-clock"></i> <?php $this->date(); ?></p>
				<p class="post-button-box large-screen"><a href="<?php $this->permalink(); ?>" class="button post-button">Read More</a></p>
			  </div>
			</div></div>
		  </div>
                <br />
		<?php endwhile; ?>
		<!-- 文章分页 -->
		<div class="post-pagenav">
          <span class="post-pagenav-left"><?php $this->pageLink('<i class="iconfont icon-chevron-left"></i>'); ?></span>
		  <span class="post-pagenav-right"><?php $this->pageLink('<i class="iconfont icon-chevron-right"></i>','next'); ?></span>
		</div>
	  <!-- 文章循环结束 --></div>
	</main>
	<!-- 防止找不到 owo 容器而报错 -->
	<div style="display:none" class="OwO"></div>
<?php $this->need('includes/footer.php'); ?>
