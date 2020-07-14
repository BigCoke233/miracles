<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container" role="main">
	  <div class="post-body">
	    <div class="post-content" role="article" id="post-content"><!-- Post Content -->
		  <?php $postCheck = Utils::isOutdated($this); if($postCheck["is"] && $this->is('post')): ?>
            <div class="tip red" id="out-date-alert">
			  <div class="container-fluid"><div class="row">
			    <div class="col-1 tip-icon"><i class="iconfont icon-info"></i></div>
				<div class="col-11 tip-content"><?php gtaecho('postTexts','post_timeAlert_1',$postCheck["created"]); gtaecho('postTexts','post_timeAlert_2',$postCheck["updated"]); ?></div>
			  </div></div>
			</div>
          <?php endif; ?>
		  <?php if($this->options->ifShowRTA!=0): ?>
		  <div class="tip blue" id="reading-time-alert">
            <div class="container-fluid">
              <div class="row">
                <div class="col-1 tip-icon"><i class="iconfont icon-info"></i></div>
                <div class="col-11 tip-content" id="readTip"></div>
			  </div></div>
	      </div>
		  <?php endif;?>
		  <?php $this->content(); ?>
		</div>
		<div class="post-qr" id="post-qr">
		</div>
		<div class="post-footer"><!-- Post Footer -->
		  <div class="post-share"><?php gtecho('postTexts','post_share'); ?>
            <button class="social-share qrcode" id="post-qrcode-btn"><i class="iconfont icon-qr_code"></i></button>
		    <a class="social-share qq hint--bottom"  target="_blank" href="https://connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink() ?>&title=<?php $this->title() ?>&summary=<?php $this->excerpt(100); ?>" data-tooltip="QQ"><i class="iconfont icon-qq1-copy"></i></a>
		    <a class="social-share weibo hint--bottom"  target="_blank" href="http://service.weibo.com/share/share.php?url=<?php $this->permalink() ?>/&appkey=<?php $this->options->title(); ?>/&title=<?php $this->title() ?>" data-tooltip="Weibo"><i class="iconfont icon-weibo-copy"></i></a>
		    <a class="social-share twitter hint--bottom"  target="_blank" href="https://twitter.com/intent/tweet?text=<?php $this->excerpt(100); ?>&amp;url=<?php $this->permalink() ?>" data-tooltip="Twitter"><i class="iconfont icon-twitter-copy"></i></a>
            <a class="social-share copyright" onclick="alertSend('<?php gtecho('otherTexts','copyrightAlert'); ?>')"><i class="iconfont icon-info1"></i></a>
		  </div>
		  <span class="post-tags"><i class="iconfont icon-tags"></i> <?php $this->tags(' ', true, gt('postTexts','post_tag')); ?></span>
		</div>
	  </div>
<?php $this->need('includes/comments.php'); ?>
	</main>
<?php $this->need('includes/footer.php'); ?>
