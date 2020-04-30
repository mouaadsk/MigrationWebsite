<?php
$widgets_all = \ElementsKit::default_widgets('pro');
$widgets_active = $this->utils->get_option('widget_list', $widgets_all);
$widgets_free = \ElementsKit::default_widgets('free');
?>
<div class="ekit-admin-header">
    <h2 class="ekit-admin-header-title"><?php esc_html_e('Active Widget List', 'elementskit'); ?></h2>
</div>
<div class="ekit-admin-fields-container">
    <span class="ekit-admin-fields-container-description"><?php esc_html_e('You can disable the elements you are not using on your site. That will disable all associated assets of those widgets to improve your site loading.', 'elementskit'); ?></span>
    <div class="ekit-admin-fields-container-fieldset">
        <div class="attr-row">
            <?php foreach($widgets_all as $widget): ?>
            <div class="attr-col-md-6 attr-col-lg-4">
                <?php
                    include_once \ElementsKit::widget_dir() . $widget .'/'. $widget . '-handler.php';
                    $widget_handler = '\ElementsKit\Elementskit_Widget_' . \ElementsKit\Utils::make_classname($widget) . '_Handler';
                    $widget_handler = new $widget_handler();
                    $pro = (in_array($widget, $widgets_free) && \ElementsKit::PACKAGE_TYPE == 'free') ? false : true;
                    $this->utils->input([
                        'type' => 'switch',
                        'name' => 'widget_list[]',
                        'label' => str_replace('Ekit ', '', $widget_handler::get_title()),
                        'value' => $widget,
                        'class' => (($pro == false ) ? 'ekit-content-type-free' : 'ekit-content-type-pro'),
                        'attributes' => (($pro == false ) ? [] : [
                            'data-attr-toggle' => 'modal',
                            'data-target' => '#elementskit_go_pro_modal'
                        ]),
                        'options' => [
                            'checked' => ((in_array($widget, $widgets_active) && $pro == false) ? true : false),
                        ]
                    ]);
                ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

