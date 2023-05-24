<?php
ob_clean(); ob_start();

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

// $storefront = (object) array(
// 	'version' => $storefront_version,

// 	/**
// 	 * Initialize all the things.
// 	 */
// 	'main'       => require 'inc/class-storefront.php',
// 	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
// );

// require 'inc/storefront-functions.php';
// require 'inc/storefront-template-hooks.php';
// require 'inc/storefront-template-functions.php';

/*--------------------------------------------------------------------------------------
 *
 * Includes das funções do site
 *
 *-------------------------------------------------------------------------------------*/
if( ! defined( 'FUNCTIONS_DIR' ) ) {
    define( 'FUNCTIONS_DIR', get_template_directory() . '/functions' );
}

if( ! defined( 'ODIN_CORE_DIR' ) ) {
    define( 'ODIN_CORE_DIR', get_template_directory() . '/core' );
}

if( ! defined( 'ODIN_CLASSES_DIR' ) ) {
    define( 'ODIN_CLASSES_DIR', ODIN_CORE_DIR . '/classes' );
}
function pietergoosen_theme_setup() {
    register_nav_menus( array( 
      'header' => 'Header menu', 
      'footer' => 'Footer menu' 
    ) );
   }
  
  add_action( 'after_setup_theme', 'pietergoosen_theme_setup' );
/**
 * Criação de páginas estáticas
 */
require_once FUNCTIONS_DIR . '/pages.php';

/**
 * Funções abstraídas para usar no WP
 */
require_once FUNCTIONS_DIR . '/abstract-functions.php';

/**
 * AquaResizer
 */
require_once ODIN_CLASSES_DIR . '/class-thumbnail-resizer.php';

/**
 * Includes do Odin para criação de CPT's, Metaboxes, Taxonomias, etc
 */
require_once ODIN_CLASSES_DIR . '/class-post-type.php';
require_once ODIN_CLASSES_DIR . '/class-metabox.php';
require_once ODIN_CLASSES_DIR . '/class-metabox-taxonomy.php';
require_once ODIN_CLASSES_DIR . '/class-taxonomy.php';
require_once ODIN_CLASSES_DIR . '/class-theme-options.php';
require_once ODIN_CLASSES_DIR . '/class-term-meta.php';





/*--------------------------------------------------------------------------------------
 *
 * Arquivos do tema
 *
 *-------------------------------------------------------------------------------------*/

require_once FUNCTIONS_DIR . '/taxonomies.php';
require_once FUNCTIONS_DIR . '/helpers.php';
require_once FUNCTIONS_DIR . '/custom-post-types.php';
require_once FUNCTIONS_DIR . '/classes.php';
require_once FUNCTIONS_DIR . '/controllers.php';
require_once FUNCTIONS_DIR . '/theme-options.php';

if( is_admin() ) {
    require_once FUNCTIONS_DIR . '/metaboxes.php';
}


/* Active SVG */
function cc_mime_types($mimes) {

    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
  load_theme_textdomain( 'villareal-marina', get_template_directory() . '/languages' );
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

ob_end_clean();