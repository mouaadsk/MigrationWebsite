<?php

if(!class_exists('WpMet_Banner')){
    class WpMet_Banner{
        public static $instance = null;

        public $key;
        public $api;
        public $data;
        public $last_check;
        public $check_interval;

        public $plugin_pages;

        function __construct(){
            if(!is_admin()){
                return false;
            }

            $this->key = 'wpmet_banner';
            $this->api = \ElementsKit::api_url() . 'banner/';
            $this->check_interval = (3600 * 24); // 1day
            $this->get_banner();

            $this->plugin_pages = [
                'edit-elementskit_template',
                'toplevel_page_elementskit'
            ];

            if(isset($this->data->plugin_pages) && !empty($this->data->plugin_pages)){
                $this->show_banner($this->data->plugin_pages);
            }

            if(isset($this->data->all_pages) && !empty($this->data->all_pages)){
                $this->show_banner($this->data->all_pages);
            }

            add_action('admin_footer', [$this, 'style']);
        }

        private function get_banner(){
            $this->data = get_option('__data');
            $this->data = $this->data == '' ? [] : $this->data;

            $this->last_check = get_option('__last_check');
            $this->last_check = $this->last_check == '' ? 0 : $this->last_check;
            
            if(($this->check_interval + $this->last_check) < time()){
                $response = wp_remote_get( $this->api,
                    array(
                        'timeout'     => 10,
                        'httpversion' => '1.1',
                    )
                );
                
                if(!is_wp_error($response) && isset($response['body']) && $response['body'] != ''){
                    $this->data = json_decode($response['body']);
                    
                    update_option('__last_check', time());
                    update_option('__data', $this->data);
                    
                    return;
                }

            }
        }


        public function show_banner($banner){
            if($banner->start <= time() && time() <= $banner->end){
                $screen = get_current_screen();
                
                if($banner->slug == 'all_pages'|| in_array($screen->id, $this->plugin_pages)){
                    $contents = '<a target="_blank" class="wpmet-banner-href" href="'.$banner->url.'"><img src="'.$banner->image.'" /></a>';

                    \ElementsKit\Notice::push(
                        [
                            'id'          => 'wpmet-banner-' . $banner->slug,
                            'type'        => 'banner',
                            'class'       => 'wpmet-banner-container',
                            'dismissible' => true,
                            'message'     => $contents
                        ]
                    );
                }
            }
        }


        public function style(){
            ?>
            <style>
                .wpmet-banner-container{
                    background: none!important;
                    border: 0!important;
                    box-shadow: none!important;
                    padding: 0!important;
                }
                .wpmet-banner-href{
                    text-align: center;
                    display: block;
                }
                .wpmet-banner-href img{
                    width: 100%;
                    max-width: 1400px;
                }
            </style>
            <?php
        }

        public static function run() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
    
            return self::$instance;
        }
    }
}