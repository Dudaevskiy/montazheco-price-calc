<?php

//Download and Insert a Remote Image File into the WordPress Media Library
//https://kellenmace.com/download-insert-remote-image-file-wordpress-media-library/
// Require the file that contains the KM_Download_Remote_Image class.

// Подключаем в основном файле плагина
// require_once plugin_dir_path( __FILE__ ) . '_WORKER.php';
// Заменяем redux_sds_upd_data_year_posts на свой слаг плагина
// Заменяем sds-montazheco-price-calc на свой слаг плагина

//https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js

$plugin_name = SDStudioPluginName();
$plugin_version = SDStudioPluginVersion();

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
$MarkdownParser = new \cebe\markdown\Markdown();
// Markdown to PDF
// https://www.markdowntopdf.com/
$FAQ = $MarkdownParser->parse( file_get_contents(dirname(__FILE__) . '/__FAQ.md') );
//dd($FAQ);

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if ( !function_exists( 'run_prettify' ) ){

    add_action( 'wp_enqueue_scripts', 'run_prettify' );
    function run_prettify(){
        wp_enqueue_script( 'run_prettify', 'https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js');
    }
}

////==========================================
////==========================================
//// Подключаем Redux
/// //**** 2021 ****//
if ( ! class_exists( 'ReduxFrameworkInstances' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
    require_once plugin_dir_path( __FILE__ ) . 'wp-content/plugins/redux-framework-4/redux-core/framework.php';
}

if ( ! class_exists( 'Redux' ) ) {
    // 🔴 dd('Если я отображаюсь значит Redux не подключился');
    return null;
}
////==========================================
////==========================================
///
///
//-----------------------------------------
// REMOVE DEMO and PROMO REDUX
// START
//-----------------------------------------
/**
 * Disable Redux Developer Mode dev_mode
 * https://asique.net/disable-redux-framework-developer-mode-dev_mode/
 * START
 */

if ( !function_exists( 'redux_disable_dev_mode_plugin' ) ) {

    function redux_disable_dev_mode_plugin( $redux ) {
        if ( $redux->args[ 'opt_name' ] != 'redux_demo' ) {
            $redux->args[ 'dev_mode' ] = false;
            $redux->args[ 'forced_dev_mode_off' ] = false;
        }
    }

    add_action( 'redux/construct', 'redux_disable_dev_mode_plugin' );
}

if ( !function_exists( 'gl_removeDemoModeLink' ) ) {
    function gl_removeDemoModeLink() {
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', [ ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks' ], null, 2 );
        }
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_action( 'admin_notices', [ ReduxFrameworkPlugin::get_instance(), 'admin_notices' ] );
        }
    }
    add_action( 'init', 'gl_removeDemoModeLink' );
}


/**
 * END
 * Disable Redux Developer Mode dev_mode
 */
add_action( 'redux/loaded', 'remove_demo' );


/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 * https://forums.envato.com/t/how-to-remove-redux-framework-notice/62645/4
 * START
 */
if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', [
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ], null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', [ ReduxFrameworkPlugin::instance(), 'admin_notices' ] );
        }
    }
}
/**
 * END
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 * https://forums.envato.com/t/how-to-remove-redux-framework-notice/62645/4
 */

/**
 * https://docs.reduxframework.com/core/the-basics/removing-demo-mode-and-notices/
 * START
 */
if ( ! function_exists( 'removeDemoModeLink' ) ) {
    function removeDemoModeLink() { // Be sure to rename this function to something more unique
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', [ ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'], null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', [ ReduxFrameworkPlugin::get_instance(), 'admin_notices' ] );
        }
    }
    add_action('init', 'removeDemoModeLink');
}
/**
 * END
 * https://docs.reduxframework.com/core/the-basics/removing-demo-mode-and-notices/
 */
//-----------------------------------------
// END
// REMOVE DEMO and PROMO REDUX
//-----------------------------------------



// This is your option name where all the Redux data is stored.
//dd($opt_name__redux_sds_montazheco_price_calc);
$opt_name__redux_sds_montazheco_price_calc = 'redux_sds_montazheco_price_calc';
//Redux::init($opt_name__redux_sds_montazheco_price_calc);
/**
 * GLOBAL ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: @link https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 */

