<?php
namespace ElementsKit;

class ElementsKit_Widget_Woo_Mini_Cart_Handler extends Core\Handler_Widget{

    public function wp_init(){
        add_filter( 'woocommerce_add_to_cart_fragments', array($this, 'ekit_cart_count_total_fragments'), 10, 1 );
    }

    public function ekit_cart_count_total_fragments( $fragments ) {
        
        $fragments['.ekit-cart-items-count'] = '<span class="ekit-cart-items-count">' . WC()->cart->get_cart_contents_count() ." - " .  WC()->cart->get_cart_total(). '</span>';

        $fragments['.ekit-cart-count'] = '<span class="ekit-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';

        return $fragments;
    }


    static function get_name() {
        return 'elementskit-woo-mini-cart';
    }

    static function get_title() {
        return esc_html__( 'Woo Mini Cart', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit-widget-icon eicon-product-add-to-cart';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'woo-mini-cart/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'woo-mini-cart/';
    }
    public function scripts(){
        
    }
    public function styles(){
        wp_enqueue_style( 'ekit-mini-cart', self::get_url() . 'assets/css/mini-cart.css', false, \ElementsKit::VERSION );

    }
}