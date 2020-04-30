<?php 
namespace ElementsKit\Modules\Controls;

defined( 'ABSPATH' ) || exit;

class Init{

    // instance of all control's base class
    public static function get_url(){
        return \ElementsKit::module_url() . 'controls/';
    }
    public static function get_dir(){
        return \ElementsKit::module_dir() . 'controls/';
    }

    public function __construct() {

        // Includes necessary files
        $this->include_files();
        // load icons
        Icons::_get_instance()->ekit_icons_pack();
        
        // Initilizating control hooks
        add_action('elementor/controls/controls_registered', array( $this, 'icon' ), 11 );
        add_action('elementor/controls/controls_registered', array( $this, 'image_choose' ), 11 );
        add_action('elementor/controls/controls_registered', array( $this, 'ajax_select2' ), 11 );
        add_action('elementor/controls/controls_registered', array( $this, 'widgetarea' ), 11 );

        // Initilizating control scripts
        add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'widgetarea_enqueue_styles_editor' ) );
        add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'widgetarea_enqueue_scripts_editor' ), 22 );

        // Initilizating control classes
        $widget_area_utils = new Widget_Area_Utils();
        $widget_area_utils->init();
    }

    private function include_files(){
        // Controls_Manager
        include_once self::get_dir() . 'control-manager.php';

        // image choose
        include_once self::get_dir() . 'image-choose.php';

        // icons
        include_once self::get_dir() . 'icons.php';

        // ajax select2
        include_once self::get_dir() . 'ajax-select2.php';
        include_once self::get_dir() . 'ajax-select2-api.php';

        // widgetarea
        include_once self::get_dir() . 'widget-area-utils.php';
        include_once self::get_dir() . 'widget-area.php';
    }

    public function icon( $controls_manager ) {
        $controls_manager->unregister_control( $controls_manager::ICON );
        $controls_manager->register_control( $controls_manager::ICON, new \ElementsKit\Modules\Controls\Icon());
    }

    public function image_choose( $controls_manager ) {
        $controls_manager->register_control('imagechoose', new \ElementsKit\Modules\Controls\Image_Choose());
    }

    public function ajax_select2( $controls_manager ) {
        $controls_manager->register_control('ajaxselect2', new \ElementsKit\Modules\Controls\Ajax_Select2());
    }

    public function widgetarea( $controls_manager ) {
        $controls_manager->register_control( 'widgetarea', new \ElementsKit\Modules\Controls\Widget_Area());
    }
    
	public function widgetarea_enqueue_scripts_editor() {
		wp_enqueue_script( 'elementskit-js-widgetarea-control-editor',  self::get_url() . 'assets/js/widgetarea-editor.js' );
    }
    
	public function widgetarea_enqueue_styles_editor() {
		wp_enqueue_style( 'elementskit-css-widgetarea-control-editor',  self::get_url() . 'assets/css/widgetarea-editor.css', [], '1.0.0' );
    }

}