/**
 * ---> BEGIN ARGUMENTS
 */


$args = [
    // REQUIRED!!  Change these values as you need/desire.
    'opt_name'                  => $opt_name__redux_sds_montazheco_price_calc,

    // Name that appears at the top of your panel.
    'display_name'              => SDStudioPluginName(),

    // Version that appears at the top of your panel.
    'display_version'           => SDStudioPluginVersion(),

    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
    'menu_type'                 => 'menu',

    // Show the sections below the admin menu item or not.
    'allow_sub_menu'            => true,

    'menu_title'                => SDStudioPluginName(),
    'page_title'                => SDStudioPluginName(),

    // Specify a custom URL to an icon.
    'menu_icon'                 => 'dashicons-admin-tools',

    // Use a asynchronous font on the front end or font string.
    'async_typography'          => true,

    // Disable this in case you want to create your own google fonts loader.
    'disable_google_fonts_link' => false,

    // Show the panel pages on the admin bar.
    'admin_bar'                 => false,

    // Choose an icon for the admin bar menu.
    'admin_bar_icon'            => 'dashicons-calculator',

    // Choose an priority for the admin bar menu.
    'admin_bar_priority'        => 50,

    // Set a different name for your global variable other than the opt_name.
    'global_variable'           => '',

    // Show the time the page took to load, etc.
    'dev_mode'                  => false,

    // Enable basic customizer support.
    'customizer'                => true,

    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_priority'             => null,

    // For a full list of options, visit: @link http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
    'page_parent'               => 'themes.php',

    // Permissions needed to access the options panel.
    'page_permissions'          => 'manage_options',


    // Force your panel to always open to a specific tab (by id).
    'last_tab'                  => '',

    // Icon displayed in the admin panel next to your menu_title.
    'page_icon'                 => 'icon-themes',

    // Page slug used to denote the panel.
    'page_slug'                 => 'sds-montazheco-price-calc',

    // On load save the defaults to DB before user clicks save or not.
    'save_defaults'             => true,

    // If true, shows the default value next to each field that is not the default value.
    'default_show'              => false,

    // What to print by the field's title if the value shown is default. Suggested: *.
    'default_mark'              => '',

    // Shows the Import/Export panel when not used as a field.
    'show_import_export'        => true,

    // CAREFUL -> These options are for advanced use only.
    'transient_time'            => 60 * MINUTE_IN_SECONDS,

    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
    'output'                    => true,

    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head.
    'output_tag'                => true,

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'database'                  => '',

    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    'use_cdn'                   => true,
    'compiler'                  => true,

    // HINTS.
    'hints'                     => [
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => [
            'color'   => 'light',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ],
        'tip_position'  => [
            'my' => 'top left',
            'at' => 'bottom right',
        ],
        'tip_effect'    => [
            'show' => [
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ],
            'hide' => [
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ],
        ],
    ],
];

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = [
    'id'    => 'redux-docs',
    'href'  => '//docs.reduxframework.com/',
    'title' => esc_html__( 'Documentation', 'montazheco-price-calc' ),
];

$args['admin_bar_links'][] = [
    'id'    => 'redux-support',
    'href'  => '//github.com/ReduxFramework/redux-framework/issues',
    'title' => esc_html__( 'Support', 'montazheco-price-calc' ),
];

