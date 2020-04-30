<?php
if(class_exists('\ElementsKit_Widget_Config')):
    include(\ElementsKit_Widget_Config::instance()->get_dir() . 'libs/framework/pages/settings-userdata.php');
else:
$user_data = $this->utils->get_option('user_data', []);

?>
<div class="ekit-admin-fields-container">
    <!-- <span class="ekit-admin-fields-container-description"><?php esc_html_e('You can disable the modules you are not using on your site. That will disable all associated assets of those modules to improve your site loading.', 'elementskit'); ?></span> -->
    <div class="ekit-admin-fields-container-fieldset-- xx">
        <div class="panel-group attr-accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="attr-panel ekit_accordion_card ekit-admin-card-shadow">
                <div class="attr-panel-heading" role="tab" id="mail_chimp_data_headeing">
                    <a class="attr-btn attr-collapsed" role="button" data-attr-toggle="collapse" data-parent="#accordion"
                        href="#mail_chimp_data_control" aria-expanded="true"
                        aria-controls="mail_chimp_data_control">
                        <?php esc_html_e('Mail Chimp Data', 'elementskit'); ?>
                    </a>
                </div>
                <div id="mail_chimp_data_control" class="attr-panel-collapse attr-collapse" role="tabpanel"
                    aria-labelledby="mail_chimp_data_headeing">
                    <div class="attr-panel-body">
                        <?php
                              $this->utils->input([
                                  'type' => 'text',
                                  'name' => 'user_data[mail_chimp][token]',
                                  'label' => esc_html__('Token', 'elementskit'),
                                  'placeholder' => '24550c8cb06076751a80274a52878-us20',
                                  'value' => (!isset($user_data['mail_chimp']['token'])) ? '' : ($user_data['mail_chimp']['token'])
                              ]);
                          ?>
                    </div>
                </div>
            </div>
            <div class="attr-panel ekit_accordion_card ekit-admin-card-shadow">
                <div class="attr-panel-heading" role="tab" id="facebook_data_headeing">
                    <a class="attr-btn" role="button"  data-attr-toggle="modal" data-target="#elementskit_go_pro_modal" href="#facebook_control_data"
                        aria-expanded="false" aria-controls="facebook_control_data">
                        <?php esc_html_e('Facebook User Data', 'elementskit'); ?>
                    </a>
                </div>
            </div>
            <div class="attr-panel ekit_accordion_card ekit-admin-card-shadow">
                <div class="attr-panel-heading" role="tab" id="twetter_data_headeing">
                    <a class="attr-btn attr-collapsed" role="button"  data-attr-toggle="modal" data-target="#elementskit_go_pro_modal"
                        href="#twitter_data_control" aria-expanded="false" aria-controls="twitter_data_control">
                        <?php esc_html_e('Twitter User Data', 'elementskit'); ?>
                    </a>
                </div>
            </div>
            <div class="attr-panel ekit_accordion_card ekit-admin-card-shadow">
                <div class="attr-panel-heading" role="tab" id="instagram_data_headeing">
                    <a class="attr-btn attr-collapsed" role="button"  data-attr-toggle="modal" data-target="#elementskit_go_pro_modal"
                        href="#instagram_data_control" aria-expanded="false" aria-controls="instagram_data_control">
                        <?php esc_html_e('Instragram User Data', 'elementskit'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>