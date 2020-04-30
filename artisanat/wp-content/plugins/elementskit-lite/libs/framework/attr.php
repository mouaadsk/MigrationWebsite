<?php 
namespace ElementsKit\Libs\Framework;
use ElementsKit\Libs\Framework\Classes\Utils;

defined( 'ABSPATH' ) || exit;

class Attr{

    /**
	 * The class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Attr
	 */
    public static $instance = null;
    public $utils;

    public static function get_dir(){
        return \ElementsKit::lib_dir() . 'framework/';
    }

    public static function get_url(){
        return \ElementsKit::lib_url() . 'framework/';
    }

    public static function key(){
        return 'elementskit';
    }

    public function __construct() {
        $this->utils = Classes\Utils::instance();
        new Classes\Ajax;

        

        // register admin menus
        add_action('admin_menu', [$this, 'register_settings_menus']);
        add_action('admin_menu', [$this, 'register_support_menu'], 999);

        // register js/ css
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );
        
    }

    public function include_files(){

    }

    public function enqueue_scripts(){

    }

    public function register_settings_menus(){
        // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )

        // dashboard, main menu
        add_menu_page(
            esc_html__( 'ElementsKit Settings', 'elementskit' ),
            esc_html__( 'ElementsKit', 'elementskit' ),
            'manage_options',
            self::key(),
            [$this, 'register_settings_contents__settings'],
            self::get_url() . 'assets/images/favicon.png',
            2
        );

        // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )
        //add_submenu_page( self::key(), 'ElementsKit Help', 'Help', 'manage_options', self::key().'-help', [$this, 'register_settings_contents__help'], 11);
    }


    public function register_support_menu(){
        add_submenu_page( self::key(), esc_html__( 'Support', 'elementskit' ), esc_html__( 'Support', 'elementskit' ), 'manage_options', self::key().'-support', [$this, 'register_settings_contents__support'], 11);
    }


    public function register_settings_contents__settings(){
        include self::get_dir() . 'pages/settings-init.php';
    }

    public function register_settings_contents__support(){
        echo esc_html__('Please wait..', 'elementskit');
        echo '
            <script>
            window.location.href = "https://go.wpmet.com/litesupport";
            </script>
        ';
    }


    /**
     * Instance.
     * 
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return Build_Widgets An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
        }

        return self::$instance;
    }
}