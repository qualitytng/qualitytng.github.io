<?php
/**
 * @package     Quality TNG
 * @link        http://chienplus.info
 * @copyright   Copyright (C) 2017-2019 QCS Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      http://johncms.com/about
 */

defined('_TNG_20') or die('Error: restricted access');

$headmod = isset($headmod) ? mysql_real_escape_string($headmod) : '';
$textl = isset($textl) ? $textl : $set['copyright'];
$keywords = isset($keywords) ? htmlspecialchars($keywords) : $set['meta_key'];
$description = isset($description) ? htmlspecialchars($description) : $set['meta_desc'];
//thanh vien
if ($user_id) {
   echo'<!DOCTYPE html>' .
    "\n" . '<html lang="' . core::$lng_iso . '">' .
    "\n" . '<head>' .
    "\n" . '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' .
    "\n" . '<meta name="apple-mobile-web-app-capable" content="yes">' .
    "\n" . '<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />' .
    "\n" . '<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">' .
    "\n" . '<meta name="keywords" content="' . $keywords . '">'.
    "\n" . '<link rel="stylesheet" type="text/css" href="'. $set['homeurl'] .'/styles/dn/style.css">'.
    "\n" . '<link rel="<link rel="stylesheet" type="text/css" href="' . $set['homeurl'] .'/styles/dn/framework.css">' .
	"\n" . '<link rel="stylesheet" type="text/css" href="'. $set['homeurl'] .'/app/fonts/css/fontawesome-all.min.css">  ' .
	"\n" . '<link rel="shortcut icon" href="' . $set['homeurl'] . '/favicon.ico">' .
    "\n" . '<link rel="alternate" type="application/rss+xml" title="RSS | ' . $lng['site_news'] . '" href="' . $set['homeurl'] . '/rss/rss.php">' .
    "\n" . '<title>' . $textl . '</title>' .
    "\n" . '</head><div id="page-preloader">
    <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
</div>
    ';
	        
	echo'<div id="page">
	<div class="header header-fixed header-logo-app">
        <a href="#" class="header-title ultrabold"><span class="color-highlight">Q</span>  CS</a>
		<a href="#" class="header-icon header-icon-1" data-menu="menu-1"><i class="fas fa-bars"></i></a>
        <a href="#" class="header-icon header-icon-2" data-menu="menu-2"><i class="fas fa-cog"></i></a>
        <a href="#" class="header-icon header-icon-3" data-toggle-theme><i class="fas fa-moon"></i></a>
	</div>
        
    <div id="menu-1" class="menu menu-box-left" 
         data-menu-width="250"
         data-menu-load="menu.html"
         data-menu-effect="menu-over"
         data-menu-select="page-home">
    </div>                
    ';
}
//khach
 else {
    echo'<!DOCTYPE html>' .
    "\n" . '<html lang="' . core::$lng_iso . '">' .
    "\n" . '<head>' .
    "\n" . '<meta charset="utf-8">' .
    "\n" . '<meta name="robots" content="index, follow">' .
    "\n" . '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' .
    "\n" . '<meta name="keywords" content="' . $keywords . '">'.
    "\n" . '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> ' .
    "\n" . '<meta name="description" content="' . $description . '">'.
    "\n" . '<link rel="stylesheet" href="' . $set['homeurl'] . '/styles/core.css">' .
	"\n" . '<link rel="stylesheet" href="' . $set['homeurl'] . '/styles/landing.css">' .
    "\n" . '<link rel="shortcut icon" href="' . $set['homeurl'] . '/favicon.ico">' .
    "\n" . '<link rel="alternate" type="application/rss+xml" title="RSS | ' . $lng['site_news'] . '" href="' . $set['homeurl'] . '/rss/rss.php">' .
    "\n" . '<title>' . $textl . '</title>' .
	'<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript"></script><script src="https://secure.comodo.com/trustlogo/javascript/trustlogo.js" type="text/javascript"></script><style type="text/css" media="screen">#comodoTL {display:block;font-size:8px;padding-left:18px;}</style>' .
    "\n" . '</head><body data-spy="scroll" data-target="#header" class="landing" style="">' . core::display_core_errors();
echo'<header id="header" class="navbar navbar-fixed-top affix-top" data-spy="affix" data-offset-top="1">
<div class="container">
<div class="navbar-brand"><img src="https://tngfashion.vn/image/catalog/LOGO/logowsok-02.png" width="130" height="25" alt="" align="left"/></div>
<p class="navbar-text pull-left text-muted hidden-xs"><small><em>Quality TNG Group</em></small></p>
<ul class="nav navbar-nav pull-right hidden-xs">
<li>
<a href="/">Trang chủ</a>
</li>
<li>
<a href="https://blog.wapmaker.net">Blog</a>
</li>
<li>
<a href="/dangky.html">Đăng kí</a>
</li>
<li>
<a href="/dangnhap.html">Đăng nhập</a>
</li>
</ul>
</div>
</header>';
}