$args['admin_bar_links'][] = [
    'id'    => 'redux-extensions',
    'href'  => 'reduxframework.com/extensions',
    'title' => esc_html__( 'Extensions', 'montazheco-price-calc' ),
];

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
// Social URLs
$SDStudio_github_com = 'https://github.com/Dudaevskiy';
$SDStudio_facebook_com = 'https://www.facebook.com/WebSDStudio/';
$SDStudio_site = '//sdstudio.top/';
$SDStudio_linkedin_com = 'https://www.linkedin.com/public-profile/settings?trk=d_flagship3_profile_self_view_public_profile&lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_self_edit_contact_info%3BhWD%2Fwa9lSmWLHB9H6SsiWA%3D%3D';
// http://elusiveicons.com/icons/
$args['share_icons'][] = [
//    'url'   => 'https://github.com/Dudaevskiy',
    'url'   => $SDStudio_github_com,
    'title' => 'Visit us on GitHub',
    'target' => '_blank',
    'icon'  => 'el el-github',
];
$args['share_icons'][] = [
//    'url'   => 'https://www.facebook.com/WebSDStudio/',
    'url'   => $SDStudio_facebook_com,
    'title' => esc_html__( 'Like us on Facebook', 'sds-options-and-settings' ),
    'target' => '_blank',
    'icon'  => 'el el-facebook',
];
$args['share_icons'][] = [
//    'url'   => '//sdstudio.top/',
    'url'   => $SDStudio_site,
    'title' => esc_html__( 'Website', 'sds-options-and-settings' ),
    'target' => '_blank',
    'icon'  => 'el el-home',
];
$args['share_icons'][] = [
//    'url'   => 'https://www.linkedin.com/public-profile/settings?trk=d_flagship3_profile_self_view_public_profile&lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_self_edit_contact_info%3BhWD%2Fwa9lSmWLHB9H6SsiWA%3D%3D',
    'url'   => $SDStudio_linkedin_com,
    'title' => esc_html__( 'FInd us on LinkedIn', 'sds-options-and-settings' ),
    'target' => '_blank',
    'icon'  => 'el el-linkedin',
];

// Panel Intro text -> before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
    if ( ! empty( $args['global_variable'] ) ) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace( '-', '_', $args['opt_name'] );
    }
//    $args['intro_text'] = '<p>' . sprintf( __( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $s', 'montazheco-price-calc' ) . '</p>', '<strong>' . $v . '</strong>' );
} else {
//    $args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'montazheco-price-calc' ) . '</p>';
}

// Add content after the form.
//$args['footer_text'] = '<p>' . esc_html__( 'This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', 'montazheco-price-calc' ) . '</p>';

