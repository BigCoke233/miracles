<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container">
	  <div class="post-body">
	    <div class="post-content">
		  <h2 class="archive-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h2>
		  <?php if ($this->have()): ?>
          <?php else: ?>
          <p style="text-align:center">居然没有找到相关内容</p>
          <?php endif; ?>
		  <?php while($this->next()): ?>
		  <a href="<?php $this->permalink(); ?>" class="post-link">
		    <h3 class="archive-item-title"><?php $this->title(); ?></h3>
			<p class="arvchive-item-excerpt"><?php $this->excerpt(); ?></p>
		  </a>
		  <hr />
		  <?php endwhile; ?>
		  <div class="post-pagenav">
            <span class="post-pagenav-left"><?php $this->pageLink('<i class="iconfont icon-chevron-left"></i>'); ?></span>
		    <span class="post-pagenav-right"><?php $this->pageLink('<i class="iconfont icon-chevron-right"></i>','next'); ?></span>
		  </div>
		</div>
	  </div>
	</main>

<?php $this->need('includes/footer.php'); ?>