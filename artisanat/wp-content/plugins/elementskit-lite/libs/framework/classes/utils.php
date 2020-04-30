<?php 
namespace ElementsKit\Libs\Framework\Classes;

defined( 'ABSPATH' ) || exit;

class Utils{

    public static $instance = null;
    private static $key = 'elementskit_options';

    public static function get_dir(){
        return \ElementsKit::lib_dir() . 'framework/';
    }

    public static function get_url(){
        return \ElementsKit::lib_url() . 'framework/';
    }

    public static function sanitize($value, $senitize_func = 'sanitize_text_field'){
        $senitize_func = (in_array($senitize_func, [
                'sanitize_email', 
                'sanitize_file_name', 
                'sanitize_hex_color', 
                'sanitize_hex_color_no_hash', 
                'sanitize_html_class', 
                'sanitize_key', 
                'sanitize_meta', 
                'sanitize_mime_type',
                'sanitize_sql_orderby',
                'sanitize_option',
                'sanitize_text_field',
                'sanitize_title',
                'sanitize_title_for_query',
                'sanitize_title_with_dashes',
                'sanitize_user',
                'esc_url_raw',
                'wp_filter_nohtml_kses',
            ])) ? $senitize_func : 'sanitize_text_field';
        
        if(!is_array($value)){
            return $senitize_func($value);
        }else{
            return array_map(function($inner_value) use ($senitize_func){
                return self::sanitize($inner_value, $senitize_func);
            }, $value);
        }
    }

    public function get_option($key, $default = ''){
        $data_all = get_option(self::$key);
        return (isset($data_all[$key]) && $data_all[$key] != '') ? $data_all[$key] : $default;
    }

    public function save_sanitized($key, $value = '', $senitize_func = 'sanitize_text_field'){
        $data_all = get_option(self::$key);

        $value = self::sanitize($value, $senitize_func);

        $data_all[$key] = $value;
        update_option('elementskit_options', $data_all);
    }

    public function input($input_options){
        $defaults = [
            'type' => null,
            'name' => '',
            'value' => '',
            'class' => '',
            'label' => '',
            'info' => '',
            'options' => [],
        ];
        $input_options = array_merge($defaults, $input_options);
        //d($input_options);
        if(file_exists(self::get_dir() . 'controls/settings/' . $input_options['type'] . '.php')){
            extract($input_options);
            include self::get_dir() . 'controls/settings/' . $input_options['type'] . '.php';
        }
    }

    public static function strify($str){
        return strtolower(preg_replace("/[^A-Za-z0-9]/", "__", $str));
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
        }

        return self::$instance;
    }
}