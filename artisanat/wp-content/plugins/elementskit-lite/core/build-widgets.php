<?php
namespace ElementsKit\Core;
use ElementsKit\Libs\Framework\Attr;

defined( 'ABSPATH' ) || exit;

class Build_Widgets{

	/**
	 * Collection of default widgets.
	 *
	 * @since 1.0.0
	 * @access private
	 */
    private $active_widgets;
    private $core_widgets;

    /**
	 * The class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Build_Widgets
	 */
    public static $instance = null;


    public function __construct() {

        new \ElementsKit\Widgets\Init\Enqueue_Scripts;

        $this->core_widgets = \ElementsKit::default_widgets();
        $this->active_widgets = Attr::instance()->utils->get_option('widget_list', $this->core_widgets);

        // check if the widget is exists
        foreach($this->active_widgets as $widget){
            if(in_array($widget, $this->core_widgets)){

                $wdir = (class_exists('\ElementsKit_Widget_Config')) ? \ElementsKit_Widget_Config::instance()->get_dir() . 'widgets/' : \ElementsKit::widget_dir();

                include $wdir . $widget .'/'. $widget . '.php';
                include $wdir . $widget .'/'. $widget . '-handler.php';

                $base_class_name = '\ElementsKit\ElementsKit_Widget_' . \ElementsKit\Utils::make_classname($widget);
                $handler_class = $base_class_name . '_Handler';

                $widget = new $handler_class();

                if($widget->scripts() != false){
                    add_action( 'wp_enqueue_scripts', [$widget, 'scripts'] );
                }

                if($widget->inline_css() != false){
                    wp_add_inline_style( 'elementskit-init-css', $widget->inline_css());
                }

                if($widget->inline_js() != false){
                    wp_add_inline_script( 'elementskit-init-js', $widget->inline_js());
                }

                if($widget->register_api() != false){
                    include_once $widget->register_api();
                    $api_class = $base_class_name . '_Api';
                    new $api_class();
                }

                if($widget->wp_init() != false){
                    add_action('init', [$widget, 'wp_init']);
                }
            }
        }

        add_action( 'elementor/widgets/widgets_registered', [$this, 'register_widget']);
    }


    public function register_widget($widgets_manager){

        foreach($this->active_widgets as $widget){
            if(in_array($widget, $this->core_widgets)){
                $class_name = '\Elementor\ElementsKit_Widget_' . \ElementsKit\Utils::make_classname($widget);
                if(class_exists($class_name)){
                    $widgets_manager->register_widget_type(new $class_name());
                }
            }
        }
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