/*
-----------------------------------------------------------------
Рекламный модуль
-----------------------------------------------------------------
*/
$cms_ads = array();
if (!isset($_GET['err']) && $act != '404' && $headmod != 'admin') {
    $view = $user_id ? 2 : 1;
    $layout = ($headmod == 'mainpage' && !$act) ? 1 : 2;
    $req = mysql_query("SELECT * FROM `cms_ads` WHERE `to` = '0' AND (`layout` = '$layout' or `layout` = '0') AND (`view` = '$view' or `view` = '0') ORDER BY  `mesto` ASC");
    if (mysql_num_rows($req)) {
        while (($res = mysql_fetch_assoc($req)) !== FALSE) {
            $name = explode("|", $res['name']);
            $name = htmlentities($name[mt_rand(0, (count($name) - 1))], ENT_QUOTES, 'UTF-8');
            if (!empty($res['color'])) $name = '<span style="color:#' . $res['color'] . '">' . $name . '</span>';
            // Если было задано начертание шрифта, то применяем
            $font = $res['bold'] ? 'font-weight: bold;' : FALSE;
            $font .= $res['italic'] ? ' font-style:italic;' : FALSE;
            $font .= $res['underline'] ? ' text-decoration:underline;' : FALSE;
            if ($font) $name = '<span style="' . $font . '">' . $name . '</span>';
            @$cms_ads[$res['type']] .= '<a href="' . ($res['show'] ? functions::checkout($res['link']) : $set['homeurl'] . '/go.php?id=' . $res['id']) . '">' . $name . '</a><br/>';
            if (($res['day'] != 0 && time() >= ($res['time'] + $res['day'] * 3600 * 24)) || ($res['count_link'] != 0 && $res['count'] >= $res['count_link']))
                mysql_query("UPDATE `cms_ads` SET `to` = '1'  WHERE `id` = '" . $res['id'] . "'");
        }
    }
}

/*
-----------------------------------------------------------------
Рекламный блок сайта
-----------------------------------------------------------------
*/
if (isset($cms_ads[0])) echo $cms_ads[0];

/*
-----------------------------------------------------------------
Выводим логотип и переключатель языков
-----------------------------------------------------------------
*/


/*
-----------------------------------------------------------------
Главное меню пользователя
-----------------------------------------------------------------
*/


/*
-----------------------------------------------------------------
Рекламный блок сайта
-----------------------------------------------------------------
*/
if (!empty($cms_ads[1])) echo '<div class="gmenu">' . $cms_ads[1] . '</div>';

