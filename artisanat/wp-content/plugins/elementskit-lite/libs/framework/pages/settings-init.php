<?php

$sections = [
    'dashboard' => [
        'title' => esc_html__('Dashboard', 'elementskit'),
        'sub-title' => esc_html__('General info', 'elementskit'),
        'icon' => 'icon icon-home',
    ],
    'elements' => [
        'title' => esc_html__('Elements', 'elementskit'),
        'sub-title' => esc_html__('Enable disable widgets', 'elementskit'),
        'icon' => 'icon icon-magic-wand',
    ],
    'modules' => [
        'title' => esc_html__('Modules', 'elementskit'),
        'sub-title' => esc_html__('Enable disable modules', 'elementskit'),
        'icon' => 'icon icon-settings-2',
    ],
    'userdata' => [
        'title' => esc_html__('User Data', 'elementskit'),
        'sub-title' => esc_html__('Data for fb, mailchimp etc', 'elementskit'),
        'icon' => 'icon icon-settings1',
    ],
];


?>
<div class="ekit-wid-con">
    <div class="ekit_container">
        <form action="" method="POST" id="ekit-admin-settings-form">
            <div class="attr-row ekit_tab_wraper_group">
                <div class="attr-col-lg-3 attr-col-md-4">
                    <div class="ekit_logo">
                        <img src="<?php echo self::get_url() . 'assets/images/elements_kit_logo_black.svg'; ?>" height="40" />
                    </div>
                    <div class="ekit-admin-nav" id="v-elementskit-tab" role="tablist" aria-orientation="vertical">
                        <ul class="attr-nav attr-nav-tabs">
                            <?php foreach($sections as $section_key => $section): reset($sections);?>
                            <li role="presentation" class="<?php echo ($section_key !== key($sections)) ? : 'attr-active'; ?>">
                                <a class="ekit-admin-nav-link" id="v-elementskit-<?php echo esc_attr($section_key); ?>-tab" data-attr-toggle="pill" href="#v-elementskit-<?php echo esc_attr($section_key); ?>" role="tab"
                                    aria-controls="v-elementskit-<?php echo esc_attr($section_key); ?>" data-attr-toggle="tab" role="tab">
                                    <div class="ekit-admin-tab-content">
                                        <span class="ekit-admin-title"><?php echo esc_html($section['title']); ?></span>
                                        <span class="ekit-admin-subtitle"><?php echo esc_html($section['sub-title']); ?></span>
                                    </div>
                                    <div class="ekit-admin-tab-icon">
                                        <i class="<?php echo esc_attr($section['icon']) ?>"></i>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>

                            <li role="presentation" class="ekit-go-pro-nav-tab">
                                <a class="ekit-admin-nav-link" id="v-elementskit-ekit-go-pro-nav-tab" href="https://go.wpmet.com/ekitpro" role="tab" target="_blank">
                                    <div class="ekit-admin-tab-content">
                                        <span class="ekit-admin-title"><?php echo esc_html__('Go Pro', 'elementskit'); ?></span>
                                        <span class="ekit-admin-subtitle"><?php echo esc_html__('Get premium features', 'elementskit'); ?></span>
                                    </div>
                                    <div class="ekit-admin-tab-icon">
                                        <img src="<?php echo self::get_url() . 'assets/images/loader-krasi.gif'; ?>" class="ekit-go-pro-gif" alt="elementskit go pro" />
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="attr-col-lg-9 attr-col-md-8">
                    <div class="attr-tab-content" id="v-elementskit-tabContent">
                        <?php foreach($sections as $section_key => $section): reset($sections); ?>
                            <div class="attr-tab-pane <?php echo ($section_key !== key($sections)) ? : 'attr-active'; ?>" id="v-elementskit-<?php echo esc_attr($section_key); ?>" role="tabpanel" aria-labelledby="v-elementskit-tab-<?php echo esc_attr($section_key); ?>">
                                <div class="ekit-admin-section-header">
                                    <h2 class="ekit-admin-section-heaer-title"><i class="<?php echo esc_attr($section['icon']) ?>"></i><?php echo esc_html($section['title']); ?></h2>
                                    <div class="ekit-admin-input-switch">
                                        <button class="attr-btn-primary attr-btn ekit-admin-settings-form-submit"><div class="ekit-spinner"></div><?php esc_html_e('Save Changes', 'elementskit'); ?></button>
                                    </div>
                                </div>
                                <?php include self::get_dir() . 'pages/settings-' . $section_key . '.php'; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>