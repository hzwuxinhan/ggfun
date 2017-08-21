<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'mysql');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', '');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{,<dn^w!u]JMQc&Qed%ff`H]r!2|fUyin8(6!ZyxsC/L4cw^!B:[Xb59~#~-IS}$');
define('SECURE_AUTH_KEY',  'Fm(mPq(oW#XW8:ec<_OE+,@]jY@Atbc2_vH:{:]/V&Ex6+;S{BwKkcBJHhvNi}~U');
define('LOGGED_IN_KEY',    'f?.3|KJDSTjgg-Kpce^*ry=CUkI{$]-O<Yr=+%R.:R{eE!&U$#e>y1i>Bn0E40m}');
define('NONCE_KEY',        'QbIy1VU^4N)7#HH,YbJ,|&{3@7ftn;d1}=T=ZRM1yJtYf-BO`dZ?MJ<WvJCy{B8a');
define('AUTH_SALT',        'JY~lK#;tPTtWEG5&z,?u1I`FS[gNz&H4aRIUVJ&34<a=<4>{v*rCb{HdGt9>1LSw');
define('SECURE_AUTH_SALT', 'N$ls1j1ceNj}VQy#}|u0trCT|wHU-!z.JZgKLEKNX9&9+R^&*JZ@ENk1T.<*ldwh');
define('LOGGED_IN_SALT',   'N^%nIx8DA}~3 m{|8D>D7PP<$lU7</$r{4;~/FnA8gIa3b#>Qg1h+m,S]Ex}<6?S');
define('NONCE_SALT',       '4,K$X,!_}PhN>L{4e%X45%hJ7$+c$iV]3Lk+Zgua_&le|z)i63tP>CCx/4@z]v[/');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_2_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