/*
-----------------------------------------------------------------
Фиксация местоположений посетителей
-----------------------------------------------------------------
*/
$sql = '';
$set_karma = unserialize($set['karma']);
if ($user_id) {
    // Фиксируем местоположение авторизованных
    if (!$datauser['karma_off'] && $set_karma['on'] && $datauser['karma_time'] <= (time() - 86400)) {
        $sql .= " `karma_time` = '" . time() . "', ";
    }
    $movings = $datauser['movings'];
    if ($datauser['lastdate'] < (time() - 300)) {
        $movings = 0;
        $sql .= " `sestime` = '" . time() . "', ";
    }
    if ($datauser['place'] != $headmod) {
        ++$movings;
        $sql .= " `place` = '" . mysql_real_escape_string($headmod) . "', ";
    }
    if ($datauser['browser'] != $agn)
        $sql .= " `browser` = '" . mysql_real_escape_string($agn) . "', ";
    $totalonsite = $datauser['total_on_site'];
    if ($datauser['lastdate'] > (time() - 300))
        $totalonsite = $totalonsite + time() - $datauser['lastdate'];
    mysql_query("UPDATE `users` SET $sql
        `movings` = '$movings',
        `total_on_site` = '$totalonsite',
        `lastdate` = '" . time() . "'
        WHERE `id` = '$user_id'
    ");
} else {
    // Фиксируем местоположение гостей
    $movings = 0;
    $session = md5(core::$ip . core::$ip_via_proxy . core::$user_agent);
    $req = mysql_query("SELECT * FROM `cms_sessions` WHERE `session_id` = '$session' LIMIT 1");
    if (mysql_num_rows($req)) {
        // Если есть в базе, то обновляем данные
        $res = mysql_fetch_assoc($req);
        $movings = ++$res['movings'];
        if ($res['sestime'] < (time() - 300)) {
            $movings = 1;
            $sql .= " `sestime` = '" . time() . "', ";
        }
        if ($res['place'] != $headmod) {
            $sql .= " `place` = '" . mysql_real_escape_string($headmod) . "', ";
        }
        mysql_query("UPDATE `cms_sessions` SET $sql
            `movings` = '$movings',
            `lastdate` = '" . time() . "'
            WHERE `session_id` = '$session'
        ");
    } else {
        // Если еще небыло в базе, то добавляем запись
        mysql_query("INSERT INTO `cms_sessions` SET
            `session_id` = '" . $session . "',
            `ip` = '" . core::$ip . "',
            `ip_via_proxy` = '" . core::$ip_via_proxy . "',
            `browser` = '" . mysql_real_escape_string($agn) . "',
            `lastdate` = '" . time() . "',
            `sestime` = '" . time() . "',
            `place` = '" . mysql_real_escape_string($headmod) . "'
        ");
    }
}

/*
-----------------------------------------------------------------
Выводим сообщение о Бане
-----------------------------------------------------------------
*/
if (!empty($ban)) echo '<div class="alarm">' . $lng['ban'] . '&#160;<a href="' . $set['homeurl'] . '/users/profile.php?act=ban">' . $lng['in_detail'] . '</a></div>';

/*
-----------------------------------------------------------------
Ссылки на непрочитанное
-----------------------------------------------------------------
*/
if ($user_id) {
    $list = array();
    $new_sys_mail = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE `from_id`='$user_id' AND `read`='0' AND `sys`='1' AND `delete`!='$user_id';"), 0);
	if ($new_sys_mail) $list[] = '<a href="' . $home . '/mail/index.php?act=systems">Система</a> (+' . $new_sys_mail . ')';
	$new_mail = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' WHERE `cms_mail`.`from_id`='$user_id' AND `cms_mail`.`sys`='0' AND `cms_mail`.`read`='0' AND `cms_mail`.`delete`!='$user_id' AND `cms_contact`.`ban`!='1' AND `cms_mail`.`spam`='0'"), 0);
	if ($new_mail) $list[] = '<a href="' . $home . '/mail/index.php?act=new">' . $lng['mail'] . '</a> (+' . $new_mail . ')';
    if ($datauser['comm_count'] > $datauser['comm_old']) $list[] = '<a href="' . core::$system_set['homeurl'] . '/users/profile.php?act=guestbook&amp;user=' . $user_id . '">' . $lng['guestbook'] . '</a> (' . ($datauser['comm_count'] - $datauser['comm_old']) . ')';
    $new_album_comm = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_album_files` WHERE `user_id` = '" . core::$user_id . "' AND `unread_comments` = 1"), 0);
    if ($new_album_comm) $list[] = '<a href="' . core::$system_set['homeurl'] . '/users/album.php?act=top&amp;mod=my_new_comm">' . $lng['albums_comments'] . '</a>';

    if (!empty($list)) echo '<div class="rmenu">' . $lng['unread'] . ': ' . functions::display_menu($list, ', ') . '</div>';
}
