<?php namespace Poppy\Framework\Helper;

/**
 * 功能函数类
 */
class UtilHelper
{
    /**
     * 计算某个经纬度的周围某段距离的正方形的四个点
     * @param float $lng      经度
     * @param float $lat      纬度
     * @param float $distance 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
     * @return array 正方形的四个点的经纬度坐标
     */
    public function squarePoint($lng, $lat, $distance = 0.5): array
    {
        //地球半径，平均半径为6371km
        $EARTH_RADIUS = 6371;
        $dlng         = 2 * asin(sin($distance / (2 * $EARTH_RADIUS)) / cos(deg2rad($lat)));
        $dlng         = rad2deg($dlng);

        $dlat = $distance / $EARTH_RADIUS;
        $dlat = rad2deg($dlat);

        //使用此函数计算得到结果后，带入sql查询。
        // $info_sql = "select id,locateinfo,lat,lng from `lbs_info` where lat<>0 and lat> {$squares['right-bottom']['lat']} and lat<{$squares['left-top']['lat']} and lng>{$squares['left-top']['lng']} and lng<{$squares['right-bottom']['lng']}";
        return [
            'left-top'     => ['lat' => $lat + $dlat, 'lng' => $lng - $dlng],
            'right-top'    => ['lat' => $lat + $dlat, 'lng' => $lng + $dlng],
            'left-bottom'  => ['lat' => $lat - $dlat, 'lng' => $lng - $dlng],
            'right-bottom' => ['lat' => $lat - $dlat, 'lng' => $lng + $dlng],
        ];
    }

    /**
     * 检测是否email
     * @param string $email Email address
     * @return bool
     */
    public static function isEmail(string $email): bool
    {
        return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
    }

    /**
     * 是不是url地址
     * @param string $url url address
     * @return false|int
     */
    public static function isUrl(string $url)
    {
        return preg_match('/^http(s?):\/\/.*/', $url);
    }

