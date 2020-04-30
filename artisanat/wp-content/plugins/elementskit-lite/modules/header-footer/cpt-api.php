<?php 
namespace ElementsKit;

defined( 'ABSPATH' ) || exit;

class ElementsKit_HeaderFooterBuilder_Api extends Core\Handler_Api {

    public function config(){
        $this->prefix = 'my-template';
        $this->param  = "/(?P<id>\w+)/";
    }

    public function get_update(){
        $id = $this->request['id'];
        $open_editor = $this->request['open_editor'];

        $title = ($this->request['title'] == '') ? ('ElementsKit Template #' . time()) : $this->request['title'];
        $activation = $this->request['activation'];
        $type = $this->request['type'];
        $condition_a = ($type == 'section') ? '' : $this->request['condition_a'];
        $condition_singular = ($type == 'section') ? '' : $this->request['condition_singular'];
        $condition_singular_id = ($type == 'section') ? '' : $this->request['condition_singular_id'];

        $post_data = array(
            'post_title' => $title,
            'post_status' => 'publish',
            'post_type' => 'elementskit_template',
        );

        $post = get_post($id);
        
        if($post == null){
            // $post_data['post_author'] = $this->request['post_author'];
            $id = wp_insert_post($post_data);
        }else{
            $post_data['ID'] = $id;
            wp_update_post( $post_data );
        }
        
        update_post_meta( $id, '_wp_page_template', 'elementor_canvas' );
        update_post_meta( $id, 'elementskit_template_activation', $activation );
        update_post_meta( $id, 'elementskit_template_type', $type );
        update_post_meta( $id, 'elementskit_template_condition_a', $condition_a );
        update_post_meta( $id, 'elementskit_template_condition_singular', $condition_singular );
        update_post_meta( $id, 'elementskit_template_condition_singular_id', $condition_singular_id );

        if($open_editor == 'true'){
            $url = get_admin_url() . '/post.php?post='.$builder_post_id.'&action=elementor';
            wp_redirect( $url );
            exit;
        }else{
            $cond = ucwords( str_replace('_', ' ',
                $condition_a  
                . (($condition_a == 'singular')
                    ? (($condition_singular != '' )
                        ? (' > ' . $condition_singular 
                        . (($condition_singular_id != '')
                            ? ' > ' . $condition_singular_id
                            : ''))
                        : '')
                    : '')
            ));

            return [
                'saved' => true,
                'data' => [
                    'id' => $id,
                    'title' => $title,
                    'type' => $type,
                    'activation' => $activation,
                    'cond_text' => $cond,
                    'type_html' => (ucfirst($type) . (($activation == 'yes') 
                        ? ( '<span class="ekit-headerfooter-status ekit-headerfooter-status-active">'. esc_html__('Active', 'elementskit') .'</span>' ) 
                        : ( '<span class="ekit-headerfooter-status ekit-headerfooter-status-inactive">'. esc_html__('Inactive', 'elementskit') .'</span>' ))),
                ]
            ];
        }
    }

    public function get_get(){
        $id = $this->request['id'];
        $post = get_post($id);
        if($post != null){
            return [
                'title' => $post->post_title,
                'status' => $post->post_status,
                'activation' => get_post_meta($post->ID, 'elementskit_template_activation', true),
                'type' => get_post_meta($post->ID, 'elementskit_template_type', true),
                'condition_a' => get_post_meta($post->ID, 'elementskit_template_condition_a', true),
                'condition_singular' => get_post_meta($post->ID, 'elementskit_template_condition_singular', true),
                'condition_singular_id' => get_post_meta($post->ID, 'elementskit_template_condition_singular_id', true),
            ];
        }
        return true;
    }

}
new ElementsKit_HeaderFooterBuilder_Api();