<?php 
namespace ElementsKit\Libs\Framework\Classes;

defined( 'ABSPATH' ) || exit;

class Customizer {
    public $attrInput = [
        'content' => [
            'type' => 'array',
        ]
    ];

    public $getSettings = [];

    public function init() {
        add_action( 'init', [$this, 'register_block'] );
        add_action( 'admin_enqueue_scripts', [$this, 'render_react_script'] );

    }

    public function get_name() {
        return null;
    }

    public function get_title() {
        return null;
    }

    public function get_icon() {
        return null;
    }

    public function get_cateory() {
        return 'common';
    }

    public function scripts() {
        return null;
    }

    protected function register_controls() {

    }

    public function add_control($name, $attr){
        $typeStr = explode('::', $attr['type']);
        unset($attr['type']);
        $fields = array_merge([
            'type' => $typeStr[1],
            'label' => $attr['title'],
            'placement' => isset($attr['placement']) ? $attr['placement'] : 'inspector',
        ], $attr);

        $this->attrInput[$name] = [
            'type' => $typeStr[0],
            'field' => $fields,
            'default' => isset($attr['default']) ? $attr['default'] : ''
        ];
    }

    public function render_output($attr){
        $this->getSettings = $attr;
        ob_start();
        $this->render();
        $output  = ob_get_contents();
        ob_end_clean();

        return $output;
    }
    public function render(){

    }

    public function register_block(){
        $this->register_controls();
        register_block_type( $this->get_name(), [
            'title' => $this->get_title(),
            'render_callback' => [$this, 'render_output'],
            'category' => $this->get_cateory(),
            'attributes' => $this->attrInput
        ]);
    }

 
    public function render_react_script(){
        wp_add_inline_script( 'vinkmag-gutenwarper-handeler',  '
        "use strict";

        var registerBlockType = wp.blocks.registerBlockType;
        var ServerSideRender = wp.components.ServerSideRender;

        registerBlockType("'.$this->get_name().'", {
            edit: function edit(props, gutenwarper) {
                console.log(gutenwarper.inspectorControls);
                return [
                    gutenwarper.inspectorControls,
                    
                    React.createElement(ServerSideRender, {
                        block: "'.$this->get_name().'",
                        attributes: props.attributes,
                    })
                ]
            },
            save: function save() {
                return null;
            }
        });	
        ');
    }
 
}


class GutenWarperRegisterer{
    function register($klass){
        $klass->init();
    }
}