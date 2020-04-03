<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container" role="main">
	  <div class="post-body">
	    <div class="post-content" role="article" id="post-content"><!-- 文章内容 -->
		  <?php $postCheck = Utils::isOutdated($this); if($postCheck["is"] && $this->is('post')): ?>
            <div class="tip red" id="out-date-alert">
			  <div class="container-fluid"><div class="row">
			    <div class="col-1 tip-icon"><i class="iconfont icon-info"></i></div>
				<div class="col-11 tip-content">本文编写于 <?php echo $postCheck["created"]; ?> 天前，最后修改于 <?php echo $postCheck["updated"]; ?> 天前，其中某些信息可能已经过时。</div>
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
		<div class="post-footer"><!-- 文章页脚 -->
		  <div class="post-share">分享至：
            <button class="social-share qrcode" id="post-qrcode-btn"><i class="iconfont icon-qr_code"></i></button>
		    <a class="social-share qq"  target="_blank" href="https://connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink() ?>&title=<?php $this->title() ?>&summary=<?php $this->excerpt(100); ?>" title="分享至 QQ 好友"><i class="iconfont icon-qq1-copy"></i></a>
		    <a class="social-share weibo"  target="_blank" href="http://service.weibo.com/share/share.php?url=<?php $this->permalink() ?>/&appkey=<?php $this->options->title(); ?>/&title=<?php $this->title() ?>" title="分享至新浪微博"><i class="iconfont icon-weibo-copy"></i></a>
		    <a class="social-share twitter"  target="_blank" href="https://twitter.com/intent/tweet?text=<?php $this->excerpt(100); ?>&amp;url=<?php $this->permalink() ?>"><i class="iconfont icon-twitter-copy" title="分享至 Twitter"></i></a>
            <a class="social-share copyright" onclick="alertSend('文章未声明即为原创，转载请注明原作者')"><i class="iconfont icon-info1"></i></a>
		  </div>
		  <span class="post-tags"><i class="iconfont icon-tags"></i> <?php $this->tags(' ', true, '这人还没有写标签哦~'); ?></span>
		</div>
	  </div>
<?php $this->need('includes/comments.php'); ?>
	</main>
<?php $this->need('includes/footer.php'); ?>
