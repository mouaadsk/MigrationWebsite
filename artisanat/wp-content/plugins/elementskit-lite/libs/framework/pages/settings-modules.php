<?php
$modules_all = \ElementsKit::default_modules('pro');
$modules_active = $this->utils->get_option('module_list', $modules_all);
$modules_free = \ElementsKit::default_modules('free');
?>

<div class="ekit-admin-header">
    <h2 class="ekit-admin-header-title"><?php esc_html_e('Active Module List', 'elementskit'); ?></h2>
</div>
<div class="ekit-admin-fields-container">
    <span class="ekit-admin-fields-container-description"><?php esc_html_e('You can disable the modules you are not using on your site. That will disable all associated assets of those modules to improve your site loading.', 'elementskit'); ?></span>
    <div class="ekit-admin-fields-container-fieldset">
        <div class="attr-hidden" id="elementskit-template-admin-menu">
            <li><a href="edit.php?post_type=elementskit_template"><?php esc_html_e('My Templates', 'elementskit'); ?></a></li>
        </div>
        <div class="attr-row">
        <?php foreach($modules_all as $module): ?>
            <div class="attr-col-md-6 attr-col-lg-4">
            <?php
                $pro = (in_array($module, $modules_free) && \ElementsKit::PACKAGE_TYPE == 'free') ? false : true;
                $this->utils->input([
                    'type' => 'switch',
                    'name' => 'module_list[]',
                    'value' => $module,
                    'class' => (($pro == false) ? 'ekit-content-type-free' : 'ekit-content-type-pro'),
                    'label' => ucwords(str_replace('-', ' ', $module)),
                    'attributes' => (($pro == false ) ? [] : [
                        'data-attr-toggle' => 'modal',
                        'data-target' => '#elementskit_go_pro_modal'
                    ]),
                    'options' => [
                        'checked' => ((in_array($module, $modules_active) && $pro == false) ? true : false),
                    ]
                ]);
            ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>