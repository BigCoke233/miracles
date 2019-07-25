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
  <div class="container-fluid">
    <div class="row">
      <div class="comment-author-avatar col-md-1">
        <?php $comments->gravatar('100', ''); ?>
      </div>
	  <div class="comment-main comment-author-info col-md-11">
		<div class="comment-content bubble">
		  <span class="comment-reply">
		    <?php $comments->reply('<i class="iconfont icon-return"></i>'); ?>
		  </span>
	      <?php $comments->content(); ?>
	    </div>
		<p class="comment-meta">
		  <span class="comment-author"><?php $comments->author(); ?></span>
		  <span class="comment-date"><?php $comments->date('Y-m-d H:i'); ?></span>
		</p>
		<?php if ($comments->children) { ?>
        <div class="comment-children">
          <?php $comments->threadedComments($options); ?>
        </div>
        <?php } ?>
	  </div>
	</div>
  </div>
</div>
<?php } ?>
      <div class="comment">
	    <?php $this->comments()->to($comments); ?>
		<h3 class="comment-title">
		  <?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?>
		</h3>
        <?php if ($comments->have()): ?>
		<div class="comment-container">
          <?php $comments->listComments(array(
            'before'        =>  '<div class="comment-list">',
            'after'         =>  '</div>',
            'avatarSize'    =>  200,
            'dateFormat'    =>  'Y-m-d H:i'
            )); ?>
		</div>
		<div class="comment-pagenav">
          <?php $comments->pageNav('<i class="iconfont icon-chevron-left comment-pagenav-icon"></i>', '<i class="iconfont icon-chevron-right comment-pagenav-icon"></i>'); ?>
        </div>
        <?php endif; ?>
		
		<div class="comment-form">
		  <!-- 判断设置是否允许对当前文章进行评论 -->
<?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>

        <h3 id="response"><?php _e('添加新评论'); ?></h3>
<!-- 输入表单开始 -->
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
<!-- 输入要回复的内容 -->
            <div class="container-fluid"><div class="row">
              <p class="col-md-12">
                <textarea rows="8" cols="50" name="text" id="textarea" class="OwO-textarea comment-textarea textarea" required ><?php $this->remember('text'); ?></textarea>
              </p>
			</div></div>
<!-- 如果当前用户已经登录 -->
            <?php if($this->user->hasLogin()): ?>
<!-- 显示当前登录用户的用户名以及登出连接 -->
            <p class="col-md-12"><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
<!-- 若当前用户未登录 -->
            <?php else: ?>
<!-- 要求输入名字、邮箱、网址 -->
            <div class="container-fluid comment-input"><div class="row">
              <p class="col-md-4">
                <label for="author" class="required"><?php _e('称呼'); ?></label>
                <input type="text" name="author" id="author" class="text" placeholder="称呼" value="<?php $this->remember('author'); ?>" required />
              </p>
              <p class="col-md-4">
                <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('Email'); ?></label>
                <input type="email" name="mail" id="mail" class="text" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
              </p>
              <p class="col-md-4">
                <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
                <input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
              </p>
			</div></div>
            <?php endif; ?>
			<div class="container-fluid"><div class="row">
			  <p class="col-md-12 owo-para">
			    <div title="OwO" class="OwO"></div>
			  </p>
			  <p class="comment-submit col-md-12">
                <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
              </p>
			</div></div>
        </form>
    </div>
<!-- 若当前文章不允许进行评论 -->
    <?php else: ?>
    <h3 class="comment-closed-alert"><?php _e('<i class="iconfont icon-x"></i> 评论已关闭'); ?></h3>
    <?php endif; ?>
		</div>
	  </div>
	