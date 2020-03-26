<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 说说页面
 *
 * @package custom
 */
$this->need('includes/head.php');
$this->need('includes/header.php');
function threadedComments($comments, $options) {
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
<div id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->_levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass; 
?>">
  <div class="saying-item">
    <div class="saying-inner saying-header">
	  <p class="saying-meta">
	    <?php $comments->gravatar('100', ''); ?><span class="saying-author"><?php $comments->author(); ?></span><br>
	    <?php $comments->date('Y-m-d H:i'); ?>
	  </p>
	</div>
	<div class="saying-hr"></div>
	<div class="saying-inner saying-middle">
	  <?php echo Contents::parseEmo($comments->content); ?>
	</div>
  </div>
</div>
<?php } ?>
    <main class="main-container container">
	  <div class="saying-body">
	    <?php if($this->user->hasLogin()): ?>
	    <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="saying-form" role="form">
          <p>
            <textarea rows="8" cols="50" name="text" id="textarea" placeholder="Anything interesting happening?" class="OwO-textarea comment-textarea textarea" required ><?php $this->remember('text'); ?></textarea>
          </p>
	      <p>
            <button type="submit" class="comment-submit submit"><?php _e('发表新鲜事'); ?></button>
          </p>
		</form>
		<br>
		<?php endif; ?>
	    <?php $this->comments()->to($comments); ?>
	    <?php $comments->listComments(array(
            'before'        =>  '<div class="comment-list">',
            'after'         =>  '</div>',
            'avatarSize'    =>  200,
            'dateFormat'    =>  'Y-m-d H:i'
        )); ?>
		<div class="comment-pagenav">
          <?php $comments->pageNav('<i class="iconfont icon-chevron-left comment-pagenav-icon"></i>', '<i class="iconfont icon-chevron-right comment-pagenav-icon"></i>'); ?>
        </div>
      </div>
	</main>
<?php $this->need('includes/footer.php'); ?>