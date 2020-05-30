<?php
/**
 * 归档页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container" role="main">
	  <div class="post-body">
	    <div class="post-content page-content">
          <h2>文章标签</h2>
		  <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); ?>
          <?php if($tags->have()): ?>
          <ul class="tags-list">
          <?php while ($tags->next()): ?>
            <li class="tags-item"><a href="<?php $tags->permalink(); ?>" rel="tag" class="no-line" title="有 <?php $tags->count(); ?> 篇文章在这个标签下"><?php $tags->name(); ?></a></li>
          <?php endwhile; ?>
          </ul>
		  <?php else: ?>
            <p><?php _e('看来这个博主没有写标签的习惯~'); ?></p>
          <?php endif; ?>
		  <br />
		  <h2>文章归档</h2>
		  <ul class="archives-list">
      <?php
      $archives = Contents::archives($this);
      $number = 0;
      foreach($archives as $year => $posts) {
       $detailsOpen = ($number === 0) ? ' open' : NULL;
       echo '<details'.$detailsOpen.'>';
       echo '<summary>'.$year.' 年<small class="archives-count">共 '.count($posts).' 篇文章</small></summary>';
        foreach($posts as $created => $post) {
         echo '<li><a href="'.$post['permalink'].'" class="no-line">
          <span class="archives-date">'.date('m-d', $created).'</span>
          '.$post['title'].'
        </a></li>';
        }
       echo '</details>';
       $number++;
      }
     ?>
		  </ul>
		</div>
	  </div>
	</main>
<?php $this->need('includes/footer.php'); ?>