Redux::set_args( $opt_name__redux_sds_montazheco_price_calc, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> BEGIN HELP TABS
 */

$help_tabs = [
    [
        'id'      => 'redux-help-tab-1',
        'title'   => esc_html__( 'Theme Information 1', 'montazheco-price-calc' ),
        'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'montazheco-price-calc' ) . '</p>',
    ],

    [
        'id'      => 'redux-help-tab-2',
        'title'   => esc_html__( 'Theme Information 2', 'montazheco-price-calc' ),
        'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'montazheco-price-calc' ) . '</p>',
    ],
];

Redux::set_help_tab( $opt_name__redux_sds_montazheco_price_calc, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'montazheco-price-calc' ) . '</p>';
Redux::set_help_sidebar( $opt_name__redux_sds_montazheco_price_calc, $content );

/*
 * <--- END HELP TABS
 */

/*
 *
 * ---> BEGIN SECTIONS
 *
 */

/* As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for. */

/* -> START Basic Fields. */

$kses_exceptions = [
    'a'      => [
        'href' => [],
    ],
    'strong' => [],
    'br'     => [],
];

$section = [
    'title'  => esc_html__( 'FAQ', 'sds-montazheco-price-calc-faq' ),
    'id'     => 'basic',
    'icon'   => 'el el-home',
];

Redux::set_section( $opt_name__redux_sds_montazheco_price_calc, $section );

$section = [
    'title' => __( 'FAQ', 'sds-montazheco-price-calcmontazheco-price-calc' ),
    'id'    => 'basic',
    // Смотрим файл __FAQ.md
    'desc'     => $FAQ,
    'icon'  => 'el el-home',
];

Redux::set_section( $opt_name__redux_sds_montazheco_price_calc, $section );

/**
 * UPDAE ALL POSTS
 * START
 *********************************/

$section = [
    'title' => __( 'Указать глобальные суммы', 'update-all-posts-sds-montazheco-price-calc' ),
    'id'    => 'posts_updater',
    'subsection' => false,
    'fields' => [


        // 1
        [
            //Link: https://docs.redux.io/core-fields/media.html
            'id'       => 'SUMMA_1_sds-montazheco-price-calc',
            'title' => __( 'Цена (Базовая, от) за метр', 'montazheco-price-calc' ),
            'type' => 'text',
            'placeholder' => 'Укажите сумму в рублях, например - 21000',
        ],

        // 2
        [
            //Link: https://docs.redux.io/core-fields/media.html
            'id'       => 'SUMMA_2_sds-montazheco-price-calc',
            'title' => __( 'Цена (Оптимальная) за метр', 'montazheco-price-calc' ),
            'type' => 'text',
            'placeholder' => 'Укажите сумму в рублях, например - 35000',
        ],

        // 3
        [
            //Link: https://docs.redux.io/core-fields/media.html
            'id'       => 'SUMMA_3_sds-montazheco-price-calc',
            'title' => __( 'Цена (Премиум) за метр', 'montazheco-price-calc' ),
            'type' => 'text',
            'placeholder' => 'Укажите сумму в рублях, например - 45000',
        ],


    ],
    'desc'  => __( 'Здесь указываются суммы из которырых будет отображена цена для каждого проекта. По формуле цена * на метры.', 'montazheco-price-calc' ),
    // Иконки брать здесь
    // http://elusiveicons.com/icons/
    'icon'  => 'el el-repeat-alt',
];

Redux::set_section( $opt_name__redux_sds_montazheco_price_calc, $section );


/*
 * <--- END SECTIONS
 */

//require_once plugin_dir_path( __FILE__ ) . '_sdstudio_controllers/redux-update-all-posts-JS-SCRIPT-aJax.php';

//require_once plugin_dir_path( __FILE__ ) . '_sdstudio_controllers/redux-update-all-posts.php';

/**
 * END
 * UPDAE ALL POSTS
 *********************************/


?>



<?php
/**
 * DEV
 */
// В данном случае обязательно используем wp-load
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
include_once(ABSPATH . 'wp-includes/pluggable.php');


















/**
 * Elementor Динамически генерируемая сума по формуле цена * метраж
 * https://developers.elementor.com/dynamic-tags/
 */
//Class Elementor_SDStudio_REPLACER_1_price_base extends \Elementor\Core\DynamicTags\Tag {
Class Elementor_Server_Var_Tag extends \Elementor\Core\DynamicTags\Tag {

    /**
     * Get Name
     *
     * Returns the Name of the tag
     *
     * @since 2.0.0
     * @access public
     *
     * @return string
     */
    public function get_name() {
        return 'server-variable';
    }

    /**
     * Get Title
     *
     * Returns the title of the Tag
     *
     * @since 2.0.0
     * @access public
     *
     * @return string
     */
    public function get_title() {
        return __( 'Montazheco Price Calc - ДИНАМИЧЕСКИЕ ЦЕНЫ', 'elementor-pro' );
    }

    /**
     * Get Group
     *
     * Returns the Group of the tag
     *
     * @since 2.0.0
     * @access public
     *
     * @return string
     */
    public function get_group() {
        return 'request-variables';
    }

    /**
     * Get Categories
     *
     * Returns an array of tag categories
     *
     * @since 2.0.0
     * @access public
     *
     * @return array
     */
    public function get_categories() {
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
    }

    /**
     * Register Controls
     *
     * Registers the Dynamic tag controls
     *
     * @since 2.0.0
     * @access protected
     *
     * @return void
     */
    protected function _register_controls() {

        $variables = [];
        $variables['SET_1_g-price-base'] = '1) Динамическая цена [Базовая, от] -  за метр';
        $variables['SET_2_g-price-opt'] = '2) Динамическая Цена [Оптимальная] -  за метр';
        $variables['SET_3_g-g-price-pro'] = '3) Динамическая Цена [Премиум] -  за метр';

//        foreach ( array_keys( $_SERVER ) as $variable ) {
//
//            $variables[ $variable ] = ucwords( str_replace( '_', ' ', $variable ) );
//        }

        $this->add_control(
            'param_name',
            [
                'label' => __( 'Param Name', 'elementor-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $variables,
            ]
        );
    }

    /**
     * Render
     *
     * Prints out the value of the Dynamic tag
     *
     * @since 2.0.0
     * @access public
     *
     * @return void
     */
    public function render() {
        /**
         * Получаем значения указанные в плагине (рубли)
         */
        $redux = get_option( 'redux_sds_montazheco_price_calc' );

        global $SUMMA_1_sds_montazheco_price_calc;
        $SUMMA_1_sds_montazheco_price_calc = $redux['SUMMA_1_sds-montazheco-price-calc'];
        global $SUMMA_2_sds_montazheco_price_calc;
        $SUMMA_2_sds_montazheco_price_calc = $redux['SUMMA_2_sds-montazheco-price-calc'];
        global $SUMMA_3_sds_montazheco_price_calc;
        $SUMMA_3_sds_montazheco_price_calc = $redux['SUMMA_3_sds-montazheco-price-calc'];


        // Цена 1
        // $CENA_1_REPLACE__g_price_base = 'g-price-base';
        // Цена 2
        // $CENA_2_REPLACE__g_price_opt = 'g-price-opt';
        // Цена 3
        // $CENA_3_REPLACE__g_price_pro = 'g-price-pro';

        // Площадь в метрах
        $PLOCHAD__g_square = 'g-square';


        global $post;
        if ($post->post_type === 'gazoblock'){
            // Получаем ID текущего поста (газоблока)
            $gazoblock_ID = $post->ID;
            // МЕТА
            $gazoblock_META = get_post_meta($gazoblock_ID);
            // Узнаем сколько метров квадратных у данного дома
            $gazoblock_META_PLOCHAD__g_square  = (int)$gazoblock_META[$PLOCHAD__g_square][0];


            /**
             * 1) Динамическая цена [Базовая, от] -  за метр
             * g-price-base
             */
            if ($this->get_settings('param_name') === 'SET_1_g-price-base'){
                // Умножаем указанную в плагине цену на метры
                $NEW_PRICE = $SUMMA_1_sds_montazheco_price_calc * $gazoblock_META_PLOCHAD__g_square;
                $NEW_PRICE = round($NEW_PRICE);
                // Выводим динамически снгенерированную цену
                // Плюс проблеы + формат числа + округление
                echo wp_kses_post( number_format($NEW_PRICE, 0, ',', ' ') );
            }

            /**
             * 2) Динамическая Цена [Оптимальная] -  за метр
             * g-price-base
             */
            if ($this->get_settings('param_name') === 'SET_2_g-price-opt'){
                // Умножаем указанную в плагине цену на метры
                $NEW_PRICE = $SUMMA_2_sds_montazheco_price_calc * $gazoblock_META_PLOCHAD__g_square;
                $NEW_PRICE = round($NEW_PRICE);
                // Выводим динамически снгенерированную цену
                // Плюс проблеы + формат числа + округление
                echo wp_kses_post( number_format($NEW_PRICE, 0, ',', ' ') );
            }

            /**
             * 3) Динамическая Цена [Премиум] -  за метр
             * g-price-base
             */
            if ($this->get_settings('param_name') === 'SET_3_g-g-price-pro'){
                // Умножаем указанную в плагине цену на метры
                $NEW_PRICE = $SUMMA_3_sds_montazheco_price_calc * $gazoblock_META_PLOCHAD__g_square;
                $NEW_PRICE = round($NEW_PRICE);
                // Выводим динамически снгенерированную цену
                // Плюс проблеы + формат числа + округление
                echo wp_kses_post( number_format($NEW_PRICE, 0, ',', ' ') );
            }
        }
    }
}
add_action( 'elementor/dynamic_tags/register_tags', function( $dynamic_tags ) {

    // In our Dynamic Tag we use a group named request-variables so we need
    // To register that group as well before the tag
    \Elementor\Plugin::$instance->dynamic_tags->register_group( 'request-variables', [
        'title' => 'Montazheco Price Calc'
    ] );


    // Finally register the tag
    $dynamic_tags->register_tag( 'Elementor_Server_Var_Tag' );
} );
?>