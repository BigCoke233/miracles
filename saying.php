<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 说说动态
 *
 * @package custom
 */
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    } 
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>
<div>
<div id="li-<?php $comments->theId(); ?>" class="bubble saying-body comment-body<?php 
if ($comments->_levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass; 
?>">
  <div class="saying-content">
    <span class="saying-author"><?php $comments->author(); ?> said:</span>
    <?php $comments->content(); ?>
	<span class="saying-meta"><i class="iconfont icon-clock"></i> <?php $comments->date('F jS, Y'); ?></span>
  </div>
</div>
</div>
<?php } ?>

    <main class="main-container container">
	  <div class="post-body">
	    <div class="post-content">
		  <?php if($this->user->hasLogin()): ?>
		  <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="saying-form" role="form">
		    <textarea rows="8" cols="50" name="text" id="textarea" class="OwO-textarea comment-textarea textarea" required ><?php $this->remember('text'); ?></textarea>
		    <p class="saying-action">
			  <div title="OwO" class="saying-OwO OwO"></div>
			  <button type="submit" class="saying-submit submit"><?php _e('发表动态'); ?></button>
	        </p>
		  </form>
		  <hr>
		  <?php endif; ?>
		  <?php $this->comments()->to($comments); ?>
		  <h3 class="comment-title">
		    <span style="color:#ccc">- </span>
		    <?php $this->commentsNum(_t('暂无动态'), _t('仅有一条动态'), _t('已有 %d 条动态')); ?>
		    <span style="color:#ddd"> -</span>
		  </h3>
		  <?php if ($comments->have()): ?>
		    <?php $comments->listComments(); ?>
            <?php $comments->pageNav('<i class="iconfont icon-chevron-left"></i>', '<i class="iconfont icon-chevron-right"></i>'); ?>
          <?php endif; ?>
		</div>
	  </div>
	</main>


<?php $this->need('includes/footer.php'); ?>