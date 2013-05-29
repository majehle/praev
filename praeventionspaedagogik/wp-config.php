<?php
/**
 * In dieser Datei werden die Grundeinstellungen für WordPress vorgenommen.
 *
 * Zu diesen Einstellungen gehören: MySQL-Zugangsdaten, Tabellenpräfix,
 * Secret-Keys, Sprache und ABSPATH. Mehr Informationen zur wp-config.php gibt es auf der {@link http://codex.wordpress.org/Editing_wp-config.php
 * wp-config.php editieren} Seite im Codex. Die Informationen für die MySQL-Datenbank bekommst du von deinem Webhoster.
 *
 * Diese Datei wird von der wp-config.php-Erzeugungsroutine verwendet. Sie wird ausgeführt, wenn noch keine wp-config.php (aber eine wp-config-sample.php) vorhanden ist,
 * und die Installationsroutine (/wp-admin/install.php) aufgerufen wird.
 * Man kann aber auch direkt in dieser Datei alle Eingaben vornehmen und sie von wp-config-sample.php in wp-config.php umbenennen und die Installation starten.
 *
 * @package WordPress
 */

/**  MySQL Einstellungen - diese Angaben bekommst du von deinem Webhoster. */
/**  Ersetze database_name_here mit dem Namen der Datenbank, die du verwenden möchtest. */
define('DB_NAME', 'db390494662');

/** Ersetze username_here mit deinem MySQL-Datenbank-Benutzernamen */
define('DB_USER', 'dbo390494662');

/** Ersetze password_here mit deinem MySQL-Passwort */
define('DB_PASSWORD', 'bienemaja');

/** Ersetze localhost mit der MySQL-Serveradresse */
define('DB_HOST', 'db390494662.db.1and1.com');

/** Der Datenbankzeichensatz der beim Erstellen der Datenbanktabellen verwendet werden soll */
define('DB_CHARSET', 'utf8');

/** Der collate type sollte nicht geändert werden */
define('DB_COLLATE', '');

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden KEY in eine beliebige, möglichst einzigartige Phrase. 
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service} kannst du dir alle KEYS generieren lassen.
 * Bitte trage für jeden KEY eine eigene Phrase ein. Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten Benutzer müssen sich danach erneut anmelden.
 *
 * @seit 2.6.0
 */
define('AUTH_KEY',         'I&47]SAf|sPAAdCl VEos@sU,l-&$#@UVz&/<AM.,ihz,P+lR+xThEKH4zf1}#jU');
define('SECURE_AUTH_KEY',  '2IAiz]S6wj_o3I%37n/-D6yqtP UwQ%g}do)$UtS]ucYI|ft,%{1,dpnA(@PvH>u');
define('LOGGED_IN_KEY',    '+n:JyZf5F>4pR[+0nWwj;]9LV+7v-Lj:H[ F|#2]rq#uq0_A^c8[f<,S0kDL6~dn');
define('NONCE_KEY',        'gE5tAB=1^j}R3B2l:zOkWhyUJ;^G8lNhyLvEv7-RfXA,L+9~:mFn8*h^,7VvY_Fr');
define('AUTH_SALT',        'mcl*8QrEB0l+GUQ;#ObT-t0%&]uC/]j:B-]Bw_ty!pY:COcWGyhn?Iwe1xIyx#x;');
define('SECURE_AUTH_SALT', 'QDdh:w!WK+E`|yUGveh^LZN=-2o=e,<-m_&3RNw>cu?e(HF9.}#bw#%=LK]P{w~Q');
define('LOGGED_IN_SALT',   '@%-.X-1F.eo7At`ukZub dg/u+tre~+^IzTKW4I%Bq%*g@XMMo?0t+09.`+~%BkT');
define('NONCE_SALT',       'w$$?v{hE_t59{D!=|:P|Xi7 90cTw(Rvk<<|C^XV&fm<7EHj6ibi]z$151?Y{q7y');

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 *  Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 *  verschiedene WordPress-Installationen betreiben. Nur Zahlen, Buchstaben und Unterstriche bitte!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Sprachdatei
 *
 * Hier kannst du einstellen, welche Sprachdatei benutzt werden soll. Die entsprechende
 * Sprachdatei muss im Ordner wp-content/languages vorhanden sein, beispielsweise de_DE.mo
 * Wenn du nichts einträgst, wird Englisch genommen.
 */
define('WPLANG', 'de_DE');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');