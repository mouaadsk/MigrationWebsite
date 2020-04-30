=== Ocean Extra ===
Contributors: oceanwp, apprimit
Tags: widgets, meta box, metaboxes, metabox, oceanwp
Requires at least: 5.3
Tested up to: 5.4
Stable tag: 1.6.2
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Ocean Extra add extra features to [OceanWP](https://oceanwp.org/) like widgets, metaboxes, activate/deactivate the customizer sections, enable/disable the theme's scripts and styles, import/export and a panel to activate the premium extensions.
This plugin requires the [OceanWP](https://oceanwp.org/) theme to be installed.

== Installation ==

1. Upload `ocean-extra` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!

== Frequently Asked Questions ==

= I installed the plugin but it does not work =

This plugin will only work with the [OceanWP](https://oceanwp.org/) theme.

== Screenshots ==

1. The meta boxes.
2. Customizer panels.
3. Custom CSS.

== Changelog ==

= 1.6.2 =
- fixed: [oceanwp_nav] error.

= 1.6.1 =
- fixed: Shortocde [oceanwp_nav] is not working.

= 1.6.0 =
- Updated: Freemius SDK for better account and license management.
- Fixed: [oceanwp_nav] shortcode mobile menu issue.
- Fixed: Theme Panel > Scripts & Styles - PHP7.4 Warning message after disabling/enabling styles & scripts.
- Fixed: Replaced get_woocommerce_term_meta (deprecated) by get_term_meta.
- Added: Accessibility Improvement - Added 'aria-hidden' labels to the social icon widget.

= 1.5.20 =
- Fixed: - Fixed: Menu Icon Library: icon library loading blank.

= 1.5.19 =
- Fixed: Icon issue.
- Fixed: Compatibility with WP5.3

= 1.5.18 =
- Fixed: Fatal Error.

= 1.5.17 =
- Added: Updated to FontAwesome-5 to fix the version conflict.

= 1.5.16 =
- New: Added white-labeling capabilities for client installations.

= 1.5.15 =
- Fix: Fixed the WP Cron jobs issue.

= 1.5.14 =
- Update: Added special logging and troubleshooting for the migration logic.

= 1.5.13 =
- Fixed: Free label in Freemius.

= 1.5.12 =
- Fixed: Security issue.

= 1.5.11 =
- Added: Important codes for the Freemius switch.

= 1.5.10 =
- Fixed: Errors issue with the updater.php file.

= 1.5.8 =
- Tweak: Gutenberg support removed for the My Library post type to avoid conflict with Ocean Hooks.

= 1.5.7 =
- Added: Gutenberg support.

= 1.5.6 =
- Added: Some codes for an upcoming release.

= 1.5.5 =
- Tweak: Small improvement on the setup wizard.

= 1.5.4 =
- Tweak: Import demo improved.

= 1.5.3 =
- Fixed: White screen error with older PHP version.

= 1.5.2 =
- Fixed: White screen error.

= 1.5.1 =
- Added: Meta tags directly added to this plugin as it is not allowed in a theme.

= 1.5.0 =
- Added: Setup Wizard to help you to create very easily your website.
- Tweak: You can now select a post type for the [oceanwp_search] shortcode.
- Tweak: The WooCommerce shortcodes take into account the taxes calculation if activated.
- Fixed: Import issue with the contact form of the demos.
- Fixed: WPML issue to translate pages.
- Fixed: The MailChimp and Social Share JS files are now only loaded if the widgets are used on a post.
- Removed: First box in Theme Panel sidebar.

= 1.4.29 =
- Tweak: Some tweaks for an upcoming big update.

= 1.4.28 =
- Tweak: Notices will not be displayed if Ocean White Label is used (you don't need to update if you don't use this white label plugin).

= 1.4.27 =
- Added: Dismiss button for the theme panel rating box so you can easily remove it.

= 1.4.26 =
- Fixed: Missing CSS issue.

= 1.4.25 =
- Tweak: Contact Forms 7 replaced by WPForms for all free demos, which is a much better and flexible form plugin.

= 1.4.24 =
- Fixed: Issue with the [oceanwp_woo_free_shipping_left} shortcode.

= 1.4.23 =
- Fixed: White screen if PHP under 5.6 is used.

= 1.4.22 =
- Tweak: Slick script in Theme Panel > Scripts & Styles.

= 1.4.21 =
- Fixed: Issue with the About Me widget in the customizer.

= 1.4.20 =
- Added: New setting in OceanWP Settings to select a custom footer per page/post.
- Tweak: Sticky Header notice automatically removed if one premium extension is activated.

= 1.4.19 =
- Tweak: New setting for the Custom Menu widget to allow you to open the sub menus at the parent link hover or via an icon click.

= 1.4.18 =
- Fixed: issue with some shortcodes and Yoast SEO.

= 1.4.17 =
- Tweak: Theme Panel sidebar improved.

= 1.4.16 =
- Fixed: Social Share widget not displayed in the widget page.

= 1.4.15 =
- Added: New widget Social Share. 
- Added: New premium extension Full Screen in the extensions page.

= 1.4.14 =
- Added: New premium extension "Ocean Cookie Notice" in the Extensions admin page. 

= 1.4.13 =
- Tweak: MailChimp widget improved, you just need to add your MailChimp API Key and List ID in Theme Panel > Integration, and the form will don't redirect anymore.

= 1.4.12 =
- Added: Typography settings for the Menu in the OceanWP Settings metabox.
- Removed: Push Monkey integration, if you used it in the Theme Panel, you just need to install the official plugin: https://wordpress.org/plugins/push-monkey-desktop-push-notifications/

= 1.4.11 =
-Tweak: Theme Panel edited.

= 1.4.10 =
-Tweak: OceanWP dashboard widget display the theme version.

= 1.4.9 =
-Added: OceanWP News & Updates widget in the WordPress dashboard so you can see the latest news of the theme.
-Tweak: Licenses tab moved to an admin panel, more easier to access, Theme Panel > Licenses.
-Fixed: Color picker that close on Safari browser.
-Fixed: $hashtag and $blocked_users user variables not defined for the Instagram widget.
-Fixed: Mini cart issue on the Cart and Checkout page if the woo cart icon shortcode is used.

= 1.4.8 =
-Added: Switch button to easily check or un-check every script for the Scripts & Styles page.
-Added: Upload setting for the Instagram widget if you want to add a profile picture, as it is not possible anymore to get it from the username.
-Fixed: Instagram widget issue "Images not found".

= 1.4.7 =
-Fixed: Error in Theme Panel > Extensions.

= 1.4.6 =
-Fixed: 500 error on PHP 5.4.

= 1.4.5 =
-Tweak: The activation/deactivation of the scripts and styles work on every hosts now.
-Removed: Wishlist icon shortcode, with the TI WooCommerce Wishlist plugin you can use their "[ti_wishlist_products_counter]" shortcode, so if you use the theme shortcode, you need to replace it.
-Removed: Rec. Plugins in Theme Panel, it can be confusing for new users.

= 1.4.4 =
- Added: Cart icon shortcode.
- Added: Wishlist icon shortcode.
- Added: Twiiter widget.
- Fixed: Menu icons issue.
- Fixed: Font Awesome and Simple Line Icons styles was not disabled if no other styles was not un-checked.

= 1.4.3 =
- Added: Popup Login extension in Theme Panel > Extensions.

= 1.4.2 =
- Added: Core Extensions Bundle block in Theme Panel > Licenses, so now, you just need to add one license to activate all premium extensions.
- Fixed: Theme Panel issue with PHP 5.6.

= 1.4.1 =
- Fixed: Scripts & Styles issue on the Theme Panel page.
- Fixed: Licenses issue on mulsite, now you can enable your premium extensions licenses for all your subsites.

= 1.4.0 =
- Added: Integration with Push Monkey, see Theme Panel > Push Notifications.
- Added: Instagram and White Label extensions added in the extensions tab.
- Added: New options for the Contact Info widget to add a target to the links.
- Tweak: Better approch for the Scripts & Styles, now the files are automatically updated after the theme update, no need to do it manually.
- Fixed: Icons issue of the contact info widget on RTL.

= 1.3.10 =
- Fixed: Small issue on the Scripts & Styles page.

= 1.3.9 =
- Added: New fields in the Contact Info widget to allow you to add a URL for the Address, Phone and Mobile fields.
- Added: Three styles for the Contact Info widget, default, big icons and no icons.
- Deleted: Post tab in the OceanWP Settings metabox if it is not the Post post type.
- Deleted: Admin notice if OceanWP is not the theme used.

= 1.3.8 =
- Added: Color fields in the Social Icons widget.
- Added: Custom JS textarea in the customizer.
- Fixed: Issue with the breadcrumb shortcode in the elementor editor mode.
- Fixed: Issue with the color control on the OceanWP Settings metabox.
- Fixed: Issue with the Magnific Popup script when you disable a script in the Scripts and Styles page with external plugins who are using the same script.
- Fixed: Save button for the About Me and Social widgets.

= 1.3.7 =
- Fixed: Issue with some admin pages style.

= 1.3.6 =
- Added: Spanish language, thanks to Angel Julian Mena.
- Added: Filter to remove the admin notice to get Ocean Hooks.
- Tweak: The fields to enter your licenses key are now hidden so you can use them for your customers..
- Fixed: Page header, page header heading and breadcrumb issue if there disabled in the customizer and you want enable them per page/post.

= 1.3.5 =
- Added: OceanWP Settings metabox in Anywhere Elementor post type.

= 1.3.4 =
- Fixed: 500 error issue if you use an outdated OceanWP version.

= 1.3.3 =
- Added: New "Both Sidebars" layout in OceanWP Settings.
- Added: New option in OceanWP Settings to select a header per page/post, the header style options need to be set via the customizer.
- Added: New options in OceanWP Settings to add a different logo and retina logo per page/post.
- Added: New options in OceanWP Settings to add a different max width and max height for your logo per page/post.
- Added: New options in OceanWP Settings to add different parent menu items color per page/post.
- Added: New options in the Title tab in OceanWP Settings to disable the page title heading per page/post.
- Added: New shortcode to display the breadcrumb where you want: [oceanwp_breadcrumb].
- Added: Parallax Footer script in Theme Panel > Scripts & Styles, so you can disable it.
- Tweak: Scripts and styles files path.

= 1.3.2 =
- Added: Capabilities for the OceanWP Settings metabox with "manage_options" by default, you can change it with the "ocean_main_metaboxes_capabilities" filter.
- Tweak: Now you can add HTML code in the text field of the About Me widget.

= 1.3.1 =
- Fixed: Transparent header style issue in the edit mode of elementor.
- Fixed: Blog entries CSS issue.

= 1.3.0 =
- Added: Shortcode in the My Library post type, now you can create a template via this post type and insert it where you want via the Shortcodes tab of the OceanWP Settings metabox, work with any page builder.
- Added: Links Effect style in Scripts & Styles.

= 1.2.10 =
- Added: New "My Library" tab in Theme Panel, this post type will be used for your custom header, custom footer, custom error page, etc... The old way (pages select) still work but it is better to import your content directly into this new post type.
- Added: French translation, thanks a lot to Jean of freepixel.net.
- Tweak: Your posts can be displayed on the Recent Posts widget even if there is no thumbnails.
- Tweak: Improvement for the Scripts & Styles feature. If you see that your site's CSS is malfunctioning, go to your WordPress dashboard, click Theme Panel > Scripts & Styles, and click Save Changes. This will create a new JS and CSS files if you have disabled an JS or CSS field.

= 1.2.9 =
- Added: Portfolio extension in the Extensions tab.

= 1.2.8 =
- Fixed: Issue with the top bar menu with the center header style.

= 1.2.7 =
- Added: New Typography control for the metabox to use it in extensions.
- Fixed: JS error with the Fixed Footer script.

= 1.2.6 =
- Added: Admin notice.
- Tweak: Some code improvements.

= 1.2.5 =
- Fixed: Double lighbox icon on the single product images.

= 1.2.4 =
- Tweak: Code improvements for the metabox.

= 1.2.3 =
- Added: Ajax for the [oceanwp_woo_free_shipping_left] shortcode, now when you'll add a product on your cart, the free shipping left amount will updated automatically.
- Added: Review box instead of the affiliate box.

= 1.2.2.3 =
- Fixed: Mobile menu with the Custom Header Nav widget.

= 1.2.2.2 =
- Deleted: Customizer unnecessary sections.

= 1.2.2.1 =
- Fixed: Theme Panel issue.
- Fixed: Issue when disabling Font Awesome and Simple Line Icons, did not work anymore.

= 1.2.2 =
- Added: New way to add an icon for your menu items, now you can see available icons, change the size, put your icon before/after or above text, hide text, etc.
- Added: New "Rec. Plugins" tab in Theme Panel to easily allow you to install recommended plugins.
- Added: New "Shortcodes" tab in the OceanWP Settings metabox to allow you to add shortcodes before/after elements.
- Added: New "Breadcrumbs" tab and fields in the OceanWP Settings metabox to show/hide and customizer the breadcrumbs per page/post.
- Added: New WooCommerce shortcode "[oceanwp_woo_total_cart]" to display the total amount of your cart.
- Added: New WooCommerce shortcode "[oceanwp_woo_cart_items]" to display the total items number of your cart.
- Added: New WooCommerce shortcode "[oceanwp_woo_free_shipping_left]" to display the amount left to get free shipping.
- Fixed: Issue when you add the OceanWP widgets in your page with Elementor.
- Fixed: Issue with disabling customizer's panels via Theme Panel, if you have disabled customizer panels, you have to do it again, sorry for that.
- Fixed: Issue when you add HTML code in the content of the contact info widget.
- Tweak: Improved Theme Panel page.
- Tweak: Improved Extensions admin page.

= 1.2.1.2 =
- Fixed: WooCommerce CSS updated to fix the small issue with the products categories images.

= 1.2.1.1 =
- Fixed: Small issue with some scripts.

= 1.2.1 =
- Added: Scripts Panel tab to allow you to enable or disable any scripts from the theme to improve your loading speed, thank you a lot to Steeve Lefebvre for helping me with this.
- Added: New shortcode "[oceanwp_current_user]", see the [documentation](http://docs.oceanwp.org/article/433-oceanwpcurrentuser-shortcode).
- Added: Tags cloud widget, now you can add your own style (background, color, font size, text-transform, etc...).
- Tweak: Layouts names modified, from No Sidebar to Full Width and Full Screen to 100% Full Width.
- Fixed: Small issue with the Custom Menu widget.
- Deleted: oceanwp_insta_square image size, no need anymore.

= 1.2.0.1 =
- Fixed: Small issue with the post type select in the recent post widget.

= 1.2.0 =
- Added: All widgets have been added in this plugin because some things are not allowed in a theme.

= 1.1.9 =
- Added: New shortcodes: [see the documentation](http://docs.oceanwp.org/category/369-shortcodes)
- Tweak: The [ocean_logo] and [ocean_nav] shortcodes have changed to [oceanwp_logo] and [oceanwp_nav], so if you use its shortcodes on your site, you need to update them.

= 1.1.8 =
- Added: New fields to add image attributs for the background image of the page header.
- Added: Dynamic date shortcode: [see the documentation](http://docs.oceanwp.org/article/367-add-a-dynamic-date-in-the-footer-bottom)

= Added: 1.1.7 =
- Added: Ocean Sticky Footer in the extension tab.
- Tweak: Improvement of the licenses fields.

= 1.1.6 =
- Tweak: Select2 script replaced by Selective to prevent conflict.

= 1.1.5.1 =
- Fixed: Error 500 fixed.

= 1.1.5 =
- Added: Ocean Modal Window added in the extension tab.
- Fixed: Issue with select on the admin product page.

= 1.1.4.2 =
- Tweak: Color picker script moved to use it in all metaboxes.

= 1.1.4.1 =
- Tweak: Admin script loaded only when necessary.

= 1.1.4 =
- Fixed: Import issue with WordPress 4.7.1/4.7.2 bug affecting uploads.

= 1.1.3 =
- Added: New "Sidebar" section in the Theme Panel.
- Added: New "Ocean Hooks" and "Ocean Posts Slider" extensions in the extensions tab.
- Deleted: Posts Slider shorcode from this plugin, added directly into the free Ocean Posts Slider extension.

= 1.1.2 =
- Added: New settings to enabled/disabled the top bar, header, footer widgets and footer bottom per page or per post.
- Tweak: Large improvement of metabox options.

= 1.1.1 =
- Added: OceanWP Settings into the Library post type of Elementor.
- Added: Shortcodes for the custom header (available in OceanWP 1.1.1).

= 1.1.0 =
- Added: RTL support for the metaboxes.
- Added: Support OceanWP 1.1.
- Deleted: Custom CSS tab (Since version 1.0.9 the CSS is imported directly into the customizer).

= 1.0.9 =
- Tweak: Improvement of referral urls for affiliation.

= 1.0.8 =
- Added: New field in the Title tab in the metabox to add a custom color to the overlay title.
- Tweak: Improved style for the Import/Export tab.

= 1.0.7 =
- Added: New "Ocean Demo Import" extension in the extensions tab.

= 1.0.6 =
- Tweak: Improvement exporter settings.

= 1.0.5 =
- Added: New import/export tab to easily import or export your settings.

= 1.0.4 =
- Tweak: Modified capability to manage options for the Custom CSS tab.

= 1.0.3 =
- Added: New field in the OceanWP Settings meta box to add an overlay to the background image title.

= 1.0.2 =
- Added: New "Custom Sidebar" extension in the extensions tab.
- Added: New field in the Main tab in the metabox to add shorcode to the top of the page.
- Added: Posts Slider shortcode, see the documentation for more infos.

= 1.0.1 =
- Added: Add documentation link in the panel.

= 1.0.0 =
- Initial release.