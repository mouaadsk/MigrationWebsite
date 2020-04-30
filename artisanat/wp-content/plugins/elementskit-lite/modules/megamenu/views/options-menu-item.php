<div class="attr-modal attr-fade" id="attr_menu_control_panel_modal" tabindex="-1" role="dialog">
    <div class="attr-modal-dialog attr-modal-dialog-centered" role="document">
        <div class="attr-modal-content ekit_menu_modal_content">
            <div class="attr-modal-header">
                <ul class="tb-nav tb-nav-tabs ekit_menu_control_nav" role="tablist">
                    <li role="presentation" id="attr_content_nav" class="attr-active"><a class="attr-nav-link" href="#attr_content_tab" aria-controls="attr_content_tab"
                            role="tab" data-attr-toggle="tab"><?php esc_html_e('Content', 'elementskit'); ?></a></li>
                    <li role="presentation" id="attr_icon_nav"><a class="attr-nav-link ekit-pro-labal" href="#attr_icon_tab" aria-controls="attr_icon_tab" role="tab"
                            data-attr-toggle="tab"><?php esc_html_e('Icon', 'elementskit'); ?></a></li>
                    <li role="presentation" id="attr_badge_nav"><a class="attr-nav-link ekit-pro-labal" href="#attr_badge_tab" aria-controls="attr_badge_tab"
                            role="tab" data-attr-toggle="tab"><?php esc_html_e('Badge', 'elementskit'); ?></a></li>
                </ul>
            </div>
            <div class="attr-modal-body ekit-wid-con">
                <div class="attr-tab-content">
                    <div role="tabpanel" class="attr-tab-pane attr-active" id="attr_content_tab">
                        <?php if(defined( 'ELEMENTOR_VERSION' )): ?>
                        <div class="switch-wrapper">
                            <input type="checkbox" value="1" id="elementskit-menu-item-enable" />
                            <label for="elementskit-menu-item-enable"><span><em></em></span></label>
                        </div>
                        <div id="elementskit-menu-builder-warper">
                            <small
                                class="elementskit-menu-mega-submenu enabled_item"><?php esc_html_e('Megamenu enabled'); ?></small>
                            <small
                                class="elementskit-menu-mega-submenu disabled_item"><?php esc_html_e('Megamenu disabled'); ?></small>

                            <button disabled type="button" id="elementskit-menu-builder-trigger"
                                class="elementskit-menu-elementor-button button" data-attr-toggle="modal"
                                data-target="#elementskit-menu-builder-modal">
                                <img src="<?php echo esc_url($this->url); ?>/assets/images/elementor-icon.png"
                                    alt="elementskit megamenu" />
                                <?php esc_html_e('Edit megamenu content'); ?>
                            </button>

                            <div id="mobile_submenu_content_type" class="ekit-pro-labal ekit-pro-labal-container">
                                <strong><?php esc_html_e('Use mobile submenu as:'); ?></strong>
                                <span><input type="radio" name="content_type" checked value="builder_content"> <?php esc_html_e('builder content'); ?></span>
                                <span><input type="radio" name="content_type" value="submenu_list"> <?php esc_html_e('wp submenu list'); ?></span>
                            </div>
                        </div>
                        <?php else: ?>
                        <p class="no-elementor-notice">
                            <?php esc_html_e( 'This plugin requires Elementor page builder to edt megamenu items content', 'elementskit' ); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div role="tabpanel" class="attr-tab-pane" id="attr_icon_tab">
                        <table class="option-table ekit-pro-labal-container">
                            <tbody>
                                <tr>
                                    <td><strong><?php esc_html_e('Choose icon color', 'elementskit'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="text" value="#bada55" class="elementskit-menu-wpcolor-picker"
                                            id="elementskit-menu-icon-color-field" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong><?php esc_html_e('Select icon', 'elementskit'); ?></strong></td>
                                    <td class="alignright">
                                        <select id="elementskit-menu-icon-field" class="elementskit-menu-icon-picker">
                                            <option value=""><?php esc_html_e('No icon', 'elementskit'); ?></option>
                                            <?php
                                    foreach( self::get_icons() as $icon_class){
                                        echo "<option value='$icon_class'></option>";
                                    }
                                ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="attr-tab-pane" id="attr_badge_tab">
                        <table class="option-table ekit-pro-labal-container">
                            <tbody>
                                <tr>
                                    <td><strong><?php esc_html_e('Badge text', 'elementskit'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="text"
                                            placeholder="<?php esc_html_e('Badge Text', 'elementskit'); ?>"
                                            id="elementskit-menu-badge-text-field" />
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong><?php esc_html_e('Choose badge color', 'elementskit'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="text" class="elementskit-menu-wpcolor-picker" value="#bada55"
                                            id="elementskit-menu-badge-color-field" />
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong><?php esc_html_e('Choose badge background', 'elementskit'); ?></strong>
                                    </td>
                                    <td class="alignright">
                                        <input type="text" class="elementskit-menu-wpcolor-picker" value="#bada55"
                                            id="elementskit-menu-badge-background-field" />
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="attr-modal-footer">
                <input type="hidden" id="elementskit-menu-modal-menu-id">
                <input type="hidden" id="elementskit-menu-modal-menu-has-child">
                <div class="clearfix ekit-modal-controls">
                    <div class="left-content">
                        <button class="btn-modal-close" type="button" data-dismiss="modal">
                            <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                                <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="right-content">
                        <span class='spinner'></span>
                        <?php echo get_submit_button(esc_html__('Save', 'elementskit'), 'elementskit-menu-item-save button-primary alignright','', false); ?>
                    </div>
                </div>
            </div>
            <span id="elementskit-menu-modal-spinner" class='spinner'></span>
        </div>
    </div>
</div>

<div class="attr-modal attr-fade" id="elementskit-menu-builder-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="attr-modal-dialog attr-modal-dialog-centered" role="document">
        <div class="attr-modal-content">
            <div class="attr-modal-body">
                <button class="ekit_close" type="button" data-dismiss="modal"><svg width="20" height="20"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <line fill="none" stroke="#fff" stroke-width="1.4" x1="1" y1="1" x2="19" y2="19"></line>
                        <line fill="none" stroke="#fff" stroke-width="1.4" x1="19" y1="1" x2="1" y2="19"></line>
                    </svg></button>
                <iframe id="elementskit-menu-builder-iframe" src="<?php echo esc_url(get_rest_url() . 'elementskit/v1/dynamic-content/content_editor/megamenu/menuitem'); ?>" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>