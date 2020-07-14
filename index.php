<?php
/**
 * Born to be the Miracles. 生为奇迹
 * 作者：<a href="https://guhub.cn">Eltrac</a> | 帮助文档：<a href="https://github.com/BigCoke233/miracles/blob/master/docs/wiki.md">Wiki</a>
 * 
 * @package     Miracles
 * @author      Eltrac
 * @version     1.5.5
 * @link        https://guhub.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container" role="main">
	  <div class="post-list"><!-- 文章循环开始 -->
	    <?php while($this->next()): ?>
		<br />
                <!-- 文章卡片 -->
                <div class="post-item" role="article">
                    <div class="container-fluid"><div class="row">
			  <div class="col-md-6 post-banner-box">
			    <a href="<?php $this->permalink(); ?>" class="post-link">
			      <div class="post-banner">
				    <img src="<?php Utils::indexTheme('images/loading/'.$this->options->loading_image.'.gif') ?>" data-gisrc="<?php Utils::postBanner($this); ?>">
				  </div>
				</a>
			  </div>
			  <div class="col-md-6 post-item-content">
			    <a href="<?php $this->permalink(); ?>" class="post-link" title="<?php $this->title(); ?>">
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
				<p class="post-button-box large-screen"><a href="<?php $this->permalink(); ?>" class="button post-button"><?php gtecho('postTexts','read_more'); ?></a></p>
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
<?php $this->need('includes/footer.php'); ?>