    /**
     * 检测是否搜索机器人.
     * @return bool
     */
    public static function isRobot(): bool
    {
        if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], '://') === false && preg_match('/(MSIE|Netscape|Opera|Konqueror|Mozilla)/i', $_SERVER['HTTP_USER_AGENT'])) {
            return false;
        }

        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(Spider|Bot|Crawl|Slurp|lycos|robozilla)/i', $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        }

        return false;
    }

    /**
     * 检测IP的匹配
     * @param string $ip 是否是IPv4
     * @return int
     */
    public static function isIp($ip)
    {
        return preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $ip);
    }

    /**
     * 是否是md5, 检测是否32位数字字母的组合
     * @param string $str string
     * @return int
     */
    public static function isMd5(string $str)
    {
        return preg_match('/^[a-z0-9]{32}$/', $str);
    }

    /**
     * 文件是否是图像
     * @param string $filename 文件名是否是图像
     * @return bool
     */
    public static function isImage(string $filename): bool
    {
        return (bool) preg_match('/^(jpg|jpeg|gif|png|bmp)$/i', FileHelper::ext($filename));
    }

    /**
     * 是否是正确的手机号码
     * @url https://regex101.com/r/gO3lJ7/1
     * @param string $mobile 手机号
     * @return int
     */
    public static function isMobile(string $mobile)
    {
        return preg_match("/^(\+86)?1(3|4|5|6|8|7|9)[0-9]\d{8}$/i", $mobile);
    }

    /**
     * 联系方式
     * @param string $telephone 电话号码
     * @return int
     */
    public static function isTelephone(string $telephone)
    {
        //return preg_match("/^[0-9\-\+]{7,}$/", $telephone);
        //return preg_match("/^(\(\d{3,4}-)|\d{3.4}-)?\d{7,8}$/", $telephone);
        return preg_match("/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/", $telephone);
    }

    /**
     * 是否全部为中文, 并且验证长度
     * @param string $str 字串
     * @return int
     */
    public static function isChinese(string $str)
    {
        $re = '/^[\\x{4e00}-\\x{9fa5}]{1,}$/u';

        return preg_match($re, $str, $matches);
    }

    /**
     * 验证身份证号 , 身份证有效性检测
     * @param string $id_card 身份证号码
     * @return bool
     */
    public static function isChId(string $id_card): bool
    {
        if (strlen($id_card) === 18) {
            return self::idcardChecksum18($id_card);
        }

        if (strlen($id_card) === 15) {
            $id = self::idcard15to18($id_card);

            return self::idcardChecksum18($id);
        }

        return false;
    }

    /**
     * 是否是标准的银行账号
     * // todo
     * @param string $bank_account 银行账号
     * @return bool
     */
    public static function isBankNumber(string $bank_account): bool
    {
        $bank = str_replace(' ', '', $bank_account);

        return (bool) preg_match('/^[0-9]{16,19}$/', $bank);
    }

    /**
     * 检测是否含有空格符
     * @param string $value 需要检测的字串
     * @return bool
     */
    public static function hasSpace(string $value): bool
    {
        return (bool) preg_match('/\s+/', $value);
    }

    /**
     * 是否是单词, 不包含空格, 仅仅是字母组合
     * @param string $letter 检测是否单词
     * @return bool
     */
    public static function isWord(string $letter)
    {
        $letter_match = preg_match('/^[A-Za-z]+$/', $letter);
        return !(empty($letter_match) || strlen($letter) > 1);
    }

    /**
     * 检测代码中是否含有 html 标签
     * @param string $content string
     * @return int
     */
    public static function hasTag(string $content)
    {
        return preg_match('/<[^>]+>/', $content, $matches);
    }

    /**
     * 格式化小数, 也可以用于货币的格式化
     * @param string $input     value
     * @param bool   $sprinft   是否格式化
     * @param int    $precision 保留小数
     * @return float|string
     */
    public static function formatDecimal(string $input, $sprinft = true, $precision = 2)
    {
        $var = round((float) $input, $precision);
        if ($sprinft) {
            $var = sprintf('%.' . $precision . 'f', $var);
        }

        return $var;
    }

    /**
     * 修复链接地址, 如果没有 :// 则补齐
     * @param string $url string
     * @return string
     */
    public static function fixLink(string $url): string
    {
        if (strlen($url) < 10) {
            return '';
        }

        return strpos($url, '://') === false ? 'http://' . $url : $url;
    }

    /**
     * 18位身份证校验码有效性检查
     * @param string $idcard 18 位身份证号码
     * @return bool
     */
    public static function idcardChecksum18(string $idcard)
    {
        if (strlen($idcard) !== 18) {
            return false;
        }
        $idcard_base = substr($idcard, 0, 17);
        return !(self::idcardVerify($idcard_base) !== strtoupper(substr($idcard, 17, 1)));
    }

    /**
     * 计算给定 字串/数组 的 md5 的值, 支持多个参数传入
     * @param string|array $str need md5 string
     * @return string
     */
    public static function md5($str): string
    {
        $key = '';
        foreach (func_get_args() as $v) {
            $key .= is_array($v) ? serialize($v) : $v;
        }

        return md5($key);
    }

    /**
     * 生成递归数列
     * @param array|object $items 条目
     * @param string       $id    id键
     * @param string       $pid   父级元素
     * @param string       $son   子元素
     * @return array        返回的排序好的数组
     */
    public static function genTree($items, $id = 'id', $pid = 'pid', $son = 'children')
    {
        $items = self::objToArray($items);

        $tree   = []; //格式化的树
        $tmpMap = [];  //临时扁平数据

        foreach ($items as $item) {
            $itemId          = $item[$id];
            $tmpMap[$itemId] = $item;
        }

        foreach ($items as $item) {
            $itemPid = $item[$pid];
            $itemId  = $item[$id];
            if (isset($tmpMap[$itemPid])) {
                if (!isset($tmpMap[$itemPid][$son]) || !is_array($tmpMap[$itemPid][$son])) {
                    $tmpMap[$itemPid][$son] = [];
                }
                $tmpMap[$itemPid][$son][] = &$tmpMap[$itemId];
            }
            else {
                $tree[] = &$tmpMap[$itemId];
            }
        }
        unset($tmpMap);

        return $tree;
    }

    /**
     * 对象到数组
     * @param object|array $obj 需要转换的对象
     * @return array
     */
    public static function objToArray($obj)
    {
        $arr = json_decode(json_encode($obj), true);
        foreach ($arr as $k => $v) {
            if (is_object($v)) {
                $arr[$k] = self::objToArray($v);
            }
        }

        return $arr;
    }

    /**
     * 生成 提示信息
     * @param string       $type    type
     * @param string       $message message
     * @param string|array $append  append
     * @return array
     */
    public static function genSplash($type = 'success', $message = '', $append = '')
    {
        if ($type === 'success' && !$message) {
            $message = '操作成功';
        }
        if ($type === 'error' && !$message) {
            $message = '操作失败';
        }
        $data = [
            'status' => $type,
            'msg'    => $message,
        ];
        if (is_array($append)) {
            $data = array_merge($data, $append);
        }
        elseif (is_string($append)) {
            $arr_append = StrHelper::parseKey($append);
            if ($arr_append) {
                $data = array_merge($data, $arr_append);
            }
        }

        return $data;
    }

    /**
     * 返回 sql 中存储的时间信息.
     * @param int|null $time time
     * @return bool|string
     */
    public static function sqlTime($time = null)
    {
        if (!$time) {
            $time = EnvHelper::time();
        }

        return date('Y-m-d H:i:s', $time);
    }

    /**
     * check bom
     * @param string     $basedir basedir
     * @param bool|false $remove  remove
     * @deprecated  这个函数可以去掉了. 现在基本不存在有 bom 的情况了
     */
    public static function checkBom(string $basedir, $remove = false)
    {
        set_time_limit(0);
        if (!file_exists($basedir)) {
            die('No director "' . $basedir . '"');
        }
        if ($dh = opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file !== '.' && $file !== '..' && $file !== '.git' && $file !== '.htaccess' && $file !== '.idea') {
                    if (!is_dir($basedir . '/' . $file)) {
                        $ext = FileHelper::ext($file);
                        if (!in_array($ext, ['jpg', 'gif', 'png'])) {
                            echo "filename: {$basedir}/{$file} &nbsp; " . self::checkFileBom("$basedir/$file", $remove) . ' <br>';
                            ob_flush();
                            flush();
                        }
                    }
                    else {
                        $dirname = $basedir . '/' . $file;
                        self::checkBom($dirname, $remove);
                    }
                }
            }
            closedir($dh);
        }
    }

    /**
     * 检测目录文件 utf8 状态
     * @param string $basedir basedir
     */
    public static function checkUtf8(string $basedir)
    {
        if ($dh = opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file !== '.' && $file !== '..' && $file !== '.git' && $file !== '.htaccess' && $file !== '.idea') {
                    if (!is_dir($basedir . '/' . $file)) {
                        $ext = FileHelper::ext($file);
                        if (!in_array($ext, ['jpg', 'gif', 'png', 'psd', 'ttf', 'ico', 'swf', 'csv', 'xdb', 'dat', 'fla', 'db', 'cur', 'phar', 'bat'])) {
                            echo "filename: {$basedir}/{$file} &nbsp; " . self::isUtf8("$basedir/$file") . ' <br>';
                            ob_flush();
                            flush();
                        }
                    }
                    else {
                        $dirname = $basedir . '/' . $file;
                        self::checkUtf8($dirname);
                    }
                }
            }
            closedir($dh);
        }
    }

    /**
     * 转换成小时
     * @param int $hour hour
     * @param int $day  day num
     * @return int
     */
    public static function toHour(int $hour, $day = 0): int
    {
        return (int) $day * 24 + (int) $hour;
    }

    /**
     * 格式化文件大小
     * @param int $bytes     长度
     * @param int $precision 分数
     * @return string
     */
    public static function formatBytes(int $bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow   = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow   = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= 1024 ** $pow;
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * 检测是不是正规版本号
     * @param string $version 版本
     * @return int
     */
    public static function isVersion(string $version)
    {
        return preg_match("/\d\.\d\..+/", $version);
    }

    /**
     * 根据两点间的经纬度计算距离
     * @param float|int $lng1 lng1
     * @param float|int $lat1 lat1
     * @param float|int $lng2 lng2
     * @param float|int $lat2 lat2
     * @return string
     */
    public static function getDistance($lng1, $lat1, $lng2, $lat2): string
    {
        //将角度转为狐度
        $radLat1 = deg2rad($lat1);//deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a       = $radLat1 - $radLat2;
        $b       = $radLng1 - $radLng2;
        $s       = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137;

        return round($s, 2) . 'km';
    }

    /**
     * guid 生成函数
     * @return string
     */
    public static function guid(): string
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        }

        mt_srand((float) microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid   = chr(123) // "{"
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12)
            . chr(125); // "}"
        return $uuid;
    }

    /**
     * 检测是否是有效的json数据格式
     * @param mixed $string string
     * @return bool
     */
    public static function isJson($string): bool
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * 检测是否是有效的日期格式
     * @param string $string string
     * @return bool
     */
    public static function isDate(string $string): bool
    {
        [$year, $month, $day] = explode('-', $string);

        return checkdate($month, $day, $year);
    }

    /**
     * 是否是密码
     * @param string $pwd pwd
     * @return bool
     */
    public static function isPwd(string $pwd): bool
    {
        if (preg_match('/([0-9a-zA-Z_\*\.\[\]\-!@#\$%\^&\(\)\~]+)/i', $pwd, $match)) {
            return $match[0] === $pwd;
        }

        return false;
    }

    /**
     * 是否是逗号隔开的数字字符串
     * @param string $str str
     * @return bool
     */
    public static function isComma(string $str): bool
    {
        if (preg_match('/^(\d+\,)+\d+$|^\d+$/i', $str)) {
            return true;
        }

        return false;
    }

    /**
     * 计算身份证校验码，根据国家标准GB 11643-1999
     * @param string $idcard_base idcard_base
     * @return string
     */
    private static function idcardVerify(string $idcard_base): string
    {
        if (strlen($idcard_base) !== 17) {
            return false;
        }
        //加权因子
        $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        //校验码对应值
        $verify_number_list = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        $checksum           = 0;
        for ($i = 0, $iMax = strlen($idcard_base); $i < $iMax; $i++) {
            $checksum += (int) substr($idcard_base, $i, 1) * $factor[$i];
        }
        $mod = $checksum % 11;
        return $verify_number_list[$mod];
    }

    /**
     * 将15位身份证升级到18位
     * @param string $idcard idcard
     * @return bool|string
     */
    private static function idcard15to18(string $idcard)
    {
        if (strlen($idcard) !== 15) {
            return false;
        }

        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if (array_search(substr($idcard, 12, 3), ['996', '997', '998', '999']) !== false) {
            $idcard = substr($idcard, 0, 6) . '18' . substr($idcard, 6, 9);
        }
        else {
            $idcard = substr($idcard, 0, 6) . '19' . substr($idcard, 6, 9);
        }

        $idcard .= self::idcardVerify($idcard);

        return $idcard;
    }

    /**
     * check if Utf8
     * @param string $filename filename
     * @return string
     */
    private static function isUtf8(string $filename): string
    {
        $info     = '<span style="color:red;">NOT UTF8 file</span>';
        $contents = file_get_contents($filename);
        if ($contents === mb_convert_encoding(mb_convert_encoding($contents, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32')) {
            $info = '<span>IS UTF8 file</span>';
        }

        return $info;
    }

    /**
     * _checkFileBom
     * @param string $file_name  文件名称
     * @param bool   $remove_bom 是否移除
     * @return string
     */
    private static function checkFileBom(string $file_name, $remove_bom = false): string
    {
        $info       = '<span>BOM Not Found</span>';
        $contents   = file_get_contents($file_name);
        $charset[1] = $contents[0];
        $charset[2] = $contents[1];
        $charset[3] = $contents[2];
        if (ord($charset[1]) === 239 && ord($charset[2]) === 187 && ord($charset[3]) === 191) {
            if ($remove_bom) {
                $rest = substr($contents, 3);
                file_put_contents($file_name, $rest);
                $info = '<span style="color:red;">BOM found, automatically removed..</span>';
            }
            else {
                $info = '<span style="color:red;">BOM found.</span>';
            }
        }

        return $info;
    }
}