<?php
/**
 * Utils.php
 * 
 * 提供某些 Typecho 方法的封装，以及一些常用方法实现
 * 
 * @author      熊猫小A
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Utils
{
    /**
     * 输出相对首页路由，本方法会自适应伪静态，用于动态文件
     */
    public static function index($path = '')
    {
        Helper::options()->index($path);
    }

    /**
     * 输出相对首页路径，本方法用于静态文件
     */
    public static function indexHome($path = '')
    {
        Helper::options()->siteUrl($path);
    }

    /**
     * 输出相对主题目录路径，用于静态文件
     */
    public static function indexTheme($path = '')
    {
        Helper::options()->themeUrl($path);
    }

    /**
     * 根据邮箱返回 Gravatar 头像链接
     */
    public static function gravatar($mail, $size = 64, $d = '')
    {
        return Typecho_Common::gravatarUrl($mail, $size, '', urlencode($d), true);
    }

    /**
     * 判断插件是否可用（存在且已激活）
     */
    public static function hasPlugin($name) 
    {
        $plugins = Typecho_Plugin::export();
        $plugins = $plugins['activated'];
        return is_array($plugins) && array_key_exists($name, $plugins);
    }

    /**
     * 判断移动端请求
     */
    public static function isMobile()
    { 
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
            return TRUE;
        }
        
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array ('mobile','nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap'
                ); 
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
                return TRUE;
            }
        }
        if (isset ($_SERVER['HTTP_ACCEPT'])){
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))){
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * 判定电脑端微信内置浏览器
     */
    public static function isWeixin() 
    {
        return  !self::isMobile() && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false; 
    }

    /**
     * 判定内容是否过时
     * $timeout：过期时间，单位为天
     */
    public static function isOutdated($archive, $timeout)
    {
        date_default_timezone_set("Asia/Shanghai");
        return round((time()- $archive->created) / 3600 / 24) > $timeout;
    }

    /**
     * 输出建站时间（最早一篇文章的写作时间）
     */
    public static function getBuildTime()
    {
        date_default_timezone_set("Asia/Shanghai");
        $db = Typecho_Db::get();
        $content = $db->fetchRow($db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.password IS NULL')
            ->order('table.contents.created', Typecho_Db::SORT_ASC)
            ->limit(1));
        return $content['created'];
    }

    /**
     * 已发布文章数量
     */
    public static function getPostNum()
    {
        $db = Typecho_Db::get();
        return $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))
            ->from('table.contents')
            ->where('table.contents.type = ?', 'post')
            ->where('table.contents.status = ?', 'publish'))->num;
    }

    /**
     * 分类数量
     */
    public static function getCatNum()
    {
        $db = Typecho_Db::get();
        return $db->fetchObject($db->select(array('COUNT(mid)' => 'num'))
            ->from('table.metas')
            ->where('table.metas.type = ?', 'category'))->num;
    }

    /**
     * 标签数量
     */
    public static function getTagNum()
    {
        $db = Typecho_Db::get();
        return $db->fetchObject($db->select(array('COUNT(mid)' => 'num'))
            ->from('table.metas')
            ->where('table.metas.type = ?', 'tag'))->num;
    }

    /**
     * 总字数
     * 
     * @return int
     */
    public static function getWordCount()
    {
        $db = Typecho_Db::get();
        $posts = $db->fetchAll($db->select('table.contents.text')
                    ->from('table.contents')
                    ->where('table.contents.type = ?', 'post')
                    ->where('table.contents.status = ?', 'publish'));
        $total = 0;
        foreach ($posts as $post) {
            $total = $total + mb_strlen(preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $post['text']), 'UTF-8');
        }
        return $total;
    }
}
