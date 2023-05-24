<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'translig_site_2020' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'translig_site_2020' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'K0VMdgaqU*68W723xY&$U' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '%&.N/h(78KyfgPgFWS8CABltAER4R<- oPEH5i:z8_2W~p[tSajO+LmPI8<-w~]!' );
define( 'SECURE_AUTH_KEY',  '??<2aGR`>9#={xl9n1<A]#Y8B,N|.gWs.|JV*@W<)dQn]EYT0`44~7s{:DTXW,}4' );
define( 'LOGGED_IN_KEY',    ',)lo=#1MY noRw@T;S;e=;W`c-if4Eq2SM*5Qr0]=,QL<|J:m*M]T>t(4kZK2aPy' );
define( 'NONCE_KEY',        '<e,xNt3|g@2b`1R8xY?B*Ctx0^R%GImV5ifzn7Uc[w0a=^nEE$`@]XTu|3<qH=t,' );
define( 'AUTH_SALT',        '=kU+;JwB$=$,8(pE}(%qjouW.jo=pJK1uTtD@+*xMpw<CoOC)5[^Y~?WzH5ZB`m ' );
define( 'SECURE_AUTH_SALT', 'u(@59EAA,x6ov7<TIuYaPMf8:D35N^]@rL>]R9lEP=%E(po%`ynoS.6rfFB4T$Nn' );
define( 'LOGGED_IN_SALT',   '=~`o.?ND.wAJa<I>-w6X8uiM^5+~1U-gra{RgXDjmih]gjhISPZ`$-}LxA_&`s,F' );
define( 'NONCE_SALT',       'DJoec.]d#D>5*UrDB3u[m?&3&& BAQv@yC.2LZ(0QS2~%HA6G&JmkKZ?KY~!.z$:' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'ZgKxhw_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
@ini_set( 'upload_max_size' , '20M' );
@ini_set( 'post_max_size', '13M');
@ini_set( 'memory_limit', '15M' );

define('WP_DEBUG', false);
define('SAVEQUERIES', true);

define('WP_MEMORY_LIMIT', '512M');

define( 'DISALLOW_FILE_EDIT', true );

define('FS_METHOD','direct');

/** Setando URLs para não consultar a base em busca delas */
define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME'] . '/novo');
define('WP_SITEURL', WP_HOME);

/** Alterando localização do diretório wp-content */
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/novo/site');
define('WP_CONTENT_URL', WP_HOME . '/site');

/** Alterando localização do diretório de plugins */
define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');

define('UPLOADS', 'site/' . 'uploads');

/** Para que o Contact Form 7 não adicione tags br ou p nos formulários de contato **/
define ('WPCF7_AUTOP', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');