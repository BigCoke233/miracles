<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container">
	  <div class="post-body">
	    <!-- 页面内容 -->
	    <div class="post-content page-content">
		  <?php $postCheck = Utils::isOutdated($this); if($postCheck["is"] && $this->is('post')): ?>
            <div class="tip red">
			  <div class="container-fluid"><div class="row">
			    <div class="col-1 tip-icon"><i class="iconfont icon-info"></i></div>
				<div class="col-11 tip-content">页面编写于 <?php echo $postCheck["created"]; ?> 天前，最后修改于 <?php echo $postCheck["updated"]; ?> 天前，其中某些信息可能已经过时。</div>
			  </div></div>
			</div>
          <?php endif; ?>
		  <?php $this->content(); ?>
		</div>
	  </div>
<?php $this->need('includes/comments.php'); ?>
	</main>
<?php $this->need('includes/footer.php'); ?>