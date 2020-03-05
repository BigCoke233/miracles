<?php

/**
 * Bangumi追番API
 * @author Kengwang
 * @copyright Kengwang
 */


class BGMFL
{
    static function curl($url, $cookie)
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
}

class bilibili
{
    private static $uid = '';
    //用户ID
    private static $cookie = '';

    //cookie,假如说没有公开就要填写,只需要SESSDATA

    public static function setUserInfo($uid, $sessdata)
    {

        self::$cookie = 'SESSDATA=' . $sessdata . ';';
        self::$uid = $uid;
    }

    public static function getFollowingListRaw($pn = 1, $ps = 15)
    {
        /**
         * 关于链接的注释
         * 首先说说已知的参数
         * type :          追逐类型 1为追番 2为追剧 [必须]
         * follow_status : 番剧类别 0为全部 1为想看 2为在看 3为看过
         * ps :            每一页的个数 相当于SQL的Limit
         * pn :            页码,承接上一个参数
         * vmid :          用户ID [必须]
         *
         * 还有什么参数后期补充哦
         */
        $back = BGMFL::curl('https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&vmid=' . self::$uid . '&ps=' . $ps . '&pn=' . $pn, self::$cookie);
        $array = json_decode($back, true);
        if (!$array) echo "追番状态获取失败";
        return $array;
    }

    public static function getFollowingList($pn = 1, $ps = 15)
    {
        return self::getFollowingListRaw($ps, $pn)['data']['list'];
    }

    public static function getFormatList($data = null)
    {
        /**
         * 按照老夫追了那么多番剧,看了那么多情况,可以将它归纳一下
         *
         * ssid    : 唯一番剧ID [Done]
         * name    : 番剧名称 [Done]
         * des     : 描述简介 没有的话就是 '暂无简介' [Done]
         * link    : 链接 [Done]
         * status  : 番剧状态 0为正在播 1为将开 2为完结 [Done]
         * followst: 追番状态(自动判断) 0为未看,1为在看,2为看完 [Done]
         * basket  : 在B站定的状态,0为想看 1为在看 2为看完 [Done]
         * all     : 总集数 未开为0 [Done]
         * watched : 已观看集数 PV为0 [Done]
         * nowraw  : 已观看集数和时间 (Bilibili直接显示) [Done]
         * progress: 特色功能,追番进度 n% [Done]
         * img     : 图片 [Done]
         * coin    : 硬币 [Done]
         * score   : 分数 未开/未评分番剧是0.0 [Done]
         * new     : 最新集(array)={title:名字 ep:集数 finish:是否完结撒花} [Done]
         *
         */
        if ($data === null) {
            $data = self::getFollowingList();
        }
        $ret = array();
        foreach ($data as $bangumi) {
            //判断是否填写Cookie
            if (empty($bangumi['both_follow'])) {
                $temp['ssid'] = 0;
                $temp['name'] = "Cookie填写错误:Cookie错误";
                // 名称
                $temp['des'] = "可能由于格式不对或者Cookie过期,请重新获取Cookie并且更改Cookie";
                $ret[] = $temp;
                break;
            } elseif ($bangumi['both_follow'] == 0) {
                $temp['ssid'] = 0;
                $temp['name'] = "Cookie填写错误:Cookie与用户名不匹配";
                // 名称
                $temp['des'] = "可能由于格式不对或者Cookie过期,请重新获取Cookie并且更改Cookie";
                $ret[] = $temp;
                break;
            }

            $temp['ssid'] = $bangumi['season_id'];
            //ID
            $temp['name'] = $bangumi['title'];
            // 名称
            $temp['des'] = isset($bangumi['evaluate']) && $bangumi['evaluate'] != '' ? $bangumi['evaluate'] : '暂无简介';
            // 简介
            $temp['link'] = 'https:////www.bilibili.com/bangumi/play/ss' . $bangumi['season_id'] . '/';
            //链接
            $temp['nowraw'] = $bangumi['progress'];
            //进度复杂型
            //番剧状态
            if ($bangumi['is_finish']) {
                $temp['status'] = 2;
            } elseif (!$bangumi['is_started']) {
                $temp['status'] = 1;
            } else {
                $temp['status'] = 0;
            }

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
            $temp['all'] = $total;

            //获取当前看到的集数
            $ep = 0;
            if (!$bangumi['is_started']) {
                //没有开始
                $ep = 0;
            } elseif (strpos($bangumi['progress'], '已看完')) {
                $ep = $total;
            } elseif (isset($bangumi['progress']) && !strpos($bangumi['progress'], 'PV')) {
                $ep = self::getSubstr($bangumi['progress'], '第', '话');
                if (!is_numeric($ep)) $ep = 0;
                //匹配左右取中间数字
            } else {
                $ep = 0;
            }
            $temp['watched'] = $ep;

            //追番状态 - Auto
            if (!$bangumi['is_started'] || $ep == 0) {
                $temp['followst'] = 0;
            } elseif ($ep == $total) {
                $temp['followst'] = 2;
            } else {
                $temp['followst'] = 1;
            }

            //追番状态 - Bilibili
            $temp['basket'] = $bangumi['follow_status'] - 1;

            //图片 - 原图 (非方形小头像)
            $temp['img'] = $bangumi['cover'];

            //硬币
            $temp['coin'] = $bangumi['stat']['coin'];

            //分数
            $temp['score'] = $bangumi['rating']['score'];

            //进度
            if ($total == 0) {
                $percent = 0;
            } else {
                $percent = floor($ep * 100 / $total);
            }
            $temp['progress'] = $percent;

            //最新
            $temp['new'] = array(
                'title' => '第' . $total . '话 ' . (isset($bangumi['new_ep']['long_title']) ? $bangumi['new_ep']['long_title'] : $bangumi['new_ep']['title']), //紫罗兰的永恒花园为例子,最后一集没有long_title
                'ep' => $total,
                'finish' => $bangumi['is_finish']
            );

            $ret[] = $temp;
            //循环尾 看清楚
        }
        return $ret;
    }

    private static function getSubstr($str, $leftStr, $rightStr)
    {
        $left = strpos($str, $leftStr);
        //echo '左边:'.$left;
        $right = strpos($str, $rightStr, $left);
        //echo '<br>右边:'.$right;
        if ($left < 0 or $right < $left) return '';
        return substr($str, $left + strlen($leftStr), $right - $left - strlen($leftStr));
    }
}