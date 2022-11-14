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
		<div class="post-footer"><!-- Post Footer -->
		  <span class="post-tags"><i class="iconfont icon-tags"></i> <?php $this->tags(' ', true, gt('postTexts','post_tag')); ?></span>
		</div>
	  </div>
<?php $this->need('includes/comments.php'); ?>
	</main>
<?php $this->need('includes/footer.php'); ?>
