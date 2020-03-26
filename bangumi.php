<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 追番页面
 *
 * @author Kengwang
 * @for BigCoke233/miracles
 *
 * @package custom
 */

//判断是否为HTTPS
function is_https()
{
    if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        return true;
    } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    }
    return false;
}

define('IS_HTTPS', is_https());
$this->need('includes/head.php');
$this->need('includes/header.php');


function curl($url, $cookie)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    //地址
    //curl_setopt ($curl, CURLOPT_COOKIEJAR, $cookiefile);//文件式
    //curl_setopt ($curl, CURLOPT_COOKIEFILE, $cookiefile);
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $str = curl_exec($curl);
    curl_close($curl);
    return $str;
}

function getSubstr($str, $leftStr, $rightStr)
{
    $left = strpos($str, $leftStr);
    //echo '左边:'.$left;
    $right = strpos($str, $rightStr, $left);
    //echo '<br>右边:'.$right;
    if ($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right - $left - strlen($leftStr));
}

if ($this->fields->uid == !'' && $this->fields->sessdata == !'') {
    if (empty($_GET['page']) || $_GET['page'] == 0) $page = 1; else $page = $_GET['page'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&vmid=' . $this->fields->uid . '&ps=16&pn=' . $page);
    curl_setopt($curl, CURLOPT_COOKIE, 'SESSDATA=' . $this->fields->sessdata . ';');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $str = curl_exec($curl);
    curl_close($curl);
    $bgmdataraw = json_decode($str, true);
    $error = false;
    if (!$bgmdataraw) $error = true;
} else {
    $bgmdataraw = array();
    $bgmlist = array();
}

//  Uncomment for debugging
/*
if ($_GET['dbg'] == 'format') {
    echo "<pre>";
    print_r($bgmlist);
    echo "</pre>";
}
if ($_GET['dbg'] == 'rawlist') {
    echo "<pre>";
    print_r($bgmdataraw);
    echo "</pre>";
}
*/

?>
    <main class="main-container container">
        <div class="post-body">
            <div class="post-content">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        if (!$error && $bgmdataraw['data']['total'] != 0): //没有东西
                            $bgmlist=$bgmdataraw['data']['list'];
                            foreach ($bgmlist as $bangumi) : ?>
                                <div class="bangumi-item col-md-4 col-lg-3"><a href="<?php echo 'https:////www.bilibili.com/bangumi/play/ss' . $bangumi['season_id'] . '/'; ?>" target="_blank" class="no-line bangumi-link">
                                        <div class="bangumi-banner">
                                            <?php $db = Typecho_Db::get();
                                            $load_image = $db->fetchAll($db->select('value')->from('table.options')->where('name = %s', "theme:Miracles")->limit(1));
                                            $load_image = explode("\";", explode("\"", explode("\"loading_image\";", $load_image[0]["value"], 2)[1], 2)[1], 2)[0]; ?>
                                            <img src="<?php if (IS_HTTPS): ?>/usr/themes/Miracles/images/loading/<?php echo $load_image; ?>.gif"
                                                 data-original="<?php echo $bangumi['cover']; else: echo $bangumi['cover'];
                                                 endif; ?>" referrerpolicy="no-referrer">
                                            <div class="bangumi-des">
                                                <p><?php echo isset($bangumi['evaluate']) && $bangumi['evaluate'] != '' ? $bangumi['evaluate'] : '暂无简介'; ?></p>
                                            </div>
                                        </div>
                                        <div class="bangumi-content">
                                            <h3 class="bangumi-title" title="<?php echo $bangumi['title']; ?>"><?php echo $bangumi['title']; ?></h3>
                                            <div class="bangumi-progress" style="width:100%">
                                                <div class="bangumi-progress-bar"
                                                     style="width:<?php
                                                     //获取总集数
                                                     $total = 0;
                                                     if ($bangumi['is_finish']) {
                                                         $total = $bangumi['total_count'];
                                                         //total_count是预计总集数
                                                     } elseif (!$bangumi['is_started'] || $bangumi['new_ep']['index_show'] == '即将开播') {
                                                         $total = 0;
                                                     } else {
                                                         $total = $bangumi['new_ep']['title'];
                                                         if (!is_numeric($total)) $total = $bangumi['total_count'];
                                                         //有些最后是Extra,默认识别为最后一集
                                                     }
                                                     if ($total < 0) $total = 0;
                                                     $ep = 0;
                                                     if (!$bangumi['is_started']) {
                                                         //没有开始
                                                         $ep = 0;
                                                     } elseif (strpos($bangumi['progress'], '已看完')) {
                                                         $ep = $total;
                                                     } elseif (isset($bangumi['progress']) && !strpos($bangumi['progress'], 'PV')) {
                                                         $ep = getSubstr($bangumi['progress'], '第', '话');
                                                         if (!is_numeric($ep)) $ep = $total;
                                                         //匹配左右取中间数字
                                                     } else {
                                                         $ep = 0;
                                                     }
                                                     echo round(($ep / $total) * 100); ?>%"></div>
                                            </div>
                                            <div class="bangumi-progress-num">进度：<?php echo $ep;
                                                echo ' / ';
                                                echo $total; ?></div>
                                        </div>
                                    </a>
                                </div>

                            <?php endforeach;
                        else: ?>
                            <h1 class="about-name"><?php echo '啥也没有呐 !!!∑(ﾟДﾟノ)ノ'; ?></h1>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="post-pagenav">
            <?php if ($page != 1): ?><a class="post-pagenav-left" href="?page=<?php echo $page - 1; ?>"><i
                        class="iconfont icon-chevron-left"></i></a> <?php endif; ?>
            <?php if ($bgmdataraw['data']['pn'] * $bgmdataraw['data']['ps'] < $bgmdataraw['data']['total']): ?>
                <a class="post-pagenav-right" href="?page=<?php echo $page + 1; ?>"><i
                            class="iconfont icon-chevron-right"></i></a>
            <?php endif; ?>
        </div>
        <br>
        <?php $this->need('includes/comments.php');
        ?>
    </main>
<?php $this->need('includes/footer.php');
?>