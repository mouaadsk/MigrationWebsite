<div class="attr-input attr-input-switch <?php echo esc_attr($class); ?>">

    <div class="ekit-admin-input-switch ekit-admin-card-shadow attr-card-body" <?php
        // print_r($attributes);
        if(isset($attributes) && is_array($attributes)){
            foreach($attributes as $k => $v){
                echo $k . '="'.$v.'"';
            }
        }
    ?>>
        <input <?php echo esc_attr($options['checked'] === true ? 'checked' : ''); ?> 
            type="checkbox" value="<?php echo esc_attr($value); ?>" 
            class="ekit-admin-control-input" 
            name="<?php echo esc_attr($name); ?>" 
            id="ekit-admin-switch__<?php echo esc_attr(self::strify($name) . $value); ?>"
        >

        <label class="ekit-admin-control-label"  for="ekit-admin-switch__<?php echo esc_attr(self::strify($name) . $value); ?>">
        <?php echo esc_html($label); ?>
            <span class="ekit-admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
        </label>
    </div>

</div>