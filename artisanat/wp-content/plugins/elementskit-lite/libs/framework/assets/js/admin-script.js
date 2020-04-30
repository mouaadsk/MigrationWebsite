jQuery(document).ready(function ($) {
    "use strict";
    
    function EkitAdminonHashChange() {
        var hash = window.location.hash;
        if (hash) {
            // using ES6 template string syntax
            $(`${hash}-tab`).trigger('click');
        }
    }
    EkitAdminonHashChange();

    $('#ekit-admin-settings-form').on('submit', function(e){
        var form = $(this);
        var btn = form.find('.ekit-admin-settings-form-submit');
        var formdata = form.serialize();
        form.addClass('is-loading');
        btn.attr("disabled", true);

        $.post( ajaxurl + '?action=ekit_admin_action', formdata, function( data ) {
            form.removeClass('is-loading');
            btn.removeAttr("disabled");
            show_header_footer_menu();
        });

        e.preventDefault();
    });

    $('.ekit-content-type-pro ').on( 'click', function(e){
        e.preventDefault();
    });

    // only for header footer module
    function show_header_footer_menu(){
        var checked = $('#ekit-admin-switch__module__list____header-footer').prop('checked');
        var menu_html = $('#elementskit-template-admin-menu').html();
        var menu_parent = $('#toplevel_page_elementskit .wp-submenu');
        var menu_item = menu_parent.find('a[href="edit.php?post_type=elementskit_template"]');
        
        if(checked == true){
            if(menu_item.length > 0 || menu_parent.attr('item-added') == 'y'){
                menu_item.parent().show();
            }else{
                menu_parent.find('li.wp-first-item').after(menu_html);
                menu_parent.attr('item-added', 'y');
            }
        }else{
            menu_item.parent().hide();
        }
    };

    $('#elementskit_go_pro_modal').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'));
        myModal.data('hideInterval', setTimeout(function(){
            myModal.find('.close').click();
        }, 5000));
    });

}); // end ready function